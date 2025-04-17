<?php

namespace App\Livewire\OrganizationDashboard\Projects\Request;

use Livewire\Component;

class RequestIndex extends Component
{
    public function render()
    {
        return view('livewire.organization-dashboard.projects.request.request-index')->layout('layouts.Organization_Dashboard.app');
    }
}
