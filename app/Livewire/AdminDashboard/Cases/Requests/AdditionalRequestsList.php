<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Models\OrganizationCaseRequest;
use Livewire\Component;

class AdditionalRequestsList extends Component
{
    public $requests;

    protected $listeners = [
    'deleteRequestCase' => 'deleteRequestCase' 
    ];
    

    public function confirmDelete($modaldata)
    {
        $this->dispatch('confirmDeletion', [
            'id' => $modaldata,
            'eventName' => 'deleteRequestCase',
            'title' => 'هل أنت متأكد؟',
            'text' => 'لن تتمكن من التراجع عن هذا!'
        ]);
    }

    public function mount()
    {
        $this->refreshRequests();
    }

    public function refreshRequests()
    {
        $this->requests = OrganizationCaseRequest::where('approval_status', 'pending')->get();
    }

    public function RejectedRequests()
    {
        $this->requests = OrganizationCaseRequest::where('approval_status', 'rejected')->get();
    }
    public function ApprovedRequests()
    {
        $this->requests = OrganizationCaseRequest::where('approval_status', 'approved')->get();
    }

    public function deleteRequestCase($modaldata)
    {

            $org = OrganizationCaseRequest::findOrFail($modaldata);
            $org->delete();
            $this->refreshRequests();

    }

    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.additional-requests-list')->layout('layouts.app');
    }
}
