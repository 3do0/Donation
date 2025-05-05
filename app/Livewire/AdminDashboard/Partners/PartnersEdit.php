<?php

namespace App\Livewire\AdminDashboard\Partners;

use App\Models\Partner;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PartnersEdit extends Component
{

    use WithFileUploads;

    public $partnerId, 
        $name, 
        $email, 
        $phone, 
        $logo, 
        $contract_file, 
        $address, 
        $type, 
        $support_details, 
        $donation_amount, 
        $start_date, 
        $end_date, 
        $status, 
        $isOpen = false;

    #[On('editpart')]
    public function loadPartner($id)
    { 
        $partner = Partner::findOrFail($id);
        $this->partnerId = $partner->id;
        $this->name = $partner->name;
        $this->email = $partner->email;
        $this->phone = $partner->phone;
        $this->logo = $partner->logo;
        $this->contract_file = $partner->contract_file;
        $this->address = $partner->address;
        $this->type = $partner->type;
        $this->support_details = $partner->support_details;
        $this->donation_amount = $partner->donation_amount;
        $this->start_date = $partner->start_date;
        $this->end_date = $partner->end_date;
        $this->isOpen = true;
    }

    public function updatePartner()
    {
        $partner = Partner::findOrFail($this->partnerId);

        $rules = [];

        if ($this->name !== $partner->name) {
            $rules['name'] = 'required|string|max:100';
        }

        if ($this->email !== $partner->email) {
            $rules['email'] = 'required|email|unique:partners,email,' . $partner->id;
        }

        if ($this->phone !== $partner->phone) {
            $rules['phone'] = 'required|string|regex:/^7[0-9]{8}$/|unique:partners,phone,' . $partner->id;
        }

        if ($this->logo instanceof \Illuminate\Http\UploadedFile) {
            $rules['logo'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000';
        }

        if ($this->contract_file instanceof \Illuminate\Http\UploadedFile) {
            $rules['contract_file'] = 'nullable|mimes:pdf|max:10000';
        }

        if ($this->address !== $partner->address) {
            $rules['address'] = 'required|string|max:255';
        }

        if ($this->type !== $partner->type) {
            $rules['type'] = 'required|in:individual,company,government';
        }

        if ($this->support_details !== $partner->support_details) {
            $rules['support_details'] = 'required|string';
        }

        if ($this->donation_amount != $partner->donation_amount) {
            $rules['donation_amount'] = 'required|numeric|min:0';
        }

        if ($this->start_date != $partner->start_date) {
            $rules['start_date'] = 'required|date';
        }

        if ($this->end_date != $partner->end_date) {
            $rules['end_date'] = 'required|date|after_or_equal:start_date';
        }

        // تنفيذ التحقق فقط في حال وجود تغييرات
        if (!empty($rules)) {
            $this->validate($rules);
        }

        $partner->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'logo' => $this->logo instanceof \Illuminate\Http\UploadedFile 
                        ? $this->logo->store('PartnersLogos', 'public') 
                        : $partner->logo,
            'contract_file' => $this->contract_file instanceof \Illuminate\Http\UploadedFile 
                        ? $this->contract_file->store('PartnersContracts', 'public') 
                        : $partner->contract_file,
            'address' => $this->address,
            'type' => $this->type,
            'support_details' => $this->support_details,
            'donation_amount' => $this->donation_amount,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->closeModal();

        $this->dispatch('partnerUpdated');
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تمت عملية التعديل بنجاح',
        ]);
    }

    public function closeModal()
    {
        $this->reset();
        $this->resetErrorBag(); 
        $this->resetValidation(); 
    }
    
    public function render()
    {
        return view('livewire.admin-dashboard.partners.partners-edit');
    }
}
