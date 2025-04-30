@section('title')
    المشاريع الفعالة
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
                            <h4 class="font-weight-semibold ">قائمة المشاريع الحالية</h4>
                            <p class="text-sm">معرفة المشاريع المصادق عليها والتي تعمل الان</p>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive overflow-hidden">
                        <table id="style-1" class="table style-1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-center">رقم السجل</th>
                                    <th class="text-center custom-btn-color">اسم المشروع</th>
                                    <th class="text-center custom-btn-color">المنشىء</th>
                                    <th class="text-center custom-btn-color">المؤسسة التابع لها</th>
                                    <th class="text-center custom-btn-color">صورة المشروع</th>
                                    <th class="text-center custom-btn-color">ملف المشروع</th>
                                    <th class="text-center custom-btn-color">عدد المستفيدين</th>
                                    <th class="text-center custom-btn-color">الموقع</th>
                                    <th class="text-center custom-btn-color">رقم الاتصال</th>
                                    <th class="text-center custom-btn-color">واتس اب</th>
                                    <th class="text-center custom-btn-color">الحالة</th>
                                    <th class="text-center custom-btn-color">الزيارات</th>
                                    <th class="text-center custom-btn-color">تاريخ البدء</th>
                                    <th class="text-center custom-btn-color">تاريخ الأنتهاء</th>
                                    <th class="text-center custom-btn-color"> حساب الايام المتبقية</th>
                                    <th class="text-center custom-btn-color">وصف المشروع</th>
                                    <th class="text-center custom-btn-color">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td class="text-center text-white"> {{ $project->id }} </td>
                                        <td class="text-center text-white">{{ $project->project_name }}</td>
                                        <td class="text-center text-white">{{ $project->organization_user->name }}</td>
                                        <td class="text-center text-white">{{ $project->organization_user->organization->name }}</td>
                                        <td class="">
                                            @if ($project->project_photo)
                                                <a class="profile-img"
                                                    href="{{ asset('storage/' . $project->project_photo) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $project->project_photo) }}"
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
                                            @if ($project->project_file)
                                                <a href="{{ asset('storage/' . $project->project_file) }}" target="_blank"
                                                    class="btn btn-outline-info btn-rounded btn-sm">
                                                    عرض الملف
                                                </a>
                                            @else
                                                <p class="text-danger">لايوجد ملف</p>
                                            @endif
                                        </td>
                                        <td class="text-center text-white">{{ $project->beneficiaries_count }}</td>
                                        <td class="text-center text-white">{{ $project->location }}</td>
                                        <td class="text-center"><a class="text-white badge outline-badge-info " href="tel:+967{{ $project->contact_number }}">{{$project->contact_number}}</a></td>
                                        <td class="text-center"><a class="text-white badge outline-badge-success" href="tel:+967{{ $project->whatsapp_number }}">{{$project->whatsapp_number}}</a></td>
                                        <td class="text-center">
                                            @if ($project->status == 'completed')
                                            <span class="badge outline-badge-success">مكتملة</span>
                                            @elseif ($project->status == 'in_progress')
                                            <span class="badge outline-badge-info">مستمرة</span>
                                            @else
                                            <span class="badge outline-badge-danger">موقفة</span>
                                            @endif
                                        </td>
                                        <td class="text-center text-info">{{ $project->visitors_count}}</td>
                                        <td class="text-center text-warning">
                                            {{ $project->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="text-center text-danger">
                                            {{ $project->end_date->format('Y-m-d') }}
                                        </td>
                                        <td class="text-center text-danger">
                                            @if ($project->end_date)
                                                {{ max(floor(\Carbon\Carbon::now()->diffInDays($project->end_date, false)), 0) }}
                                            @else
                                                غير متاح
                                            @endif
                                        </td>
                                        <td class="text-center text-nowrap text-white">
                                            <span title="{{ $project->description }}">
                                                {{ \Illuminate\Support\Str::limit($project->description, 30, '...') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            @if ($project->status == 'in_progress')
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#stoping-{{ $project->id }}">
                                               تعطيل
                                            </button>
                                             @elseif ($project->status == 'stopped')
                                             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#continue-{{ $project->id }}">
                                                تشغيل
                                             </button>   
                                            @endif
                                        </td>

                                        <div id="stoping-{{ $project->id }}" class="modal animated fadeInLeft custo-fadeInLeft"
                                            role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">رفض المشروع</h5>
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
                                                        <p class="modal-text">هل أنت متأكد من توقيف هذا المشروع ؟</p>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn btn-danger" data-dismiss="modal"><i
                                                                class="flaticon-cancel-12"></i> إلغاء</button>
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="stopingProject({{ $project->id }})"
                                                            data-dismiss="modal">تأكيد</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="continue-{{ $project->id }}" class="modal animated fadeInLeft custo-fadeInLeft"
                                            role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">رفض المشروع</h5>
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
                                                        <p class="modal-text">هل أنت متأكد من تشغيل هذا المشروع ؟</p>
                                                    </div>
                                                    <div class="modal-footer md-button">
                                                        <button class="btn btn-danger" data-dismiss="modal"><i
                                                                class="flaticon-cancel-12"></i> إلغاء</button>
                                                        <button type="button" class="btn btn-primary"
                                                            wire:click="continueProject({{ $project->id }})"
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
@endpush

