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

    <div class="welcome-content text-center">
        <div class="logo-wrapper mb-4">
            <div class="platform-icon">
                <i class="bi bi-heart-fill"></i>
            </div>
            <h2 class="platform-name">تكافل</h2>
        </div>
    
        <h1 class="welcome-text">مرحباً بعودتك</h1>
        <p class="welcome-description">أنت الآن تسجل الدخول كـ منظمة</p>
    
        <div class="login-box">
            <form method="POST" action="{{ route('organization.login') }}">
                @csrf
    
                <!-- Email Field -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input id="username" type="email" name="email" class="form-control"
                        placeholder="البريد الإلكتروني" :value="old('email')" required autofocus
                        autocomplete="username">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger text-start" />
    
                <!-- Password Field -->
                <div class="input-group mb-4 position-relative">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input id="password" type="password" name="password" class="form-control" placeholder="كلمة المرور"
                        required autocomplete="current-password">
                    <span class="input-group-text bg-transparent"
                          style="z-index: 5; cursor: pointer;" id="toggle-password">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger text-start" />
    
                <!-- Remember Me Checkbox -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">تذكرني</label>
                    </div>
                    @if (Route::has('organization.password.request'))
                        <a href="{{ route('organization.password.request') }}" class="forgot-password">نسيت كلمة المرور؟</a>
                    @endif
                </div>
    
                <!-- Submit Button -->
                <button type="submit" class="btn btn-glow w-100 mb-3">تسجيل الدخول</button>
            </form>
        </div>
    </div>
    
</x-guest-layout>
