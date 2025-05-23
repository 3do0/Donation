<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CurrencyService;

class UpdateCurrencyRates extends Command
{
    protected $signature = 'currency:update-rates';
    protected $description = 'جلب أسعار العملات وتحديثها من ibyemen.com';

    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();
        $this->currencyService = $currencyService;
    }

    public function handle()
    {
        info('جلب أسعار العملات وتحديثها من ibyemen.com');
        $result = $this->currencyService->fetchAndStoreRates();

        if ($result) {
            $this->info('تم تحديث أسعار العملات بنجاح.');
        } else {
            $this->error('حدث خطأ أثناء جلب البيانات.');
        }
    }
}
