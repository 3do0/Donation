<?php

namespace App\Livewire\AdminDashboard\Partners;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PartnersIndex extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard.partners.partners-index')->layout('layouts.app');
    }
}
