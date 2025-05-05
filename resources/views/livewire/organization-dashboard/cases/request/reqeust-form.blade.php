<div class="modal fade" id="createCaseModal" tabindex="-1" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog  modal-xl " style="max-width: 120vh;transform: translateX(-70px)">

        <div class="modal-content">
            <div class="modal-header  bg-dark d-flex justify-content-between">
                <h5 class="modal-title text-white flex-grow-1">تسجيل الحالات</h5>

                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="restForm"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="AddRequest">

                    {{-- اسم الحالة --}}
                    <div class="mb-3">
                        <label class="form-label" for="inputCaseName">اسم الحالة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                            <input type="text" class="form-control" id="inputCaseName" wire:model="case_name">
                        </div>
                        @error('case_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- نوع الحالة وعدد المستفيدين --}}
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputCaseType">نوع الحالة</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-list-ul"></i></span>
                                <select class="form-select" id="inputCaseType" wire:model="case_type">
                                    <option value="">-- اختر نوع الحالة --</option>
                                    <option value="طبي">صحية</option>
                                    <option value="تعليمي">تعليمية</option>
                                    <option value="إجتماعي">إجتماعية</option>
                                    <option value="ديني">دينية</option>
                                    <option value="أخرى">أخرى</option>
                                </select>
                            </div>
                            @error('case_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputBeneficiariesCount">عدد المستفيدين</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                                <input type="number" class="form-control" id="inputBeneficiariesCount"
                                    wire:model="beneficiaries_count">
                            </div>
                            @error('beneficiaries_count')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- المبلغ المستهدف والعملة --}}
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputTargetAmount">المبلغ المستهدف</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                                <input type="number" class="form-control" id="inputTargetAmount"
                                    wire:model="target_amount">
                            </div>
                            @error('target_amount')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="inputCurrency">العملة</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-currency-exchange"></i></span>
                                <input type="text" class="form-control" id="inputCurrency" value="ريال يمني"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    {{-- الوصف --}}
                    <div class="mb-3">
                        <label class="form-label" for="inputDescription">الوصف</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-chat-text"></i></span>
                            <textarea class="form-control" id="inputDescription" wire:model="description"></textarea>
                        </div>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- صورة الحالة --}}
                    <div class=" row">
                        <div class="mb-3  col-md-6">
                            <label class="form-label" for="inputCasePhoto">صورة الحالة</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-image-fill"></i></span>
                                <input type="file" class="form-control" id="inputCasePhoto" wire:model="case_photo"
                                    accept="image/*">
                            </div>
                            @error('case_photo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ملف الحالة --}}
                        <div class="mb-3  col-md-6">
                            <label class="form-label" for="inputCaseFile">ملف الحالة</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-file-earmark-arrow-up"></i></span>
                                <input type="file" class="form-control" id="inputCaseFile" wire:model="case_file"
                                    accept=".pdf">
                            </div>
                            @error('case_file')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- تنبيه --}}
                    <div class="alert alert-info my-4">
                        <strong>ملاحظة:</strong> سيتم مراجعة الحالة من قبل الإدارة قبل نشرها في الموقع.
                    </div>

                    {{-- زر الإرسال --}}
                    <button type="submit" class="btn btn-warning btn-color" wire:loading.attr="disabled"
                        wire:target="case_photo,case_file">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-sm" wire:loading
                            wire:target="case_photo,case_file"></div>
                        إرسال الطلب
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="restForm">
                        الغاء</button>
                </form>
            </div>
        </div>
    </div>
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
    document.addEventListener('CaseCreated', () => {

        const modalElement = document.getElementById('createCaseModal');
        const modal = bootstrap.Modal.getInstance(modalElement);

        if (modal && modal._isShown) { 
            modal.hide(); 
        }
    });
</script>

@endpush