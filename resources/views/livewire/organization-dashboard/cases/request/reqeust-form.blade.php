<div class="mt-5 bg-white p-2 border rounded shadow-lg">
    <div class="row">
        <div class="p-4">
            <h6 class="mb-4 text-warning font-weight-semibold" style="font-size: 35px; font-weight:500;">
                طلب إضافة حالة
            </h6>

            <form wire:submit.prevent="AddRequest">

                {{-- اسم الحالة --}}
                <div class="mb-3">
                    <label class="form-label" for="inputCaseName">اسم الحالة</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <input type="text" class="form-control" id="inputCaseName" wire:model="case_name">
                    </div>
                    @error('case_name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- نوع الحالة وعدد المستفيدين --}}
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputCaseType">نوع الحالة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-list-ul"></i></span>
                            <select class="form-select" id="inputCaseType" wire:model="case_type">
                                <option value="">-- اختر نوع الحالة --</option>
                                <option value="صحية">صحية</option>
                                <option value="تعليمية">تعليمية</option>
                                <option value="إغاثية">إغاثية</option>
                                <option value="سكنية">سكنية</option>
                                <option value="أخرى">أخرى</option>
                            </select>
                        </div>
                        @error('case_type') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputBeneficiariesCount">عدد المستفيدين</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                            <input type="number" class="form-control" id="inputBeneficiariesCount"
                                wire:model="beneficiaries_count">
                        </div>
                        @error('beneficiaries_count') <div class="text-danger">{{ $message }}</div> @enderror
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
                        @error('target_amount') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="inputCurrency">العملة</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-currency-exchange"></i></span>
                            <input type="text" class="form-control" id="inputCurrency" value="ريال يمني" disabled>
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
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- صورة الحالة --}}
                <div class="mb-3">
                    <label class="form-label" for="inputCasePhoto">صورة الحالة</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-image-fill"></i></span>
                        <input type="file" class="form-control" id="inputCasePhoto" wire:model="case_photo">
                    </div>
                    @error('case_photo') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- ملف الحالة --}}
                <div class="mb-3">
                    <label class="form-label" for="inputCaseFile">ملف الحالة</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-file-earmark-arrow-up"></i></span>
                        <input type="file" class="form-control" id="inputCaseFile" wire:model="case_file">
                    </div>
                    @error('case_file') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- تنبيه --}}
                <div class="alert alert-info my-4">
                    <strong>ملاحظة:</strong> سيتم مراجعة الحالة من قبل الإدارة قبل نشرها في الموقع.
                </div>

                {{-- زر الإرسال --}}
                <button type="submit" class="btn btn-warning btn-block">إرسال الطلب</button>
            </form>
        </div>
    </div>
</div>
