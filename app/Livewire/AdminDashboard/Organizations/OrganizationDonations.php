<?php

namespace App\Livewire\AdminDashboard\Organizations;

use App\Models\Donation;
use Livewire\Component;

class OrganizationDonations extends Component
{
    public $donations;
    public function mount()
    {
        $this->refreshDonations();
    }

    public function refreshDonations()
    {
        $this->donations = Donation::with('items', 'donor' ,)->latest()->get();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.organizations.organization-donations')->layout('layouts.app');
    }
}
