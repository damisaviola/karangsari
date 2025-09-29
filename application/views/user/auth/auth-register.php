<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="shortcut icon" href="<?= base_url('assets/dist/assets/compiled/svg/favicon.svg') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/dist/assets/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/assets/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/assets/compiled/css/auth.css') ?>">

    <style>
        /* Animasi Fade In */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
    </style>
</head>

<body>
    <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left" class="fade-in">
                    <div class="auth-logo"></div>
                    <h1 class="auth-title">Daftar.</h1>
                    <p class="auth-subtitle mb-5">Isi data Anda untuk mendaftar di situs web kami.</p>

                    <!-- Flashdata -->
                    <?php if ($this->session->flashdata('error')): ?>
                        <?= $this->session->flashdata('error'); ?>
                    <?php endif; ?>
                    
                    <?php if ($this->session->flashdata('success')): ?>
                        <?= $this->session->flashdata('success'); ?>
                    <?php endif; ?>
                     <form action="<?= site_url('user/auth/register/action_register2') ?>" method="post">

                     <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                        value="<?= $this->security->get_csrf_hash(); ?>">
                        
                        <label for="nama">Nama Lengkap</label>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" id="nama" name="nama" class="form-control form-control-xl" placeholder="Nama Lengkap" required>
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>

                        <label for="email">Email</label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" id="email" name="email" class="form-control form-control-xl" placeholder="Email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        <label for="alamat">Alamat</label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" id="alamat" name="alamat" class="form-control form-control-xl" placeholder="Alamat" required>
                            <div class="form-control-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                        </div>

                        <label for="telp">Nomor Telepon</label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" id="telp" name="telp" class="form-control form-control-xl" placeholder="Nomor Telepon" required>
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                        </div>

                        <label for="password">Password</label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" id="password" name="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <label for="confirm_password">Konfirmasi Password</label>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-xl" placeholder="Konfirmasi Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Dengan mendaftar, Anda telah setuju dengan kebijakan dan aturan dalam menggunakan sistem <b>D'Paragon</b>.
                            </label>
                        </div>

                        <button id="btn-submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4" disabled>Daftar</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>
                            Sudah memiliki akun?
                            <a href="<?= site_url('user/auth/login') ?>" class="font-bold">Masuk</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
  const btn = document.getElementById('btn-submit');
  const formInputs = document.querySelectorAll('#auth-left input[type="text"], #auth-left input[type="email"], #auth-left input[type="password"]');
  const checkbox = document.getElementById('terms');

  function toggleButton() {
    let allFilled = true;
    formInputs.forEach(input => {
      if (input.value.trim() === '') {
        allFilled = false;
      }
    });

    btn.disabled = !(allFilled && checkbox.checked);
  }

  formInputs.forEach(input => input.addEventListener('input', toggleButton));
  checkbox.addEventListener('change', toggleButton);
</script>