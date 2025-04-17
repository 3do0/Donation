<?php

namespace App\Livewire\AdminDashboard\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionsList extends Component
{

    public $permissions;

    protected $listeners = [
        'deletePermission' => 'deletePermission' 
    ];
    

    public function confirmDelete($modaldata)
    {
        $this->dispatch('confirmDeletion', [
            'id' => $modaldata,
            'eventName' => 'deletePermission',
            'title' => 'هل أنت متأكد؟',
            'text' => 'لن تتمكن من التراجع عن هذا!'
        ]);
    }

    public function deletePermission($modaldata)
    {
        $permission = Permission::findOrFail($modaldata);
        $permission->delete();
        $this->refreshPermissions();
    }

    public function refreshPermissions()
    {
        $this->permissions = Permission::latest()->get();
    }

    public function mount()
    {
        $this->refreshPermissions();
    }


    public function render()
    {
        return view('livewire.admin-dashboard.permissions.permissions-list');
    }
}
