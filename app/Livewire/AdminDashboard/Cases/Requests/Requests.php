<?php

namespace App\Livewire\AdminDashboard\Cases\Requests;

use App\Events\CaseRequestRespondingEvent;
use App\Events\OrganizationNotification;
use App\Models\OrganizationCase;
use App\Models\OrganizationCaseRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Requests extends Component
{
    public $duration;
    public $endDate ;
    public $rejectionReason;
    public $requests; 
    
    #[On('CaseCreated')]
    public function refreshRequests(){
        $this->requests = OrganizationCaseRequest::with('organization_user.organization')->where('approval_status', 'pending')->latest()->get();
    }

    public function mount()
    {
        $this->refreshRequests();
    }

    public function approve($requestId)
    {
        if (!in_array($this->duration, [6, 9, 12])) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'مدة غير صالحة',
            ]);
            return;
        }
    
        $request = OrganizationCaseRequest::find($requestId);
        if (!$request) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'طلب غير موجود',
            ]);
            return;
        }
    
        DB::beginTransaction();
    
        try {
            $this->duration = (int) $this->duration;
            $this->endDate = Carbon::now()->addMonths($this->duration);
            $request->approval_status = 'approved';
            $request->user_id = auth('admin')->user()->id;
            $request->reviewed_at = Carbon::now();
            $request->save();
    
            OrganizationCase::create([
                'organization_user_id' => $request->organization_user_id,
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
                'user_id' => auth('admin')->user()->id,
            ]);
    
            DB::commit();
    
            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تمت الموافقة على الطلب بنجاح',
            ]);
            $this->refreshRequests();
            event(new CaseRequestRespondingEvent());

            $msg = '✨ تم الموافقة على طلب الحالة: ' . $request->case_name . ' 📑 رقم الطلب: ' . $request->id . ' 🎉';

            broadcast(new OrganizationNotification([
                'organization_id' => auth('organization')->user()->organization_id,
                'title' => '💥 تم قبول الطلب بنجاح!',
                'content' => $msg,
            ]));


        } catch (Exception $e) {
            DB::rollBack();
    
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'حدث خطأ أثناء الموافقة على الطلب'. $e->getMessage(),
            ]);

        }
    }


    public function reject($requestId)
    {
        
        $request = OrganizationCaseRequest::find($requestId);
        if (!$request) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'طلب غير موجود',
            ]);
            return;
        }

        $request->approval_status = 'rejected';
        $request->rejection_reason = $this->rejectionReason; 
        $request->user_id = auth('admin')->user()->id;
        $request->reviewed_at = Carbon::now();
        $request->save(); 

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم رفض الطلب بنجاح',
        ]);
        $this->refreshRequests();
        event(new CaseRequestRespondingEvent());

        $msg = '❌ تم رفض طلب الحالة: ' . $request->case_name . ' 📑 رقم الطلب: ' . $request->id . ' 😔';

        broadcast(new OrganizationNotification([
            'organization_id' => auth('organization')->user()->organization_id,
            'title' => '🚫 تم رفض الطلب',
            'content' => $msg,
        ]));

    }


    public function render()
    {
        return view('livewire.admin-dashboard.cases.requests.requests')->layout('layouts.app');
    }
}
