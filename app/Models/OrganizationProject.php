<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class OrganizationProject extends Model
{
    protected $fillable = [
        'organization_user_id',
        'project_name',
        'project_photo',
        'project_file',
        'project_type',
        'beneficiaries_count',
        'description',
        'location',
        'contact_number',
        'whatsapp_number',
        'end_date',
        'status',
        'user_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'end_date' => 'datetime',
    ];


    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(DonorFeedback::class, 'feedbackable');
    }


    public function organization_user() :BelongsTo
    {
        return $this->belongsTo(OrganizationUser::class);
    }
}
