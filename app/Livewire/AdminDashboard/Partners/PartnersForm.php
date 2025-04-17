<?php

namespace App\Livewire\AdminDashboard\Partners;

use App\Models\Partner;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PartnersForm extends Component
{
    use WithFileUploads;

    public $name;
    public $logo;
    public $email;
    public $phone;
    public $address;
    public $type = 'company';
    public $support_details;
    public $donation_amount;
    public $contract_file;
    public $start_date;
    public $end_date;

    protected $rules = [
        'name' => 'required|string|max:100',
        'email' => 'nullable|email|unique:partners,email',
        'phone' => 'nullable|string|unique:partners,phone',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        'contract_file' => 'nullable|mimes:pdf|max:10000',
        'address' => 'nullable|string|max:255',
        'type' => 'required|in:individual,company,government',
        'support_details' => 'required|string',
        'donation_amount' => 'nullable|numeric|min:0',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date|after:start_date',
        'status' => 'boolean',
    ];

    public function registerPartner()
    {
        $this->validate();

        $logoPath = null;
        if ($this->logo) {
            $logoPath = $this->logo->storeAs('PartnersLogos', $this->logo->hashName(), 'public');
        }

        $contractPath = null;
        if ($this->contract_file) {
            $contractPath = $this->contract_file->storeAs('PartnersContracts', $this->contract_file->hashName(), 'public');
        }

        try {
            Partner::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'logo' => $logoPath,
                'address' => $this->address,
                'type' => $this->type,
                'support_details' => $this->support_details,
                'donation_amount' => $this->donation_amount,
                'contract_file' => $contractPath,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            $this->reset();
            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تم تسجيل الشريك بنجاح!',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin-dashboard.partners.partners-form')->layout('layouts.app');
    }
}
