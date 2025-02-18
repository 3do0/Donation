<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesList extends Component
{

    public $roles;

    protected $listeners = [
        'deleteRole' => 'deleteRole' 
    ];
    

    public function confirmDelete($modaldata)
    {
        $this->dispatch('confirmDeletion', [
            'id' => $modaldata,
            'eventName' => 'deleteRole',
            'title' => 'هل أنت متأكد؟',
            'text' => 'لن تتمكن من التراجع عن هذا!'
        ]);
    }

    public function deleteRole($modaldata)
    {
        $role = Role::findOrFail($modaldata);
        $role->delete();
        $this->refreshRoles();
    }

    public function refreshRoles()
    {
        $this->roles = Role::latest()->get();
    }

    public function mount()
    {
        $this->refreshRoles();
    }


    public function render()
    {
        return view('livewire.roles.roles-list');
    }
}
