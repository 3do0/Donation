<?php

namespace App\Livewire\AdminDashboard;

use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Donor;
use App\Models\OrganizationCase;
use App\Models\PlatformDonation;
use Livewire\Component;

class Main extends Component
{

   public $topThreeCases = []; 
   public $totalDonations = 0;
   public $DonorsCount = 0;
   public $CasesCount = 0;
   public $DonationsCount= 0;
   public $platform_balance;

   public function mount() {
    $this->totalDonations = Donation::sum('total_amount');
    $this->DonationsCount = Donation::count();
    $this->DonorsCount = Donor::count();
    $this->CasesCount = OrganizationCase::count();
    
    $this->platform_balance = DonationItem::with('donation')->where('donatable_type', PlatformDonation::class)->sum('amount');

    $this->topThreeCases = OrganizationCase::with('organization_user.organization', 'donationItems')
    ->orderByDesc('raised_amount')
    ->take(3)
    ->get();
   }    
    public function render()
    {
        return view('livewire.admin-dashboard.main')->layout('layouts.app');
    }
}
