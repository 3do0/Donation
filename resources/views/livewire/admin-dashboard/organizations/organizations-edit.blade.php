<div>
    @if ($isOpen)
    <div wire:ignore.self class="modal fade show d-block" id="editOrgModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header ">
                    <h5 class="modal-title text-white">تعديل بيانات الجمعية</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeModal">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                    <form wire:submit.prevent=" updateOrganization" novalidate>
                        <!-- اسم المؤسسة -->
                        <div class="mb-3">
                            <label class="form-label">اسم المؤسسة</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <!-- الشعار -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">الشعار</label>
                                <input type="file" class="form-control" wire:model="logo" accept="image/*">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- ملف التصاريح -->
                            <div class="mb-3 col-md-6">
                                <label class="form-label">ملف التصاريح</label>
                                <input type="file" class="form-control" wire:model="license" accept=".pdf">
                                @error('license')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- بيانات التوصيل (الإيميل) -->
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="inputActivityType">نوع النشاط الخيري</label>
                                <select id="inputActivityType" class="form-control" wire:model='activity_type' multiple>
                                    @foreach (App\Enums\OrganizationType::cases() as $case)
                                    <option value="{{ $case->name }}">{{ $case->value }}</option>
                                    @endforeach
                                </select>
                                @error('activity_type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- موقع المؤسسة (المحافظة والحي) -->
                            <div class="mb-3 col-md-6">

                                <label class="form-label" for="inputCity">المدينة</label>
                                <select id="inputCity" class="form-control" wire:model='city'>
                                    @foreach (App\Enums\Cities::cases() as $case)
                                    <option value="{{ $case->value }}">{{ $case->value }}</option>
                                    @endforeach
                                </select>
                                @error('city')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <!-- رقم التسجيل -->
                                <div class="mb-3">
                                    <label class="form-label">رقم التسجيل</label>
                                    <input type="text" class="form-control" wire:model="registration_number">
                                    @error('registration_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الحي</label>
                            <input type="text" class="form-control" wire:model="address">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <!-- البنك ورقم الحساب -->
                        <div class="mb-3">
                            <label class="form-label">البنك</label>
                            <input type="text" class="form-control" wire:model="bank">
                            @error('bank')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">رقم الحساب البنكي</label>
                            <input type="text" class="form-control" wire:model="bank_account">
                            @error('bank_account')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <!-- رابط المؤسسة -->
                        <div class="mb-3">
                            <label class="form-label">رابط المؤسسة</label>
                            <input type="text" class="form-control" wire:model="organization_link">
                            @error('organization_link')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-warning btn-color" wire:loading.attr="disabled"
                            wire:target="logo,license">
                            <div class="spinner-grow text-white mr-2 align-self-center loader-sm" wire:loading
                                wire:target="logo,license"></div>
                            حفظ التعديلات
                        </button>

                        <button type="button" class="btn btn-dark" wire:click="closeModal">إلغاء</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-backdrop fade show" id="backdrop" wire:ignore></div>
    @endif
</div>
@push('scripts')
<script>
    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env('PUSHER_APP_KEY') }}',
        cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        forceTLS: true,
    });

    window.Echo.channel('case-updates')
        .listen('.CaseCreated', (e) => {
            console.log('📢 استقبلنا الحدث العام CaseCreated:', e);
            Livewire.dispatch('CaseCreated'); 
        });

        window.Echo.channel('reject-project')
        .listen('.ProjectRejection', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('ProjectRejection'); 
        });

        window.Echo.channel('new-donation')
        .listen('.NewDonation', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('NewDonation'); 
        });
</script>

<script>
    document.addEventListener('close-EditOgModal', () => {
        document.getElementById('editOrgModal').classList.remove('show', 'd-block');
        document.getElementById('backdrop').remove();
        document.addEventListener('organizationUpdated', () => {
            document.getElementById('editOrgModal').classList.remove('show', 'd-block');
            document.getElementById('backdrop').remove();
        });
    });
</script>
@endpush