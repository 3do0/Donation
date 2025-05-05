<?php

namespace App\Livewire\AdminDashboard\Cases;

use App\Models\Donation;
use App\Models\OrganizationCase;
use Livewire\Attributes\On;
use Livewire\Component;

class CaseDonations extends Component
{

    public $cases;

    #[On('CaseRequestResponding')]
    #[On('NewDonation')]

    public function refreshCases()
    {
        $this->cases = OrganizationCase::with('organization_user.organization' , 'donationItems')->latest()->get(); 
    }

    public function mount()
    {
        $this->refreshCases();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.cases.case-donations')->layout('layouts.app');
    }
}
