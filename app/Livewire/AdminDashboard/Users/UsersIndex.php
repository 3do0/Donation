<?php

namespace App\Livewire\AdminDashboard\Users;

use Livewire\Component;

class UsersIndex extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard.users.users-index')->layout('layouts.app');
    }
}
