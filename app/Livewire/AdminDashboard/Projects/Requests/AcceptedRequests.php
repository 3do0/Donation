<?php

namespace App\Livewire\AdminDashboard\Projects\Requests;

use App\Models\DonorFeedback;
use App\Models\OrganizationProject;
use Livewire\Component;

class AcceptedRequests extends Component
{
    public $projects;


    public function stopingProject($projectId)
    {
        $project = OrganizationProject::find($projectId);
        $project->status = 'stopped';
        $project->save();
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم ايقاف المشروع بنجاح',
        ]);
        $this->refreshProjects();
    }

    public function continueProject($projectId)
    {
        $project = OrganizationProject::find($projectId);
        $project->status = 'in_progress';
        $project->save();
        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم استكمال المشروع بنجاح',
        ]);
        $this->refreshProjects();
    }

    public function refreshProjects()
    {
        $this->projects = OrganizationProject::with('organization_user.organization')->get();
    }
    public function mount()
    {
        $this->refreshProjects();
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
        $this->refreshProjects();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.projects.requests.accepted-requests')->layout('layouts.app');
    }
}
