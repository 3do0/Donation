<?php

namespace App\Livewire\OrganizationDashboard\OrgUsers;

use App\Models\OrganizationUser;
use Livewire\Component;

class OrgUsersList extends Component
{

    public $users;
    public $usersCount;
    public $onlineUserCount;

    protected $listeners = [
        'deleteUser' => 'deleteUser'
    ];


    public function confirmDelete($modaldata)
    {
        $this->dispatch('confirmDeletion', [
            'id' => $modaldata,
            'eventName' => 'deleteUser',
            'title' => 'هل أنت متأكد؟',
            'text' => 'لن تتمكن من التراجع عن هذا!'
        ]);
    }

    public function mount()
    {
        $this->refreshUsers();
    }

    public function refreshUsers()
    {
        $this->users = OrganizationUser::with('organization')->get();
        $this->usersCount = OrganizationUser::count();
        $this->onlineUserCount = OrganizationUser::where('is_online', true)->count();
    }

    public function deleteUser($modaldata)
    {
        $user = OrganizationUser::findOrFail($modaldata);
        $user->delete();
        $this->refreshUsers();
    }

    public function edit($id)
    {
        $this->dispatch('editUser', $id);
    }
    public function render()
    {
        return view('livewire.organization-dashboard.org-users.org-users-list')->layout('layouts.Organization_Dashboard.app');
    }
}
