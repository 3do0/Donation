<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id', 'title', 'message', 'is_read', 'type'
    ];
    public function donor(){
        return $this->belongsTo(Donor::class);
    }
}
