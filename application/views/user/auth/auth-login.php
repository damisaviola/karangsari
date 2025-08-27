<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/dist/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/assets/compiled/css/auth.css') ?>">

    <style>
        .fade-up {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.7s ease-out;
        }

        .fade-up.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>

    <div id="auth">
        <script src="<?= base_url('assets/dist/assets/static/js/initTheme.js') ?>"></script>

        <div class="row h-100">
            <!-- Login Form -->
            <div class="col-lg-5 col-12">
                <div id="auth-left" class="fade-up">
                    <div class="auth-logo"></div>
                    <h1 class="auth-title">Masuk.</h1>
                    <p class="auth-subtitle mb-5">Silakan masuk dengan data yang Anda masukkan saat pendaftaran.</p>

                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Belum mempunyai akun?
                            <a href="<?= site_url('user/auth/register') ?>" class="font-bold">Daftar</a>.
                        </p>
                        <p><a class="font-bold" href="auth-forgot-password.html">Lupa Sandi?</a>.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side / Gambar -->
               <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fadeTarget = document.querySelector('.fade-up');
            if (fadeTarget) {
                setTimeout(() => {
                    fadeTarget.classList.add('show');
                }, 200);
            }
        });
    </script>
</body>

</html>
