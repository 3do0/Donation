<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Organization extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'logo',
        'address',
        'city',
        'activity_type',
        'registration_number',
        'bank_name',
        'bank_account_number',
        'license',
        'web_url',
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
                'address',
                'city',
                'activity_type',
                'registration_number',
                'bank_name',
                'bank_account_number',
                'license',
                'web_url',
                'status',
                ])
            ->useLogName('organizations')     
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs() 
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}"); 
    }
    
}
