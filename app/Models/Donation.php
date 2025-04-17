<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';

    protected $fillable = [
        'donor_id',
        'guest_name',
        'guest_email',
        'total_amount',
        'currency',
        'payment_method',
        'transaction_id',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'string', 
    ];


    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
    
    public function items()
    {
        return $this->hasMany(DonationItem::class);
    }
}
