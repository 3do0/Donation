<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Partner extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'partners'; 

    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
        'contract_file',
        'address',
        'type',
        'support_details',
        'donation_amount',
        'start_date',
        'end_date',
        'status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'email',
                'phone',
                'logo',
                'contract_file',
                'address',
                'type',
                'support_details',
                'donation_amount',
                'start_date',
                'end_date',
                'status',
            ])
            ->useLogName('partners') 
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}");
    }
}
