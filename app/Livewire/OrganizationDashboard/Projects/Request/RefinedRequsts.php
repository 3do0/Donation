<?php

namespace App\Livewire\OrganizationDashboard\Projects\Request;

use App\Models\OrganizationProjectRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RefinedRequsts extends Component
{

    public $requests;

    public function mount()
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;
         $this->requests = OrganizationProjectRequest::whereHas('organization_user', function ($query) use ($organizationId) {
         $query->where('organization_id', $organizationId); 
         })->where('approval_status', 'rejected')->get();
    }
    public function render()
    {
        return view('livewire.organization-dashboard.projects.request.refined-requsts')->layout('layouts.Organization_Dashboard.app');
    }
}
