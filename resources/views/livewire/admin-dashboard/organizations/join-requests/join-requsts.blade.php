@section('title')
طلبات الأنضمام
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
    <div class="row">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-pencil primary font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>278</h3>
                                <span>New Posts</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="icon-speech warning font-large-2 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>156</h3>
                                <span>New Comments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row layout-spacing mt-5">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow border rounded">
                <div class="widget-header px-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="font-weight-semibold ">قائمة الجمعيات الخيريـة</h4>
                            <p class="text-sm">معرفة حميع المعلومات عن الجمعيات الخيرية المسجله لدى المنصة</p>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive overflow-hidden">
                        <table id="style-1" class="table style-1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-center checkbox-column"> Record no. </th>
                                    <th class="custom-btn-color">أسم المؤسسة</th>
                                    <th class="custom-btn-color">الشعار</th>
                                    <th class="text-center custom-btn-color">بيانات التواصل</th>
                                    <th class="custom-btn-color">موقع المؤسسـة</th>
                                    <th class="text-center custom-btn-color">نوع النشاط</th>
                                    <th class="text-center custom-btn-color"> رقم التسجيل</th>
                                    <th class="custom-btn-color ">البنك الذي تتعامل معة</th>
                                    <th class="custom-btn-color">رقم حساب البنك</th>
                                    <th class="custom-btn-color">ملف التصاريح</th>
                                    <th class="text-center custom-btn-color">رابط المؤسسـة</th>
                                    <th class="custom-btn-color">تاريخ الانشاء</th>
                                    <th class="custom-btn-color">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td class="checkbox-column"> {{ $request->id }} </td>
                                        <td class="user-name">{{ $request->name }}</td>
                                        <td class="">
                                            @if ($request->logo)
                                                <a class="profile-img" href="{{ asset('storage/' . $request->logo) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/' . $request->logo) }}" alt="شعار المؤسسة">
                                                </a>
                                            @else
                                                <a class="profile-img" href="../assets/img/id.jpg" target="_blank">
                                                    <img src="../assets/img/id.jpg" alt="شعار المؤسسة">
                                                </a>
                                            @endif
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $request->email }}</h6>
                                                <h6 class="mb-0 text-sm font-weight-semibold">{{ $request->phone }}</h6>
                                            </div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">المـحـافـظـة :
                                                    <span
                                                        class="font-weight-semibold text-warning">{{ $request->city }}</span>
                                                </h6>
                                                <h6 class="mb-0 text-sm">الـحـي :
                                                    <span
                                                        class="font-weight-semibold text-warning">{{ $request->address }}</span>
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm ">
                                            @php
                                                $activities = explode(',', $request->activity_type);
                                            @endphp
                                            <div class="text-center"
                                                style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; max-width: 300px; margin: auto;">
                                                @foreach ($activities as $activity)
                                                    <span class="badge outline-badge-info">{{ $activity }}</span>
                                                @endforeach
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $request->registration_number }}
                                            </h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $request->bank_name }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $request->bank_account_number }}
                                            </h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            @if ($request->license)
                                                <a href="{{ asset('storage/' . $request->license) }}" target="_blank"
                                                    class="btn btn-outline-info btn-rounded btn-sm">
                                                    عرض الملف
                                                </a>
                                            @else
                                                لا يوجد ملف
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ $request->web_url }}" class="btn btn-link bg-transparent"
                                                target="_blank">
                                                <h6 class="text-decoration-underline">{{ $request->web_url }}</h6>
                                            </a>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-warning text-sm font-weight-normal">{{ $request->created_at->format('Y-m-d') }}</span>
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
                                                        <p class="modal-text">هل أنت متأكد من هذه العملية ؟ يرجى التأكيد </p>
                                                        <!-- اختيار مدة التاريخ -->
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
@endpush