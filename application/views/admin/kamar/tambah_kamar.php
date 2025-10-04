<body>
  <div id="main">
    <!-- Header -->
    <header class="mb-3">
      <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
      </a>
    </header>

    <!-- Judul Halaman -->
    <div class="page-heading">
      <div class="page-title mb-3">
        <?php if($this->session->flashdata('error')): ?>
  <div class="alert alert-danger">
    <?= $this->session->flashdata('error'); ?>
  </div>
<?php endif; ?>
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tambah Kamar</h3>
            <p class="text-muted">
              Silakan lengkapi form di bawah ini untuk menambahkan data kamar baru.
            </p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Kamar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kamar</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Form -->
    <section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header">
              <h4 class="card-title">Form Tambah Kamar</h4>
            </div>
            <div class="card-body">
              <form action="<?= base_url('admin/kamar/simpan') ?>" method="post" enctype="multipart/form-data">

              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
              value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row g-3">

                   <!-- Nomor Kamar -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="nomor_kamar" class="form-label">No. Kamar</label>
                      <input type="text" id="nomor_kamar" class="form-control" name="nomor_kamar" placeholder="Masukkan nomor kamar" required>
                    </div>
                  </div>

                  <!-- Lantai -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="lantai" class="form-label">Lantai</label>
                      <input type="number" id="lantai" class="form-control" name="lantai" placeholder="Masukkan lantai" required>
                    </div>
                  </div>

                  <!-- Harga -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="harga" class="form-label">Harga per Bulan</label>
                      <input type="number" id="harga" class="form-control" name="harga" placeholder="Masukkan harga (Rp)" required>
                    </div>
                  </div>

                  <!-- Status -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="status" class="form-label">Status</label>
                      <select id="status" name="status" class="form-select" required>
                        <option value="tersedia">Tersedia</option>
                        <option value="dihuni">Dihuni</option>
                      </select>
                    </div>
                  </div>

                  <!-- Deskripsi -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="deskripsi" class="form-label">Deskripsi</label>
                      <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" placeholder="Tulis deskripsi kamar"></textarea>
                    </div>
                  </div>

                  <!-- Fasilitas -->
                  <div class="col-12">
                    <fieldset class="form-group">
                      <legend class="form-label">Fasilitas</legend>
                      <div>
                        <?php foreach ($fasilitas as $fas): ?>
                          <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" 
                                   name="fasilitas[]" 
                                   value="<?= $fas->id_fasilitas ?>" 
                                   id="fasilitas<?= $fas->id_fasilitas ?>">
                            <label class="form-check-label" for="fasilitas<?= $fas->id_fasilitas ?>">
                              <?= $fas->nama_fasilitas ?>
                            </label>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </fieldset>
                  </div>
                  <!-- Tombol -->
                  <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>


