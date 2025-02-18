<?php

namespace App\Livewire\Organizations;

use Livewire\Component;

class OrganizationsIndex extends Component
{
    public function render()
    {
        return view('livewire.organizations.organizations-index')->layout('layouts.app');
    }
}
