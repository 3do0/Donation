<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CurrencyRate;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Organization;
use App\Models\OrganizationCase;
use App\Models\Partner;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TakafulPlatform extends Controller
{
    public function statistics()
    {
        $totalDonationsCount = DonationItem::count();

        $currencyRates = CurrencyRate::whereIn('currency_code', ['SAR', 'USD'])->pluck('rate', 'currency_code');

        $donationsByCurrency = Donation::select('currency', DB::raw('SUM(total_amount) as total'))
            ->groupBy('currency')
            ->pluck('total', 'currency');

        $yemeniRiyalDonations = $donationsByCurrency['yer'] ?? 0;
        $saudiRiyalDonations = ($donationsByCurrency['sar'] ?? 0) * ($currencyRates['SAR'] ?? 1);
        $usdDonations = ($donationsByCurrency['usd'] ?? 0) * ($currencyRates['USD'] ?? 1);

        $totalDonations = $yemeniRiyalDonations + $saudiRiyalDonations + $usdDonations;

        $caseCounts = OrganizationCase::select('status', DB::raw('count(*) as count'))
            ->whereIn('status', ['completed', 'in_progress'])
            ->groupBy('status')
            ->pluck('count', 'status');

        $completedCases = $caseCounts['completed'] ?? 0;
        $activeCases = $caseCounts['in_progress'] ?? 0;

        return response()->json([
            'totalDonationsCount' => $totalDonationsCount,
            'totalDonationsAmount' => $totalDonations,
            'completedCases' => $completedCases,
            'activeCases' => $activeCases,
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

        $organizations = Organization::where('status', 'approved')->select('name', 'logo', 'web_url')->get()
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
