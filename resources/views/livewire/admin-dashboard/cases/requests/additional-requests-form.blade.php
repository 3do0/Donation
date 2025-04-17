<div class=" p-5 my-5 rounded border shadow-lg custom-form">
    <h6 class="mb-4 text-warning font-weight-semibold" style="font-size: 35px; font-weight:500;">طلب إضافة حالة جديدة</h6>

    @if (session()->has('message'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check text-success me-3"></i>
            <div>{{ session('message') }}</div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="AddCase">
        <div class="mb-3">
            <label class="form-label" for="inputCaseName">اسم الحالة</label>
            <input type="text" class="form-control" id="inputCaseName" wire:model="case_name">
            @error('case_name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputCaseType">نوع الحالة</label>
                <input type="text" class="form-control" id="inputCaseType" wire:model="case_type">
                @error('case_type') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputBeneficiariesCount">عدد المستفيدين</label>
                <input type="number" class="form-control" id="inputBeneficiariesCount" wire:model="beneficiaries_count">
                @error('beneficiaries_count') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="row">
            
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputTargetAmount">المبلغ المستهدف</label>
                <input type="number" class="form-control" id="inputTargetAmount" wire:model="target_amount">
                @error('target_amount') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label class="form-label" for="inputCurrency">العملة</label>
                <input type="text" class="form-control" id="inputCurrency" = disabled value="ريال يمني">
                @error('currency') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label" for="inputDescription">الوصف</label>
            <textarea class="form-control" id="inputDescription" wire:model="description"></textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="inputCasePhoto">صورة الحالة</label>
            <input type="file" class="form-control" id="inputCasePhoto" wire:model="case_photo">
            @error('case_photo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label" for="inputCasefile">ملف الحالة</label>
            <input type="file" class="form-control" id="inputCasefile" wire:model="case_file">
            @error('case_file') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- إشعار للمستخدم بأن الحالة في انتظار الموافقة -->
        <div class="alert alert-info my-4">
            <strong>ملاحظة:</strong> سيتم عرض الحالة في الموقع بعد مراجعتها  وموافقة المسؤول.
        </div>

        <button type="submit" class="btn btn-warning btn-block">إرسال الطلب</button>
    </form>
</div>