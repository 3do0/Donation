<?php

namespace App\Livewire\AdminDashboard\Cases\Responses;

use App\Models\OrganizationCase;
use App\Models\OrganizationCaseRequest;
use Carbon\Carbon;
use Livewire\Component;

class AdditionalResponses extends Component
{
    public $duration;
    public $endDate ;
    public $rejectionReason;
    public $requests; 

    protected $rules = [
        'rejectionReason' => 'required|string|min:10',  
        'duration' => 'required',  
    ];

    
    public function refreshRequests(){
        $this->requests = OrganizationCaseRequest::where('approval_status', 'pending')->get();
    }
    public function mount()
    {
        $this->refreshRequests();
    }

    public function approve($requestId)
    {
        if (!in_array($this->duration, [6, 9, 12])) {
            session()->flash('error', 'مدة غير صالحة');
            return;
        }

        $request = OrganizationCaseRequest::find($requestId);
        if (!$request) {
            session()->flash('error', 'طلب غير موجود');
            return;
        }

        
        $this->duration = (int) $this->duration;
        $this->endDate = Carbon::now()->addMonths($this->duration);
        $request->approval_status = 'approved';
        $request->user_id = auth()->user()->id;
        $request->reviewed_at = Carbon::now();
        $request->save(); 

        OrganizationCase::create([
            'organization_id' => $request->organization_id,
            'case_name' => $request->case_name,
            'case_photo' => $request->case_photo,
            'case_file' => $request->case_file,
            'case_type' => $request->case_type,
            'beneficiaries_count' => $request->beneficiaries_count,
            'description' => $request->description,
            'currency' => $request->currency,
            'target_amount' => $request->target_amount,
            'raised_amount' => 0, 
            'status' => 'in_progress',
            'end_date' =>$this->endDate,  
            'user_id' => auth()->user()->id,
        ]);

        // $request->delete();

        session()->flash('message', 'تمت الموافقة على الطلب بنجاح');
        $this->refreshRequests();
    }


    public function reject($requestId)
    {
        
        $request = OrganizationCaseRequest::find($requestId);
        if (!$request) {
            session()->flash('error', 'طلب غير موجود');
            return;
        }

        $request->approval_status = 'rejected';
        $request->rejection_reason = $this->rejectionReason; 
        $request->user_id = auth()->user()->id;
        $request->reviewed_at = Carbon::now();
        $request->save(); 

        session()->flash('message', 'تم رفض الطلب بنجاح');
        $this->refreshRequests();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.cases.responses.additional-responses')->layout('layouts.app');
    }
}
