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
            ['token' => $request->device_token],
        );
    
        return response()->json(['status' => 'تم تسجيل الجهاز بنجاح'], 200);
    }
    
    
}



