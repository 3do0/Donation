




<div class="col-12 layout-spacing">
    <form method="POST" action="{{ route('password.update') }}" class="section general-info">
        @csrf
        @method('PUT')

        <div class="info">
            <header class="mb-3">
                <h5 class="text-lg fw-bold">{{ __('تحديث كلمة المرور') }}</h5>
                <p class="text-muted">{{ __('تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية للحفاظ على الأمان.') }}</p>
            </header>

            @if (session('status') === 'password-updated')
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    <strong>نجحت العملية!</strong> تم تغيير كلمة السر بنجاح.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
                </div>
            @endif

            <div class="row mt-4">

                <!-- كلمة المرور الحالية -->
                <div class="col-md-6 mb-4">
                    <label for="update_password_current_password" class="form-label">{{ __('كلمة المرور الحالية') }}</label>
                    <input type="password" id="update_password_current_password" name="current_password" class="form-control" autocomplete="current-password">
                    @if ($errors->updatePassword->has('current_password'))
                        <div class="text-danger mt-2">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>

                <!-- كلمة المرور الجديدة -->
                <div class="col-md-6 mb-4">
                    <label for="update_password_password" class="form-label">{{ __('كلمة المرور الجديدة') }}</label>
                    <input type="password" id="update_password_password" name="password" class="form-control" autocomplete="new-password">
                    @if ($errors->updatePassword->has('password'))
                        <div class="text-danger mt-2">{{ $errors->updatePassword->first('password') }}</div>
                    @endif
                </div>

                <!-- تأكيد كلمة المرور -->
                <div class="col-md-6 mb-4">
                    <label for="update_password_password_confirmation" class="form-label">{{ __('تأكيد كلمة المرور') }}</label>
                    <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
                    @if ($errors->updatePassword->has('password_confirmation'))
                        <div class="text-danger mt-2">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>

                <!-- زر الحفظ -->
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-warning">{{ __('حفظ') }}</button>
                </div>

            </div>
        </div>
    </form>
</div>
