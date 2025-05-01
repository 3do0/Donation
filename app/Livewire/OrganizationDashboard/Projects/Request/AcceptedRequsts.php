<?php

namespace App\Livewire\OrganizationDashboard\Projects\Request;

use App\Models\OrganizationProject;
use App\Models\OrganizationProjectRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AcceptedRequsts extends Component
{
    use WithFileUploads;


    public $requests;
    public $editId;
    public $editProjectName;
    public $editDescription;
    public $editProjectPhoto;

    public function editRequest($id)
    {
        $project = OrganizationProject::findOrFail($id);
        $this->editId = $project->id;
        $this->editProjectName = $project->project_name;
        $this->editDescription = $project->description;
    }
  
    

    public function mount()
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;
         $this->requests = OrganizationProject::whereHas('organization_user', function ($query) use ($organizationId) {
         $query->where('organization_id', $organizationId); 
         })->get();
    }
     public function updateRequest()
    {
        $this->validate([
            'editProjectName' => 'required|string|max:100',
            'editDescription' => 'required|string',
            'editProjectPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:16000',
        ]);

        $project = OrganizationProject::findOrFail($this->editId);

        $project->project_name = $this->editProjectName;
        $project->description = $this->editDescription;

        if ($this->editProjectPhoto) {
            $photoName = $this->editProjectPhoto->hashName();
            $photoPath = $this->editProjectPhoto->storeAs('projectsPhotos', $photoName, 'public');
            $project->project_photo = $photoPath;
        }

        $project->save();

        $this->reset();

        $this->mount();

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم تعديل الطلب بنجاح',
        ]);
    }
    public function render()
    {
        return view('livewire.organization-dashboard.projects.request.accepted-requsts')->layout('layouts.Organization_Dashboard.app');
    }
}
