<?php

namespace App\Livewire\AdminDashboard\Partners;

use App\Models\Partner;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
    
class PartnersList extends Component
{
    public $partners;

    #[On('partnerUpdated')]
    public function refreshPartners()
    {
        $this->partners = Partner::get();
    }

    public function editPart($id)
    {
        $this->dispatch('editpart', $id);
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

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تمت عملية التغيير بنجاح !',
        ]);

        $this->refreshPartners();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.partners.partners-list');
    }
}

