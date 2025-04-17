<?php

namespace App\Livewire\OrganizationDashboard\Cases\Cases;

use Livewire\Component;

class CompletedCaseTable extends Component
{
    public function render()
    {
        return view('livewire.organization-dashboard.cases.cases.completed-case-table')->layout('layouts.Organization_Dashboard.app');
    }
}
