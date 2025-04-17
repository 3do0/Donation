@section('title')
    Case Requests
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
                        <div>
                            <a type="button"
                                class="btn btn-sm bg-transparent custom-btn-color btn-icon d-flex align-items-center  border border-white"
                                href="{{ route('additional-request-case-form') }}" wire:navigate>
                                <span class="btn-inner--icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.user/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                        <path
                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="btn-inner--text ">طلب جديد</span>
                            </a>
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
                                    <th class="custom-btn-color">اسم الحالة</th>
                                    <th class="text-center custom-btn-color">صورة الحالة</th>
                                    <th class="text-center custom-btn-color">ملف الحالة</th>
                                    <th class="text-center custom-btn-color">نوع الحالة</th>
                                    <th class="text-center custom-btn-color">عدد المستفيدين</th>
                                    <th class="text-center custom-btn-color">وصف الحالة</th>
                                    <th class="text-center custom-btn-color">المبلغ المستهدف</th>
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
                                        <td class="">
                                            @if ($request->case_photo)
                                                <a class="profile-img"
                                                    href="{{ asset('storage/' . $request->case_photo) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $request->case_photo) }}"
                                                        alt="صورة الحالة">
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
                                        @inject('currency', 'App\Services\CurrencyChanges')
                                        <td class="text-center">{{ $currency->convert($request->target_amount ) }}</td>
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
                                        <td class="text-center">
                                            <a type="button" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Edit"><svg
                                                    xmlns="http://www.w3.user/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-check-circle text-primary">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg></a></li>
                                            <a type="button" wire:click="confirmDelete({{$request->id}})"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete"><svg xmlns="http://www.w3.user/2000/svg"
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

        multiCheck(c1);
    </script>
@endsection
