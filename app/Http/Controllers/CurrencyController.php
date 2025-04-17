<?php

namespace App\Http\Controllers;

use App\Models\CurrencyRate;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function getCurrencyRates()
    {
        // جلب جميع أسعار العملات من قاعدة البيانات
        $rates = CurrencyRate::whereIn('currency_name', ['ريال سعودي', 'دولار', 'ريال يمني'])->get();

        // إرجاع البيانات بتنسيق JSON
        return response()->json($rates);
    }
}
