<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class OrganizationsList extends Component
{
    public $organizations;
    public $usersCount;
    public $onlineUserCount;

    protected $listeners = [
        'deleteOrganization' => 'deleteOrganization' 
    ];
    

    public function confirmDelete($modaldata)
    {
        $this->dispatch('confirmDeletion', [
            'id' => $modaldata,
            'eventName' => 'deleteOrganization',
            'title' => 'هل أنت متأكد؟',
            'text' => 'لن تتمكن من التراجع عن هذا!'
        ]);
    }

    public function mount()
    {
        $this->refreshOrganizations();
    }

    public function refreshOrganizations()
    {
        $this->organizations = Organization::get();
        // $this->usersCount = User::count();
    }

    public function toggleStatus($orgId)
    {
        $org = Organization::find($orgId);

        if ($org) {
            $org->status = !$org->status;
            $org->save();
        }

        $this->refreshOrganizations();
    }

    public function deleteOrganization($modaldata)
    {

            $org = Organization::findOrFail($modaldata);
            $org->delete();
            $this->refreshOrganizations();

    }

    public function render()
    {
        return view('livewire.organizations.organizations-list')->layout('layouts.app');
    }
}
