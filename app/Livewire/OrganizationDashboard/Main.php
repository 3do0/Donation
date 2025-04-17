<?php

namespace App\Livewire\OrganizationDashboard;

use App\Models\OrganizationCase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Main extends Component
{

    public $cases;
    public function mount(){
        $organizationId = Auth::guard('organization')->user()?->organization_id;

        $this->cases = OrganizationCase::with('organization_user')
    ->whereHas('organization_user', function ($query) use ($organizationId) {
        $query->where('organization_id', $organizationId);
    })
    ->get(); 

    }

    public function render()
    {
        return view('livewire.organization-dashboard.main')->layout('layouts.Organization_Dashboard.app');
    }
}
