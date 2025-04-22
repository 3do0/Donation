<x-guest-layout>

    <div class="welcome-content text-center">
        <div class="logo-wrapper mb-4">
            <div class="platform-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <h2 class="platform-name">تكافل</h2>
        </div>
    
        <h1 class="welcome-text">إعادة تعيين كلمة المرور</h1>
        <p class="welcome-description">أدخل كلمة المرور الجديدة لتتمكن من إعادة تعيين كلمة المرور</p>
    
        <div class="login-box">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
    
                <!-- Token (hidden) -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
    
                <!-- Email Address -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)"
                        required  readonly autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger text-start" />
    
                <!-- Password Field -->
                <div class="input-group mb-3 position-relative">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password"
                        placeholder="كلمة المرور الجديدة">
                    <span class="input-group-text bg-transparent" style="z-index: 5; cursor: pointer;" id="toggle-password">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger text-start" />
    
                <!-- Confirm Password Field -->
                <div class="input-group mb-4 position-relative">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input id="confirm-password" class="form-control" type="password" name="password_confirmation" required
                        autocomplete="new-password" placeholder="تأكيد كلمة المرور">
                    <span class="input-group-text bg-transparent" style="z-index: 5; cursor: pointer;" id="toggle-password">
                        <i class="bi bi-eye"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger text-start" />
    
                <!-- Reset Button -->
                <div class="d-sm-flex justify-content-between mt-3">
                    <div class="field-wrapper">
                        <button type="submit" class="btn btn-glow w-100 mb-3">إعادة تعيين</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</x-guest-layout>
