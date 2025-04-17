<x-guest-layout>
    <!-- Session Status -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>تنبيه!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <strong>نجاح!</strong> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1><span class="text-warning">!!!!!!!!!!!!!!مرحبًا</span> بعودتك</h1>
                    <p class="">من فضلك قم بتسجيل الدخول !</p>

                    <form method="POST" action="{{ route('organization.login') }}" class="text-left">
                        @csrf

                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <label for="username">EMAIL</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <input id="username" type="email" class="form-control" placeholder="example@text.com"
                                    name="email" :value="old('email')" required autofocus autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <div id="password-field" class="field-wrapper input">
                                <div class="d-flex justify-content-between">
                                    <label for="password">PASSWORD</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2">
                                    </rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <input id="password" name="password" type="password" class="form-control" required
                                    autocomplete="current-password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" id="toggle-password"
                                    class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </div>

                            <div class="field-wrapper keep-logged-in">
                                <div class="n-chk new-checkbox checkbox-outline-warning">
                                    <label class="new-control new-checkbox checkbox-outline-warning">
                                        <input type="checkbox" class="new-control-input" id="remember_me">
                                        <span class="new-control-indicator"></span>تذكرني
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-4">
                                <div class="d-flex align-items-center justify-content-between">

                                    <button type="submit" class="btn btn-warning">تسجيل الدخول</button>

                                    @if (Route::has('organization.password.request'))
                                        <a href="{{ route('organization.password.request') }}"
                                            class="forgot-pass-link text-warning">نسيت كلمة
                                            السر؟</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
