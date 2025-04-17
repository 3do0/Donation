<div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
    
    <form method="post" action="{{ route('password.update') }}" class="section general-info">
        @csrf
        @method('put')
        
        <div class="col-md-12 layout-spacing">
            <div class="info">
                <header>
                    <h5 class="text-lg font-medium">
                        {{ __('تحديث كلمة المرور') }}
                    </h5>
                    <p class="mt-2">
                        {{ __('تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية للحفاظ على الأمان.') }}
                    </p>
                </header>
                <div class="row mt-3">
                    <div class="col-md-11 mx-auto">
                        @if (session('status') === 'password-updated')
                                <div class="alert alert-primary mb-4 mt-3" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                    <strong>نجحت العملية !</strong>تم تغيير كلمة السر بنجاح </button>
                                </div> 
                        @endif
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-input-label for="update_password_current_password" :value="__('كلمة المرور الحالية')" />
                                <x-text-input id="update_password_current_password" name="current_password"
                                    type="password" class="form-control mb-4" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <!-- New Password Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-input-label for="update_password_password" :value="__('كلمة المرور الجديدة')" />
                                <x-text-input id="update_password_password" name="password" type="password"
                                    class="form-control mb-4" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-input-label for="update_password_password_confirmation" :value="__('تأكيد كلمة المرور')" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" class="form-control mb-4" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 m-3">
                            <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </form>
</div>
