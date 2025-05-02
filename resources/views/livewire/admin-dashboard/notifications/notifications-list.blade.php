@section('title')
    الإشعارات
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
<div class="mt-4">
    <div class="row">
        <!-- إجمالي الإشعارات -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fa fa-bell"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-warning mb-1">إجمالي الإشعارات</p>
                                <h4 class="mb-2 font-weight-bold">{{ $notificationsCount }}</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm ms-1">من المجموع الكلي</span>
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- إشعارات مقروءة -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fa fa-envelope-open-text"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-warning mb-1">المقروءة</p>
                                <h4 class="mb-2 font-weight-bold">{{ $readCount }}</h4>
                                <div class="d-flex align-items-center">
                                    
                                       
                                    <span class="text-sm ms-1">من الإجمالي</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- إشعارات غير مقروءة -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-warning mb-1">غير مقروءة</p>
                                <h4 class="mb-2 font-weight-bold">{{ $unreadCount }}</h4>
                                <div class="d-flex align-items-center">
                                    
                                    <span class="text-sm ms-1">من الإجمالي</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- متوسط الإشعارات اليومية -->
        <div class="col-xl-3 col-sm-6">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <i class="fa fa-calendar-day"></i>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-warning mb-1">متوسط يومي</p>
                                <h4 class="mb-2 font-weight-bold">{{ $dailyAverage }}</h4>
                                <div class="d-flex align-items-center">
                                   
                                    <span class="text-sm ms-1">من الأسبوع الماضي</span>
                                </div>
                               
                                
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
            <div class="widget-header ">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="font-weight-semibold ">قائمة الاشعارات</h4>
                       
                    </div>
                    <div class="m-4 d-flex align-items-center">
                        <button type="button"
                            class="btn btn-sm bg-transparent custom-btn-color btn btn-icon d-flex align-items-center  border border-white"
                             data-toggle="modal" data-target="#sendNotificationModal">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="d-block me-2" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C10.3431 2 9 3.34315 9 5V5.0946C6.16788 5.55862 4 8.03442 4 11V16L2 18V19H22V18L20 16V11C20 8.03442 17.8321 5.55862 15 5.0946V5C15 3.34315 13.6569 2 12 2ZM12 22C13.1046 22 14 21.1046 14 20H10C10 21.1046 10.8954 22 12 22Z">
                                </path>
                            </svg>
                            </span>
                            <span class="btn-inner--text ">اشعار FCM</span>
                        </button>

                        <button type="button"
                            class="btn btn-sm bg-transparent custom-btn-color btn-icon d-flex align-items-center  border border-warning m-2"
                             data-toggle="modal" data-target="#sendNotificationModal1">
                            <span class="btn-inner--icon">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                class="d-block me-2" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C10.3431 2 9 3.34315 9 5V5.0946C6.16788 5.55862 4 8.03442 4 11V16L2 18V19H22V18L20 16V11C20 8.03442 17.8321 5.55862 15 5.0946V5C15 3.34315 13.6569 2 12 2ZM12 22C13.1046 22 14 21.1046 14 20H10C10 21.1046 10.8954 22 12 22Z">
                                </path>
                            </svg>
                            </span>
                            <span class="btn-inner--text ">ارسال اشعار</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive overflow-hidden" wire:ignore>
                    <table id="style-1" class="table style-1">
                        <thead>
                            <tr>
                              
                                <th>النوع</th>
                                <th >الاسم</th>
                                <th>العنوان</th>
                                <th>الرسالة</th>
                                <th>الحالة</th>
                             
                                <th>تاريخ الإنشاء</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                            <tr>

                                <td  class="checkbox-column">{{ $notification->type }}</td>
                                <td> {{ $notification->donor?->name ?? 'غير معروف' }}</td>
                                <td>{{ $notification->title }}</td>
                                <td style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $notification->message }}</td>

                                <td>
                                    @if($notification->is_read)
                                        <span class="badge bg-success">مقروء</span>
                                    @else
                                        <span class="badge bg-danger">غير مقروء</span>
                                    @endif
                                </td>
                                <td>{{ $notification->created_at ? $notification->created_at->format('Y-m-d H:i') : 'غير متوفر' }}</td>
    
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <livewire:admin-dashboard.notifications.notifications-send>
                <livewire:admin-dashboard.notifications.notifications-push>
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