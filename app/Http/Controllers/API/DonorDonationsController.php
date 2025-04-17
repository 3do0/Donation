<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CurrencyRate;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonorDonationsController extends Controller
{

    public  function donorSummary()
    {
        $donor = Auth::guard('donor')->user();
        if (!$donor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $currencyRates = CurrencyRate::pluck('rate', 'currency_code')->toArray();
        $donorDonations = Donation::where('donor_id', $donor->id)
            ->get()
            ->sum(function ($donation) use ($currencyRates) {
                $rate = $currencyRates[$donation->currency] ?? 1;
                return $donation->total_amount * $rate;
            });

        $donorDonationsCount = Donation::where('donor_id', $donor->id)->count();
        return response()->json([
            'donorDonationsAmount' => $donorDonations,
            'donorDonationsCount' => $donorDonationsCount,
        ]);
        
    }
    public function donorDonations()
{
    $donor = Auth::guard('donor')->user();
    if (!$donor) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $donations = Donation::where('donor_id', $donor->id)
                         ->with('items' , 'donor') 
                         ->get();

                         $data = $donations->map(function ($donation) {
                            return [
                                'transaction_id' => $donation->id,
                                'total_amount' => $donation->total_amount,
                                'currency' => $donation->currency ?? 'YER',
                                'donor_name' => $donation->donor->name,
                                'payment_method' => $donation->payment_method,
                                'donated_at' => $donation->created_at->format('Y-m-d H:i'),
                                'status' => $donation->status,
                                'items' => $donation->items->map(function ($item) {

                                    if ($item->donatable_type === \App\Models\OrganizationCase::class) {
                                        return [
                                            'type' => 'تبرع لحالة',
                                            'case_id' => $item->donatable_id?? null,
                                            'case_name' => $item->donatable->case_name?? null,
                                            'case_photo' => asset('storage/' .  $item->donatable->case_photo) ?? null,
                                            'amount' => $item->amount,
                                        ];
                                    }

                                    if ($item->donatable_type === \App\Models\PlatformDonation::class) {
                                        return [
                                            'type' => 'مساهمة للمنصة',
                                            'amount' => $item->amount,
                                        ];
                                    }
                    
                                    return [
                                        'type' => 'غير معروف',
                                        'amount' => $item->amount,
                                    ];
                                }),
                            ];
                        });
                    
                        return response()->json([
                            'donations' => $data,
                        ]);

}
}
