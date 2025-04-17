<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    
    protected $fillable = ['file_path', 'organization_user_id'];

    public function reportable()
    {
        return $this->morphTo();
    }

    public function organization_user()
    {
        return $this->belongsTo(OrganizationUser::class);
    }
}
