<?php

namespace App\Livewire\AdminDashboard\Projects\Accepted;

use App\Models\DonorFeedback;
use App\Models\OrganizationProject;
use Livewire\Component;

class CompletedProject extends Component
{
    public $projects;   

    public function mount()
    {
        $this->projects = OrganizationProject::with('organization_user.organization' ,'comments','reports')->where('status', 'in_progress')->get();
    }
    protected $listeners = [
        'deleteComment' => 'deleteComment'
    ];


    public function confirmDelete($modaldata)
    {
        $this->dispatch('confirmDeletion', [
            'id' => $modaldata,
            'eventName' => 'deleteComment',
            'title' => 'هل أنت متأكد؟',
            'text' => 'لن تتمكن من التراجع عن هذا!'
        ]);
    }

    public function deleteComment($modaldata)
{
    $comment = DonorFeedback::findOrFail($modaldata);
    $comment->delete();
}

    public function render()
    {
        return view('livewire.admin-dashboard.projects.accepted.completed-project')->layout('layouts.app');
    }
}
