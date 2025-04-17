<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Models\OrganizationCase;
use Livewire\Component;

class AcceptedRequestsCards extends Component
{
    public $cases;

    public function mount()
    {
        $this->cases = OrganizationCase::with('organization_user.organization')->where('status', 'in_progress')->get();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.accepted-requests-cards')->layout('layouts.app');
    }
}
