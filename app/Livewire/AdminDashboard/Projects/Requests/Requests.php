<?php

namespace App\Livewire\AdminDashboard\Projects\Requests;

use App\Models\OrganizationProject;
use App\Models\OrganizationProjectRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Requests extends Component
{

    public $duration;
    public $endDate ;
    public $rejectionReason;
    public $requests; 
    
    public function refreshRequests(){
        $this->requests = OrganizationProjectRequest::with('organization_user.organization')->where('approval_status', 'pending')->get();
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
    
        $request = OrganizationProjectRequest::find($requestId);
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
    
            OrganizationProject::create([
                'organization_user_id' => $request->organization_user_id,
                'project_name' => $request->project_name,
                'project_photo' => $request->project_photo,
                'project_file' => $request->project_file,
                'beneficiaries_count' => $request->beneficiaries_count,
                'description' => $request->description,
                'location' => $request->location,
                'status' => 'in_progress',
                'contact_number' => $request->contact_number,
                'whatsapp_number' => $request->whatsapp_number,
                'user_id' => auth('admin')->user()->id,
                'end_date' => $this->endDate,
            ]);
    
            DB::commit();
    
            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تمت الموافقة على الطلب بنجاح',
            ]);
            $this->refreshRequests();
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
        
        $request = OrganizationProjectRequest::find($requestId);
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
    }

    public function render()
    {
        return view('livewire.admin-dashboard.projects.requests.requests')->layout('layouts.app');
    }
}
