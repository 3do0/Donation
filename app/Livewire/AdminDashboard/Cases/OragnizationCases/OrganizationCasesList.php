<?php

namespace App\Livewire\AdminDashboard\Cases\OragnizationCases;

use App\Models\OrganizationCase;
use Livewire\Component;

class OrganizationCasesList extends Component
{
    public $orgcases;
    public function OrganizationCases(){
        $this->orgcases = OrganizationCase::get();
    }
    public function mount(){
        $this->OrganizationCases();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.cases.oragnization-cases.organization-cases-list')->layout('layouts.app');
    }
}
