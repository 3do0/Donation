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

    public function toggleStatus($userId)
    {
        $partner = Partner::find($userId);

        if ($partner) {
            $partner->status = !$partner->status;
            $partner->save();
        }

        $this->refreshPartners();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.partners.partners-list');
    }
}
