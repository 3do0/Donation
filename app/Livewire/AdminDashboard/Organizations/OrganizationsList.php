<?php

namespace App\Livewire\AdminDashboard\Organizations;

use App\Models\Organization;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class OrganizationsList extends Component
{
    public $organizations;
    
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
    }

    public function toggleStatus($orgId)
    {
        DB::transaction(function () use ($orgId) {
            $org = Organization::findOrFail($orgId);

            $org->approval_status = !$org->approval_status;
            $org->save();
    
            OrganizationUser::where('organization_id', $orgId)
                ->update(['is_active' => $org->approval_status]);

            $this->refreshOrganizations();

            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تمت عملية التغيير بنجاح',
            ]);
        });
    }

    public function deleteOrganization($modaldata)
    {

            $org = Organization::findOrFail($modaldata);
            $org->delete();
            $this->refreshOrganizations();

    }

    public function render()
    {
        return view('livewire.admin-dashboard.organizations.organizations-list')->layout('layouts.app');
    }
    
}
