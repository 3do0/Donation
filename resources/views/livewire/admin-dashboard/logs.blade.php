<div class="mt-4 rounded card shadow-xs border">
    
  <div class="card-header border-bottom pb-0 bg-dark">
      <div class="d-flex align-items-center mb-3">
          <div>
              <h4 class="font-weight-semibold mb-0 text-white">
                  جدول السجلات
              </h4>
              <p class="text-sm mb-0 text-light">هذه تفاصيل حول المعاملات الأخيرة</p>
          </div>
          <div class="me-auto d-flex">
              <button type="button" class="btn btn-sm btn-white mb-0 ms-2">
                  عرض التقرير
              </button>
              <button type="button" class="btn btn-sm btn-warning btn-icon d-flex align-items-center mb-0">
                  <span class="btn-inner--icon">
                      <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="d-block ms-2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                      </svg>
                  </span>
                  <span class="btn-inner--text">تحميل</span>
              </button>
          </div>
      </div>

      <div class="d-flex align-items-center mb-3">
          <div class="row w-100 g-2">
              <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0">
                  <select class="form-select text-center border-dark border-2" wire:model.defer="selectedTable">
                      <option value="">الجدول</option>
                      <option value="User">المستخدمين</option>
                      <option value="permissions">الأذونات</option>
                  </select>
              </div>

              <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0">
                  <select class="form-select text-center border-dark border-2" wire:model.defer="selectedAction">
                      <option value="">الإجراء</option>
                      <option value="created">إنشاء</option>
                      <option value="updated">تحديث</option>
                      <option value="deleted">حذف</option>
                  </select>
              </div>

              <div class="col-12 col-md-6 col-lg-3 mb-2 mb-lg-0">
                  <select class="form-select text-center border-dark border-2" wire:model.defer="selectedUser">
                      <option value="">بواسطة</option>
                      @foreach ($users as $user)
                        <option value="{{$user->name}}">{{$user->name}}</option>
                        @endforeach
                  </select>
              </div>

              <div class="col-12 col-md-6 col-lg-3">
                  <button class="btn btn-info w-60 py-2 me-7" wire:click="search">
                      <i class="bi bi-search"></i> بحث
                  </button>
              </div>
          </div>
      </div>
  </div>

  <div class="card-body px-0 py-0">
      <div class="table-responsive p-0">
          <table class="table table-hover text-center">
              <thead class="bg-gray-100">
                  <tr>
                      <th class="text-dark">#</th>
                      <th class="text-dark">بواسطة</th>
                      <th class="text-dark">الجدول</th>
                      <th class="text-dark">الإجراء</th>
                      <th class="text-dark">السجل المتأثر</th>
                      <th class="text-dark">التاريخ</th>
                      <th class="text-dark">التفاصيل</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse($activities as $activity)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $activity->causer->name ?? 'غير معروف' }}</td>
                          <td>{{ class_basename($activity->subject_type) }}</td>
                          <td>
                              <span class="badge badge-sm {{ 
                                  $activity->description == 'created' ? 'border-success text-success bg-success' : 
                                  ($activity->description == 'updated' ? 'border-warning text-warning bg-warning' : 
                                  ($activity->description == 'deleted' ? 'border-danger text-danger bg-danger' : ''))
                              }}">
                                  {{ $activity->description }}
                              </span>
                          </td>
                          <td>{{ $activity->subject_id }}</td>
                          <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                          <td>
                              <button 
                              type="button" 
                              class="btn btn-warning btn-sm" 
                              data-bs-toggle="modal" 
                              data-bs-target="#detailsModal"
                              data-username="{{ $activity->causer->name ?? 'غير معروف' }}"
                              data-action="{{ $activity->description }}"
                              data-table="{{ class_basename($activity->subject_type) }}"
                              data-record="{{ $activity->subject_id }}"
                              data-date="{{ $activity->created_at->format('Y-m-d H:i') }}"
                              data-ip="{{ $activity->properties['ip'] ?? 'غير متوفر' }}"
                              data-browser="{{ $activity->properties['browser'] ?? 'غير معروف' }}"
                              data-os="{{ $activity->properties['os'] ?? 'غير معروف' }}">
                              مشاهدة
                          </button>
                          
                          
                              
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="7" class="text-center">لا توجد سجلات مطابقة</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  
</div>





<!-- زر لفتح النافذة -->

<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="detailsModalLabel">تفاصيل السجل</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body text-start">
          <p><strong>المستخدم:</strong> <span id="modal-username"></span></p>
          <p><strong>الإجراء:</strong> <span id="modal-action"></span></p>
          <p><strong>الجدول:</strong> <span id="modal-table"></span></p>
          <p><strong>السجل المتأثر:</strong> <span id="modal-record"></span></p>
          <p><strong>التاريخ:</strong> <span id="modal-date"></span></p>
          <p><strong>عنوان IP:</strong> <span id="modal-ip"></span></p>
          <p><strong>نوع المتصفح:</strong> <span id="modal-browser"></span></p>
          <p><strong>نظام التشغيل:</strong> <span id="modal-os"></span></p> <!-- عرض نظام التشغيل -->
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
      </div>
  </div>
</div>
</div>




</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
var detailsModal = document.getElementById('detailsModal');
detailsModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget;

  // جلب البيانات من الأزرار
  var username = button.getAttribute('data-username');
  var action = button.getAttribute('data-action');
  var table = button.getAttribute('data-table');
  var record = button.getAttribute('data-record');
  var date = button.getAttribute('data-date');
  var ip = button.getAttribute('data-ip');
  var browser = button.getAttribute('data-browser');
  var os = button.getAttribute('data-os');

  // تحديث محتوى النافذة المنبثقة
  document.getElementById('modal-username').textContent = username;
  document.getElementById('modal-action').textContent = action;
  document.getElementById('modal-table').textContent = table;
  document.getElementById('modal-record').textContent = record;
  document.getElementById('modal-date').textContent = date;
  document.getElementById('modal-ip').textContent = ip;
  document.getElementById('modal-browser').textContent = browser;
  document.getElementById('modal-os').textContent = os; 
});
});

</script>


