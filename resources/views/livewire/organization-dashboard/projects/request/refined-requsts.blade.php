<div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    @foreach ($requests as $request)
        <div class="col">
            <div class="card" style="min-height: 400px;">
                <img src="{{ asset('storage/' . $request->project_photo) }}" class="card-img-top" alt="صورة المشروع" style="object-fit: cover; height: 200px;">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $request->project_name }}</h5>
                    <p class="card-text">
                        {{ $request->description }}
                    </p>
                </div>
                <div class="card-footer" style="background-color: rgba(241, 6, 30, 0.6);">
                    <small class="text-white">سبب الرفض : {{ $request->rejection_reason ?? 'غير محدد' }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>
