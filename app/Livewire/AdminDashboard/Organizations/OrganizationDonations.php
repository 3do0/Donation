<?php

namespace App\Livewire\AdminDashboard\Organizations;

use App\Models\CurrencyRate;
use App\Models\Donation;
use App\Models\Organization;
use App\Models\OrganizationCase;
use Livewire\Component;

class OrganizationDonations extends Component
{
    public $organizations;
    public$currencyRates;

    
    public function mount()
    {
        $this->currencyRates= CurrencyRate::pluck('rate', 'currency_code')
        ->mapWithKeys(fn($rate, $code) => [strtoupper($code) => $rate])
        ->toArray();
        $this->refreshDonations();
    }

    public function refreshDonations()
    {
        $this->organizations = Organization::with([
            'users.cases.donationItems.donation.donor',
            'users.cases.donationItems.donatable',
        ])->where('approval_status', true)->latest()->get();
        
        
    }
    public function render()
    {
        return view('livewire.admin-dashboard.organizations.organization-donations')->layout('layouts.app');
    }
}
