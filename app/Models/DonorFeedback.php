<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonorFeedback extends Model
{
    protected $table = 'donor_feedback';
    protected $fillable=[
        'donor_id',
        'organization_case_id',
        'rating',
        'comment',
    ];

    public function donor() :BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }
    
    public function feedbackable()
    {
        return $this->morphTo();
    }
    

}
