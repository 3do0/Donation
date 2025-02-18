<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissions extends Component
{

    public $roleId;                // معرف الدور
    public $rolePermissions = []; // الصلاحيات الحالية للدور

    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $role = Role::findById($roleId);
        $this->rolePermissions = $role->permissions->pluck('id')->toArray(); // جلب الصلاحيات المفعلة للدور
    }

    public function savePermissions()
    {
        $role = Role::findById($this->roleId);

        if ($role) {
            // استرجاع الأسماء بدلاً من الـ ID
            $validPermissions = Permission::whereIn('id', $this->rolePermissions)->pluck('name')->toArray(); 
    
            // مزامنة الصلاحيات باستخدام الأسماء
            $role->syncPermissions($validPermissions);
            dd('wooowooowoooowooo');
        }
        else
        dd('ffffffffffffffffffff');
    

    }


    public function render()
    {
        return view('livewire.roles.role-permissions',['permissions' => Permission::all()])->layout('layouts.app');
    }
}
