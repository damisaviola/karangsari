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
          <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Form Pembayaran</h3>
            <p class="text-muted">Silakan isi data berikut untuk melakukan pembayaran kamar kos.</p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Pembayaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pembayaran</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Pembayaran -->
    <section id="form-pembayaran">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header"><h4 class="card-title">Form Tambah Pembayaran</h4></div>
            <div class="card-body">
              <form action="<?= base_url('admin/pembayaran/simpan') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                       value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row g-3">

                  <!-- Pilih Booking -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="id_booking" class="form-label">Pilih Booking</label>
                      <select id="id_booking" name="id_booking" class="form-select" required>
                        <option value="">-- Pilih Booking --</option>
                        <?php foreach($booking as $b): ?>
                          <option 
                            value="<?= $b->id_booking ?>"
                            data-nama="<?= $b->nama ?>"
                            data-kamar="<?= $b->nomor_kamar ?>"
                            data-total="<?= $b->total_harga ?>"
                          >
                            <?= $b->nama ?> - Kamar <?= $b->nomor_kamar ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Nama dan Nomor Kamar -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nama_penghuni" class="form-label">Nama Penghuni</label>
                      <input type="text" id="nama_penghuni" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nomor_kamar" class="form-label">Nomor Kamar</label>
                      <input type="text" id="nomor_kamar" class="form-control" readonly>
                    </div>
                  </div>

                  <!-- Total Harga -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="total_harga_display" class="form-label">Total Pembayaran</label>
                      <input type="text" id="total_harga_display" class="form-control" readonly>
                      <input type="hidden" id="total_harga" name="total_harga">
                    </div>
                  </div>

                  <!-- Metode Pembayaran -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="metode" class="form-label">Metode Pembayaran</label>
                      <select id="metode" name="metode" class="form-select" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cash">Tunai</option>
                      </select>
                    </div>
                  </div>

                  <!-- Upload Bukti -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                      <input type="file" id="bukti_pembayaran" name="bukti_pembayaran" class="form-control" accept="image/*" required>
                      <small class="text-muted">Upload foto bukti transfer (jpg, png, jpeg)</small>
                    </div>
                  </div>

                  <!-- Tanggal Pembayaran -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tanggal_pembayaran" class="form-label">Tanggal Pembayaran</label>
                      <input type="date" id="tanggal_pembayaran" name="tanggal_pembayaran" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                  </div>
                 

                  <!-- Catatan -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="catatan" class="form-label">Catatan</label
                      <textarea id="catatan" name="catatan" class="form-control" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
                    </div>
                  </div>

                  <!-- Tombol -->
                  <div class="col-12 d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2"><i class="bi bi-credit-card"></i> Simpan Pembayaran</button>
                    <button type="reset" class="btn btn-secondary"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
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
    // Otomatis isi data saat pilih booking
    document.getElementById('id_booking').addEventListener('change', function() {
      const selected = this.options[this.selectedIndex];
      const nama = selected.getAttribute('data-nama');
      const kamar = selected.getAttribute('data-kamar');
      const total = selected.getAttribute('data-total');

      document.getElementById('nama_penghuni').value = nama || '';
      document.getElementById('nomor_kamar').value = kamar || '';
      document.getElementById('total_harga_display').value = total ? 'Rp ' + new Intl.NumberFormat('id-ID').format(total) : '';
      document.getElementById('total_harga').value = total || '';
    });
  </script>
</body>
