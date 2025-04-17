<?php

namespace App\Console\Commands;

use App\Models\OrganizationCase;
use App\Models\OrganizationProject;
use Illuminate\Console\Command;

use function Symfony\Component\Clock\now;

class UpdateFininshedStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entities:update-finished';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force-finish any case/project whose end_date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = now();
        $this->updateModel(OrganizationCase::class, $now);
        $this->updateModel(OrganizationProject::class, $now);

        $this->info('تم تحديث جميع الحالات والمشاريع المنتهية.');

    }

    protected function updateModel(string $modelClass, $now)
    {
        $records = $modelClass::where('status', '!=', 'expired') 
            ->whereDate('end_date', '<=', $now)
            ->get();

        foreach ($records as $record) {
            $record->update(['status' => 'expired']);
        }

        $this->info("تم تحديث عدد {$records->count()} من " . class_basename($modelClass));
    }
}
