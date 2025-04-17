<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Organization;
use App\Models\OrganizationCase;
use App\Models\Partner;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class TakafulPlatform extends Controller
{
    public function Statistics(){
        $totalDonationsCount = DonationItem::count();
        $totalDonations = Donation::sum('total_amount');
        $completedCases = OrganizationCase::where('status', 'completed ')->count();
        $activeCases = OrganizationCase::where('status', 'in_progress')->count();


        return response()->json([
            'totalDonationsCount' => $totalDonationsCount,
            'totalDonationsAmount' => $totalDonations,
            'completedCases' => $completedCases,
            'activeCases' => $activeCases
        ]);
        
    }

    public function TakafulPartners()
{
    $partners = Partner::select('name', 'logo')
        ->get()
        ->map(function ($partner) {
            return [
                'name' => $partner->name,
                'logo' => asset('storage/' . $partner->logo), 
                'web_url' => null,
            ];
        });

    $organizations = Organization::select('name', 'logo', 'web_url')->get()
        ->map(function ($organization) {
            return [
                'name' => $organization->name,
                'logo' => asset('storage/' . $organization->logo),
                'web_url' => $organization->web_url,
            ];
        });

    $merged = $partners->concat($organizations)->values();

    return response()->json($merged);
}
    
}
