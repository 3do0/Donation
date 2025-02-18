<?php

namespace App\Livewire\Users;

use Livewire\Component;

class UsersIndex extends Component
{
    public function render()
    {
        return view('livewire.users.users-index')->layout('layouts.app');
    }
}
