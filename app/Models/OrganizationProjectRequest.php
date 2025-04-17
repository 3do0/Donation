<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationProjectRequest extends Model
{
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

    public function organization_user() :BelongsTo
    {
        return $this->belongsTo(OrganizationUser::class);
    }
}
