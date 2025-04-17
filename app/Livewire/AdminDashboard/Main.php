<?php

namespace App\Livewire\AdminDashboard;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\OrganizationCase;
use Livewire\Component;

class Main extends Component
{
   public $totalDonations = 0;
   public $DonorsCount = 0;
   public $CasesCount = 0;
   public $DonationsCount= 0;

   public function mount() {
    $this->totalDonations = Donation::sum('total_amount');
    $this->DonationsCount = Donation::count();
    $this->DonorsCount = Donor::count();
    $this->CasesCount = OrganizationCase::count();
   }    
    public function render()
    {
        return view('livewire.admin-dashboard.main')->layout('layouts.app');
    }
}
