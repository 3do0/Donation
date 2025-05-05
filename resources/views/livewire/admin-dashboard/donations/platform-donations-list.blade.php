
@section('title')
    التبرعات
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
                            <h4 class="font-weight-semibold ">قائمة دعم المنصة</h4>
                            <p class="text-sm">معرفة حميع المعلومات عن الدعم للمصنة</p>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive overflow-hidden">
                        <table id="style-1" class="table style-1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th class="text-center">#</th>
                                    <th class="text-center custom-btn-color">المتبرع</th>
                                    <th class="text-center custom-btn-color">المبلغ</th>
                                    <th class="text-center custom-btn-color">العملة</th>
                                    <th class="text-center custom-btn-color">طريقة الدفع</th>
                                    <th class="text-center custom-btn-color">تاريخ التبرع</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $support)
                                    <tr>
                                        <td class="text-center ">{{ $support->id }}</td>
                                        <td class="text-center "><h6>{{ $support->donation->donor->name ?? 'زائر' }}</h6></td>
                                        <td class="text-center "><h6 class="text-success">{{ number_format($support->amount, 2) }}</h6></td>
                                        <td class="text-center "><span class="badge outline-badge-info text-uppercase">ر.ي</span></td>
                                        <td class="text-center "><h6>{{ $support->donation->payment_method }}</h6></td>
                                        <td class="text-center text-warning">{{ $support->created_at->format('h-i-s/ Y-m-d') }}</td>

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
                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f>>>>' +
                         '<"col-md-12"rt>' +
                         '<"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>>',
                    buttons: [
                        { extend: 'copy', className: 'btn ' },
                        { extend: 'csv', className: 'btn ' },
                        { extend: 'excel', className: 'btn' },
                        { extend: 'print',
                          className: 'btn' ,
                          customize: function (win) {
                                $(win.document.body).find('table thead th:nth-child(9), table tbody td:nth-child(9)').css('display', 'none');
                            }
                            
                         }
                    ],
                    headerCallback: function(e, a, t, n, s) {
                        e.getElementsByTagName("th")[0].innerHTML =
                            '<label class="new-control new-checkbox checkbox-outline-info m-auto">' +
                            '<input type="checkbox" class="new-control-input chk-parent select-customers-info" id="customer-all-info">' +
                            '<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>' +
                            '</label>';
                    },
                    columnDefs: [{
                        targets: 0,
                        width: "30px",
                        orderable: false,
                        render: function(e, a, t, n) {
                            return '<label class="new-control new-checkbox checkbox-outline-info m-auto">' +
                                '<input type="checkbox" class="new-control-input child-chk select-customers-info">' +
                                '<span class="new-control-indicator"></span><span style="visibility:hidden">c</span>' +
                                '</label>';
                        }
                    }],
                    oLanguage: {
                        oPaginate: {
                            sPrevious: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                            sNext: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>'
                        },
                        sInfo: "عرض الصفحة _PAGE_ من _PAGES_",
                        sSearch: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        sSearchPlaceholder: "بحـث...",
                        sLengthMenu: "عدد النتائج : _MENU_"
                    },
                    lengthMenu: [5, 10, 20, 50],
                    pageLength: 5,
                    scrollX: true
                });

                multiCheck(dt);
            }
        }

        // إعادة التهيئة بعد التنقل بين مكونات Livewire
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

    window.Echo.channel('new-donation')
        .listen('.NewDonation', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('NewDonation'); 
        });
</script>
@endpush

