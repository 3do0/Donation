<?php

namespace App\Livewire\OrganizationDashboard\Projects\Projects;

use App\Models\DonorFeedback;
use App\Models\OrganizationProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CompletedProject extends Component
{
    use WithFileUploads;
    public $projects;
    public $project_report;

    protected $rules = [
        'project_report' => 'required|mimes:pdf|max:15000',
    ];

    public function uploadReport($project_id)
    {
        $this->validate();

        try {
            $pdfname = $this->project_report->hashName();
            $filePath = $this->project_report->storeAs('projectReports', $pdfname, 'public');

            $project = OrganizationProject::findOrFail($project_id);

            $project->reports()->create([
                'file_path' => $filePath,
                'organization_user_id' => auth('organization')->id(),
            ]);

            $this->reset('project_report');

            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تم رفع التقرير بنجاح.',
            ]);
        } catch (\Exception $e) {
            Log::error('رفع التقرير فشل: ' . $e->getMessage());
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'حدث خطأ أثناء رفع التقرير.',
            ]);
        }
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


    public function mount()
    {
        $organizationId = Auth::guard('organization')->user()?->organization_id;
         $this->projects = OrganizationProject::whereHas('organization_user', function ($query) use ($organizationId) {
         $query->where('organization_id', $organizationId); 
         })->where('status', 'in_progress')->get();
    }
    public function render()
    {
        return view('livewire.organization-dashboard.projects.projects.completed-project')->layout('layouts.Organization_Dashboard.app');
    }
}
