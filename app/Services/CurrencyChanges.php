<?php

namespace App\Services;

use App\Models\CurrencyRate;
use Illuminate\Support\Facades\Cookie;

class CurrencyChanges
{
    protected $currency;
    protected $rates;

    public function __construct()
    {
        $this->currency = Cookie::get('currency', 'YER');
        $this->rates = CurrencyRate::pluck('rate', 'currency_code');
    }

    public function convert($amount)
    {
        if ($this->currency === 'YER') {
            return number_format($amount) . ' ' . '﷼ يمني';
        }

        $converted = $amount / $this->rates[$this->currency];
        return $this->format($converted, $this->currency);
    }

    private function format($amount, $currency)
    {
        $symbols = [
            'USD' => '$',
            'SAR' => '﷼ سعودي',
            'YER' => '﷼ يمني'
        ];

        return number_format($amount, 2) . ' ' . $symbols[$currency];
    }
}