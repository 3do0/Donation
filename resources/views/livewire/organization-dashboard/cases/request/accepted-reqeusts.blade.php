<div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    @foreach ($requests as $request)
        <div class="col">
            <div class="card" style="min-height: 400px;"> 
                <img src="{{ asset('storage/' . $request->case_photo) }}" class="card-img-top" alt="صورة المشروع" style="object-fit: cover; height: 200px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $request->case_name }}</h5>
                    <p class="card-text ">
                        {{ $request->description }}
                    </p>
                </div>
                <div class="card-footer" style="background-color: rgba(7, 204, 253, 0.6);">
                    <a type="button"   data-bs-toggle="modal" data-bs-target="#editModal"  wire:click="editRequest({{ $request->id }})"  data-placement="top"
                        title="" data-original-title="Edit"><svg
                            xmlns="http://www.w3.user/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-check-circle text-primary">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg></a>
                    <small class="text-white">تمت المراجعة : {{ $request->created_at }}</small>
                  </div>
            </div>
        </div>
    @endforeach
    <div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-dark d-flex justify-content-between">
                <h5 class="modal-title text-white flex-grow-1">تعديل بيانات الحالة</h5>
                <button type="button" class="btn-close btn-close-white" aria-label="Close"  data-bs-dismiss="modal"></button>
            </div>
              <div class="modal-body">
                  <div class="mb-3">
                      <label>اسم الحالة</label>
                      <input type="text" class="form-control" wire:model.defer="editCaseName">
                  </div>
                  <div class="mb-3">
                      <label>الوصف</label>
                      <textarea class="form-control" wire:model.defer="editDescription"></textarea>
                  </div>
                  <div class="mb-3">
                    <label>صورة جديدة (اختياري)</label>
                    <input type="file" class="form-control" wire:model="editCasePhoto">
                </div>
                
              </div>
              <div >
                <div class="modal-footer">
                    
               
                  
                  <button type="submit" class="btn btn-dark btn-color"
                   wire:click="updateRequest" data-bs-dismiss="modal"
                  wire:loading.attr="disabled"
                  wire:target="editCasePhoto"
          >
              <div class="spinner-grow text-white mr-2 align-self-center loader-sm" wire:loading wire:target="editCasePhoto"></div>
             حفظ التعديلات
          </button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        </div>
          </div>
        </div>
      </div>
</div>
