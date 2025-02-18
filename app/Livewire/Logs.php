<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class Logs extends Component
{

    public $PageTitle = 'الأنشــطة';

    public $selectedTable = '';
    public $selectedAction = '';
    public $selectedUser = '';
    public $activities = [];


    public $selectedActivity = null;
    public $showModal = false;

    public function mount()
    {
        $this->loadActivities();
    }

    public function search()
    {
        $this->loadActivities();
    }

    private function loadActivities()
    {
        $query = Activity::query();

        if ($this->selectedTable) {
            $query->where('subject_type', 'like', '%' . $this->selectedTable . '%');
        }

        if ($this->selectedAction) {
            $query->where('description', $this->selectedAction);
        }

        if ($this->selectedUser) {
            $query->whereHas('causer', function ($q) {
                $q->where('name', 'like', '%' . $this->selectedUser . '%');
            });
        }

        $this->activities = $query->latest()->get();
    }
  

public function viewDetails($id)
{
    $this->selectedActivity = Activity::with('causer')->find($id);
    $this->showModal = true;  // تفعيل فتح النافذة المنبثقة
}

    public function render()
   
    {
        return view('livewire.logs',['users'=>User::all()])->layout('layouts.app');
    }
}
