<?php

namespace App\Livewire\OrganizationDashboard\Donations;

use Livewire\Attributes\On;
use Livewire\Component;

class DonationsList extends Component
{

    #[On('NewDonation')]
    public function updateTable()
    {
        $this->dispatch('organization-donation-table-g3u37v-table');
    }
    public function render()
    {
        return view('livewire.organization-dashboard.donations.donations-list')->layout('layouts.Organization_Dashboard.app');
    }
}
