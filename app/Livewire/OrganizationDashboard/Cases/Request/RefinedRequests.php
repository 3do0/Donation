<?php

namespace App\Livewire\OrganizationDashboard\Cases\Request;

use App\Models\OrganizationCaseRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RefinedRequests extends Component
{
    public $requests;

    public function mount()
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;
         $this->requests = OrganizationCaseRequest::whereHas('organization_user', function ($query) use ($organizationId) {
         $query->where('organization_id', $organizationId); 
         })->where('approval_status', 'rejected')->get();
    }
    public function render()
    {
        return view('livewire.organization-dashboard.cases.request.refined-requests')->layout('layouts.Organization_Dashboard.app');
    }
}
