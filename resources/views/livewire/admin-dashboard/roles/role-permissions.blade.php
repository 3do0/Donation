
<div class="p-4 mt-5 border rounded shadow-lg">
    <div class="container mt-3">
        <h3 class="text-center mb-4">تعديل صلاحيات الدور</h3>
        <form  wire:submit.prevent="savePermissions">
            <!-- صفوف الصلاحيات -->
            <div class="row g-3 row-cols-1 row-cols-md-2 row-cols-lg-3">

                <!-- العناصر الرئيسية -->
                @foreach ($permissions as $permission)
                    
                <div class="col">
                    <div class="card-body p-3 d-flex align-items-center gap-2">
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" id="updatePermissions" 
                            wire:model.defer="rolePermissions"
                            value="{{ $permission->id }}"
                            @if (in_array($permission->id, $rolePermissions))
                             checked 
                             @endif
                             >
                        </div>
                        <label class="form-check-label m-0">{{$permission->name}}</label>
                    </div>
                </div>
                @endforeach
                
            </div>

            <!-- زر الحفظ -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fas fa-save me-2"></i>حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>
