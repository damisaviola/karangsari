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
              <h3>Data Keluhan</h3>
              <p class="text-subtitle text-muted">Gunakan form di bawah ini untuk menambahkan keluhan baru berdasarkan pengalaman penghuni.</p>
          </div>

          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Keluhan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Keluhan</li>
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
          <h4 class="card-title">Form Tambah Keluhan</h4>
        </div>
        <div class="card-body">
          <form action="<?= base_url('user/keluhan/simpan') ?>" method="post">

            <!-- CSRF Protection -->
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
              value="<?= $this->security->get_csrf_hash(); ?>">

            <div class="row g-3">

              <!-- Nama Penghuni -->
              <div class="col-12">
                <div class="form-group">
                  <label for="nama_penghuni" class="form-label">Nama Penghuni</label>
                  <input type="text" id="nama_penghuni" class="form-control" 
                    value="<?= $this->session->userdata('nama'); ?>" readonly>
                  <input type="hidden" name="id_penghuni" value="<?= $this->session->userdata('id_penghuni'); ?>">
                </div>
              </div>

              <!-- Pesan Keluhan -->
              <div class="col-12">
                <div class="form-group">
                  <label for="pesan" class="form-label">Isi Keluhan</label>
                  <textarea id="pesan" name="pesan" class="form-control" rows="4" 
                    placeholder="Tulis keluhan Anda di sini..." required></textarea>
                </div>
              </div>

              <!-- Status (default: Menunggu, tidak perlu diisi user) -->
              <input type="hidden" name="status" value="Menunggu">

              <!-- Tombol -->
              <div class="col-12 d-flex justify-content-end">
                <button type="submit" id="btnKirim" class="btn btn-primary me-2">
                  <span id="btnSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                  <span id="btnText">Kirim Keluhan</span>
                </button>
                <button type="reset" class="btn btn-secondary">Batal</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

  </div>

  <script>
  const form = document.querySelector('form'); // pastikan ini di dalam form
  const btnSimpan = document.getElementById('btnSimpan');
  const btnSpinner = document.getElementById('btnSpinner');
  const btnText = document.getElementById('btnText');

  form.addEventListener('submit', function() {
    // tampilkan spinner dan ubah teks
    btnSpinner.classList.remove('d-none');
    btnText.textContent = 'Menyimpan...';
    btnSimpan.disabled = true;
  });
</script>
</body>


