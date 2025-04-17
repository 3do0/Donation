@section('title')
    تقارير التبرعات
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
                            @foreach ($donations as $donation)
                                <li class="nav-item">
                                    <div class="nav-link list-actions" id="invoice-{{ $donation->id }}"
                                        data-invoice-id="{{ $donation->id }}">
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
                                                <p class="invoice-number">عملية #{{ $donation->id }}</p>
                                                <p class="invoice-customer-name text-warning">
                                                    <span>المبلغ:</span>
                                                    {{ $donation->total_amount }}
                                                    <span class="text-warning">
                                                        @if ($donation->currency == 'usd')
                                                            $
                                                        @elseif ($donation->currency == 'sar')
                                                            ر.س
                                                        @else
                                                            ر.ي
                                                        @endif
                                                    </span>
                                                </p>
                                                <p class="invoice-generated-date">
                                                    <span>تاريخ:</span>{{ $donation->created_at->format('Y-m-d') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
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
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                </path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                        </div>
                    </div>

                    <div id="ct" class="">
                        @foreach ($donations as $donation)
                            <div class="invoice-{{ $donation->id }}">
                                <div class="content-section  animated animatedFadeInUp fadeInUp">
                                    <div class="row inv--head-section">
                                        <div class="col-sm-6 col-12">
                                            <h3 class=" txet-warning in-heading">التبرعات الخيرية</h3>
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
                                            <p class="inv-to">من :</p>
                                        </div>

                                        <div class="col-sm-7 align-self-center">
                                            <p class="inv-customer-name">{{ $donation->donor->name ?? 'زائر' }}</p>
                                            <p class="inv-email-address">{{ $donation->donor->email ?? 'لايوجد بريد' }}
                                            </p>
                                            <p class="inv-email-address">{{ $donation->created_at }}</p>
                                        </div>
                                        <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                            <p class="inv-list-number"><span class="inv-title">رقم الفاتورة :
                                                </span> <span class="inv-number">[invoice number]</span></p>
                                            <p class="inv-created-date"><span class="inv-title">تاريخ الاصدار :
                                                </span>
                                                <span class="inv-date">{{ now() }}</span>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row inv--product-table-section">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="">
                                                        <tr>
                                                            <th scope="col">I.No</th>
                                                            <th scope="col">نوع التبرع</th>
                                                            <th class="text-right" scope="col">رقم الحالة</th>
                                                            <th class="text-right" scope="col">اسم الحالة</th>
                                                            <th class="text-right" scope="col">المبلغ</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($donation->items as $item)
                                                            <tr>
                                                                <td>{{ $item->id }}</td>
                                                                <td>
                                                                    @if ($item->donatable_type === \App\Models\OrganizationCase::class)
                                                                        تبرع للحالات
                                                                    @elseif ($item->donatable_type === \App\Models\PlatformDonation::class)
                                                                        <span class="text-warning">تبرع للمنصة</span>
                                                                    @else
                                                                        غير معروف
                                                                    @endif
                                                                </td>
                                                                @if ($item->donatable_type === \App\Models\OrganizationCase::class)
                                                                    <td class="text-right">
                                                                        {{ $item->donatable?->id ?? '----' }}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {{ $item->donatable?->case_name ?? '----' }}
                                                                    </td>
                                                                @elseif ($item->donatable_type === \App\Models\PlatformDonation::class)
                                                                    <td class="text-right text-warning">--------</td>
                                                                    <td class="text-right text-warning">--------</td>
                                                                @else
                                                                    <td colspan="2" class="text-right text-danger">
                                                                        <em>نوع غير معروف</em>
                                                                    </td>
                                                                @endif

                                                                <td class="text-right">
                                                                    {{ number_format($item->amount) }}
                                                                    @if ($donation->currency == 'usd')
                                                                        $
                                                                    @elseif ($donation->currency == 'sar')
                                                                        ر.س
                                                                    @else
                                                                        ر.ي
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-sm-5 col-12 order-sm-0 order-1">
                                            <div class="inv--payment-info">
                                                <div class="row">
                                                    <div class="col-sm-12 col-12">
                                                        <h6 class=" inv-title" style="color:  rgb(201, 152, 63);">
                                                            بيانات الدفع :</h6>
                                                    </div>
                                                    <div class="col-sm-4 col-12">
                                                        <p class=" inv-subtitle">طريقة الدفع : </p>
                                                    </div>
                                                    <div class="col-sm-8 col-12">
                                                        <p class="">{{ $donation->payment_method }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-12 order-sm-1 order-0">
                                            <div class="inv--total-amounts text-sm-right">
                                                <div class="row">
                                                    <div class="col-sm-8 col-7 grand-total-title">
                                                        <h4 class="">اجمالي المبلغ : </h4>
                                                    </div>
                                                    <div class="col-sm-4 col-5 grand-total-amount">
                                                        <h4 class="">
                                                            {{ number_format($donation->total_amount) }}
                                                            @if ($donation->currency == 'usd')
                                                                $
                                                            @elseif ($donation->currency == 'sar')
                                                                ر.س
                                                            @else
                                                                ر.ي
                                                            @endif
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="inv--thankYou">
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <p class="">Thank you for doing Business with us.</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/js/invoice.js') }}"></script>
@endpush
