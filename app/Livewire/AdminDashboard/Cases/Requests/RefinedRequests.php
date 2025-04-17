<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Models\OrganizationCaseRequest;
use Livewire\Component;

class RefinedRequests extends Component
{
    
    public $requests;

    public function mount()
    {
        $this->requests = OrganizationCaseRequest::with('organization_user.organization')->where('approval_status', 'rejected')->get();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.refined-requests')->layout('layouts.app');
    }
}
