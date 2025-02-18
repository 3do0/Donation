<?php

namespace App\Livewire\Organizations;

use App\Models\Organization;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class OrganizationsForm extends Component
{
    use WithFileUploads;

    public $name;
    public $logo;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $bank_name;
    public $bank_account_number;
    public $registration_number;
    public $activity_type=[];
    public $license;
    public $status;
    public $web_url;

    protected $rules = [
        'name' => 'required|string|max:50',
        'email' => 'required|email|unique:organizations,email',
        'phone' => 'required|string|unique:organizations,phone',
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
        'license' => 'required|mimes:pdf|max:10000',
        'address' => 'required|string|max:70',
        'city' => 'required|string|max:50',
        'bank_name' => 'required|string|max:70',
        'bank_account_number' => 'required|string|max:50|min:4',
        'registration_number' => 'required|string|max:50|min:4',
        'activity_type' => 'required',
    ];

    

    public function register()
    {
        $this->validate();

 
           
            $logoPath = null;
            if ($this->logo) {
                $logoname = $this->logo->hashName();
                $logoPath = $this->logo->storeAs('OrganizationsLogos', $logoname, 'public');
            }

            $pdfPath = null;
            if ($this->license) {
                $pdfname = $this->license->hashName();
                $pdfPath = $this->license->storeAs('OrganizationsLicenses', $pdfname, 'public');
            }

            $organizations = Organization::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'logo' => $logoPath,
                'address' => $this->address,
                'city' => $this->city,
                'activity_type' => implode(',', $this->activity_type),
                'registration_number' => $this->registration_number,
                'bank_name' => $this->bank_name,
                'bank_account_number' => $this->bank_account_number,
                'license' => $pdfPath,
                'web_url' => $this->web_url,
                'status' => $this->status
            ]);

            $this->reset();

            session()->flash('message', 'تم تسجيل المنظمة بنجاح !');
        // } catch (\Exception $e) {
        //     session()->flash('error', 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.');
        // }
    }

    public function render()
    {
        return view('livewire.organizations.organizations-form')->layout('layouts.app');
    }
}
