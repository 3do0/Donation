<?php

namespace App\Livewire\AdminDashboard\Donations;

use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\PlatformDonation;
use Livewire\Component;

class PlatformDonationsList extends Component
{
    public $donations;

    public function refreshDonations()
    {
        $this->donations = DonationItem::with('donation')->where('donatable_type', PlatformDonation::class)->latest()->get();
    }
    public function mount()
    {
        $this->refreshDonations();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.donations.platform-donations-list')->layout('layouts.app');
    }
}
