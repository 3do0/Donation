<?php

namespace App\Livewire\AdminDashboard\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{

    public function render()
    {
        return view('livewire.admin-dashboard.roles.roles-index')->layout('layouts.app');
    }
}
