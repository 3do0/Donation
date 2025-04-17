<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Donor extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'donors';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'avatar',
        'password',
        'gender',
        'country',
        'is_online',
        'otp_expires_at',
        'otp'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'email_verified_at',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function donorfeedbacks(): HasMany
    {
        return $this->hasMany(DonorFeedback::class);
    }

    public function deviceToken(){
        return $this->belongsTo(DeviceToken::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
}
