<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    
    <form method="post" action="{{ route('organization.password.update') }}" class="section general-info">
        @csrf
        @method('put')
    
        <div class="info">
            <header>
                <h5 class="text-lg font-medium">تحديث كلمة المرور</h5>
                <p class="mt-2">تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية للحفاظ على الأمان.</p>
            </header>
            <div class="row mt-3">
                <div class="col-md-11 mx-auto">
                    @if (session('status') === 'password-updated')
                        <div class="alert alert-primary mb-4 mt-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">...</button>
                            <strong>نجحت العملية !</strong> تم تغيير كلمة السر بنجاح
                        </div>
                    @endif
    
                    <!-- كلمة المرور الحالية -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-input-label for="update_password_current_password" :value="__('كلمة المرور الحالية')" />
                            <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control mb-4" autocomplete="current-password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                        </div>
                    </div>
    
                    <!-- كلمة المرور الجديدة -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-input-label for="update_password_password" :value="__('كلمة المرور الجديدة')" />
                            <x-text-input id="update_password_password" name="password" type="password" class="form-control mb-4" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                        </div>
                    </div>
    
                    <!-- تأكيد كلمة المرور -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <x-input-label for="update_password_password_confirmation" :value="__('تأكيد كلمة المرور')" />
                            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control mb-4" autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                        </div>
                    </div>
    
                    <div class="flex items-center gap-4 m-3">
                        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
</div>
