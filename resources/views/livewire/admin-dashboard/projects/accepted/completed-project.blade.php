@section('title')
   المشاريع المكتملة
@endsection

@section('PageCss')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components/custom-media_object.css') }}">
@endsection

<div class="row row-cols-1 row-cols-md-3 g-4 m-4">
    @foreach ($projects as $project)
        <div class="col">
            <div class="card component-card_9" style="min-height: 400px;">
                <img src="{{ asset('storage/' . $project->project_photo) }}" class="card-img-top" alt="صورة المشروع" style="height: 250px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="meta-date text-warning">{{ $project->created_at->format('d-m-Y H:i') }}</p>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#zoomupModal{{ $project->id }}">بيانات تفصيلية</button>
                    </div>

                    <h5 class="card-title">{{ $project->project_name }}</h5>
                    <p class="card-text">{{ $project->description }}</p>

                    <div class="meta-info mt-3">
                        <div class="meta-user">
                            @if ($project->organization_user && $project->organization_user->organization)
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('storage/' . $project->organization_user->organization->logo) }}" class="avatar-title rounded-circle" alt="المنظمة">
                                </div>
                                <div class="user-name text-warning">{{ $project->organization_user->organization->name }}</div>
                            @else
                                <span class="text-muted">المنظمة غير موجودة</span>
                            @endif
                        </div>

                        <div class="meta-action">
                            <div class="meta-view text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg> {{ $project->visitors_count }}
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div id="zoomupModal{{ $project->id }}" class="modal animated zoomInUp custo-zoomInUp" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ملحقات الحالة</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="text-warning">التقارير</h5>
                                    @if ($project->reports->isNotEmpty())
                                        @foreach ($project->reports as $report)
                                            @if ($report->file_path)
                                                <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="btn btn-outline-info btn-rounded btn-sm mb-1">
                                                    عرض الملف رقم {{ $loop->iteration }}
                                                </a>
                                            @endif
                                        @endforeach
                                    @else
                                        <h6 class="text-danger text-center">لم يتم رفع أي تقارير حتى الآن</h6>
                                    @endif

                                    <hr class="bg-white">
                                    <h5 class="text-warning">التعليقات</h5>
                                    <ul class="list-unstyled">
                                        @foreach ($project->comments as $comment)
                                            <li class="media d-flex align-items-start justify-content-between">
                                                <img class="rounded me-3" src="{{ asset('storage/' . $comment->donor->photo) }}" alt="pic1" width="50" height="50">
                                                <div class="media-body w-100">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h5 class="media-heading mb-1">
                                                            <span class="media-title">{{ $comment->donor->name }}</span>
                                                        </h5>
                                                        <span class="text-muted small">{{ $comment->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <p class="media-text mb-2">{{ $comment->comment }}</p>
                                                    <div class="d-flex justify-content-end">
                                                        <a wire:click="confirmDelete({{ $comment->id}})" class="text-danger" title="حذف التعليق" data-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
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