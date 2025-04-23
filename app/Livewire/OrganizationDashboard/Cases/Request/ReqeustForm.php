<?php

namespace App\Livewire\OrganizationDashboard\Cases\Request;

use App\Models\OrganizationCaseRequest;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ReqeustForm extends Component
{
    use WithFileUploads;

    public $organization_user_id;
    public $case_name;
    public $case_photo;
    public $case_file;
    public $case_type;
    public $beneficiaries_count;
    public $description;
    public $currency = 'ريال يمني';
    public $target_amount;
    public function restForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    protected $rules = [
        'case_name' => 'required|string|max:100',
        'case_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:16000',
        'case_file' => 'required|mimes:pdf|max:10000',
        'case_type' => 'required|string|max:50',
        'beneficiaries_count' => 'required|integer|min:1',
        'description' => 'required|string',
        'currency' => 'required|string|max:30',
        'target_amount' => 'required|numeric|min:5000',
    ];


    public function AddRequest()
    {
        $this->validate();

        $photoPath = null;
        if ($this->case_photo) {
            $photoName = $this->case_photo->hashName();
            $photoPath = $this->case_photo->storeAs('casesPhotos', $photoName, 'public');
        }
        $FilePath = null;
        if ($this->case_file) {
            $pdfname = $this->case_file->hashName();
            $FilePath = $this->case_file->storeAs('casesFiles', $pdfname, 'public');
        }

        try {
            $case = OrganizationCaseRequest::create([
                'organization_user_id' => $this->organization_user_id,
                'case_name' => $this->case_name,
                'case_photo' => $photoPath,
                'case_file' => $FilePath,
                'case_type' => $this->case_type,
                'beneficiaries_count' => $this->beneficiaries_count,
                'description' => $this->description,
                'currency' => $this->currency,
                'target_amount' => $this->target_amount,
            ]);


            $this->SetOrganizationUserId();
            $this->reset();

            $this->dispatch('pg:eventRefresh-case-requests-foovyd-table');
            $this->dispatch('CaseCreated');
            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تمت إضافة الطلب بنجاح',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'حدث خطأ ما' . $e->getMessage(),
            ]);
        }
    }


    public function mount()
    {
        $this->SetOrganizationUserId();
    }

    public function SetOrganizationUserId()
    {
        if (auth('organization')->check()) {
            $this->organization_user_id = auth('organization')->user()->id;
        }
    }
    public function render()
    {
        return view('livewire.organization-dashboard.cases.request.reqeust-form')->layout('layouts.Organization_Dashboard.app');
    }
}
