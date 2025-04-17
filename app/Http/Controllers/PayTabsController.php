<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class PayTabsController extends Controller
{
    public function payment(){
        $cartId = uniqid(); // رقم فريد لكل طلب
        $pay = paypage::sendPaymentCode('all')
        ->sendTransaction('sale', 'ecom')
        ->sendCart($cartId, 1000, 'test')
        ->sendCustomerDetails(auth()->user()->name, auth()->user()->email, auth()->user()->phone , 'test', 'Nasr City', 'Cairo', 'EG', '1234', '100.279.20.10')
        ->sendShippingDetails(auth()->user()->name, auth()->user()->email, auth()->user()->phone , 'test', 'Nasr City', 'Cairo', 'EG', '1234', '100.279.20.10')
        ->sendURLs(url('/return'), url('/callback')) // استخدم الروابط الفعلية هنا
        ->sendLanguage('en')
        ->create_pay_page();
        return $pay;
    }

    public function callback(){
        $paymentRef = request('tranRef');

    $response = paypage::queryTransaction($paymentRef);

    if ($response->payment_result->response_status === 'A') {
        return 'تم الدفع بنجاح!';
    } else {
        return 'فشل الدفع!';
    }
    }
}
