<?php

namespace App\Livewire\AdminDashboard\Roles;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesForm extends Component
{
    public $roleName;
    #[Rule('required|min:5')]
    public $selectedPermissions = []; // لحفظ الصلاحيات المختارة

    // protected $rules = [
    //     'roleName' => 'required|string|unique:roles,name',
    //     // 'selectedPermissions' => 'array',
    // ];

    // public function mount(){
    //     dd('تم تنفيذ الدالة!');
    // }

    public function createRole()
    {

        // dd('تم تنفيذ الدالة!');
        // $this->validate();
        // dd($this->roleName, $this->selectedPermissions);

        // إنشاء الدور الجديد
        $role = Role::create(['name' => $this->roleName]);

        // تعيين الصلاحيات لهذا الدور
        $role->syncPermissions($this->selectedPermissions);

        // session()->flash('message', 'تم إنشاء الدور بنجاح مع الصلاحيات!');
        // $this->reset(['roleName', 'selectedPermissions']);
    }

    public function render()
    {
        return view('livewire.admin-dashboard.roles.roles-form',['permissions' => Permission::all()])->layout('layouts.app');
    }
}
