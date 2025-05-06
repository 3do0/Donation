<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Report extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $fillable = ['file_path', 'organization_user_id'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['file_path', 'organization_user_id'])
            ->useLogName('organization_user_document')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName} organization user document");
    }
    

    public function reportable()
    {
        return $this->morphTo();
    }

    public function organization_user()
    {
        return $this->belongsTo(OrganizationUser::class);
    }
}
