<div class="row row-cols-1 row-cols-md-3 g-4 mt-4 mx-2">
    @foreach ($projects as $project)
        <div class="col">
            <div class="card component-card_9" style="min-height: 400px;">
                <img src="{{ asset('storage/' . $project->project_photo) }}" class="card-img-top" alt="صورة المشروع"
                style=" height: 250px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p class="meta-date text-warning">{{ $project->created_at }}</p>
                        <p class="meta-date text-danger border border-danger p-1 rounded"> الأيام المتبقية :
                            {{ max(floor(\Carbon\Carbon::now()->diffInDays($project->end_date, false)), 0) }}</p>
                    </div>
                    <h5 class="card-title">{{ $project->project_name }}</h5>
                    <p class="card-text">{{ $project->description }}</p>

                    <div class="meta-info">
                        <div class="meta-user">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('storage/' . $project->organization_user->organization->logo) }}"
                                    class="avatar-title rounded-circle" alt="المنظمة"></img>
                            </div>
                            <div class="user-name">{{ $project->organization_user->organization->name }}</div>
                        </div>

                        <div class="meta-action">
                            <div class="meta-likes">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                                    </path>
                                </svg> 51
                            </div>

                            <div class="meta-view">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg> {{ $project->visitors_count }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
