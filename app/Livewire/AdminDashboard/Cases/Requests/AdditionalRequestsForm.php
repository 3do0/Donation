<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Models\OrganizationCaseRequest;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AdditionalRequestsForm extends Component
{
    use WithFileUploads;

    public $organization_user_id;
    public $case_name;
    public $case_photo;
    public $case_file;
    public $case_type;
    public $beneficiaries_count;
    public $description;
    public $currency='ريال يمني';
    public $target_amount;

    protected $rules = [
        'case_name' => 'required|string|max:100',
        'case_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:16000', 
        'case_file' => 'nullable|mimes:pdf|max:10000', 
        'case_type' => 'required|string|max:50',
        'beneficiaries_count' => 'nullable|integer|min:0',
        'description' => 'nullable|string',
        'currency' => 'required|string|max:30',
        'target_amount' => 'required|numeric|min:0',
    ];

    public function AddCase()
    {
        // dd( $this->organization_id);
        $this->validate();

        $photoPath = null;
        if ($this->case_photo) {
            $photoName = $this->case_photo->hashName();
            $photoPath = $this->case_photo->storeAs('CasePhotos', $photoName, 'public');
        }
        $FilePath = null;
        if ($this->case_file) {
            $pdfname = $this->case_file->hashName();
            $FilePath = $this->case_file->storeAs('CaseFiles', $pdfname, 'public');
        }

        try {
            $case = OrganizationCaseRequest::create([
                'organization_id' => $this->organization_id,
                'case_name' => $this->case_name,
                'case_photo' => $photoPath,
                'case_file' => $FilePath,
                'case_type' => $this->case_type,
                'beneficiaries_count' => $this->beneficiaries_count,
                'description' => $this->description,
                'currency' => $this->currency,
                'target_amount' => $this->target_amount,
            ]);

            $this->reset();
            $this->SetOrganizationId();

            session()->flash('message', 'تم أضافة حالة خيرية جديدة الى طابور الانتظار لمراجعتها !');
        } catch (\Exception $e) {
            session()->flash('error', 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.');
        }
    }

    public function mount()
{
        $this->SetOrganizationId();
}

    public function SetOrganizationId(){
        if (auth('organization')->check()) {
            $this->organization_user_id = auth('organization')->user()->organization_id;
        }
    }

    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.additional-requests-form')->layout('layouts.app');
    }
}
