<?php

namespace App\Livewire\AdminDashboard\Cases\Cases;

use App\Models\DonorFeedback;
use App\Models\OrganizationCase;
use Livewire\Component;

class CompletedCase extends Component
{

    public $cases;

    public function mount()
    {
        $this->cases = OrganizationCase::with('organization_user.organization' ,'comments','reports')->where('status', 'in_progress')->get();
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
        return view('livewire.admin-dashboard.cases.cases.completed-case')->layout('layouts.app');
    }
}
