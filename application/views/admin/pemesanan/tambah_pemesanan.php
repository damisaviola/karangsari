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

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success">
            <?= $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Tambah Pemesanan</h3>
            <p class="text-muted">
              Silakan lengkapi form di bawah ini untuk menambahkan data pemesanan kamar kos.
            </p>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="#">Pemesanan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Pemesanan</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- Form Tambah Pemesanan -->
    <section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header">
              <h4 class="card-title">Form Tambah Pemesanan</h4>
            </div>
            <div class="card-body">
              <form action="<?= base_url('admin/pemesanan/simpan') ?>" method="post">

                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="row g-3">

                  <!-- Nama Penghuni -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="id_penghuni" class="form-label">Nama Penghuni</label>
                      <select id="id_penghuni" name="id_penghuni" class="form-select" required>
                        <option value="">-- Pilih Penghuni --</option>
                        <?php foreach ($penghuni as $p): ?>
                          <option value="<?= $p->id_penghuni ?>"><?= $p->nama ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Pilih Kamar -->
                  <div class="col-12">
                    <div class="form-group">
                      <label for="id_kamar" class="form-label">Pilih Kamar</label>
                     <select id="id_kamar" name="id_kamar" class="form-select" required>
                        <option value="">-- Pilih Kamar --</option>
                        <?php foreach ($kamar as $k): ?>
                            <option 
                            value="<?= $k->id_kamar ?>"
                            data-harga="<?= $k->harga ?>"
                            data-lantai="<?= $k->lantai ?>"
                            >
                            Kamar <?= $k->nomor_kamar ?> 
                            </option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                  </div>

                                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="harga" class="form-label">Harga Kamar</label>
                        <input type="text" id="harga" name="harga" class="form-control" readonly>
                    </div>
                    </div>

                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="lantai" class="form-label">Lantai</label>
                        <input type="text" id="lantai" name="lantai" class="form-control" readonly>
                    </div>
                    </div>

                  <!-- Bulan Masuk -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bulan_mulai" class="form-label">Bulan Masuk</label>
                      <input type="month" id="bulan_mulai" name="bulan_mulai" class="form-control" required>
                    </div>
                  </div>

                  <!-- Bulan Keluar -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="bulan_akhir" class="form-label">Bulan Akhir</label>
                      <input type="month" id="bulan_akhir" name="bulan_akhir" class="form-control" required>
                    </div>
                  </div>

                  <!-- Status Pembayaran -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                    <select id="status_pembayaran" name="status_pembayaran" class="form-select" required>
                      <option value="belum bayar">Belum Bayar</option>
                      <option value="lunas">Lunas</option>
                    </select>
                  </div>
                </div>


                  <!-- Catatan -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="catatan" class="form-label">Catatan</label>
                      <textarea id="catatan" name="catatan" class="form-control" rows="2" placeholder="Catatan tambahan (opsional)"></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
        <div class="form-group">
            <label for="total_harga" class="form-label">Total Harga</label>
            <input type="text" id="total_harga" name="total_harga" class="form-control" readonly>
        </div>
        </div>

<!-- Input hidden untuk nilai murni, benar-benar tidak terlihat -->
<input type="hidden" name="total_harga" id="total_harga_hidden">




                  <!-- Tombol -->
                  <div class="col-12 d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary me-2">
                      <i class="bi bi-check-circle"></i> Simpan
                    </button>
                    <button type="reset" class="btn btn-secondary">
                      <i class="bi bi-arrow-counterclockwise"></i> Reset
                    </button>
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
 
  document.getElementById('id_kamar').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const harga = selected.getAttribute('data-harga');
    const lantai = selected.getAttribute('data-lantai');

    document.getElementById('harga').value = harga ? 'Rp' + parseInt(harga).toLocaleString('id-ID') : '';
    document.getElementById('lantai').value = lantai || '';
  });
</script>


<script>
const selectKamar = document.getElementById('id_kamar');
const hargaInput = document.getElementById('harga');
const lantaiInput = document.getElementById('lantai');
const totalHargaInput = document.getElementById('total_harga'); // untuk tampilan
const totalHargaHidden = document.getElementById('total_harga_hidden'); // input hidden angka murni
const bulanMulai = document.getElementById('bulan_mulai');
const bulanAkhir = document.getElementById('bulan_akhir');

let hargaPerBulan = 0;

// Fungsi update harga dan lantai saat kamar dipilih
function updateKamar() {
    const selected = selectKamar.options[selectKamar.selectedIndex];
    const harga = selected.getAttribute('data-harga');
    const lantai = selected.getAttribute('data-lantai');

    hargaPerBulan = parseInt(harga) || 0;
    hargaInput.value = harga ? 'Rp' + hargaPerBulan.toLocaleString('id-ID') : '';
    lantaiInput.value = lantai || '';

    hitungTotalHarga();
}

// Fungsi hitung total harga sesuai logika khusus
function hitungTotalHarga() {
    const mulai = bulanMulai.value;
    const akhir = bulanAkhir.value;

    if (mulai && akhir && hargaPerBulan > 0) {
        const [mulaiTahun, mulaiBulan] = mulai.split('-').map(Number);
        const [akhirTahun, akhirBulan] = akhir.split('-').map(Number);

        let selisihBulan = (akhirTahun - mulaiTahun) * 12 + (akhirBulan - mulaiBulan);

        let totalBulan = 1; // default 1 bulan
        if (selisihBulan === 1) {
            totalBulan = 1;
        } else if (selisihBulan >= 2) {
            totalBulan = selisihBulan - 1 + 1;
        }

        const total = hargaPerBulan * totalBulan;
        totalHargaInput.value = 'Rp' + total.toLocaleString('id-ID'); // untuk tampilan
        totalHargaHidden.value = total; // angka murni untuk dikirim ke server
    } else {
        totalHargaInput.value = '';
        totalHargaHidden.value = '';
    }
}

// Event listener
selectKamar.addEventListener('change', updateKamar);
bulanMulai.addEventListener('change', hitungTotalHarga);
bulanAkhir.addEventListener('change', hitungTotalHarga);

// Jalankan sekali jika sudah ada kamar terpilih
if (selectKamar.value) updateKamar();

</script>






  </script>
</body>
