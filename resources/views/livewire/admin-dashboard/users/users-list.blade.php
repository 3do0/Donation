@section('title')
    مشرفي النظام
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
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg height="16" width="16" xmlns="http://www.w3.user/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                            <path fill-rule="evenodd"
                                d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-secondary mb-1">عدد المستخدمين</p>
                                <h4 class="mb-2 font-weight-bold">{{ $usersCount }}</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i class="fa fa-chevron-up text-xs ms-1"></i>10.5%
                                    </span>
                                    <span class="text-sm ms-1">من $89,740.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg width="16" height="16" xmlns="http://www.w3.user/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                clip-rule="evenodd" />
                            <path
                                d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-secondary mb-1">النشطين</p>
                                <h4 class="mb-2 font-weight-bold">{{ $onlineUserCount }}</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i class="fa fa-chevron-up text-xs ms-1"></i>55%
                                    </span>
                                    <span class="text-sm ms-1">من 243</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg width="16" height="16" xmlns="http://www.w3.user/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm2.25-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0113.5 9zm3.75-1.5a.75.75 0 00-1.5 0v9a.75.75 0 001.5 0v-9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-secondary mb-1">متوسط عملية</p>
                                <h4 class="mb-2 font-weight-bold">$450.53</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i class="fa fa-chevron-up text-xs ms-1"></i>22%
                                    </span>
                                    <span class="text-sm ms-1">من $369.30</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg width="16" height="16" xmlns="http://www.w3.user/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-secondary mb-1">مبيعات القسيمة</p>
                                <h4 class="mb-2 font-weight-bold">$23,364.55</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i class="fa fa-chevron-up text-xs ms-1"></i>18%
                                    </span>
                                    <span class="text-sm ms-1">من $19,800.40</span>
                                </div>
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
                            <h4 class="font-weight-semibold ">قائمة المستخدمين</h4>
                            <p class="text-sm">معرفة حميع المعلومات عن المستخدمين</p>
                        </div>
                        <div>
                            <a type="button"
                                class="btn btn-sm bg-transparent custom-btn-color btn-icon d-flex align-items-center  border border-white"
                                href="{{ route('users-form') }}" wire:navigate>
                                <span class="btn-inner--icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.user/2000/svg"
                                        viewBox="0 0 24 24" fill="currentColor" class="d-block me-2">
                                        <path
                                            d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="btn-inner--text ">أضافة مستخدم</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive overflow-hidden">
                        <table id="style-1" class="table style-1">
                            <thead>
                                <tr class="">
                                    <th class="text-center checkbox-column"> Record no. </th>
                                    <th class="custom-btn-color">المستخدم</th>
                                    <th class="text-center custom-btn-color">الجنس</th>
                                    <th class="text-center custom-btn-color">الحالــة</th>
                                    <th class="text-center custom-btn-color">تاريخ الانشاء</th>
                                    <th class="text-center custom-btn-color">التمكين</th>
                                    <th class="custom-btn-color">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr data-status="{{ $user->is_online ? 'online' : 'offline' }}">
                                        <td class="checkbox-column"> {{ $user->id }} </td>
                                        <td class="user-name">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex align-items-center">
                                                    @if ($user->photo)
                                                        <a class="profile-img"
                                                            href="{{ asset('storage/' . $user->photo) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/' . $user->photo) }}"
                                                                alt="صورة المستخدم"
                                                                class="rounded-circle profile-img">
                                                        </a>
                                                    @else
                                                        <a class="profile-img" href="../assets/img/id.jpg"
                                                            target="_blank">
                                                            <img src="../assets/img/id.jpg" alt="صورة المستخدم"
                                                                class="rounded-circle profile-img">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">{{ $user->name }}
                                                    </h6>
                                                    <p class="text-sm">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $user->gender }}</h6>
                                        </td>
                                        <td class="text-center">
                                            @if ($user->is_online)
                                                <span class="badge outline-badge-success">Online</span>
                                            @else
                                                <span class="badge outline-badge-dark">Offline</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-warning text-sm font-weight-normal">{{ $user->created_at->format('Y-m-d') ?? '-' }}</span>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <label class="switch s-icons s-outline s-outline-info mr-2">
                                                <input type="checkbox" role="switch" id="{{ $user->id }}"
                                                    wire:click="toggleStatus({{ $user->id }})"
                                                    {{ $user->is_active ? 'checked' : '' }} />
                                                <span class="slider round"></span>
                                            </label>
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
                                                </svg></a>
                                            </li>
                                            <a type="button" wire:click="confirmDelete({{ $user->id }})"
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
                                                </svg>
                                            </a>
                                            </li>
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
        // تأكد من إعادة تهيئة الجدول عند التنقل بين المكونات
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
