@section('title')
    تقارير تبرعات المنظمات
@endsection

@section('PageCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/invoice.css') }}">
@endsection

<div class="row invoice layout-top-spacing mb-4">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="app-hamburger-container">
            <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu chat-menu d-xl-none">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></div>
        </div>
        <div class="doc-container">
            <div class="tab-title">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="search">
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <ul class="nav nav-pills inv-list-container d-block" id="pills-tab" role="tablist">
                            @forelse ($organizations ?? [] as $org)
                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-{{ $org->id }}"
                                        data-invoice-id="{{ $org->id }}">
                                        <div class="f-m-body">
                                            <div class="f-head">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-dollar-sign">
                                                    <line x1="12" y1="1" x2="12" y2="23">
                                                    </line>
                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                </svg>
                                            </div>
                                            <div class="f-body">
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex align-items-center">
                                                        @if ($org->logo)
                                                            <img src="{{ asset('storage/' . $org->logo) }}"
                                                                alt="شعار المنظمة" class="rounded mx-2"
                                                                style="width: 35px; height: 35px;">
                                                        @else
                                                            <img src="{{ asset('assets/img/id.jpg') }}"
                                                                alt="شعار المنظمة" class="rounded mx-2"
                                                                style="width: 35px; height: 35px;">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center ms-2">
                                                        <h6
                                                            class="mb-0 text-sm font-weight-semibold text-warning text-nowrap">
                                                            {{ $org->name }}</h6>
                                                        @inject('currency', 'App\Services\CurrencyChanges')
                                                        @php
                                                            $totalDonation = $org->users->flatMap->cases->flatMap->donationItems->sum(
                                                                function ($item) use ($currencyRates) {
                                                                    $currency = strtoupper(
                                                                        optional($item->donation)->currency,
                                                                    );
                                                                    $rate = $currencyRates[$currency] ?? 1;
                                                                    return $item->amount * $rate;
                                                                },
                                                            );
                                                        @endphp

                                                        <p class="text-sm mb-0">
                                                            <span>اجمالى التبرعات :</span>
                                                            {{ $currency->convert($totalDonation) }}
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="nav-item text-center text-danger">لا توجد حالات حالياً</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="invoice-container">
                <div class="invoice-inbox">

                    <div class="inv-not-selected">
                        <p>افتح أي معاملة من القائمة 😶.</p>
                    </div>

                    <div class="invoice-header-section">
                        <h4 class="inv-number"></h4>
                        <div class="invoice-action">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-printer action-print"
                                data-toggle="tooltip" data-placement="top" data-original-title="Reply">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                        </div>
                    </div>

                    <div id="ct" class="">
                        @forelse ($organizations ?? [] as $org)
                            <div class="invoice-{{ $org->id }}">
                                <div class="content-section animated animatedFadeInUp fadeInUp">
                                    <div class="row inv--head-section">
                                        <div class="col-sm-6 col-12">
                                            <h3 class=" txet-warning in-heading">تبرعات االمنظمة</h3>
                                        </div>
                                        <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                            <div class="company-info">
                                                <img class="img-fluid rounded"
                                                    src="{{ asset('assets/img/Takaful.png') }}" alt="الشعار"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                                <h5 class="inv-brand-name">Takaful</h5>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row inv--detail-section">
                                        <div class="col-sm-7 align-self-center">
                                            <p class="inv-to">بيانات المنظمة :</p>
                                            <p class="inv-customer-name">{{ $org->id }}</p>
                                            <p class="inv-email-address">{{ $org->name ?? 'غير معروف' }}</p>
                                            <p class="inv-email-address">{{ $org->email }}</p>
                                            <p class="inv-email-address">{{ $org->city }} / {{ $org->address }}
                                            </p>
                                        </div>
                                        <div class="col-sm-5 align-self-center text-sm-right order-2">
                                            <p class="inv-list-number"><span class="inv-title">الحساب البنكي :</span>
                                                <span class="">{{ $org->bank_name ?? 'غير متاحة' }}</span>
                                            </p>
                                            <p class="inv-list-number"><span class="inv-title">رقم الحساب البنكي
                                                    :</span>
                                                <span
                                                    class="text-warning">{{ $org->bank_account_number ?? 'غير متاحة' }}</span>
                                            </p>
                                            <p class="inv-created-date"><span class="inv-title">تاريخ الإصدار :</span>
                                                <span class="inv-date">{{ now() }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row inv--product-table-section">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">I.No</th>
                                                            <th scope="col" class="text-center">الحالة</th>
                                                            <th scope="col" class="text-center">المتبرع</th>
                                                            <th class="text-center" scope="col">المبلغ</th>
                                                            <th class="text-center" scope="col">طريقة الدفع</th>
                                                            <th class="text-center" scope="col">تاريخ التبرع</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $donationItems = $org->users->flatMap->cases->flatMap->donationItems->sortByDesc(
                                                                'created_at',
                                                            );
                                                        @endphp

                                                        @forelse ($donationItems as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>

                                                                <td class="text-center">
                                                                    {{ $item->donatable->case_name ?? 'بدون عنوان حالة' }}
                                                                </td>
                                                                <!-- بيانات المتبرع -->
                                                                <td class="text-center">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center">
                                                                        <p class="mb-0 text-sm font-weight-semibold">
                                                                            {{ $item->donation->donor->name ?? 'غير معروف' }}
                                                                        </p>
                                                                        <p class="text-sm">
                                                                            {{ $item->donation->donor->email ?? 'غير معروف' }}
                                                                        </p>
                                                                    </div>
                                                                </td>

                                                                <!-- المبلغ والعملة -->
                                                                <td class="text-center">
                                                                    {{ number_format($item->amount) }}
                                                                    @php $currency = $item->donation->currency ?? null; @endphp
                                                                    @if ($currency === 'usd')
                                                                        $
                                                                    @elseif ($currency === 'sar')
                                                                        ر.س
                                                                    @else
                                                                        ر.ي
                                                                    @endif
                                                                </td>

                                                                <!-- طريقة الدفع -->
                                                                <td class="text-center">
                                                                    {{ $item->donation->payment_method ?? 'غير معروف' }}
                                                                </td>

                                                                <!-- تاريخ التبرع -->
                                                                <td
                                                                    class="text-center text-warning text-sm text-nowrap">
                                                                    {{ $item->created_at->format('Y-m-d / H-i-s') }}
                                                                </td>

                                                                <!-- اسم الحالة المتبرع لها -->
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="6" class="text-center text-danger">لا
                                                                    توجد تبرعات لهذه المنظمة</td>
                                                            </tr>
                                                        @endforelse

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-sm-5 col-12 order-sm-0 order-1">
                                            <div class="inv--payment-info">
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-12 order-sm-1 order-0">
                                            <div class="inv--total-amounts text-sm-right">
                                                <div class="row">
                                                    <div class="col-sm-8 col-7 grand-total-title">
                                                        <h4 class="">إجمالي المبلغ :</h4>
                                                    </div>
                                                    <div class="col-sm-4 col-5 grand-total-amount">
                                                        @inject('currency', 'App\Services\CurrencyChanges')
                                                        @php
                                                            $donationItems =
                                                                $org->users->flatMap->cases->flatMap->donationItems;

                                                            $totalDonation = $donationItems->sum(function ($item) use (
                                                                $currencyRates,
                                                            ) {
                                                                $currency = strtoupper(
                                                                    optional($item->donation)->currency,
                                                                );
                                                                $rate = $currencyRates[$currency] ?? 1;
                                                                return $item->amount * $rate;
                                                            });
                                                        @endphp

                                                        <h4>
                                                            {{ $currency->convert($totalDonation) }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="alert alert-warning mt-4">لا توجد حالات متاحة حالياً</div>
                        @endforelse
                    </div>
                </div>

                <div class="inv--thankYou">
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <p class="">شكراً لتعاملكم معنا.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script src="{{ asset('assets/js/invoice.js') }}"></script>
    <script>
        function runInvoiceIfExists() {
            if (typeof window.initInvoice === 'function') {
                window.initInvoice();
            }
        }

        document.addEventListener('livewire:navigated', () => {
            requestAnimationFrame(() => {
                runInvoiceIfExists();
            });
        });

        document.addEventListener('livewire:init', () => {
            window.Livewire.hook('commit', ({
                succeed
            }) => {
                succeed(() => {
                    requestAnimationFrame(() => {
                        runInvoiceIfExists();
                    });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', () => {
            runInvoiceIfExists();
        });
    </script>
@endpush
