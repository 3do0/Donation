<div>
    @if ($isOpen)
        <div wire:ignore.self class="modal fade show d-block" id="editPartnerModal" tabindex="-1"
            aria-labelledby="editPartnerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-dark d-flex justify-content-between">

                        <h5 class="modal-title text-white flex-grow-1">تعديل بيانات الشراكة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            wire:click="closeModal">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                        <form wire:submit.prevent="updatePartner" novalidate>
                            {{-- الحقول الأربعة الأولى --}}
                            <div class="mb-3">
                                <label class="form-label">الاسم</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">الشعار</label>
                                    <input type="file" class="form-control" wire:model="logo" accept="image/*">
                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="contractFile">ملف العقد </label>
                                    <input type="file" class="form-control" id="contractFile"
                                        wire:model="contract_file" accept=".pdf">
                                    @error('contract_file')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

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

                            <div class="mb-3">
                                <label class="form-label">العنوان</label>
                                <input type="text" class="form-control" wire:model="address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- باقي الحقول مع سكرول --}}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="partnerType">نوع الشريك</label>
                                    <select id="partnerType" class="form-control" wire:model="type" required>
                                        <option value="individual">فرد</option>
                                        <option value="company">شركة</option>
                                        <option value="government">حكومة</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">مبلغ التبرع</label>
                                    <input type="number" class="form-control" wire:model="donation_amount">
                                    @error('donation_amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">تفاصيل الدعم</label>
                                <textarea class="form-control" wire:model="support_details"></textarea>
                                @error('support_details')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="mb-3">
                                <label class="form-label">تاريخ البداية</label>
                                <input type="date" class="form-control" wire:model="start_date">
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">تاريخ النهاية</label>
                                <input type="date" class="form-control" wire:model="end_date">
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-warning btn-color" wire:loading.attr="disabled"
                                wire:target="logo,contract_file">
                                <div class="spinner-grow text-white mr-2 align-self-center loader-sm" wire:loading
                                    wire:target="logo,contract_file"></div>
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
