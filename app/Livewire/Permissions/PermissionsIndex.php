<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionsIndex extends Component
{
    public function render()
    {
        return view('livewire.permissions.permissions-index')->layout('layouts.app');
    }
}
