<?php

namespace App\Livewire\OrganizationDashboard\Projects\Request;

use App\Models\OrganizationProjectRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AcceptedRequsts extends Component
{
    public $requests;

    public function mount()
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;
         $this->requests = OrganizationProjectRequest::whereHas('organization_user', function ($query) use ($organizationId) {
         $query->where('organization_id', $organizationId); 
         })->where('approval_status', 'approved')->get();
    }
    public function render()
    {
        return view('livewire.organization-dashboard.projects.request.accepted-requsts')->layout('layouts.Organization_Dashboard.app');
    }
}
