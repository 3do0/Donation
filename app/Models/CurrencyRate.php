<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyRate extends Model
{
    use HasFactory;

    // تحديد الأعمدة القابلة للتحديث
    protected $fillable = ['currency_name','currency_code','rate'];
}
