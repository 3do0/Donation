var togglePassword = document.getElementById("toggle-password");
    
        if (togglePassword) {
            togglePassword.addEventListener('click', function () {
                var passwordInput = document.getElementById("password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    togglePassword.innerHTML = '<i class="bi bi-eye-slash"></i>';
                } else {
                    passwordInput.type = "password";
                    togglePassword.innerHTML = '<i class="bi bi-eye"></i>';
                }
            });
        }