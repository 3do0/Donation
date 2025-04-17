<?php

namespace App\Livewire\AdminDashboard\Projects\Requests;

use App\Models\OrganizationProjectRequest;
use Livewire\Component;

class RefinedRequests extends Component
{
    public $requests;

    public function mount()
    {
        $this->requests = OrganizationProjectRequest::with('organization_user.organization')->where('approval_status', 'rejected')->get();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.projects.requests.refined-requests')->layout('layouts.app');
    }
}
