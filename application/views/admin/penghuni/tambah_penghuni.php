<div id="main">
  <div class="page-heading">
    <div class="page-title mb-3">
      <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
          <h3>Tambah Penghuni</h3>
          <p class="text-muted">Lengkapi form berikut untuk menambahkan data penghuni baru.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('admin/penghuni') ?>">Penghuni</a></li>
              <li class="breadcrumb-item active" aria-current="page">Tambah Penghuni</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <section id="form-tambah-penghuni">
    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4 class="card-title">Form Tambah Penghuni</h4>
          </div>
          <div class="card-body">
            <form action="<?= base_url('admin/penghuni/simpan') ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
              value="<?= $this->security->get_csrf_hash(); ?>">

              <div class="row g-3">
                <!-- Nama -->
                <div class="col-12">
                  <label for="nama" class="form-label">Nama Lengkap</label>
                  <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- No HP -->
                <div class="col-12">
                  <label for="no_hp" class="form-label">No HP</label>
                  <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
                </div>

                <!-- Email -->
                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>

                <!-- Alamat -->
                <div class="col-12">
                  <label for="alamat" class="form-label">Alamat</label>
                  <textarea id="alamat" name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <!-- Status -->
                <div class="col-12">
                  <label for="status" class="form-label">Status</label>
                  <select id="status" name="status" class="form-select" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                  </select>
                </div>

                <!-- Tombol -->
                <div class="col-12 d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary me-2">Simpan</button>
                  <a href="<?= base_url('admin/penghuni') ?>" class="btn btn-secondary">Batal</a>
                </div>

              </div>
            </form>
            <small class="text-muted">
              * Password akan otomatis tergenerate oleh sistem.
            </small>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
