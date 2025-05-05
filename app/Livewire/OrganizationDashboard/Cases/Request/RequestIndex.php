<?php

namespace App\Livewire\OrganizationDashboard\Cases\Request;

use Livewire\Attributes\On;
use Livewire\Component;

class RequestIndex extends Component
{
    
    public function render()
    {
        return view('livewire.organization-dashboard.cases.request.request-index')->layout('layouts.Organization_Dashboard.app');
    }
}
