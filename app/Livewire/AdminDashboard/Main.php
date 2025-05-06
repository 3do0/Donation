<?php

namespace App\Livewire\AdminDashboard;

use App\Models\DeviceToken;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Donor;
use App\Models\OrganizationCase;
use App\Models\PlatformDonation;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Main extends Component
{

   public $topThreeCases = []; 
   public $totalDonations = 0;
   public $DonorsCount = 0;
   public $CasesCount = 0;
   public $DonationsCount= 0;
   public $platform_balance;
   public $visiors = 0;
   public $dailyVisitors = [];
   public $dailyDonors = [];
   public $dailyCases = [];
   public $dailyDonations = [];
   public $monthlyVisits, $monthlyDonations;
   



    // #[On('CaseRequestResponding')]
    // #[On('NewDonation')]
    // #[On('ProjectRejection')]
   public function refreshComponents() {
    $this->totalDonations = Donation::sum('total_amount');
    $this->DonationsCount = Donation::count();
    $this->DonorsCount = Donor::count();
    $this->CasesCount = OrganizationCase::count();
    
    $this->platform_balance = DonationItem::with('donation')->where('donatable_type', PlatformDonation::class)->sum('amount');

    $this->topThreeCases = OrganizationCase::with('organization_user.organization', 'donationItems')
    ->orderByDesc('raised_amount')
    ->take(3)
    ->get();

    $this->visiors = DeviceToken::count();

    $this->dailyVisitors = collect(range(0, 9))->map(function ($i) {
        $date = Carbon::today()->subDays($i);
        return DeviceToken::whereDate('created_at', $date)->count();
    })->reverse()->values()->toArray();

    $this->dailyDonors = collect(range(0, 9))->map(function ($i) {
        $date = Carbon::today()->subDays($i);
        return Donor::whereDate('created_at', $date)->count();
    })->reverse()->values()->toArray();

    $this->dailyCases = collect(range(0, 9))->map(function ($i) {
        $date = Carbon::today()->subDays($i);
        return OrganizationCase::whereDate('created_at', $date)->count(); 
    })->reverse()->values()->toArray(); 

    $this->dailyDonations = collect(range(0, 9))->map(function ($i) {
        $date = Carbon::today()->subDays($i);
        return Donation::whereDate('created_at', $date)->sum('total_amount'); 
    })->reverse()->values()->toArray();

    $months = collect(range(1, 12));

    $this->monthlyVisits = $months->map(function ($month) {
        return OrganizationCase::whereMonth('created_at', $month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
    })->values()->toArray();

    $this->monthlyDonations = $months->map(function ($month) {
        return Donation::whereMonth('created_at', $month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count(); 
    })->values()->toArray();
    
       
    $this->dispatch('donorsData', ['donors' => $this->dailyDonors]);
    $this->dispatch('visitorsData', ['visitors' => $this->dailyVisitors]);
    $this->dispatch('CasesData', ['cases' => $this->dailyCases]);
    $this->dispatch('DonationsData', ['donations' => $this->dailyDonations]);
    $this->dispatch('visitsAndDonationsData', ['visitors' => $this->monthlyVisits , 'donations' => $this->monthlyDonations]);
   }

   public function mount() {
       $this->refreshComponents();
       

   }    
    public function render()
    {
        return view('livewire.admin-dashboard.main')->layout('layouts.app');
    }
}
