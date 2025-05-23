<?php


namespace App\Livewire\AdminDashboard\Users;

use App\Models\User;
use Livewire\Component;

class UsersList extends Component
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
        $this->users = User::get();
        $this->usersCount = User::count();
        $this->onlineUserCount = User::where('is_online', true)->count();
    }

    public function toggleStatus($userId)
    {
        $user = User::find($userId);

        if ($user) {
            $user->is_active = !$user->is_active;
            $user->save();
        }

        $this->refreshUsers();
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تمت عملية التغيير بنجاح !',
        ]);
    }

    public function deleteUser($modaldata)
    {

            $user = User::findOrFail($modaldata);
            $user->delete();
            $this->refreshUsers();

    }

    public function edit($id)
    {
        $this->dispatch('editUser', $id);
    }

    public function render()
    {
        return view('livewire.admin-dashboard.users.users-list')->layout('layouts.app');
    }
}
