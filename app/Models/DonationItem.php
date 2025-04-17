<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationItem extends Model
{
    protected $fillable = [
        'donation_id',
        'donatable_type',
        'donatable_id',
        'amount',
    ];
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }

    public function donatable()
    {
        return $this->morphTo();
    }
}
