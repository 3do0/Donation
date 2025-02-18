
<div class="bg-white p-4 mt-5 border rounded shadow-lg">
    <div class="container mt-3">
        <h3 class="text-center mb-4">إنشاء الادوار</h3>
        <form wire:submit="createRole">
         
                <label class="form-label" for="rolename">اسم الدور الجديد</label>
                <input type="text" class="form-control" wire:model.live="roleName" id="rolename" name="name">
                @error('roleName') <span class="text-danger">{{ $message }}</span> @enderror

            <!-- صفوف الصلاحيات -->
            <h6 class="mt-4">اسناد الصلاحيات للدور :</h6>
            <div class="row g-3 row-cols-1 row-cols-md-2 row-cols-lg-3 border mt-1 rounded">

                <!-- العناصر الرئيسية -->
                @foreach ($permissions as $permission)
                    
                <div class="col">
                    <div class="card-body p-3 d-flex align-items-center gap-2">
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" wire:model="selectedPermissions" value="{{ $permission->name }}" id="updatePermissions" 
                           
                             >
                        </div>
                        <label class="form-check-label m-0">{{$permission->name}}</label>
                    </div>
                </div>
                @endforeach
                
            </div>

            <!-- زر الحفظ -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-warning px-5" >
                    <i class="fas fa-save me-2"></i>حفظ التغييرات
                </button>
            </div>
        </form>
       
    </div>
</div>

