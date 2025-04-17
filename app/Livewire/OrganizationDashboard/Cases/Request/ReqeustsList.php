<?php

namespace App\Livewire\OrganizationDashboard\Cases\Request;

use Livewire\Component;

class ReqeustsList extends Component
{
    public function render()
    {
        return view('livewire.organization-dashboard.cases.request.reqeusts-list')->layout('layouts.Organization_Dashboard.app');
    }
}
