<?php

namespace App\Livewire\AdminDashboard\Organizations;

use App\Models\Organization;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class OrganizationsEdit extends Component
{
    use WithFileUploads;

    public $organization_link, 
        $organizationId, 
        $name,
        $logo,
        $email,
        $activity_type, 
        $registration_number, 
        $bank, 
        $bank_account,
        $license,
        $isOpen = false, 
        $city, 
        $address,
        $phone;

    #[On('editorg')]
    public function loadOrganization($id)
    { 
        $organization = Organization::findOrFail($id);
    
        $this->organizationId = $organization->id;
        $this->name = $organization->name;
        $this->phone = $organization->phone;
        $this->email = $organization->email;
        $this->activity_type = explode(',', $organization->activity_type);
        $this->city = $organization->city;
        $this->address = $organization->address;
        $this->registration_number = $organization->registration_number;
        $this->bank = $organization->bank_name;
        $this->bank_account = $organization->bank_account_number;
        $this->organization_link = $organization->web_url;
       
        $this->isOpen = true;
    }

    public function updateOrganization()
    {  
        $organization = Organization::findOrFail($this->organizationId);

        $rules = [];

        if ($this->name !== $organization->name) {
            $rules['name'] = 'required|string|max:50';
        }

        if ($this->email !== $organization->email) {
            $rules['email'] = 'required|email|unique:organizations,email,' . $this->organizationId;
        }

        if ($this->phone !== $organization->phone) {
            $rules['phone'] = 'required|regex:/^7[0-9]{8}$/|string|unique:organizations,phone,' . $this->organizationId;
        }

        if ($this->logo instanceof \Illuminate\Http\UploadedFile) {
            $rules['logo'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000';
        }

        if ($this->license instanceof \Illuminate\Http\UploadedFile) {
            $rules['license'] = 'nullable|mimes:pdf|max:10000';
        }

        if ($this->address !== $organization->address) {
            $rules['address'] = 'required|string|max:70';
        }

        if ($this->city !== $organization->city) {
            $rules['city'] = 'required|string|max:50';
        }

        if ($this->bank !== $organization->bank_name) {
            $rules['bank'] = 'required|string|max:70';
        }

        if ($this->bank_account !== $organization->bank_account_number) {
            $rules['bank_account'] = 'required|string|max:50|min:4';
        }

        if ($this->registration_number !== $organization->registration_number) {
            $rules['registration_number'] = 'required|string|max:50|min:4';
        }

        if (implode(',', $this->activity_type) !== $organization->activity_type) {
            $rules['activity_type'] = 'required';
        }

        if ($this->organization_link !== $organization->web_url) {
            $rules['organization_link'] = 'required';
        }

        if (!empty($rules)) {
            $this->validate($rules);
        }

        $organization->update([
            'name' => $this->name,
            'logo' => $this->logo instanceof \Illuminate\Http\UploadedFile 
                        ? $this->logo->store('OrganizationsLogos', 'public') 
                        : $organization->logo,
            'email' => $this->email,
            'activity_type' => implode(',', $this->activity_type),
            'web_url' => $this->organization_link,
            'city' => $this->city,
            'address' => $this->address,
            'registration_number' => $this->registration_number,
            'bank_name' => $this->bank,
            'phone' => $this->phone,
            'bank_account_number' => $this->bank_account,
            'license' => $this->license instanceof \Illuminate\Http\UploadedFile 
                          ? $this->license->store('OrganizationsLicenses', 'public') 
                          : $organization->license,
        ]);
        
        $this->closeModal();

        $this->dispatch('organizationUpdated');
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تمت عملية التعديل بنجاح',
        ]);
    }

    public function closeModal()
    {
        $this->reset();
        $this->dispatch('close-EditOrgModal');
        $this->resetErrorBag(); 
        $this->resetValidation(); 
    }


    public function render()
    {
        return view('livewire.admin-dashboard.organizations.organizations-edit');
    }
}
