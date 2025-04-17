<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformDonation extends Model
{
    protected $table = 'platforms'; 
    public $timestamps = false;

    public function getTable()
    {
        return 'platforms';
    }
}
