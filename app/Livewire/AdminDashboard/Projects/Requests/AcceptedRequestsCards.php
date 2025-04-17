<?php

namespace App\Livewire\AdminDashboard\Projects\Requests;

use App\Models\OrganizationProject;
use Livewire\Component;

class AcceptedRequestsCards extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = OrganizationProject::with('organization_user.organization')->where('status', 'in_progress')->get();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.projects.requests.accepted-requests-cards')->layout('layouts.app');
    }
}
