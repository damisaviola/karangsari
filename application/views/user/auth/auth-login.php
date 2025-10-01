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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        .divider {
  display: flex;
  align-items: center;
  text-align: center;
  color: #6c757d;
  font-size: 0.9rem;
  margin: 25px 0;
}

.divider::before,
.divider::after {
  content: "";
  flex: 1;
  border-bottom: 1px solid #ddd;
}

.divider:not(:empty)::before {
  margin-right: 10px;
}

.divider:not(:empty)::after {
  margin-left: 10px;
}

    </style>
</head>

<body>
    <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>

    <div id="auth">
        <script src="<?= base_url('assets/dist/assets/static/js/initTheme.js') ?>"></script>

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left" class="fade-up">
                    <div class="auth-logo"></div>
                    <h1 class="auth-title">Masuk.</h1>
                    <p class="auth-subtitle mb-5">Silakan masuk dengan data yang Anda masukkan saat pendaftaran.</p>

                     <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    
            

                    <form action="<?= site_url('user/auth/login/login_action') ?>" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                        value="<?= $this->security->get_csrf_hash(); ?>">

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="email" class="form-control form-control-xl" placeholder="Email atau No HP" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                       
                        <label for="">Captcha : </label>
                        <div class="form-group mt-3">
                            <div class="g-recaptcha" data-sitekey="6LfMpNorAAAAAL8ExfzyifLLO_FMR60LnUp1K1l2"></div>
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


            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>
