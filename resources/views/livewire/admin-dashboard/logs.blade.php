@section('title')
 سجلات النظام
@endsection

@section('PageCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/custom_dt_custom.css') }}">

    @php
        $theme = session('theme', 'dark');
    @endphp

    @if ($theme === 'light')
        <link rel="stylesheet" type="text/css"
            href="{{ asset('assets/plugins/table/datatable/dt-global_style-light.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/dt-global_style.css') }}">
    @endif
@endsection


<div>
<div class="card shadow-sm  mt-4">
    <div class="card-header  bg-gray text-white  mb-3">
        <div class="d-flex justify-content-between align-items-center  bg-gray">
            <div>
                <h5 class="mb-0">جدول السجلات</h5>
                <small>هذه تفاصيل حول المعاملات الأخيرة</small>
            </div>
           
        </div>

        <div class="row mt-3 g-2  bg-gray mb-3">
            <div class="col-md-3">
                <select class="form-control text-center text-white bg-gray" wire:model.defer="selectedTable">
                    <option value="">الجدول</option>
                    <option value="User">المستخدمين</option>
                    <option value="Donor">المتبرعين</option>
                    <option value="Organization">الجمعيات</option>
                    <option value="OrganizationUser">مستخدمي الجمعيات</option>
                    <option value="OrganizationCase">الحالات</option>
                    <option value="OrganizationCaseRequest">طلبات الحالات</option>
                    <option value="CaseReport">تقارير الحالات</option>
                    <option value="OrganizationProject">المشاريع</option>
                    <option value="OrganizationProjectRequest">طلبات المشاريع</option>
                    <option value="Partner">الشركاء</option>
                    <option value="CaseModel">الحالات</option>
                    <option value="Donation">التبرعات</option>
                    <option value="QuickDonation">التبرع السريع</option>
                    <option value="Project">المشاريع</option>
                    <option value="DonorFeedback">التقييمات</option>
                    <option value="Notification">الإشعارات</option>
                    <option value="Report">التقارير</option>
                </select>
                
            </div>
            <div class="col-md-3">
                <select  class="form-control form-control-sm text-center  text-white bg-gray   " wire:model.defer="selectedAction">
                    <option value="">الإجراء</option>
                    <option value="created">إنشاء</option>
                    <option value="updated">تحديث</option>
                    <option value="deleted">حذف</option>
                </select>
                
                
                
            </div>
            <div class="col-md-3">
                <select class="form-control form-control-sm text-center  text-white bg-gray   "  wire:model.defer="selectedUser">
                    <option value="">بواسطة</option>
                
                    <optgroup class="bg-gray text-warning" label="المدراء">
                        @foreach ($adminUsers as $user)
                            <option class="text-muted" value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </optgroup>
                
                    <optgroup class="bg-gray text-warning" label="مستخدمي الجمعيات">
                        @foreach ($orgUsers as $user)
                            <option class="text-muted" value="{{ $user->name }}">{{ $user->name }}</option>
                        @endforeach
                    </optgroup>
                </select>
                
                
                
            </div>
            <div class="col-md-3  ms-10">
                <button class="btn btn-info w-50" wire:click="search">
                    فرز <i class="bi bi-arrow-left mx-3"></i> 
                </button>
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark" id="logs-table">
                <thead class="bg-gray">
                    <tr>
                        <th>#</th>
                        <th>بواسطة</th>
                        <th>الجدول</th>
                        <th>الإجراء</th>
                        <th>السجل المتأثر</th>
                        <th>التاريخ</th>
                        <th>التفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $activity->causer->name ?? 'غير معروف' }}</td>
                            <td>{{ class_basename($activity->subject_type) }}</td>
                            <td>
                                <span class="badge bg-{{ 
                                    $activity->description == 'created' ? 'success' : 
                                    ($activity->description == 'updated' ? 'warning' : 
                                    ($activity->description == 'deleted' ? 'danger' : 'secondary')) }}">
                                    {{ $activity->description }}
                                </span>
                            </td>
                            <td>{{ $activity->subject_id }}</td>
                            <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning"
                                    data-bs-toggle="modal" data-bs-target="#detailsModal"
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
                            <td colspan="7">لا توجد سجلات مطابقة</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
        <div class="row gy-2">
            <div class="col-12 d-flex justify-content-between">
                <span><strong>المستخدم:</strong></span>
                <span id="modal-username" class="text-muted"></span>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <span><strong>الإجراء:</strong></span>
                <span id="modal-action" class="text-muted"></span>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <span><strong>الجدول:</strong></span>
                <span id="modal-table" class="text-muted"></span>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <span><strong>السجل المتأثر:</strong></span>
                <span id="modal-record" class="text-muted"></span>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <span><strong>التاريخ:</strong></span>
                <span id="modal-date" class="text-muted"></span>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <span><strong>عنوان IP:</strong></span>
                <span id="modal-ip" class="text-muted"></span>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <span><strong>نوع المتصفح:</strong></span>
                <span id="modal-browser" class="text-muted"></span>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <span><strong>نظام التشغيل:</strong></span>
                <span id="modal-os" class="text-muted"></span>
            </div>
        </div>
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
    document.addEventListener('click', function (e) {
        if (e.target.matches('[data-bs-target="#detailsModal"]')) {
            var button = e.target;

            document.getElementById('modal-username').textContent = button.getAttribute('data-username');
            document.getElementById('modal-action').textContent = button.getAttribute('data-action');
            document.getElementById('modal-table').textContent = button.getAttribute('data-table');
            document.getElementById('modal-record').textContent = button.getAttribute('data-record');
            document.getElementById('modal-date').textContent = button.getAttribute('data-date');
            document.getElementById('modal-ip').textContent = button.getAttribute('data-ip');
            document.getElementById('modal-browser').textContent = button.getAttribute('data-browser');
            document.getElementById('modal-os').textContent = button.getAttribute('data-os');
        }
    });
</script>


@push('scripts')
<script>
    function initDataTableIfExists() {
        let tableElement = $('#logs-table');
        if (tableElement.length) {
            if ($.fn.DataTable.isDataTable(tableElement)) {
                tableElement.DataTable().destroy();
            }
            const dt = tableElement.DataTable({
                headerCallback: function(e, a, t, n, s) {
                    e.getElementsByTagName("th")[0].innerHTML =
                        '<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>';
                },
                columnDefs: [{
                    targets: 0,
                    width: "30px",
                    orderable: false,
                    render: function(e, a, t, n) {
                        return '<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>';
                    }
                }],
                "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.request/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.request/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.request/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "بحـث...",
                "sLengthMenu": "النتيجة :  _MENU_",
                },
                "lengthMenu": [5, 10, 20, 50,100,500],
                "pageLength": 50,
                "scrollX": true,
            });

            multiCheck(dt);
        }
    }

    document.addEventListener('livewire:navigated', () => {
        
        requestAnimationFrame(() => {
            initDataTableIfExists();
        });
    });

    document.addEventListener('livewire:init', () => {
        window.Livewire.hook('commit', ({ succeed }) => {
            succeed(() => {
                requestAnimationFrame(() => {
                    initDataTableIfExists();
                });
            });
        });
    });
</script>
@endpush





