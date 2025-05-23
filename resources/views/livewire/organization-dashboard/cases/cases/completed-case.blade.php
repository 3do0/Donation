@section('title')
    الحالات المكتملة
@endsection

@section('PageCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components/custom-media_object.css') }}">
@endsection

@inject('currency', 'App\Services\CurrencyChanges')

<div class="row row-cols-1 row-cols-md-3 g-4 m-4 ">
    @foreach ($cases as $case)
        @php
            $collected = $case->raised_amount;
            $required = $case->target_amount;
            $percentage = $required > 0 ? min(100, round(($collected / $required) * 100)) : 0;

            $progressColor = 'bg-danger';
            if ($percentage >= 70) {
                $progressColor = 'bg-success';
            } elseif ($percentage >= 30) {
                $progressColor = 'bg-warning';
            }
        @endphp

        <div class="col">
            <div class="card component-card_9" style="min-height: 400px;">
                <img src="{{ asset('storage/' . $case->case_photo) }}" class="card-img-top" alt="صورة المشروع"
                    style="height: 250px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="meta-date text-warning">{{ $case->created_at }}</p>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                            data-bs-target="#zoomupModal-{{ $case->id }}">
                            بيانات تفصيلية
                        </button>
                    </div>

                    <h5 class="card-title">{{ $case->case_name }}</h5>
                    <p class="card-text">{{ $case->description }}</p>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-warning">تم جمعه: {{ $currency->convert($collected) }}</small>
                            <small class="text-warning">المطلوب: {{ $currency->convert($required) }}</small>
                        </div>

                        <div class="progress br-30" style="height: 10px;">
                            <div class="progress-bar {{ $progressColor }}" role="progressbar"
                                style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}"
                                aria-valuemin="0" aria-valuemax="100">
                                {{ $percentage }}%
                            </div>
                        </div>
                    </div>

                    <div wire:ignore class="modal fade" id="zoomupModal-{{ $case->id }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $case->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel{{ $case->id }}">ملحقات الحالة</h5>
                                    <button type="button" class="btn-close-info" data-bs-dismiss="modal"
                                        aria-label="إغلاق"></button>
                                </div>

                                <div class="modal-body">
                                    <h5 class="text-dark">التقارير</h5>
                                    @if ($case->reports->isNotEmpty())
                                    <div class="text-center">
                                        @foreach ($case->reports as $report)
                                            @if ($report->file_path)
                                                <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank"
                                                    class="btn btn-info ">
                                                    عرض الملف رقم {{ $loop->iteration }}
                                                </a>
                                            @endif
                                        @endforeach
                                        <div class="row align-items-center text-center">
                                            <div class="col-md-10 mb-2">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-file-earmark-arrow-up"></i>
                                                    </span>
                                                    <input type="file" class="form-control" id="inputCaseFile"
                                                        wire:model="case_report">
                                                </div>
                                                @error('case_report')
                                                    <div class="text-danger text-start small mt-1">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 mb-1 ">
                                                <button class="btn btn-info btn-sm" wire:click="uploadReport({{ $case->id }})">
                                                    تقرير جديد 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <div class="text-center">
                                            <h6 class=" alert alert-danger text-danger text-center">لم يتم رفع أي تقارير
                                                حتى الآن</h6>
                                            <div class="row align-items-center text-center">
                                                <div class="col-md-10 mb-2">
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-file-earmark-arrow-up"></i>
                                                        </span>
                                                        <input type="file" class="form-control" id="inputCaseFile"
                                                                wire:model="case_report" accept=".pdf">

                                                    </div>
                                                    @error('case_report')
                                                        <div class="text-danger text-start small mt-1">{{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-2 mb-1 ">
                                                    <button class="btn btn-info btn-sm" wire:click="uploadReport({{ $case->id }})">
                                                        رفع التقرير
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <hr class="bg-white">
                                    <h5 class="text-dark">التعليقات</h5>
                                    <ul class="list-unstyled">
                                        @foreach ($case->comments as $comment)
                                            <li class="media d-flex align-items-start justify-content-between mb-3">
                                                <img class="rounded me-3"
                                                    src="{{ asset('storage/' . $comment->donor->avatar) }}"
                                                    alt="avatar" width="50" height="50">

                                                <div class="media-body w-100">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-1">{{ $comment->donor->name }}</h6>
                                                        <small
                                                            class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                    </div>

                                                    <p class="mb-2">{{ $comment->comment }}</p>

                                                    <div class="d-flex justify-content-end">
                                                        <a wire:click="confirmDelete({{ $comment->id }})"
                                                            class="text-danger" role="button" title="حذف التعليق"
                                                            data-bs-dismiss="modal" aria-label="إغلاق">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@push('scripts')
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
