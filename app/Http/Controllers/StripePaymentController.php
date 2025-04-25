<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\OrganizationCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\DonationSuccessful;
use App\Models\CurrencyRate;
use App\Models\DonationItem;
use App\Models\Donor;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;

class StripePaymentController extends Controller
{

    public function CreateSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            if (!$request->has('items') || !is_array($request->items)) {
                return response()->json(['error' => 'الرجاء إرسال العناصر (items) بشكل صحيح'], 400);
            }

            $hasCase = false;
            foreach ($request->items as $item) {
                if (isset($item['case_number'])) {
                    $hasCase = true;
                    break;
                }
            }

            if (!$hasCase) {
                return response()->json(['error' => 'يجب أن يحتوي التبرع على حالة واحدة على الأقل'], 400);
            }

            $lineItems = [];

            foreach ($request->items as $item) {
                $metadata = [];

                if (isset($item['case_number'])) {
                    $case = OrganizationCase::find($item['case_number']);
                    if (!$case) {
                        return response()->json(['error' => 'معرف الحالة غير صحيح'], 404);
                    }
                    $metadata['case_number'] = $item['case_number'];
                }

                if (isset($item['donor_id'])) {
                    $donor = Donor::find($item['donor_id']);
                    if (!$donor) {
                        return response()->json(['error' => 'معرف المتبرع غير صحيح'], 404);
                    }
                    $metadata['donor_id'] = $item['donor_id'];
                }

                if (isset($item['is_platform']) && $item['is_platform']) {
                    $metadata['is_platform'] = 'true';
                }

                $lineItems[] = [
                    'price_data' => [
                        'currency' => strtolower($item['currency']),
                        'product_data' => [
                            'name' => $item['name'],
                            'metadata' => $metadata,
                        ],
                        'unit_amount' => $item['amount'] * 100,
                    ],
                    'quantity' => 1,
                ];
            }

            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => env('FRONTEND_URL') . '/payment-success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => env('FRONTEND_URL') . '/payment-failed',
            ]);

            return response()->json(['url' => $session->url]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function stripeWebhook(Request $request)
    {
        $endpoint_secret = env('STRIPE_WEBHOOK_SECRET'); 

        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');

        try {
            // التحقق من صحة التوقيع باستخدام Stripe
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (SignatureVerificationException $e) {
            // إذا كانت التوقيع غير صالح
            return response('Webhook signature verification failed.', 400);
        } catch (\Exception $e) {
            // التعامل مع الأخطاء الأخرى
            return response('Something went wrong.', 500);
        }

        // إذا كانت عملية التحقق ناجحة، قم بمعالجة الحدث
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                break;

            case 'payment_intent.created':
                $paymentIntent = $event->data->object;
                break;

            case 'charge.updated':
                $paymentIntent = $event->data->object;
                break;

            case 'charge.succeeded':
                $paymentIntent = $event->data->object;
                break;

            case 'checkout.session.completed':
                $session = $event->data->object;
                if ($session->payment_status === 'paid') {
                    $this->SuccessfulDonation($session);
                }
                break;

            case 'payment_intent.failed':
                $paymentIntent = $event->data->object;
                break;

            default:
                return response('Unhandled event type', 400);
        }

        return response('Webhook received', 200);
    }

    private function SuccessfulDonation($session)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $session->id;

        try {
            $paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
            $paymentMethodId = $paymentIntent->payment_method;
            $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
            $cardBrand = $paymentMethod->card->brand ?? 'Unknown';

            $lineItems = \Stripe\Checkout\Session::allLineItems(
                $sessionId,
                ['expand' => ['data.price.product']]
            );

            DB::beginTransaction();

            $firstItem = $lineItems->data[0];
            $firstProduct = $firstItem->price->product;
            $donorId = $firstProduct->metadata->donor_id ?? null;

            $donation = Donation::create([
                'donor_id' => $donorId,
                'guest_name' => null,
                'guest_email' => null,
                'total_amount' => $session->amount_total / 100,
                'currency' => $session->currency,
                'payment_method' => $cardBrand,
                'transaction_id' => $sessionId,
                'status' => 'paid',
            ]);

            $currencies = CurrencyRate::pluck('rate', 'currency_code')->toArray();

            foreach ($lineItems->data as $item) {
                $product = $item->price->product;
                $caseNumber = $product->metadata->case_number ?? null;
                $isPlatformDonation = $product->metadata->is_platform ?? false;

                if (!$caseNumber && !$isPlatformDonation) {
                    Log::error("❌ بيانات غير مكتملة في المنتج: " . $product->id);
                    continue;
                }

                if ($session->currency == 'usd') {
                    $convertedAmount = (($item->amount_total) * $currencies['USD']) / 100;
                } elseif ($session->currency == 'sar') {
                    $convertedAmount = (($item->amount_total) * $currencies['SAR']) / 100;
                } else {
                    $convertedAmount = $item->amount_total / 100;
                }

                if ($isPlatformDonation) {
                    DonationItem::create([
                        'donation_id' => $donation->id,
                        'donatable_type' => 'App\Models\PlatformDonation',
                        'donatable_id' => 1,
                        'amount' => $item->amount_total / 100,
                    ]);
                } else {
                    $case = OrganizationCase::find($caseNumber);
                    if (!$case) {
                        throw new \Exception("❌ الحالة غير موجودة: $caseNumber");
                    }

                    DonationItem::create([
                        'donation_id' => $donation->id,
                        'donatable_type' => OrganizationCase::class,
                        'donatable_id' => $case->id,
                        'amount' => $item->amount_total / 100,
                    ]);

                    $case->increment('raised_amount', $convertedAmount);
                    if ($case->raised_amount >= $case->target_amount) {
                        $case->update(['status' => 'completed']);
                    }
                }
            }

            $donor = Donor::find($donorId);
            if ($donor && !empty($donor->email)) {
                try {
                    $details = [
                        'donor_name' => $donor->name ?? 'متبرع مجهول',
                        'amount' => $donation->total_amount,
                        'currency' => $session->currency,
                        'case_number' => null,
                        'date' => $donation->created_at->format('Y-m-d'),
                    ];
                    Mail::to($donor->email)->send(new DonationSuccessful($details));
                    Log::info("📧 تم إرسال بريد تأكيد التبرع إلى: " . $donor->email);
                } catch (\Exception $e) {
                    Log::error("❌ فشل إرسال البريد إلى {$donor->email}: " . $e->getMessage());
                }
            }

            DB::commit();

            return response()->json([
                'message' => '✅ تمت إضافة التبرع بنجاح',
                'donation' => $donation
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("❌ فشلت المعاملة: " . $e->getMessage());
            return response()->json([
                'message' => '❌ حدث خطأ أثناء معالجة التبرع',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
