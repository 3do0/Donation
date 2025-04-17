<?php

namespace App\Livewire\OrganizationDashboard\Projects\Projects;

use Livewire\Component;

class CompletedProjectTable extends Component
{
    public function render()
    {
        return view('livewire.organization-dashboard.projects.projects.completed-project-table')->layout('layouts.Organization_Dashboard.app');
    }
}
