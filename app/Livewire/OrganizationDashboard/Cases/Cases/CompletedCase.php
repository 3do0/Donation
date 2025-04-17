<?php

namespace App\Livewire\OrganizationDashboard\Cases\Cases;

use App\Models\DonorFeedback;
use App\Models\OrganizationCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CompletedCase extends Component
{
    use WithFileUploads;
    public $cases;
    public $case_report;

    protected $rules = [
        'case_report' => 'required|mimes:pdf|max:15000',
    ];

    public function uploadReport($case_id)
    {
        $this->validate();

        try {
            $pdfname = $this->case_report->hashName();
            $filePath = $this->case_report->storeAs('casesReports', $pdfname, 'public');

            $case = OrganizationCase::findOrFail($case_id);

            $case->reports()->create([
                'file_path' => $filePath,
                'organization_user_id' => auth('organization')->id(),
            ]);

            $this->reset('case_report');

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
        $this->cases = OrganizationCase::whereHas('organization_user', function ($query) use ($organizationId) {
            $query->where('organization_id', $organizationId);
        })->where('status', 'in_progress')->get();
    }
    public function render()
    {
        return view('livewire.organization-dashboard.cases.cases.completed-case')->layout('layouts.Organization_Dashboard.app');
    }
}
