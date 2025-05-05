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
                <img src="{{ asset('storage/' . $case->case_photo) }}" class="card-img-top" alt="صورة المشروع" style="height: 250px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="meta-date text-warning">{{ $case->created_at }}</p>
                        <p class="meta-date text-danger border border-danger p-1 rounded">
                            الأيام المتبقية : {{ max(floor(\Carbon\Carbon::now()->diffInDays($case->end_date, false)), 0) }}
                        </p>
                    </div>

                    <h5 class="card-title">{{ $case->case_name }}</h5>
                    <p class="card-text">{{ $case->description }}</p>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-warning">تم جمعه: {{ $currency->convert($collected) }}</small>
                            <small class="text-warning">المطلوب: {{ $currency->convert($required) }}</small>
                        </div>

                        <div class="progress br-30" style="height: 20px;">
                            <div class="progress-bar {{ $progressColor }}" role="progressbar"
                                 style="width: {{ $percentage }}%;"
                                 aria-valuenow="{{ $percentage }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                                {{ $percentage }}%
                            </div>
                        </div>
                    </div>

                    <div class="meta-info mt-3">
                        <div class="meta-user">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('storage/' . $case->organization_user->organization->logo) }}"
                                     class="avatar-title rounded-circle" alt="المنظمة">
                            </div>
                            <div class="user-name text-warning">{{ $case->organization_user->organization->name }}</div>
                        </div>
                    
                        <div class="meta-action">
                           
                            <div class="meta-view text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none"
                                     stroke="orange" stroke-width="2"
                                     stroke-linecap="round" stroke-linejoin="round"
                                     class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg> {{ $case->visitors_count }}
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
</script>

@endpush