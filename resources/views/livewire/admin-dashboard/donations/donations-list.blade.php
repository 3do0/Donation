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
                            <h4 class="font-weight-semibold ">قائمة التبرعات</h4>
                            <p class="text-sm">معرفة حميع المعلومات عن التبرعات</p>
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
                                    <th class="text-center custom-btn-color">رقم المعاملة</th>
                                    <th class="text-center custom-btn-color">الحالة</th>
                                    <th class="text-center custom-btn-color">تاريخ التبرع</th>
                                    <th class="text-center custom-btn-color">التفاصيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $donation)
                                    <tr>
                                        <td class="text-center ">{{ $donation->id }}</td>
                                        <td class="text-center "><h6>{{ $donation->donor->name ?? 'زائر' }}</h6></td>
                                        <td class="text-center "><h6 class="text-success">{{ number_format($donation->total_amount, 2) }}</h6></td>
                                        <td class="text-center "><span class="badge outline-badge-info text-uppercase">{{ $donation->currency }}</span></td>
                                        <td class="text-center "><h6>{{ $donation->payment_method }}</h6></td>
                                        <td class="text-center ">
                                            <h6>
                                             <span title="{{ $donation->transaction_id}}">
                                                {{ \Illuminate\Support\Str::limit($donation->transaction_id, 15, '...')   ?? 'غير متوفر'}}
                                             </span>
                                            </h6>
                                        </td>
                                        <td class="text-center ">
                                            @if ($donation->status === 'pending')
                                                <span class="badge outline-badge-warning">قيد الانتظار</span>
                                            @elseif ($donation->status === 'paid')
                                                <span class="badge outline-badge-success">مدفوع ✔</span>
                                            @else
                                                <span class="badge outline-badge-danger">فشل</span>
                                            @endif
                                        </td>
                                        <td class="text-center text-warning">{{ $donation->created_at->format('h-i-s/ Y-m-d')}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm mx-2" data-toggle="modal" data-target="#detailsModal{{ $donation->id}}">تفاصيل التبرع</button>
                                        </td>

                                        {{-- Modal الخاص بالتفاصيل --}}
                                        <div class="modal fade" id="detailsModal{{ $donation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تفاصيل التبرع</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach ($donation->items as $item)
                                                            <li class="list-group bg-dark text-end mb-3 p-3 d-flex align-items-start">
                                                                <div class="d-flex flex-row">
                                                                    <div class="me-3">
                                                                        @if ($item->donatable_type === \App\Models\OrganizationCase::class)
                                                                            @if ($item->donatable)
                                                                                
                                                                            <a class="profile-img" href="{{ asset('storage/' .  $item->donatable->case_photo) }}" target="_blank">
                                                                                <img class="img-fluid rounded" src="{{ asset('storage/' . $item->donatable->case_photo) }}" alt="شعار المؤسسة" style="width: 80px; height: 80px; object-fit: cover;">
                                                                            </a>
                                                                            @endif
                                                                        @elseif ($item->donatable_type === \App\Models\PlatformDonation::class)
                                                                            <div class="d-flex flex-column align-items-start">
                                                                                <div class="mt-1 text-muted">
                                                                                    <strong>دعم للمنصة</strong>
                                                                                </div>
                                                                            </div>
                                                                        @else
                                                                            <div class="mt-1 text-danger">
                                                                                <em>نوع غير معروف</em>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mx-3">
                                                                        <div>
                                                                            <strong>المبلغ:</strong> {{ number_format($item->amount) }} 
                                                                            @if ($donation->currency == 'usd')
                                                                                $
                                                                            @elseif($donation->currency == 'sar')
                                                                                ر.س
                                                                            @else
                                                                                ر.ي
                                                                            @endif
                                                                        </div>
                                                                        @if ($item->donatable_type === \App\Models\OrganizationCase::class)
                                                                            <div class="mt-1 text-muted">
                                                                                رقم الحالة: {{ $item->donatable?->id ?? 'غير معروفة' }}
                                                                            </div>
                                                                            <div class="mt-1 text-muted">
                                                                                الحالة: {{ $item->donatable?->case_name ?? 'غير معروفة' }}
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">اغلاق</button>
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
                    "lengthMenu": [5, 10, 20, 50,100,200],
                    "pageLength": 50,
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

        // إعادة التهيئة بعد أي commit في Livewire
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

