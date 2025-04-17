<?php

namespace App\Livewire\AdminDashboard\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionsIndex extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard.permissions.permissions-index')->layout('layouts.app');
    }
}
