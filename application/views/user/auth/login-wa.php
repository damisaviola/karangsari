<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login via WhatsApp</title>

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
        .btn-whatsapp { 
            background-color: #198754; 
            color: #fff; 
        }
        /* Tambahan untuk mengatur posisi form agar lebih turun */
        #auth-left {
            padding-top: 80px; /* ubah sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12 d-flex align-items-center">
                <div id="auth-left" class="fade-up w-100">
                    <h1 class="auth-title">Login via WhatsApp</h1>
                    <p class="auth-subtitle mb-4">Masukkan nomor HP yang Anda gunakan saat mendaftar.</p>

                    <?php if($this->session->flashdata('error')): ?>
                        <?= $this->session->flashdata('error'); ?>
                    <?php endif; ?>

                    <form action="<?= site_url('user/auth/register/action_verify_otp') ?>" method="post">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="otp" class="form-control form-control-xl" placeholder="Masukan OTP" required>
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-whatsapp btn-block btn-lg shadow-lg">
                            <i class="fa-brands fa-whatsapp"></i> Verifikasi
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <p>Belum punya akun? 
                            <a href="<?= site_url('user/auth/register') ?>">Daftar</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const fadeTarget = document.querySelector('.fade-up');
            if(fadeTarget) setTimeout(() => fadeTarget.classList.add('show'), 200);
        });
    </script>
</body>
</html>
