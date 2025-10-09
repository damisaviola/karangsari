<body>
    <div id="app">
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <?php if($this->session->flashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= $this->session->flashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <h3>Pengaturan Akun</h3>
                            <p class="text-muted">Kelola profil, keamanan, dan preferensi akun Anda.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pengaturan Akun</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">

                            <!-- Bagian Profil -->
                            <h5 class="mb-4"><i class="bi bi-person-circle me-2"></i>Informasi Profil</h5>
                            <form action="<?= base_url('user/update_profile') ?>" method="post" class="mb-5">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" class="form-control" value="<?= $user->nama ?? '' ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control" value="<?= $user->email ?? '' ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nomor HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="no_hp" class="form-control" value="<?= $user->no_hp ?? '' ?>">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan Profil
                                    </button>
                                </div>
                            </form>

                            <!-- Bagian Keamanan -->
                            <h5 class="mb-4"><i class="bi bi-shield-lock me-2"></i>Ubah Kata Sandi</h5>
                            <form action="<?= base_url('user/update_password') ?>" method="post" class="mb-5">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Kata Sandi Lama</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_lama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Kata Sandi Baru</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password_baru" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Konfirmasi Kata Sandi Baru</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="konfirmasi_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-shield-check me-1"></i> Ubah Password
                                    </button>
                                </div>
                            </form>

                            <!-- Bagian Preferensi -->
                            <h5 class="mb-4"><i class="bi bi-gear me-2"></i>Preferensi Aplikasi</h5>
                            <form action="<?= base_url('user/update_preferences') ?>" method="post">
                                <div class="mb-4 row">
                                    <label class="col-sm-3 col-form-label">Mode Tampilan</label>
                                    <div class="col-sm-9">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="toggle-dark" name="tema" value="dark"
                                                <?= isset($user->tema) && $user->tema == 'dark' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="toggle-dark">
                                                <?= isset($user->tema) && $user->tema == 'dark' ? 'Dark Mode Aktif' : 'Light Mode Aktif' ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label class="col-sm-3 col-form-label">Bahasa</label>
                                    <div class="col-sm-9">
                                        <select name="bahasa" class="form-select">
                                            <option value="id" <?= isset($user->bahasa) && $user->bahasa == 'id' ? 'selected' : '' ?>>Indonesia</option>
                                            <option value="en" <?= isset($user->bahasa) && $user->bahasa == 'en' ? 'selected' : '' ?>>English</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-gear me-1"></i> Simpan Preferensi
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
