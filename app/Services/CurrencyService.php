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
        $url = 'https://ibyemen.com/ar/currency-rate'; 

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
            $currencyData = [
                ['currency_name' => 'دولار أمريكي', 'currency_code' => 'USD', 'rate' => $currency[3]],  
                ['currency_name' => 'ريال سعودي','currency_code' => 'SAR', 'rate' => $currency[7]],  
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


