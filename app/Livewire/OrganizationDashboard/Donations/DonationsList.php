<?php

namespace App\Livewire\OrganizationDashboard\Donations;

use Livewire\Component;

class DonationsList extends Component
{
    public function render()
    {
        return view('livewire.organization-dashboard.donations.donations-list')->layout('layouts.Organization_Dashboard.app');
    }
}
