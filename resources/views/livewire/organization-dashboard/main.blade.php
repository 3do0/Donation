<div>
    <div class="row">
        <div class="swiper mySwiper mt-4 mb-2">
            <div class="swiper-wrapper">
                @foreach ($latestCases as $case)
                    <div class="swiper-slide">
                        <div>
                            <div
                                class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                <div class="full-background bg-cover"
                                    style="background-image: url({{ asset('storage/' . $case->case_photo) }})"></div>
                                <div class="card-body text-start px-0 py-0 w-100 ">
                                    <div class="row mt-12 bg-dark px-3">
                                        <div class="col-3 mt-auto text-end">
                                            <h4 class="text-white font-weight-bolder">{{ $case->id }}</h4>
                                            <p class="text-light text-xs font-weight-bolder mb-0">
                                                اسم
                                            </p>
                                            <h5 class="text-white font-weight-bolder text-nowrap">{{ $case->case_name }}
                                            </h5>
                                        </div>
                                        <div class="col-3 me-auto mt-auto">
                                            <p class="text-light text-xs font-weight-bolder mb-0">
                                                الفئة
                                            </p>
                                            <h5 class="text-white font-weight-bolder">
                                                {{ $case->case_type }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
            <div class="card shadow-xs border h-100">
                <div class="card-header pb-0">
                    <h6 class="font-weight-semibold text-lg mb-0">
                        أرصدة بمرور الوقت
                    </h6>
                    <p class="text-sm">هنا لديك تفاصيل حول الرصيد.</p>
                </div>
                <div class="card-body py-3">
                    <div class="chart mb-2">
                        <canvas id="chart-bars" class="chart-canvas" height="240"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6">
            <div class="card shadow-xs border">
                <div class="card-header border-bottom pb-0">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">
                                التبرعات الاخيرة
                            </h6>
                            <p class="text-sm mb-0">هذه تفاصيل حول المعاملات الأخيرة</p>
                        </div>
                        <div class="me-auto d-flex">
                            <button type="button" class="btn btn-sm btn-white mb-0 ms-2">
                                عرض التقرير
                            </button>
                            <a href="{{ route('organization.donations') }}" type="button" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0" wire:navigate="donations">
                                <span class="btn-inner--text">عرض المزيد</span>
                                <span class="btn-inner--icon">
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="d-block ms-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 12h18m-9-9l9 9-9 9-9-9 9-9" />
                                    </svg>
                                </span>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7">
                                        الحالة
                                    </th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                        مقدار
                                    </th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                        تاريخ
                                    </th>
                                    <th class="text-secondary text-xs font-weight-semibold opacity-7 ps-2">
                                        الحساب
                                    </th>
                                    <th class="text-center text-secondary text-xs font-weight-semibold opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $items = collect();
                                    foreach ($latestCases as $case) {
                                        foreach ($case->donationItems as $item) {
                                            $items->push([
                                                'case' => $case,
                                                'item' => $item
                                            ]);
                                        }
                                    }
                                    $items = $items->take(5);
                                @endphp

                                @foreach ($items as $data)
                                    @php
                                        $case = $data['case'];
                                        $item = $data['item'];
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div class="text-center">
                                                    <a class="profile-img"
                                                    href="{{ asset('storage/' . $case->case_photo) }}"
                                                    target="_blank">
                                                        <img src="{{ asset('storage/' . $case->case_photo) }}"
                                                            alt="صورة الحالة"
                                                            style="width: 40px; height: 40px; object-fit: cover; border-radius: .375rem;">
                                                    </a>
                                                </div>
                                                <div class="my-auto m-2">
                                                    <h6 class="mb-0 text-sm" title="{{ $case->case_name }}">
                                                        {{ \Illuminate\Support\Str::limit($case->case_name, 10, '...') }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $item->amount }}
                                                <span class="text-warning font-weight-bold">
                                                    @if ($item->donation->currency == 'usd')
                                                        $
                                                    @elseif ($item->donation->currency == 'sar')
                                                        ر.س
                                                    @else
                                                        ر.ي
                                                    @endif
                                                </span>
                                            </p>
                                        </td>
                                        <td>
                                            <span class="text-sm font-weight-normal">{{ $item->created_at->diffForHumans() }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex">
                                                <div class="border px-1 py-1 text-center d-flex align-items-center border-radius-sm my-auto">
                                                    @if ($item->donation->payment_method == 'visa')
                                                        <img src="{{ asset('assets/img/logos/visa.png') }}" class="w-90 mx-auto" alt="visa" />
                                                    @elseif ($item->donation->payment_method == 'mastercard')
                                                        <img src="{{ asset('assets/img/logos/mastercard.png') }}" class="w-90 mx-auto" alt="mastercard" />
                                                    @else
                                                        <img src="{{ asset('assets/img/logos/mastercard.png') }}" class="w-90 mx-auto" alt="mastercard" />
                                                    @endif
                                                </div>
                                                <div class="me-2">
                                                    <p class="text-dark text-sm mb-0">{{ $item->donation->donor ? $item->donation->donor->name : 'زائر'}}</p>
                                                    <p class="text-secondary text-sm mb-0">{{ $item->donation->donor? $item->donation->donor->email : '-----------' }}</p>
                                                </div>
                                            </div>
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
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card border shadow-xs mb-4">
                <div class="card-body text-start p-3 w-100">
                    <div
                        class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
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
                                <p class="text-sm text-secondary mb-1">تبرعات</p>
                                @inject('currency', 'App\Services\CurrencyChanges')
                                <h4 class="mb-2 font-weight-bold">{{ $currency->convert($totalDonations) }}</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i
                                            class="fa fa-chevron-up text-xs ms-1"></i>{{ number_format($donationLevel, 2) }}%
                                    </span>
                                    <span
                                        class="text-sm ms-1 text-warning">{{ $currency->convert($targetDonations) }}</span>
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
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
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
                                <p class="text-sm text-secondary mb-1">الحالات الفعلية</p>
                                <h4 class="mb-2 font-weight-bold">{{ $totalPendingCases }}</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i
                                            class="fa fa-chevron-up text-xs ms-1"></i>{{ number_format($pendingCasesLevel, 2) }}%
                                    </span>
                                    <span class="text-sm ms-1 text-warning">من {{ $totalCases }}</span>
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
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm2.25-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0113.5 9zm3.75-1.5a.75.75 0 00-1.5 0v9a.75.75 0 001.5 0v-9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-secondary mb-1">الحالات المكتملة</p>
                                <h4 class="mb-2 font-weight-bold">{{ $totalCompletedCases }}</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i
                                            class="fa fa-chevron-up text-xs ms-1"></i>{{ number_format($completedCasesLevel, 2) }}%
                                    </span>
                                    <span class="text-sm ms-1 text-warning">من {{ $totalCases }}</span>
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
                        <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="w-100 text-end">
                                <p class="text-sm text-secondary mb-1">إجمالي المشاريع</p>
                                <h4 class="mb-2 font-weight-bold">{{ $totalProjects }}</h4>
                                <div class="d-flex align-items-center">
                                    <span class="text-sm text-success font-weight-bolder">
                                        <i
                                            class="fa fa-chevron-up text-xs ms-1"></i>{{ number_format($projectsLevel, 2) }}%
                                    </span>
                                    <span class="text-sm ms-1 text-warning">من {{ $totalProjects }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-xs border">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">
                                نظرة عامة على التوازن
                            </h6>
                            <p class="text-sm mb-0">هنا لديك تفاصيل حول الرصيد.</p>
                        </div>
                        <div class="me-auto d-flex">
                            <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                عرض التقرير
                            </button>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 font-weight-semibold">{{ $currency->convert($totalDonations) }}</h3>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="chart mt-n6">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@section('js')
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}" type="text/javascript"></script>
<script>
    // دالة لتفعيل الـ Swiper و Chart عند التنقل بين المكونات
    function initSwiperAndChart() {
        if (document.getElementsByClassName("mySwiper")) {
            var swiper = new Swiper(".mySwiper", {
                effect: "cards",
                grabCursor: true,
                initialSlide: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        }

        window.addEventListener('updateChart', event => {
            const data = event.detail[0];
            const { cases, targets, caseNumbers } = data;

            var ctx = document.getElementById("chart-bars").getContext("2d");

            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: caseNumbers,
                    datasets: [
                        {
                            label: "تم جمعه",
                            tension: 0.4,
                            borderWidth: 0,
                            borderSkipped: false,
                            backgroundColor: "#2ca8ff",
                            data: cases,
                            maxBarThickness: 6,
                        },
                        {
                            label: "الهدف",
                            tension: 0.4,
                            borderWidth: 0,
                            borderSkipped: false,
                            backgroundColor: "#7c3aed",
                            data: targets,
                            maxBarThickness: 6,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                        },
                        tooltip: {
                            backgroundColor: "#fff",
                            titleColor: "#1e293b",
                            bodyColor: "#1e293b",
                            borderColor: "#e9ecef",
                            borderWidth: 1,
                            usePointStyle: true,
                        },
                    },
                    interaction: {
                        intersect: false,
                        mode: "index",
                    },
                    scales: {
                        y: {
                            stacked: true,
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [4, 4],
                            },
                            ticks: {
                                beginAtZero: true,
                                padding: 10,
                                font: {
                                    size: 12,
                                    family: "Noto Sans",
                                    style: "normal",
                                    lineHeight: 2,
                                },
                                color: "#64748B",
                            },
                        },
                        x: {
                            stacked: true,
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    family: "Tajawal",
                                    style: "normal",
                                    lineHeight: 2,
                                },
                                color: "#64748B",
                            },
                        },
                    },
                },
            });
        });

        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, "rgba(45,168,255,0.2)");
        gradientStroke1.addColorStop(0.2, "rgba(45,168,255,0.0)");
        gradientStroke1.addColorStop(0, "rgba(45,168,255,0)");

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, "rgba(119,77,211,0.4)");
        gradientStroke2.addColorStop(0.7, "rgba(119,77,211,0.1)");
        gradientStroke2.addColorStop(0, "rgba(119,77,211,0)");

        new Chart(ctx2, {
            plugins: [{
                beforeInit(chart) {
                    const originalFit = chart.legend.fit;
                    chart.legend.fit = function fit() {
                        originalFit.bind(chart.legend)();
                        this.height += 40;
                    };
                },
            }],
            type: "line",
            data: {
                labels: [
                    "Aug 18", "Aug 19", "Aug 20", "Aug 21", "Aug 22", "Aug 23", "Aug 24", "Aug 25", "Aug 26",
                    "Aug 27", "Aug 28", "Aug 29", "Aug 30", "Aug 31", "Sept 01", "Sept 02", "Sept 03", "Aug 22",
                    "Sept 04", "Sept 05", "Sept 06", "Sept 07", "Sept 08", "Sept 09",
                ],
                datasets: [
                    {
                        label: "مقدار",
                        tension: 0,
                        borderWidth: 2,
                        pointRadius: 3,
                        borderColor: "#2ca8ff",
                        pointBorderColor: "#2ca8ff",
                        pointBackgroundColor: "#2ca8ff",
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: [
                            2828, 1291, 3360, 3223, 1630, 980, 2059, 3092, 1831, 1842, 1902,
                            1478, 1123, 2444, 2636, 2593, 2885, 1764, 898, 1356, 2573, 3382,
                            2858, 4228,
                        ],
                        maxBarThickness: 6,
                    },
                    {
                        label: "تبرع",
                        tension: 0,
                        borderWidth: 2,
                        pointRadius: 3,
                        borderColor: "#832bf9",
                        pointBorderColor: "#832bf9",
                        pointBackgroundColor: "#832bf9",
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: [
                            2797, 2182, 1069, 2098, 3309, 3881, 2059, 3239, 6215, 2185,
                            2115, 5430, 4648, 2444, 2161, 3018, 1153, 1068, 2192, 1152,
                            2129, 1396, 2067, 1215, 712, 2462, 1669, 2360, 2787, 861,
                        ],
                        maxBarThickness: 6,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: "top",
                        align: "start",
                        labels: {
                            boxWidth: 6,
                            boxHeight: 6,
                            padding: 20,
                            pointStyle: "circle",
                            borderRadius: 50,
                            usePointStyle: true,
                            font: {
                                weight: 400,
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: "#fff",
                        titleColor: "#1e293b",
                        bodyColor: "#1e293b",
                        borderColor: "#e9ecef",
                        borderWidth: 1,
                        usePointStyle: true,
                    },
                },
                interaction: {
                    intersect: false,
                    mode: "index",
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [4, 4],
                        },
                        ticks: {
                            callback: function(value, index, ticks) {
                                return parseInt(value).toLocaleString() + " ریال";
                            },
                            display: true,
                            padding: 10,
                            color: "#b2b9bf",
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: "normal",
                                lineHeight: 2,
                            },
                            color: "#64748B",
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [4, 4],
                        },
                        ticks: {
                            display: true,
                            color: "#b2b9bf",
                            padding: 20,
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: "normal",
                                lineHeight: 2,
                            },
                            color: "#64748B",
                        },
                    },
                },
            },
        });
    }
    
    initSwiperAndChart();

    document.addEventListener('livewire:navigated', () => {
        requestAnimationFrame(() => {
            initSwiperAndChart();
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
    window.Echo.channel('case-request-updates')
        .listen('.CaseRequestResponding', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('CaseRequestResponding'); 
        });

   window.Echo.channel('reject-project')
        .listen('.ProjectRejection', (e) => {
            console.log('📢 استقبلنا الحدث العام PCreated:', e);
            Livewire.dispatch('ProjectRejection'); 
        });
</script>
@endsection

