@section('title')
   المتبرعين
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
                            <h4 class="font-weight-semibold ">قائمة المستخدمين</h4>
                            <p class="text-sm">معرفة حميع المعلومات عن المستخدمين</p>
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
                                    <th class="text-center custom-btn-color">رقم الهاتف</th>
                                    <th class="text-center custom-btn-color">المدينة</th>
                                    <th class="text-center custom-btn-color">الجنس</th>
                                    <th class="text-center custom-btn-color">تاريخ الانشاء</th>
                                    <th class="text-center custom-btn-color">التمكين</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donors as $donor)
                                    <tr>
                                        <td class="checkbox-column"> {{ $donor->id }} </td>
                                        <td class="user-name">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex align-items-center">
                                                    @if ($donor->avatar)
                                                        <a class="profile-img"
                                                            href="{{ asset('storage/' . $donor->avatar) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/' . $donor->avatar) }}"
                                                                alt=""
                                                                class="rounded-circle profile-img">
                                                        </a>
                                                    @else
                                                        <a class="profile-img" href="../assets/img/id.jpg"
                                                            target="_blank">
                                                            <img src="{{ asset('assets/img/tim.png')}}" alt="صورة المستخدم"
                                                                class="rounded-circle profile-img">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-1">
                                                    <h6 class="mb-0 text-sm font-weight-semibold">{{ $donor->name }}
                                                    </h6>
                                                    <p class="text-sm">{{ $donor->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $donor->phone }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $donor->country }}</h6>
                                        </td>
                                        <td class="text-center">
                                            <h6 class="text-sm font-weight-semibold">{{ $donor->gender }}</h6>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span
                                                class="text-warning text-sm font-weight-normal">{{ $donor->created_at ? $donor->updated_at->format('Y-m-d') :   '-------' }}</span>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <label class="switch s-icons s-outline s-outline-info mr-2">
                                                <input type="checkbox" role="switch" id="{{ $donor->id }}"
                                                    wire:click="toggleStatus({{ $donor->id }})"
                                                    {{ $donor->is_active ? 'checked' : '' }} />
                                                <span class="slider round"></span>
                                            </label>
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
        if (tableElement.length && $.fn.DataTable) {
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

    document.addEventListener('livewire:navigated', async () => {
        await new Promise(resolve => setTimeout(resolve, 100));
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

        window.Echo.channel('reject-project')
        .listen('.ProjectRejection', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('ProjectRejection'); 
        });

        window.Echo.channel('new-donation')
        .listen('.NewDonation', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('NewDonation'); 
        });
</script>

@endpush
