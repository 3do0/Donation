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

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">استعادة كلمة المرور</h1>
                        <p class="signup-link recovery">!!!!!!أدخل بريدك الإلكتروني، وستصلك التعليمات!</p>
                        <form method="POST" action="{{ route('organization.password.email') }}">
                            @csrf
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                        <label for="email">بريدك الألكتروني</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign">
                                        <circle cx="12" cy="12" r="4"></circle>
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                                    </svg>
                                    <input id="email" class="form-control" type="email" name="email"
                                        :value="old('email')" required autofocus placeholder="Email">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger"  />
                                </div>

                                <div class="d-sm-flex justify-content-between mt-2">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-warning" value="">إعادة
                                            تعيين</button>
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
