<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Events\CaseRequestRespondingEvent;
use App\Models\OrganizationCase;
use Livewire\Attributes\On;
use Livewire\Component;

class AcceptedRequests extends Component
{
    public $cases;
    
    public function stopingCase($caseId)
    {
        $case = OrganizationCase::find($caseId);
        $case->status = 'stopped';
        $case->save();
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم ايقاف الحالة بنجاح',
        ]);
        $this->refreshCases();
        event(new CaseRequestRespondingEvent());
    }

    public function continueCase($caseId)
    {
        $case = OrganizationCase::find($caseId);
        $case->status = 'in_progress';
        $case->save();
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم استكمال الحالة بنجاح',
        ]);
        $this->refreshCases();
        event(new CaseRequestRespondingEvent());
    }


    #[On('CaseRequestResponding')]
    #[On('NewDonation')]
    public function refreshCases()
    {
        $this->cases = OrganizationCase::with('organization_user.organization')->where('status', '!=', 'completed')->latest()->get();
    }
    public function mount()
    {
        $this->refreshCases();
    }
    
    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.accepted-requests')->layout('layouts.app');
    }
}
