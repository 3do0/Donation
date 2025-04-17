<?php

namespace App\Livewire\AdminDashboard\Cases\All;

use Livewire\Component;

class AllCasesIndex extends Component
{
    public function render()
    {
        return view('livewire.admin-dashboard.cases.all.all-cases-index')->layout('layouts.app');
    }
}
