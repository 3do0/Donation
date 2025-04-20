<?php

namespace App\Http\Controllers;

use App\Models\CurrencyRate;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function getCurrencyRates()
    {
        $rates = CurrencyRate::get();

        return response()->json($rates);
    }
}
