<?php

namespace App\Livewire\OrganizationDashboard\Cases\Request;

use App\Models\OrganizationCase;
use App\Models\OrganizationCaseRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AcceptedReqeusts extends Component
{
    use WithFileUploads;

    public $requests;
    public $editId;
    public $editCaseName;
    public $editDescription;
    public $editCasePhoto;

    public function mount()
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;
         $this->requests = OrganizationCase::whereHas('organization_user', function ($query) use ($organizationId) {
         $query->where('organization_id', $organizationId); 
         })->get();
    }
    
    public function editRequest($id)
    {
        $case = OrganizationCase::findOrFail($id);
        $this->editId = $case->id;
        $this->editCaseName = $case->case_name;
        $this->editDescription = $case->description;
        
    }


    public function updateRequest()
    {
    
    
      
        $this->validate([
            'editCaseName' => 'required|string|max:100',
            'editDescription' => 'required|string',
            'editCasePhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:16000',
        ]);
    
        $case = OrganizationCase::findOrFail($this->editId);
    
        $case->case_name = $this->editCaseName;
        $case->description = $this->editDescription;
    
        if ($this->editCasePhoto) {
            $photoName = $this->editCasePhoto->hashName();
            $photoPath = $this->editCasePhoto->storeAs('casesPhotos', $photoName, 'public');
            $case->case_photo = $photoPath;
        }
    
        $case->save();
    
        $this->reset();
    
        $this->mount();
    
       
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم تعديل الطلب بنجاح',
        ]);
    }
    
    public function render()
    {
        return view('livewire.organization-dashboard.cases.request.accepted-reqeusts')->layout('layouts.Organization_Dashboard.app');
    }
}
