<?php

namespace App\Livewire\AdminDashboard\Cases\OragnizationCases;

use Livewire\Component;

class OrganizationCasesIndex extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard.cases.oragnization-cases.organization-cases-index')->layout('layouts.app');
    }
}
