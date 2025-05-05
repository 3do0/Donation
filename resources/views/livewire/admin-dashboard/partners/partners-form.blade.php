<div class="p-4 bd mt-5 border rounded shadow-lg">
    <h6 class="c-grey-900 mb-4 text-warning text-lg">تسجيل الشركاء</h6>

    <form wire:submit.prevent="registerPartner">
        <!-- الاسم -->
        <div class="mb-3">
            <label class="form-label" for="partnerName">الاسم</label>
            <input type="text" class="form-control" id="partnerName" wire:model="name" placeholder="اسم الشريك هنا" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- البريد الإلكتروني -->
        <div class="mb-3">
            <label class="form-label" for="partnerEmail">البريد الإلكتروني</label>
            <input type="email" class="form-control" id="partnerEmail" wire:model="email" placeholder="البريد الإلكتروني هنا">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- رقم الهاتف -->
        <div class="mb-3">
            <label class="form-label" for="partnerPhone">رقم الهاتف</label>
            <input type="text" class="form-control" id="partnerPhone" wire:model="phone" placeholder="رقم الهاتف هنا">
            @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- الشعار -->
        <div class="mb-3">
            <label class="form-label" for="partnerLogo">شعار الشريك (اختياري)</label>
            <input type="file" class="form-control" id="partnerLogo" wire:model="logo">
            @error('logo') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- ملف العقد -->
        <div class="mb-3">
            <label class="form-label" for="contractFile">ملف العقد (اختياري)</label>
            <input type="file" class="form-control" id="contractFile" wire:model="contract_file">
            @error('contract_file') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- العنوان -->
        <div class="mb-3">
            <label class="form-label" for="partnerAddress">العنوان</label>
            <input type="text" class="form-control" id="partnerAddress" wire:model="address" placeholder="العنوان هنا">
            @error('address') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- نوع الشريك -->
        <div class="mb-3">
            <label class="form-label" for="partnerType">نوع الشريك</label>
            <select id="partnerType" class="form-control" wire:model="type" required>
                <option value="individual">فرد</option>
                <option value="company">شركة</option>
                <option value="government">حكومة</option>
            </select>
            @error('type') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- تفاصيل الدعم -->
        <div class="mb-3">
            <label class="form-label" for="supportDetails">تفاصيل الدعم</label>
            <textarea class="form-control" id="supportDetails" wire:model="support_details" rows="4" required></textarea>
            @error('support_details') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- مبلغ التبرع -->
        <div class="mb-3">
            <label class="form-label" for="donationAmount">مبلغ الدعم (اختياري)</label>
            <input type="number" class="form-control" id="donationAmount" wire:model="donation_amount" placeholder="مبلغ التبرع">
            @error('donation_amount') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- تاريخ البدء -->
        <div class="mb-3">
            <label class="form-label" for="startDate">تاريخ البدء</label>
            <input type="date" class="form-control" id="startDate" wire:model="start_date">
            @error('start_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- تاريخ الانتهاء -->
        <div class="mb-3">
            <label class="form-label" for="endDate">تاريخ الانتهاء</label>
            <input type="date" class="form-control" id="endDate" wire:model="end_date">
            @error('end_date') <div class="text-danger">{{ $message }}</div> @enderror
        </div>


        <!-- زر التسجيل -->
        <button type="submit" class="btn btn-warning btn-color">
            <div class="spinner-grow text-white mr-2 align-self-center loader-sm" wire:loading></div>
            أضافة الشريك</button>
    </form>
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
</script>

@endpush
