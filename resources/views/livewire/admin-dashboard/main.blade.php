@section('title')
    لوحة التحكم
@endsection

@section('PageCss')
    <link href="{{ asset('assets/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
@endsection

<div class="row layout-top-spacing">

    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-one">
            <div class="widget-heading">
                <h6 class="">الاحصائيات</h6>
            </div>
            <div class="w-chart">
                <div class="w-chart-section">
                    <div class="w-detail">
                        <p class="w-title">إجمالي الزيارات</p>
                        <p class="w-stats">350</p>
                    </div>
                    <div class="w-chart-render-one">
                        <div id="total-users"></div>
                    </div>
                </div>

                <div class="w-chart-section">
                    <div class="w-detail">
                        <p class="w-title">إجمالي المتبرعين</p>
                        <p class="w-stats">{{ $DonationsCount }}</p>
                    </div>
                    <div class="w-chart-render-one">
                        <div id="paid-visits" data-donors="{{ $DonationsCount }}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-account-invoice-two">
            <div class="widget-content">
                <div class="account-box">
                    <div class="info">
                        <h5 class="">رصيد المنصة</h5>
                        @inject('currency', 'App\Services\CurrencyChanges')
                        <p class="inv-balance">{{ $currency->convert($platform_balance) }}</p>
                    </div>
                    <div class="acc-action ">
                        <a href="{{ route('donations') }}" wire:navigate>التبرعات</a>
                        <a href="{{ route('donations-report') }} " wire:navigate>التقارير</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-content">
                    <div class="w-info">
                        @inject('currency', 'App\Services\CurrencyChanges')
                        <h6 class="value">{{ $currency->convert($totalDonations) }}</h6>
                        <p class="">اجمالي التبرعات</p>
                    </div>
                    <div class="">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="progress">
                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 57%"
                        aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="">
                    <h5 class="">تفاعلات المنصة</h5>
                </div>

                <div class="dropdown  custom-dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-more-horizontal">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="uniqueVisitors">
                        <a class="dropdown-item" href="javascript:void(0);">View</a>
                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                        <a class="dropdown-item" href="javascript:void(0);">Download</a>
                    </div>
                </div>
            </div>

            <div class="widget-content">
                <div id="uniqueVisits"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-activity-three">

            <div class="widget-heading">
                <h5 class="">احداث المنصة</h5>
            </div>

            @inject('currency', 'App\Services\CurrencyChanges')

            <div class="widget-content">
                <div class="mt-container mx-auto">
                    <div class="timeline-line">

                        <div class="item-timeline timeline-new">
                            <div class="t-dot">
                                <div class="t-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-dollar-sign">
                                        <line x1="12" y1="1" x2="12" y2="23"></line>
                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 1 1 0 7H6"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="t-content">
                                <div class="t-uppercontent">
                                    <h5>إجمالي التبرعات</h5>
                                    <span>{{ $currency->convert($totalDonations) }}</span>
                                </div>
                                <p>المبلغ الكلي لجميع التبرعات</p>
                                <div class="tags">
                                    <div class="badge badge-primary">تبرعات</div>
                                </div>
                            </div>
                        </div>

                        <div class="item-timeline timeline-new">
                            <div class="t-dot">
                                <div class="t-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                        <path d="M17 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M7 21v-2a4 4 0 0 1 3-3.87"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        <path d="M8 3.13a4 4 0 0 0 0 7.75"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="t-content">
                                <div class="t-uppercontent">
                                    <h5>عدد المتبرعين</h5>
                                    <span>{{ $DonorsCount }}</span>
                                </div>
                                <p>إجمالي عدد المتبرعين المسجلين</p>
                                <div class="tags">
                                    <div class="badge badge-success">متبرعين</div>
                                </div>
                            </div>
                        </div>

                        <div class="item-timeline timeline-new">
                            <div class="t-dot">
                                <div class="t-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-layers">
                                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                                        <polyline points="2 17 12 22 22 17"></polyline>
                                        <polyline points="2 12 12 17 22 12"></polyline>
                                    </svg>
                                </div>
                            </div>
                            <div class="t-content">
                                <div class="t-uppercontent">
                                    <h5>عدد الحالات</h5>
                                    <span>{{ $CasesCount }}</span>
                                </div>
                                <p>عدد الحالات المعروضة في المنصة</p>
                                <div class="tags">
                                    <div class="badge badge-danger">حالات</div>
                                </div>
                            </div>
                        </div>

                        <div class="item-timeline timeline-new">
                            <div class="t-dot">
                                <div class="t-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-credit-card">
                                        <rect x="1" y="4" width="22" height="16" rx="2"
                                            ry="2"></rect>
                                        <line x1="1" y1="10" x2="23" y2="10"></line>
                                    </svg>
                                </div>
                            </div>
                            <div class="t-content">
                                <div class="t-uppercontent">
                                    <h5>رصيد المنصة</h5>
                                    <span>{{ $currency->convert($platform_balance) }}</span>
                                </div>
                                <p>المبلغ المخصص لدعم المنصة من التبرعات</p>
                                <div class="tags">
                                    <div class="badge badge-warning">منصة</div>
                                </div>
                            </div>
                        </div>

                        @foreach ($topThreeCases as $case)
                            <div class="item-timeline timeline-new">
                                <div class="t-dot">
                                    <div class="t-dark">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-star">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27
                                                 17 14.14 18.18 21.02 12 17.77
                                                 5.82 21.02 7 14.14 2 9.27
                                                 8.91 8.26 12 2">
                                            </polygon>
                                        </svg>
                                    </div>
                                </div>
                                <div class="t-content">
                                    <div class="t-uppercontent">
                                        <h5>{{ $loop->first ? 'أعلى حالة' : 'حالة مميزة' }}: {{ $case->title }}</h5>
                                        <span>{{ $currency->convert($case->raised_amount) }}</span>
                                    </div>
                                    <p>تم جمع هذا المبلغ من أصل {{ $currency->convert($case->required_amount) }}</p>
                                    <div class="tags">
                                        <div class="badge badge-dark">
                                            {{ $case->organization_user->organization->name ?? 'غير معروف' }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>



        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-four">
            <div class="widget-heading">
                <h5 class="">الأكثر تبرعًا</h5>
            </div>
            <div class="widget-content">
                <div class="vistorsBrowser">
                    @php $index = 0; @endphp

                    @foreach ($topThreeCases as $case)
                        @php
                            $collected = $case->raised_amount;
                            $required = $case->target_amount;
                            $percentage = $required > 0 ? round(($collected / $required) * 100) : 0;
                            $barWidth = $required > 0 ? min(100, round(($collected / $required) * 100)) : 0;

                            $barClass = match ($index) {
                                0 => 'primary',
                                1 => 'warning',
                                2 => 'danger',
                                default => 'secondary',
                            };
                        @endphp

                        <div class="browser-list">
                            <div class="">
                                @if ($case->case_photo)
                                    <a class="profile-img" href="{{ asset('storage/' . $case->case_photo) }}"
                                        target="_blank">
                                        <img src="{{ asset('storage/' . $case->case_photo) }}" alt="صورة الحالة"
                                            class="rounded-circle profile-img border border-{{ $barClass }}"
                                            style="width: 50px; height: 50px; object-fit: cover; display: inline-block; margin-left: 10px; ">
                                    </a>
                                @else
                                    <a class="profile-img" href="../assets/img/id.jpg" target="_blank">
                                        <img src="{{ asset('assets/img/tim.png') }}" alt="صورة المستخدم"
                                            class="rounded-circle profile-img"
                                            style="width: 50px; height: 50px; object-fit: cover; display: inline-block; margin-left: 10px;">
                                    </a>
                                @endif
                            </div>

                            <div class="w-browser-details">
                                <div class="w-browser-info">
                                    <h6>{{ $case->case_name }}</h6>
                                    <p class="browser-count">{{ $percentage }}%</p>
                                </div>

                                <div class="w-browser-stats">
                                    <div class="progress">
                                        <div class="progress-bar bg-gradient-{{ $barClass }}" role="progressbar"
                                            style="width: {{ $barWidth }}%" aria-valuenow="{{ $barWidth }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @php $index++; @endphp
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="row widget-statistic">

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="widget widget-one_hybrid widget-engagement">
                    <div class="widget-heading">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-message-circle">
                                <path
                                    d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                </path>
                            </svg>
                        </div>
                        <p class="w-value">{{ $CasesCount }}</p>
                        <h5 class="">عدد الحالات</h5>
                    </div>
                    <div class="widget-content">
                        <div class="w-chart">
                            <div id="hybrid_followers3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="widget widget-one_hybrid widget-followers">
                    <div class="widget-heading">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <p class="w-value">{{ $DonorsCount }}</p>
                        <h5 class="">المستخدمين</h5>
                    </div>
                    <div class="widget-content">
                        <div class="w-chart">
                            <div id="hybrid_followers"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="widget widget-one_hybrid widget-referral">
                    <div class="widget-heading">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-link">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                        </div>
                        @inject('currency', 'App\Services\CurrencyChanges')
                        <p class="w-value">{{ $currency->convert($totalDonations) }}
                        </p>
                        <h5 class="">التبرعات</h5>
                    </div>
                    <div class="widget-content">
                        <div class="w-chart">
                            <div id="hybrid_followers1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('PageJavaScribt')
    <script src="{{ asset('assets/plugins/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
@endsection
