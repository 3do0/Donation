<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OrganizationCaseRequest extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'organization_case_requests';

    protected $fillable = [
        'organization_user_id', 
        'case_name',
        'case_photo',
        'case_file',
        'case_type',
        'beneficiaries_count',
        'description',
        'currency',
        'target_amount',
        'approval_status',
        'rejection_reason',
        'user_id',
        'reviewed_at',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'organization_user_id', 
                'case_name',
                'case_photo',
                'case_file',
                'case_type',
                'beneficiaries_count',
                'description',
                'currency',
                'target_amount',
                'approval_status',
                'rejection_reason',
                'user_id',
                'reviewed_at',
                ])
            ->useLogName('organization_case_requests')     
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs() 
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}"); 
    }

    
    public function organization_user() :BelongsTo
    {
        return $this->belongsTo(OrganizationUser::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // protected $dates = ['reviewed_at'];

}
