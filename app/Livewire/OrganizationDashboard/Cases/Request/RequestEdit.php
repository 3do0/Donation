<?php

namespace App\Livewire\OrganizationDashboard\Cases\Request;

use App\Models\OrganizationCaseRequest;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class RequestEdit extends Component
{
    use WithFileUploads;


    public $case_id;
    public $case_name;
    public $case_photo;
    public $case_file;
    public $case_type;
    public $beneficiaries_count;
    public $description;
    public $currency = 'ريال يمني';
    public $target_amount;

    public  $isOpen = false;



    //  protected $listeners = ['editUser' => 'loadUser'];
    protected $listeners = ['editcase' => 'loadcase'];

    public function loadcase($id)
    {
        $case = OrganizationCaseRequest::findOrFail($id);
        $this->case_id =  $case->id;

        $this->case_name =  $case->case_name;
        $this->case_type =  $case->case_type;
        $this->beneficiaries_count =  $case->beneficiaries_count;
        $this->description = $case->description;
        $this->currency = $case->currency;
        $this->target_amount =  $case->target_amount;
        $this->isOpen = true;
    }


    public function UpdateRequest()
    {



        $this->validate([
            'case_name' => 'required|string|max:100',
            'case_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:16000',
            'case_file' => 'nullable|mimes:pdf|max:10000',
            'case_type' => 'required|string|max:50',
            'beneficiaries_count' => 'required|integer|min:1',
            'description' => 'required|string',
            'currency' => 'required|string|max:30',
            'target_amount' => 'required|numeric|min:5000',
        ]);

        $case = OrganizationCaseRequest::findOrFail($this->case_id);

        $case->update([

            'case_name' => $this->case_name,
            'case_photo' => $this->case_photo instanceof \Illuminate\Http\UploadedFile
                ? $this->case_photo->store('casesPhotos', 'public')
                : $case->case_photo,
            'case_file' => $this->case_file instanceof \Illuminate\Http\UploadedFile
                ? $this->case_file->store('casesFiles', 'public')
                : $case->case_file,
            'case_type' => $this->case_type,
            'beneficiaries_count' => $this->beneficiaries_count,
            'description' => $this->description,
            'currency' => $this->currency,
            'target_amount' => $this->target_amount,
        ]);


        $this->dispatch('pg:eventRefresh-case-requests-foovyd-table');
        $this->closeModal();
        $this->dispatch('CaseUpdated');
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تمت عملية التعديل بنجاح',
        ]);
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatch('closeEditCaseModal');
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.organization-dashboard.cases.request.request-edit');
    }
}
