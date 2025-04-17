<?php

namespace App\Livewire\OrganizationDashboard\OrgUsers;

use Livewire\Component;

class OrgUsersIndex extends Component
{
    public function render()
    {
        return view('livewire.organization-dashboard.org-users.org-users-index')->layout('layouts.Organization_Dashboard.app');
    }
}
