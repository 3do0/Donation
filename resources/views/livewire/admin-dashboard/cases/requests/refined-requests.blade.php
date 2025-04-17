<div class="row row-cols-1 row-cols-md-3 g-4 mt-4 mx-2">
    @foreach ($requests as $request)
    <div class="col">
        <div class="card" style="min-height: 400px;">
            <img src="{{ asset('storage/' . $request->case_photo) }}" class="card-img-top" alt="صورة المشروع"
                style="object-fit: cover; height: 200px;">

            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title mb-0">{{ $request->case_name }}</h5>
                    <span class="badge bg-warning">{{ $request->organization_user->organization->name }}</span>
                </div>
    
                <p class="card-text mt-3">
                    {{ $request->description }}
                </p>
            </div>
            <div class="card-footer" style="background-color: rgba(241, 6, 30, 0.6);">
                <p class="text-white">سبب الرفض : {{ $request->rejection_reason }}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>