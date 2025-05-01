<?php

namespace App\Services;

use App\Models\CurrencyRate;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;

class CurrencyService
{
    public function fetchAndStoreRates()
    {
        $url = 'https://ye-rial.com/'; 

        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);

            if ($response->getStatusCode() !== 200) {
                Log::error("حدث خطأ في جلب البيانات: " . $response->getStatusCode());
                return false;
            }

            $html = $response->getContent();

            $crawler = new Crawler($html);

            $currency = $crawler->filter('td')->each(function (Crawler $node) {
                return $node->text();
            });

            Log::info("البيانات المستخلصة: ", $currency);
            $usdBuy = null;
    $sarBuy = null;

    for ($i = 0; $i < count($currency); $i += 3) {
        $name = $currency[$i];

        if (str_contains($name, 'دولار أمريكي') && !$usdBuy) {
            $usdBuy = str_replace(',', '', $currency[$i + 1]);
        }

        if (str_contains($name, 'ريال سعودي') && !$sarBuy) {
            $sarBuy = str_replace(',', '', $currency[$i + 1]);
        }

        if ($usdBuy && $sarBuy) {
            break;
        }
    }

    $currencyData = [
        ['currency_name' => 'دولار أمريكي', 'currency_code' => 'USD', 'rate' => $usdBuy],
        ['currency_name' => 'ريال سعودي', 'currency_code' => 'SAR', 'rate' => $sarBuy],
    ];

    foreach ($currencyData as $data) {
        CurrencyRate::updateOrCreate(
            ['currency_name' => $data['currency_name']],
            ['currency_code' => $data['currency_code'], 'rate' => $data['rate']]
        );
    }

            return true;

        } catch (\Exception $e) {
            Log::error("خطأ أثناء جلب البيانات: " . $e->getMessage());
            return false;
        }
    }
}


