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
    <div class="row">
        <!-- Card for New Posts -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-sm rounded-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex align-items-center">
                            <div class="icon-wrapper bg-primary rounded-circle p-3">
                                <i class="icon-pencil font-large-2"></i>
                            </div>
                            <div class="media-body text-end">
                                <h3>278</h3>
                                <span class="text-muted">New Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card for New Comments -->
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card shadow-sm rounded-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex align-items-center">
                            <div class="icon-wrapper bg-warning rounded-circle p-3">
                                <i class="icon-speech font-large-2"></i>
                            </div>
                            <div class="media-body text-end">
                                <h3>156</h3>
                                <span class="text-muted">New Comments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Partners Table Section -->
    <div class="row layout-spacing mt-5">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow border rounded">
                <div class="widget-header px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="font-weight-semibold ">قائمة الشركاء</h4>
                            <p class="text-sm">اطلع على جميع المعلومات حول شركائك في المنصة</p>
                        </div>
                        <div>
                            <a type="button"
                                class="btn btn-sm bg-transparent custom-btn-color btn-icon d-flex align-items-center  border border-white"
                                href="{{ route('partner-form') }}" wire:navigate>
                                <span class="btn-inner--icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.user/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                        <path
                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="btn-inner--text ">إضافة شريك جديد</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive overflow-hidden">
                        <table id="style-1" class="table style-1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-center checkbox-column"> Record no. </th>
                                    <th class="text-center custom-btn-color">اسم الشريك</th>
                                    <th class="text-center custom-btn-color">الشعار</th>
                                    <th class="text-center custom-btn-color">بيانات التواصل</th>
                                    <th class="text-center custom-btn-color">الموقع</th>
                                    <th class="text-center custom-btn-color">النوع</th>
                                    <th class="text-center custom-btn-color">مبلغ الدعم</th>
                                    <th class="text-center custom-btn-color">تفاصيل الدعم</th>
                                    <th class="text-center custom-btn-color">الحالــة</th>
                                    <th class="text-center custom-btn-color">تاريخ بدءالعقد</th>
                                    <th class="text-center custom-btn-color">تاريخ انتهاء العقد</th>
                                    <th class="custom-btn-color">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td class="checkbox-column"> {{ $partner->id }} </td>
                                        <td class="user-name">{{ $partner->name }}</td>
                                        <td class="">
                                            @if ($partner->logo)
                                                <a class="profile-img" href="{{ asset('storage/' . $partner->logo) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $partner->logo) }}"
                                                        alt="شعار المؤسسة">
                                                </a>
                                            @else
                                                <a class="profile-img" href="../assets/img/id.jpg" target="_blank">
                                                    <img src="../assets/img/id.jpg" alt="شعار المؤسسة">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $partner->email }}
                                                </h6>
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $partner->phone }}
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $partner->address }}</h6>
                                        </td>
                                        <td class="text-center"><span
                                                class="badge outline-badge-info">{{ $partner->type }}</span></td>
                                        <td class="text-center text-nowrap">
                                            @if ($partner->donation_amount)
                                            <h6 class="text-sm font-weight-semibold">{{ $partner->donation_amount }} ريال يمني
                                            </h6>
                                            @else
                                            <h6 class="text-sm font-weight-semibold">لا يوجــد
                                            </h6>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $partner->support_details }}
                                            </h6>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <label class="switch s-icons s-outline s-outline-info mr-2">
                                                <input type="checkbox" role="switch" id="{{ $partner->id }}"
                                                    wire:click="toggleStatus({{ $partner->id }})"
                                                    {{ $partner->status ? 'checked' : '' }} />
                                                <span class="slider round"></span>
                                            </label>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-warning text-sm font-weight-normal">{{ $partner->start_date }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-danger text-sm font-weight-normal">{{ $partner->end_date }}</span>
                                        </td>

                                        <td class="text-center">
                                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Edit"><svg
                                                    xmlns="http://www.w3.partner/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-check-circle text-primary">
                                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                </svg></a></li>
                                            <a type="button" wire:click="confirmDelete({{ $partner->id }})"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Delete"><svg
                                                    xmlns="http://www.w3.partner/2000/svg" width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
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

@push('scripts')
    <script>
        var c1 = $('#style-1').DataTable({
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML =
                    '<label class="new-control new-checkbox checkbox-outline-info">\n' +
                    '<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">\n' +
                    '<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n' +
                    '</label>';
            },
            columnDefs: [{
                    targets: 0,
                    width: "30px",
                    className: "",
                    orderable: false,
                    render: function(e, a, t, n) {
                        return '<label class="new-control new-checkbox checkbox-outline-info ">\n' +
                            '<input type="checkbox" class="new-control-input child-chk select-customers-info">\n' +
                            '<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>\n' +
                            '</label>';
                    }
                },
                {
                    targets: "_all",
                    width: "150px",
                    whiteSpace: "nowrap"
                } // ✅ منع تكدس النصوص في العناوين
            ],
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>'
                },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "بحـث...",
                "sLengthMenu": "النتيجة :  _MENU_",
            },
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5,
            "scrollX": true,
        });

        multiCheck(c1);
    </script>
@endpush
