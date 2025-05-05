<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    <form method="POST" action="{{ route('profile.update') }}" class="section general-info" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="info">
            <h5 class="">معلومات الحساب</h5>
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <div class="row">
                        <!-- رفع الصورة -->
                        <div class="col-xl-2 col-lg-12 col-md-2">
                            <div class="upload mt-4 pr-md-4">
                                <input type="file" id="input-file-max-fs" class="dropify"
                                data-default-file="{{ asset('storage/' . $user->photo) }}" 
                                data-max-file-size="10M" name="photo" accept="image/*"/>
                                <p class="m-3"><i class="flaticon-cloud-upload mr-1"></i> رفع الصورة</p>
                            </div>
                            @error('photo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- الحقول -->
                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                            @if (session('status') === 'profile-updated')
                            <div class="alert alert-primary mb-4" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                <strong>نجحت العملية !</strong> تم التحديث بنجاح</button>
                            </div> 
                            @endif
                            <div class="form">
                                <div class="row">
                                    <!-- الاسم الكامل -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">الاسم الكامل</label>
                                            <input type="text" class="form-control mb-4" id="name" name="name" value="{{ old('name', $user->name) }}" required />
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- البريد الإلكتروني -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="email">البريد الإلكتروني</label>
                                            <input type="email" class="form-control mb-4" id="email" name="email" value="{{ old('email', $user->email) }}" required />
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- رقم الهاتف -->
                                <div class="form-group">
                                    <label for="phone">رقم الهاتف</label>
                                    <input type="text" class="form-control mb-4" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" />
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- تحديد العملة -->
                                <div class="form-group">
                                    <label for="currency">العملة المفضلة</label>
                                    <select class="form-control mb-4" id="currency" name="currency">
                                        <option value="YER" {{ old('currency', request()->cookie('currency', 'YER')) == 'YER' ? 'selected' : '' }}>الريال اليمني</option>
                                        <option value="SAR" {{ old('currency', request()->cookie('currency', 'YER')) == 'SAR' ? 'selected' : '' }}>الريال السعودي</option>
                                        <option value="USD" {{ old('currency', request()->cookie('currency', 'YER')) == 'USD' ? 'selected' : '' }}>الدولار الأمريكي</option>
                                    </select>
                                </div>

                                <!-- زر الحفظ -->
                                <div class="flex items-center gap-4">
                                    <button type="submit" class="btn btn-primary">{{ __('حفظ التغييرات') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
