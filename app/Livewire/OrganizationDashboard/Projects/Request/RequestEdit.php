<?php

namespace App\Livewire\OrganizationDashboard\Projects\Request;

use App\Models\OrganizationProjectRequest;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class RequestEdit extends Component
{

    use WithFileUploads;


    public $project_name;
    public $project_photo;
    public $project_file;
    public $beneficiaries_count;
    public $description;
    public $location;
    public $contact_number;
    public $whatsapp_number;
    public $project_id;
    public  $isOpen = false;



    //  protected $listeners = ['editUser' => 'loadUser'];
    protected $listeners = ['editproject' => 'loadproject'];

    public function loadproject($id)
    {
        $project = OrganizationProjectRequest::findOrFail($id);
        $this->project_id =  $project->id;
        $this->project_name =  $project->project_name;
        $this->beneficiaries_count =  $project->beneficiaries_count;
        $this->description =  $project->description;
        $this->location = $project->location;
        $this->contact_number = $project->contact_number;
        $this->whatsapp_number =  $project->whatsapp_number;
        $this->isOpen = true;
    }

    public function UpdateRequest()
    {



        $this->validate([
            'project_name'         => 'required|string|max:100',
            'project_photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:16000',
            'project_file'         => 'nullable|mimes:pdf|max:10000',
            'beneficiaries_count'  => 'required|integer|min:1',
            'description'          => 'nullable|string|max:1000',
            'location'             => 'required|string|max:255',
            'contact_number'       => ['required', 'regex:/^7[0-9]{8}$/'],
            'whatsapp_number'      => ['required', 'regex:/^7[0-9]{8}$/'],
        ]);

        $project = OrganizationProjectRequest::findOrFail($this->project_id);

        $project->update([
            'project_name' => $this->project_name,
            'project_photo' => $this->project_photo instanceof \Illuminate\Http\UploadedFile
                ? $this->project_photo->store('projectsPhotos', 'public')
                : $project->project_photo,
            'project_file' => $this->project_file instanceof \Illuminate\Http\UploadedFile
                ? $this->project_file->store('projectsFiles', 'public')
                : $project->project_file,
            'beneficiaries_count' => $this->beneficiaries_count,
            'description' => $this->description,
            'location' => $this->location,
            'contact_number' => $this->contact_number,
            'whatsapp_number' => $this->whatsapp_number,
        ]);


        $this->dispatch('pg:eventRefresh-project-requests-table-p3fpi4-table');
        $this->closeModal();
        $this->dispatch('ProjectUpdated');
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تمت عملية التعديل بنجاح',
        ]);
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatch('closeEditProjectModal');
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.organization-dashboard.projects.request.request-edit');
    }
}
