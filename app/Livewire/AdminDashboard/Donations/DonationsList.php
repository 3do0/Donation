<?php

namespace App\Livewire\AdminDashboard\Donations;

use App\Models\Donation;
use Livewire\Component;

class DonationsList extends Component
{

    public $donations;


    public function mount()
    {
        $this->refreshDonations();
    }

    public function refreshDonations()
    {
        $this->donations = Donation::with('items', 'donor')->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.donations.donations-list')->layout('layouts.app');
    }
}
