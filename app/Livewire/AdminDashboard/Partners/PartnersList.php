<?php

namespace App\Livewire\AdminDashboard\Partners;

use App\Models\Partner;
use Livewire\Component;

class PartnersList extends Component
{

    public $partners;

    public function refreshPartners()
    {
        $this->partners = Partner::get();
    }

    public function mount()
    {
        $this->refreshPartners();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.partners.partners-list');
    }
}
