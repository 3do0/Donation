<div>
    @if($isOpen)
    <div class="modal fade show " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white">تعديل بيانات المستخدم</h5>
                   
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="updateUser">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الجنس</label>
                            <select class="form-control" wire:model="gender">
                                <option value="ذكر">ذكر</option>
                                <option value="أنثى">أنثى</option>
                            </select>
                            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary bg-dark">حفظ التعديلات</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">إلغاء</button>
                    </form>
                </div>
            </div>
            </div>
            </div>
            @endif
</div>


 