<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CurrencyRate;
use Illuminate\Http\Request;

class CurrencyConverterController extends Controller
{
    public function convertToYER(Request $request)
{
    $request->validate([
        'currency' => 'required|string|size:3',
    ]);

    $currency = CurrencyRate::where('currency_code', strtoupper($request->currency))->first();

    if (!$currency) {
        return response()->json([
            'message' => 'لا توجد عملة بهذا الرمز',
        ], 404);
    }

    return response()->json([
        'currency' => $currency->currency_code,
        'rate' => round((float) $currency->rate, 4),
    ]);
}


}
