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
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">

                            <!-- Bagian Profil -->
                            <h5 class="mb-4"><i class="bi bi-person-circle me-2"></i>Informasi Akun</h5>
                            <form action="<?= base_url('user/pengaturan_user/update_profile') ?>" method="post" class="mb-5">
                                <input type="hidden" name="id_penghuni" value="<?= $penghuni->id_penghuni ?>">


                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                                value="<?= $this->security->get_csrf_hash(); ?>">

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" class="form-control" value="<?= $penghuni->nama ?>" >
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                       <input type="email" name="email" class="form-control" value="<?= $penghuni->email ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Nomor HP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="no_hp" class="form-control" value="<?= $penghuni->no_hp ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                         <textarea name="alamat" class="form-control"><?= $penghuni->alamat ?></textarea>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="Penghuni" disabled>
                                    </div>
                                </div>


                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>


                            <!-- Bagian Keamanan -->
                          <!-- Bagian Keamanan -->
                <h5 class="mb-4"><i class="bi bi-shield-lock me-2"></i>Ubah Kata Sandi</h5>
                <form action="<?= base_url('user/pengaturan_user/update_password') ?>" method="post">
                    <input type="hidden" name="id_penghuni" value="<?= $penghuni->id_penghuni ?>">

                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                                                value="<?= $this->security->get_csrf_hash(); ?>">


                    <!-- Kata Sandi Lama -->
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Kata Sandi Lama</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" name="password_lama" class="form-control" id="password_lama" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_lama')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Kata Sandi Baru -->
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Kata Sandi Baru</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" name="password_baru" class="form-control" id="password_baru" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_baru')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Konfirmasi Sandi Baru -->
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Konfirmasi Sandi Baru</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('konfirmasi_password')">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-shield-check me-1"></i> Ubah Password
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
