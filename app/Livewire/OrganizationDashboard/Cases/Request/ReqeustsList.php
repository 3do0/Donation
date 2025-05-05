<?php

namespace App\Livewire\OrganizationDashboard\Cases\Request;

use Livewire\Attributes\On;
use Livewire\Component;

class ReqeustsList extends Component
{
    #[On('CaseRequestResponding')]
    #[On('NewDonation')]
    public function updateTable()
    {
        $this->dispatch('pg:eventRefresh-case-requests-foovyd-table');
    }
    public function render()
    {
        return view('livewire.organization-dashboard.cases.request.reqeusts-list');
    }
}
