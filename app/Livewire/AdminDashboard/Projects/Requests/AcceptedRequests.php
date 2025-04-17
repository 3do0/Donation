<?php

namespace App\Livewire\AdminDashboard\Projects\Requests;

use App\Models\OrganizationProject;
use Livewire\Component;

class AcceptedRequests extends Component
{
    public $projects;


    public function stopingProject($projectId)
    {
        $project = OrganizationProject::find($projectId);
        $project->status = 'stopped';
        $project->save();
    }

    public function continueProject($projectId)
    {
        $project = OrganizationProject::find($projectId);
        $project->status = 'in_progress';
        $project->save();
    }
    public function mount()
    {
        $this->projects = OrganizationProject::with('organization_user.organization')->get();
    }
    
    public function render()
    {
        return view('livewire.admin-dashboard.projects.requests.accepted-requests')->layout('layouts.app');
    }
}
