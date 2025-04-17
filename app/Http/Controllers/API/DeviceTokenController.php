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
            'token' => 'required|string',
        ]);
    
       
        DeviceToken::updateOrCreate(
            ['token' => $request->token],
            ['donor_id' => auth()->id()] // أو null إذا ما فيه تسجيل دخول
        );
    
        return response()->json(['status' => 'Token stored successfully']);
    }
    
    
}



// composer require kreait/laravel-firebase
// php artisan vendor:publish --provider="Kreait\Laravel\Firebase\ServiceProvider" --tag=config
// composer require google/apiclient
// composer require laravel/sanctum 
// composer require ichtrojan/laravel-otp
// composer require guzzlehttp/guzzle   
