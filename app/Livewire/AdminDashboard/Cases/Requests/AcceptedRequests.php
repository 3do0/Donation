<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Models\OrganizationCase;
use Livewire\Component;

class AcceptedRequests extends Component
{
    public $cases;
    
    public function stopingCase($caseId)
    {
        $case = OrganizationCase::find($caseId);
        $case->status = 'stopped';
        $case->save();
    }

    public function continueCase($caseId)
    {
        $case = OrganizationCase::find($caseId);
        $case->status = 'in_progress';
        $case->save();
    }
    public function mount()
    {
        $this->cases = OrganizationCase::with('organization_user.organization')->get();
    }
    
    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.accepted-requests')->layout('layouts.app');
    }
}
