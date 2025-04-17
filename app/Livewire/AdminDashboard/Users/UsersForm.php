<?php

namespace App\Livewire\AdminDashboard\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UsersForm extends Component
{


    use WithFileUploads;

    public $name ='';
    public $email;
    public $password;
    public $photo;
    public $phone;
    public $gender;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|unique:users,phone',
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
                $photoPath = $this->photo->storeAs('images', $name, 'public');
            }

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'gender' => $this->gender,
                'password' => bcrypt($this->password),
                'photo' => $photoPath, 
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
        return view('livewire.admin-dashboard.users.users-form')->layout('layouts.app');
    }
}
