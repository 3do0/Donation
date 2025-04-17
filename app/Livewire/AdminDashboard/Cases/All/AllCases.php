<?php

namespace App\Livewire\AdminDashboard\Cases\All;

use App\Models\OrganizationCase;
use Livewire\Component;

class AllCases extends Component
{
    public $allcases;

    protected $listeners = [
        'deleteOrganizationCase' => 'deleteOrganizationCase' 
    ];
    

    public function confirmDelete($modaldata)
    {
        $this->dispatch('confirmDeletion', [
            'id' => $modaldata,
            'eventName' => 'deleteOrganizationCase',
            'title' => 'هل أنت متأكد؟',
            'text' => 'لن تتمكن من التراجع عن هذا!'
        ]);
    }

    
    public function refershCases(){
        $this->allcases = OrganizationCase::all();
    }

    public function mount(){
        $this->refershCases();
    }

    public function deleteOrganizationCase($modaldata)
    {
        $case = OrganizationCase::findOrFail($modaldata);
        $case->delete();
        $this->refershCases();
    }
    public function render()
    {
        return view('livewire.admin-dashboard.cases.all.all-cases')->layout('layouts.app');
    }
}
