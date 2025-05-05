<div class="container">
    <form method="POST" action="{{ route('Orgprofile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-4">
            <h5>معلومات الحساب</h5>
        </div>

        <div class="row">
            <!-- رفع الصورة -->
            <div class="col-xl-2 col-md-3">
                <div class="mb-3">
                    <label for="input-file-max-fs" class="form-label">رفع الصورة</label>
                    <input type="file" id="input-file-max-fs" class="form-control dropify"
                        data-default-file="{{ asset('storage/' . $Orguser->photo) }}" 
                        data-max-file-size="10M" name="photo" accept="image/*">
                    @error('photo')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- الحقول -->
            <div class="col-xl-10 col-md-9">
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>نجحت العملية!</strong> تم التحديث بنجاح.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- الاسم الكامل -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">الاسم الكامل</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $Orguser->name) }}" required>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $Orguser->email) }}" required>
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- رقم الهاتف -->
                <div class="mb-3">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('phone', $Orguser->phone) }}">
                    @error('phone')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- العملة المفضلة -->
                <div class="mb-3">
                    <label for="currency" class="form-label">العملة المفضلة</label>
                    <select class="form-select" id="currency" name="currency">
                        <option value="YER" {{ old('currency', request()->cookie('currency', 'YER')) == 'YER' ? 'selected' : '' }}>الريال اليمني</option>
                        <option value="SAR" {{ old('currency', request()->cookie('currency', 'YER')) == 'SAR' ? 'selected' : '' }}>الريال السعودي</option>
                        <option value="USD" {{ old('currency', request()->cookie('currency', 'YER')) == 'USD' ? 'selected' : '' }}>الدولار الأمريكي</option>
                    </select>
                </div>

                <!-- زر الحفظ -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-warning">حفظ التغييرات</button>
                </div>
            </div>
        </div>
    </form>
</div>
