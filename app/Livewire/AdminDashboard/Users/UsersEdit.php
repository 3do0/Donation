<?php

namespace App\Livewire\AdminDashboard\Users;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class UsersEdit extends Component
{
    public $userId, $name, $email, $gender, $isOpen = false;

    //  protected $listeners = ['editUser' => 'loadUser'];
      #[On('editUser')]
     public function loadUser($id)
     {
         $user = User::findOrFail($id);
         $this->userId = $user->id;
         $this->name = $user->name;
         $this->email = $user->email;
         $this->gender = $user->gender;
         $this->isOpen = true;
     }
 
     public function updateUser()
     {
         $this->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email,' . $this->userId,
             'gender' => 'required|in:ذكر,أنثى' ,
         ]);
 
         User::findOrFail($this->userId)->update([
             'name' => $this->name,
             'email' => $this->email,
             'gender' => $this->gender,
         ]);
 
        
         $this->isOpen = false;
        
     }
 
     public function closeModal()
     {
         $this->reset(['userId', 'name', 'email', 'gender', 'isOpen']);
     }
 
     public function render()
     {
         return view('livewire.admin-dashboard.users.users-edit');
     }
}
