<?php

namespace App\Livewire\AdminDashboard\Cases;

use App\Models\Donation;
use App\Models\OrganizationCase;
use Livewire\Component;

class CaseDonations extends Component
{

    public $cases;
    public function mount()
    {
        $this->cases = OrganizationCase::with('organization_user.organization' , 'donationItems')->get(); 
    }

    public function render()
    {
        return view('livewire.admin-dashboard.cases.case-donations')->layout('layouts.app');
    }
}
