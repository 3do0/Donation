<?php

namespace App\Livewire\AdminDashboard\Organizations;

use Livewire\Component;

class OrganizationsIndex extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard.organizations.organizations-index')->layout('layouts.app');
    }
}
