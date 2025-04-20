<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
   
  
    
    public function store(Request $request)
    {
        $request->validate([
            'device_token' => 'required|string',
        ]);
    
       
        DeviceToken::updateOrCreate(
            ['device_token' => $request->device_token],
            ['donor_id' => auth()->id()] 
        );
    
        return response()->json(['status' => 'تم تسجيل الجهاز بنجاح'], 200);
    }
    
    
}



// composer require kreait/laravel-firebase
// php artisan vendor:publish --provider="Kreait\Laravel\Firebase\ServiceProvider" --tag=config
// composer require google/apiclient
// composer require laravel/sanctum 
// composer require ichtrojan/laravel-otp
// composer require guzzlehttp/guzzle   
