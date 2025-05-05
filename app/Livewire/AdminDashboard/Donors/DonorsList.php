<?php

namespace App\Livewire\AdminDashboard\Donors;

use App\Models\Donor;
use Livewire\Component;

class DonorsList extends Component
{
    public $donors;
    public $donorsCount;

    public function mount()
    {
        $this->refreshUsers();
    }

    public function refreshUsers()
    {
        $this->donors = Donor::get();
        $this->donorsCount = Donor::count();
    }

    public function toggleStatus($donorId)
    {
        $donor= Donor::find($donorId);

        if ($donor) {
            $donor->is_active = !$donor->is_active;
            $donor->save();
        }

        $this->refreshUsers();
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تمت عملية التغيير بنجاح !',
        ]);
    }
    
    public function render()
    {
        return view('livewire.admin-dashboard.donors.donors-list')->layout('layouts.app');
    }
}
