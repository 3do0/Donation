<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OrganizationProjectRequest extends Model
{

    use LogsActivity;

    protected $fillable = [
        'project_name',
        'organization_user_id',
        'project_photo',
        'project_file',
        'beneficiaries_count',
        'description',
        'location',
        'contact_number',
        'whatsapp_number',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'project_name',
                'organization_user_id',
                'project_photo',
                'project_file',
                'beneficiaries_count',
                'description',
                'location',
                'contact_number',
                'whatsapp_number',
            ])
            ->useLogName('organization_project')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} organization project");
    }


    public function organization_user(): BelongsTo
    {
        return $this->belongsTo(OrganizationUser::class);
    }
}
