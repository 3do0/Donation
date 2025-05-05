<?php

namespace App\Livewire\OrganizationDashboard\Projects\Request;

use Livewire\Attributes\On;
use Livewire\Component;

class RequestIndex extends Component
{
    #[On('ProjectRejection')]
    public function updateTable()
    {
        $this->dispatch('pg:eventRefresh-project-requests-table-p3fpi4-table');
    }
    public function render()
    {
        return view('livewire.organization-dashboard.projects.request.request-index')->layout('layouts.Organization_Dashboard.app');
    }
}
