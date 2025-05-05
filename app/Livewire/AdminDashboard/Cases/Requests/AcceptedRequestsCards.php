<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Models\OrganizationCase;
use Livewire\Attributes\On;
use Livewire\Component;

class AcceptedRequestsCards extends Component
{
    public $cases;

    #[On('CaseRequestResponding')]
    #[On('NewDonation')]
    public function refreshCases()
    {
        $this->cases = OrganizationCase::with('organization_user.organization')->where('status', 'in_progress')->latest()->get();
    }

    public function mount()
    {
        $this->refreshCases();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.accepted-requests-cards')->layout('layouts.app');
    }
}
