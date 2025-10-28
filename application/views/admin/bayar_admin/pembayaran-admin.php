<body>
    <script src="<?= base_url('assets/dist/assets/static/js/initTheme.js') ?>"></script>

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
                <h3>Data Pemesanan</h3>
                <p class="text-subtitle text-muted">Tabel daftar pemesanan yang dapat diurutkan, dicari, dan dipaginasi secara interaktif oleh admin.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran (Admin)</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Data Pemesanan
                </h5>
            </div>
             <div class="card-body">
            <table class="table table-striped" id="table1">
            <thead>
                <tr class="text-center">
                    <th style="width: 4%;">#</th>
                    <th style="width: 10%;">ID Booking</th>
                    <th style="width: 15%;">Nama Penghuni</th>
                    <th style="width: 12%;">Tanggal Bayar</th>
                    <th style="width: 12%;">Jumlah</th>
                    <th style="width: 10%;">Metode</th>
                    <th style="width: 10%;">Status</th>
                    <th style="width: 12%;">Bukti</th>
                    <th style="width: 12%;">Dibuat</th>
                    <th style="width: 15%;">Aksi</th>
                </tr>
            </thead>

    <tbody>
<?php if (!empty($pembayaran)) : ?>
    <?php 
    $no = 1; 
    foreach ($pembayaran as $p) : 
        $status = isset($p->status_pembayaran_detail) ? $p->status_pembayaran_detail : (isset($p->status_booking) ? $p->status_booking : 'Belum Bayar');

        if (strtolower($status) == 'diterima') $status = 'Lunas';
        if (strtolower($status) == 'dibatalkan') continue; 
        if (strtolower($status) == 'lunas') continue; 
    ?>
    <tr class="text-center">
        <td><?= $no++ ?></td>
        <td><?= $p->id_booking ?></td>
        <td><?= $p->nama_penghuni ?></td>
        <td><?= !empty($p->tanggal_bayar) ? date('d-m-Y', strtotime($p->tanggal_bayar)) : '<span class="text-muted">-</span>' ?></td>
        <td>
            <?php if (!empty($p->total_harga)) : ?>
                Rp <?= number_format($p->total_harga, 0, ',', '.') ?>
            <?php else : ?>
                <span class="text-muted">Belum Bayar</span>
            <?php endif; ?>
        </td>

        <td><?= ucfirst($p->metode_pembayaran ?? '-') ?></td>
        <td>
            <?php if (strtolower($status) == 'menunggu verifikasi') : ?>
                <span class="badge bg-warning text-dark">Menunggu</span>
            <?php elseif (strtolower($status) == 'ditolak') : ?>
                <span class="badge bg-danger">Ditolak</span>
            <?php else : ?>
                <span class="badge bg-secondary">Belum Bayar</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if (!empty($p->bukti_transfer)) : ?>
                <a href="<?= base_url('uploads/bukti_transfer/'.$p->bukti_transfer) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-eye"></i> Lihat
                </a>
            <?php else : ?>
                <span class="text-muted">Belum Ada</span>
            <?php endif; ?>
        </td>
        <td><?= !empty($p->pembayaran_created_at) ? date('d-m-Y H:i', strtotime($p->pembayaran_created_at)) : (!empty($p->booking_created_at) ? date('d-m-Y H:i', strtotime($p->booking_created_at)) : '-') ?></td>
        <td>
            <?php if (strtolower($status) == 'menunggu verifikasi') : ?>
                <button type="button" class="btn btn-sm btn-secondary" disabled>
                    <i class="bi bi-hourglass-split"></i> Menunggu
                </button>
            <?php else: ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="openUploadPopup('<?= $p->id_booking ?>')">
                    <i class="bi bi-cloud-arrow-up-fill"></i> Upload
                </button>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>

    <?php if ($no == 1) : ?>
        <tr>
            <td colspan="10" class="text-center">Belum ada data pembayaran</td>
        </tr>
    <?php endif; ?>
<?php else : ?>
    <tr>
        <td colspan="10" class="text-center">Belum ada data pembayaran</td>
    </tr>
<?php endif; ?>
</tbody>



</table>



 </div>
 </div>
        </div>

    </section>


   <!-- Modal Upload -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="uploadForm" action="<?= site_url('admin/pembayaran/upload_bukti_admin') ?>" method="post" enctype="multipart/form-data" class="modal-content">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_booking" id="id_booking_input">

        <div class="mb-3">
          <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
          <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
            <option value="Tunai">Tunai</option>
            <option value="Transfer Bank">Transfer Bank</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="bukti_transfer" class="form-label">Pilih Bukti Transfer</label>
          <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept="image/*" required>
        </div>

        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Contoh: Pembayaran bulan pertama" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" id="btnKirim" class="btn btn-primary">
                <span id="spinnerKirim" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <span id="textKirim">Kirim Bukti</span>
            </button>
            </div>
    </form>
  </div>
</div>


<script>
function openUploadPopup(idBooking) {
    document.getElementById('id_booking_input').value = idBooking;
    document.getElementById('bukti_transfer').value = ''; // reset file input
    document.getElementById('keterangan').value = ''; // reset keterangan
    document.getElementById('metode_pembayaran').value = 'Tunai'; // default

    toggleBuktiInput(); // update status input file

    let modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
}

// disable input file jika metode pembayaran Tunai
document.getElementById('metode_pembayaran').addEventListener('change', toggleBuktiInput);

function toggleBuktiInput() {
    const metode = document.getElementById('metode_pembayaran').value;
    const buktiInput = document.getElementById('bukti_transfer');

    if(metode === 'Tunai') {
        buktiInput.disabled = true;
        buktiInput.required = false;
    } else {
        buktiInput.disabled = false;
        buktiInput.required = true;
    }
}
</script>

<script>
function openUploadPopup(idBooking) {
    document.getElementById('id_booking_input').value = idBooking;
    document.getElementById('bukti_transfer').value = ''; // reset input file
    document.getElementById('keterangan').value = '';      // reset keterangan

    let modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
}

</script>

<script>
  const formModal = document.querySelector('#formUploadBukti'); // ganti dengan id form kamu di modal
  const btnKirim = document.getElementById('btnKirim');
  const spinnerKirim = document.getElementById('spinnerKirim');
  const textKirim = document.getElementById('textKirim');

  if (formModal) {
    formModal.addEventListener('submit', function () {
      // Tampilkan spinner dan ubah teks tombol
      spinnerKirim.classList.remove('d-none');
      textKirim.textContent = 'Mengirim...';
      btnKirim.disabled = true;
    });
  }
</script>