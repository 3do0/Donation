<x-guest-layout>

    <!-- Session Status -->
    @if (session('status'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                position: "center-center",
                icon: "success",
                title: "{{ session('status') }}",
                showConfirmButton: false,
                timer: 3000,
                background: "#1e1e1e", 
                color: "#ffffff",  
            });
        });
    </script>
@endif

<div class="welcome-content text-center">
    <div class="logo-wrapper mb-4">
        <div class="platform-icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <h2 class="platform-name">تكافل</h2>
    </div>

    <h1 class="welcome-text">استعادة كلمة المرور</h1>
    <p class="welcome-description">أدخل بريدك الإلكتروني، وستصلك التعليمات!</p>

    <div class="login-box">
        <form method="POST" action="{{ route('organization.password.email') }}">
            @csrf

            <!-- Email Field -->
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input id="email" type="email" name="email" class="form-control"
                    placeholder="البريد الإلكتروني" :value="old('email')" required autofocus>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger text-start" />

            <!-- Reset Button -->
            <div class="mt-2">
                <div class="field-wrapper">
                    <button type="submit" class="btn btn-glow w-100 btn-small mb-3">إعادة تعيين</button>
                </div>
            </div>
        </form>
    </div>
</div>


</x-guest-layout>
