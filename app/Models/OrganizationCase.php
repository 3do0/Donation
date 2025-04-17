<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OrganizationCase extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'organization_cases';

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
        'raised_amount',
        'end_date',
        'status',
        'user_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'end_date' => 'datetime',
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
                'raised_amount',
                'end_date',
                'status',
                'user_id',
                ])
            ->useLogName('organization_cases')     
            ->logOnlyDirty() 
            ->dontSubmitEmptyLogs() 
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}"); 
    }


    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function donationItems(): MorphMany
    {
        return $this->morphMany(DonationItem::class, 'donatable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(DonorFeedback::class, 'feedbackable');
    }
    

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function organization_user() :BelongsTo
    {
        return $this->belongsTo(OrganizationUser::class);
    }
}
