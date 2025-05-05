@section('title')
    Case Response
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

<div class="mt-4">
    <div class="row layout-spacing mt-5">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow border rounded">
                <div class="widget-header px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="font-weight-semibold ">قائمة طلبات الحالات</h4>
                            <p class="text-sm">إدارة طلبات الحالات من حيث الموافقة أو الرفض</p>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    @if (session()->has('message'))
                        <div class="alert alert-success mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ...
                                </svg></button>
                            {{ session('message') }}</button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ...
                                </svg></button>
                            {{ session('error') }}</button>
                        </div>
                    @endif
                    <div class="table-responsive overflow-hidden">
                        <table id="style-1" class="table style-1">
                            <thead>
                                <tr>
                                    <th class="text-center">رقم السجل</th>
                                    <th class="text-center custom-btn-color">اسم الحالة</th>
                                    <th class="text-center custom-btn-color">المؤسسة التابع لها</th>
                                    <th class="text-center custom-btn-color">صورة الحالة</th>
                                    <th class="text-center custom-btn-color">ملف الحالة</th>
                                    <th class="text-center custom-btn-color">نوع الحالة</th>
                                    <th class="text-center custom-btn-color">عدد المستفيدين</th>
                                    <th class="text-center custom-btn-color">وصف الحالة</th>
                                    <th class="text-center custom-btn-color">المبلغ المستهدف</th>
                                    <th class="text-center custom-btn-color">العملة</th>
                                    <th class="text-center custom-btn-color">الحالة</th>
                                    <th class="text-center custom-btn-color">تاريخ الإنشاء</th>
                                    <th class="text-center custom-btn-color">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr data-status="{{ $request->approval_status }}">
                                        <td class="text-center"> {{ $request->id }} </td>
                                        <td class="text-center">{{ $request->case_name }}</td>
                                        <td class="text-center">{{ $request->organization_user->organization->name }}</td>
                                        <td class="">
                                            @if ($request->case_photo)
                                                <a class="profile-img"
                                                    href="{{ asset('storage/' . $request->case_photo) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $request->case_photo) }}"
                                                        alt="شعار المؤسسة">
                                                </a>
                                            @else
                                                <a class="profile-img" href="../assets/img/id.jpg" target="_blank">
                                                    <img src="../assets/img/id.jpg" alt="شعار المؤسسة">
                                                </a>
                                            @endif
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($request->case_file)
                                                <a href="{{ asset('storage/' . $request->case_file) }}" target="_blank"
                                                    class="btn btn-outline-info btn-rounded btn-sm">
                                                    عرض الملف
                                                </a>
                                            @else
                                                <p class="text-danger">لايوجد ملف</p>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $request->case_type }}</td>
                                        <td class="text-center">{{ $request->beneficiaries_count }}</td>
                                        <td class="text-center text-nowrap">
                                            <span title="{{ $request->description }}">
                                                {{ \Illuminate\Support\Str::limit($request->description, 30, '...') }}
                                            </span>
                                        </td>
                                        <td class="text-center">{{ $request->target_amount }}</td>
                                        <td class="text-center">{{ $request->currency }}</td>
                                        <td class="text-center">
                                            @if ($request->approval_status == 'approved')
                                                <span class="badge outline-badge-success">تمت الموافقة</span>
                                            @elseif ($request->approval_status == 'rejected')
                                                <span class="badge outline-badge-danger">مرفوضة</span>
                                            @else
                                                <span class="badge outline-badge-warning">قيد المراجعة</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $request->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="text-center d-flex align-items-center justify-content-between">
                                            <button class="btn btn-primary btn-sm mx-2" data-toggle="modal"
                                                data-target="#approve-{{ $request->id}}">موافقة</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#reject-{{ $request->id }}">رفض</button>

                                        </td>
                                        {{--  Modal الخاص بالقبول --}}
                                        <div id="approve-{{ $request->id}}" class="modal animated fadeInLeft custo-fadeInLeft"
                                            role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">الموافقة على الحالة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.request/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-x">
                                                                <line x1="18" y1="6" x2="6"
                                                                    y2="18"></line>
                                                                <line x1="6" y1="6" x2="18"
                                                                    y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="modal-text">حدد مدة حالة الطلب من الخيارات التالية:</p>
                                                        <!-- اختيار مدة التاريخ -->
                                                        <div class="form-group">
                                                            <label for="duration">مدة الحالة:</label>
                                                            <select class="form-control" id="duration"
                                                                wire:model="duration">
                                                                <option>أختر مدة</option>
                                                                <option value="6">6 أشهر</option>
                                                                <option value="9">9 أشهر</option>
                                                                <option value="12">12 شهرًا</option>
                                                            </select>
                                                            {{-- @error('duration')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn btn-danger" data-dismiss="modal"><i
                                                                class="flaticon-cancel-12"></i> إلغاء</button>
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click.prevent="approve({{ $request->id }})"
                                                            data-dismiss="modal">تأكيد</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        {{--  Modal الخاص بالرفض --}}
                                        <div id="reject-{{ $request->id }}" class="modal animated fadeInLeft custo-fadeInLeft"
                                            role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">رفض الحالة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.request/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none" stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-x">
                                                                <line x1="18" y1="6" x2="6"
                                                                    y2="18"></line>
                                                                <line x1="6" y1="6" x2="18"
                                                                    y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="modal-text">يرجى تحديد سبب الرفض للطلب:</p>
                                                        <!-- حقل سبب الرفض -->
                                                        <div class="form-group">
                                                            <label for="rejectionReason">سبب الرفض:</label>
                                                            <textarea class="form-control" id="rejectionReason" wire:model="rejectionReason" rows="4"
                                                                placeholder="ادخل سبب الرفض هنا..."></textarea>
                                                            {{-- @error('rejectionReason')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn btn-danger" data-dismiss="modal"><i
                                                                class="flaticon-cancel-12"></i> إلغاء</button>
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="reject({{ $request->id }})"
                                                            data-dismiss="modal">تأكيد</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script>
    function initDataTableIfExists() {
        let tableElement = $('#style-1');
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
                "lengthMenu": [5, 10, 20, 50],
                "pageLength": 5,
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
