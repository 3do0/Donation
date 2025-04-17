<?php

namespace App\Livewire\OrganizationDashboard\OrgUsers;

use App\Models\OrganizationUser;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class OrgUsersForm extends Component
{

    use WithFileUploads;

    public $name ='';
    public $email;
    public $password;
    public $photo;
    public $phone;
    public $gender;
    public $org_id=''; 

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:organization_users,email',
        'phone' => ['required', 'regex:/^7[0-9]{8}$/', 'unique:organization_users,phone'],
        'password' => 'required|string|min:8',
        'gender' => 'nullable|in:male,female',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        
    ];

    public function register()
    {
        $this->validate();

        try {
            $photoPath = null;
            if ($this->photo) {
                $name = $this->photo->hashName();
                $photoPath = $this->photo->storeAs('OrganizationsUsersAvtar', $name, 'public');
            }

            $this->org_id = auth('organization')->user()->organization_id;

            $user = OrganizationUser::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'password' => bcrypt($this->password),
                'photo' => $photoPath, 
                'organization_id' => $this->org_id, 
            ]);

            $this->reset();

            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تم تسجيل المستخدم بنجاح !',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'حدث خطأ ما',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.organization-dashboard.org-users.org-users-form')->layout('layouts.Organization_Dashboard.app');
    }
}
