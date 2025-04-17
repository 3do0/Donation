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
                            <h4 class="font-weight-semibold ">قائمة الحالات الحالية</h4>
                            <p class="text-sm">معرفة الحالات المصادق عليها والتي تعمل الان</p>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive overflow-hidden">
                        <table id="style-1" class="table style-1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-center">رقم السجل</th>
                                    <th class="text-center custom-btn-color">اسم الحالة</th>
                                    <th class="text-center custom-btn-color">المؤسسة التابع لها</th>
                                    <th class="text-center custom-btn-color">صورة الحالة</th>
                                    <th class="text-center custom-btn-color">ملف الحالة</th>
                                    <th class="text-center custom-btn-color">المبلغ المستهدف</th>
                                    <th class="text-center custom-btn-color">ما تم جمعه</th>
                                    <th class="text-center custom-btn-color">المبلغ المتبقي</th>
                                    <th class="text-center custom-btn-color">العملة</th>
                                    <th class="text-center custom-btn-color">نوع الحالة</th>
                                    <th class="text-center custom-btn-color">عدد المستفيدين</th>
                                    <th class="text-center custom-btn-color">الحالة</th>
                                    <th class="text-center custom-btn-color">تاريخ البدء</th>
                                    <th class="text-center custom-btn-color">تاريخ الأنتهاء</th>
                                    <th class="text-center custom-btn-color"> حساب الايام المتبقية</th>
                                    <th class="text-center custom-btn-color">وصف الحالة</th>
                                    <th class="text-center custom-btn-color">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orgcases as $case)
                                    <tr>
                                        <td class="text-center"> {{ $case->id }} </td>
                                        <td class="text-center">{{ $case->case_name }}</td>
                                        <td class="text-center">{{ $case->organization->name }}</td>
                                        <td class="">
                                            @if ($case->case_photo)
                                                <a class="profile-img"
                                                    href="{{ asset('storage/' . $case->case_photo) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $case->case_photo) }}"
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
                                            @if ($case->case_file)
                                                <a href="{{ asset('storage/' . $case->case_file) }}" target="_blank"
                                                    class="btn btn-outline-info btn-rounded btn-sm">
                                                    عرض الملف
                                                </a>
                                            @else
                                                <p class="text-danger">لايوجد ملف</p>
                                            @endif
                                        </td>
                                        @inject('currency', 'App\Services\CurrencyChanges')
                                        <td class="text-center">{{ $currency->convert($case->target_amount ) }}</td>
                                        <td class="text-center">{{ $currency->convert($case->raised_amount ) }}</td>
                                      
                                        <td class="text-center">{{  $currency->convert( max($case->target_amount - $case->raised_amount, 0)) }}</td>
                                        <td class="text-center">{{ $case->currency }}</td>
                                        <td class="text-center">{{ $case->case_type }}</td>
                                        <td class="text-center">{{ $case->beneficiaries_count }}</td>
                                        <td class="text-center">
                                            @if ($case->status == 'done')
                                                <span class="badge outline-badge-success">مكتملة</span>
                                            @elseif ($case->status == 'in_progress')
                                                <span class="badge outline-badge-warning">يتم الجمع</span>
                                            @else
                                                <span class="badge outline-badge-danger">موقفة</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $case->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $case->end_date->format('Y-m-d') }}
                                        </td>
                                        <td class="text-center">
                                            @if ($case->end_date)
                                                {{ max(floor(\Carbon\Carbon::now()->diffInDays($case->end_date, false)), 0) }}
                                            @else
                                                غير متاح
                                            @endif
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <span title="{{ $case->description }}">
                                                {{ \Illuminate\Support\Str::limit($case->description, 30, '...') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Edit"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-check-circle text-primary">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg></a></li>
                                            <a type="button" wire:click="confirmDelete({{ $case->id }})"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-x-circle text-danger">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="15" y1="9" x2="9"
                                                        y2="15"></line>
                                                    <line x1="9" y1="9" x2="15"
                                                        y2="15"></line>
                                                </svg></a></li>
                                        </td>
                                        
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

@section('PageJavaScribt')
    <script src="{{ asset('assets/plugins/table/datatable/datatables.js') }}"></script>
    <script>
        c1 = $('#style-1').DataTable({
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML =
                    '<label class="new-control new-checkbox checkbox-outline-info m-auto">\n<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
            },
            columnDefs: [{
                targets: 0,
                width: "30px",
                className: "",
                orderable: !1,
                render: function(e, a, t, n) {
                    return '<label class="new-control new-checkbox checkbox-outline-info  m-auto">\n<input type="checkbox" class="new-control-input child-chk select-customers-info" id="customer-all-info">\n<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n</label>'
                }
            }],
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.case/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.case/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.case/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "بحـث...",
                "sLengthMenu": "النتيجة :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5,
            "scrollX": true,
        });

        multiCheck(c1);
    </script>
@endsection
