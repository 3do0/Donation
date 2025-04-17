<?php

namespace App\Livewire\AdminDashboard\Organizations\JoinRequests;

use App\Mail\AcceptanceOrganizationApply;
use App\Mail\RejectionOrganizationApply;
use App\Models\Organization;
use App\Models\OrganizationUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class JoinRequsts extends Component
{
    public $requests;
    public $rejectionReason;

    public function mount()
    {
        $this->refreshOrganizations();
    }

    public function refreshOrganizations()
    {
        $this->requests = Organization::where('status', 'pending')->get();
    }

    public function approve($requestId)
    {
        $organization = Organization::find($requestId);

        if (!$organization) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' =>'طلب غير موجود',
            ]);
            return;
        }

        try {
            DB::beginTransaction();

            $organization->update([
                'status' => 'approved',
                'approval_status' => true,
            ]);

            $user = OrganizationUser::create([
                'name'            => $organization->name,
                'email'           => $organization->email,
                'phone'           => $organization->phone,
                'organization_id' => $organization->id,
                'photo'           => $organization->logo,
            ]);

            if (!$user) {
                DB::rollBack();
                $this->dispatch('swal:toast', [
                    'icon' => 'error',
                    'title' => 'فشل إنشاء حساب المستخدم التابع للمنظمة',
                ]);
                return;
            }
            Mail::to($organization->email)->send(new AcceptanceOrganizationApply($organization));

            $status = Password::broker('organizations')->sendResetLink([
                'email' => $user->email,
            ]);


            if ($status !== Password::RESET_LINK_SENT) {
                DB::rollBack();
                $this->dispatch('swal:toast', [
                    'icon' => 'error',
                    'title' => 'فشل في إرسال رابط تعيين كلمة المرور',
                ]);
                return;
            }

            DB::commit();
            
            $this->dispatch('swal:toast', [
                'icon' => 'success',
                'title' => 'تمت الموافقة على الطلب بنجاح',
            ]);


            $this->refreshOrganizations();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'حدث خطأ أثناء تنفيذ العملية',
            ]);
        }

    }


    public function reject($requestId)
    {
        
        $request = Organization::find($requestId);
        if (!$request) {
            $this->dispatch('swal:toast', [
                'icon' => 'error',
                'title' => 'طلب غير موجود',
            ]);
            return;
        }

        $request->approval_status = false;
        $request->status = 'rejected';
        $request->rejection_reason = $this->rejectionReason; 
        $request->save(); 

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'تم رفض الطلب بنجاح',
        ]);
        Mail::to($request->email)->send(new RejectionOrganizationApply($this->rejectionReason));
        $this->refreshOrganizations();
    }

    public function render()
    {
        return view('livewire.admin-dashboard.organizations.join-requests.join-requsts')->layout('layouts.app');
    }
}
