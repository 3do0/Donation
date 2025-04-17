<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use Livewire\Component;

class AdditionalRequestsIndex extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.additional-requests-index')->layout('layouts.app');
    }
}
