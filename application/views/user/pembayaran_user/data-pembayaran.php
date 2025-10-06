
<style>
    .btn-modern {
        background: linear-gradient(135deg, #4f46e5, #3b82f6);
        color: #fff;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(59,130,246,0.3);
        transition: all 0.3s ease;
    }
    .btn-modern:hover {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(59,130,246,0.4);
        color: #fff;
    }
    .btn-modern i {
        margin-right: 6px;
    }
</style>

<body>
    <script src="<?= base_url('assets/dist/assets/static/js/initTheme.js') ?>"></script>

        <a href="#" class="chat-btn">
    <i class="bi bi-chat-dots-fill"></i>
    </a>

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
                <h3>Data Pembayaran</h3>
                <p class="text-subtitle text-muted">Tabel daftar pembayarean yang dapat diurutkan, dicari, dan dipaginasi secara interaktif oleh admin.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<section class="section">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Data Pembayaran</h5>
    </div>

    <div class="card-body">
  <table class="table table-striped" id="table1">
<thead>
    <tr>
        <th>#</th>
        <th>ID Booking</th>
        <th>Nama</th>
        <th>Nomor Kamar</th>
        <th>Mulai</th>
        <th>Akhir</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</thead>
<tbody>
<?php if(!empty($pembayaran)) : ?>
    <?php $no = 1; foreach($pembayaran as $p) : 
        // Tentukan status
        if(!empty($p->status_pembayaran_detail)) {
            $status = $p->status_pembayaran_detail;
        } elseif(!empty($p->status_booking)) {
            $status = $p->status_booking;
        } else {
            $status = 'Belum Bayar';
        }

        // Normalisasi status
        if(strtolower($status) == 'diterima') $status = 'Menunggu Verifikasi';
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $p->id_booking ?></td>
        <td><?= $p->nama_penghuni ?></td>
        <td><?= $p->nomor_kamar ?></td>
        <td><?= $p->bulan_mulai ?></td>
        <td><?= $p->bulan_akhir ?></td>
        <td>Rp <?= number_format($p->total_harga,0,',','.') ?></td>
        <td>
            <?php if(strtolower($status) == 'lunas') : ?>
                <span class="badge bg-success">Lunas</span>
            <?php elseif(strtolower($status) == 'menunggu verifikasi') : ?>
                <span class="badge bg-warning text-dark">Menunggu</span>
            <?php elseif(strtolower($status) == 'ditolak') : ?>
                <span class="badge bg-danger">Ditolak</span>
            <?php else : ?>
                <span class="badge bg-secondary">Belum Bayar</span>
            <?php endif; ?>
        </td>
        <td class="text-center">
            <?php if(strtolower($status) == 'belum bayar') : ?>
                <button class="btn btn-sm btn-primary" 
                        onclick="openUploadPopup('<?= $p->id_booking ?>','')">
                    <i class="bi bi-cloud-arrow-up-fill"></i> Upload
                </button>
            <?php elseif(strtolower($status) == 'ditolak') : ?>
                <button class="btn btn-sm btn-warning" 
                        onclick="openUploadPopup('<?= $p->id_booking ?>','<?= $p->id_pembayaran ?>')">
                    <i class="bi bi-cloud-arrow-up-fill"></i> Upload Ulang
                </button>
            <?php elseif(strtolower($status) == 'menunggu verifikasi') : ?>
                <button class="btn btn-sm btn-warning text-dark" disabled>
                    <i class="bi bi-hourglass-split"></i> Menunggu
                </button>
            <?php else : ?>
                <button class="btn btn-sm btn-success" disabled>
                    <i class="bi bi-check-circle-fill"></i> Lunas
                </button>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="9" class="text-center text-muted">Belum ada data pembayaran</td>
</tr>
<?php endif; ?>
</tbody>
</table>


    </div>
  </div>
</section>


<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="uploadForm" action="<?= site_url('user/pembayaran_user/upload_bukti') ?>" method="post" enctype="multipart/form-data" class="modal-content">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
             value="<?= $this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="id_booking" id="id_booking_input">
      <input type="hidden" name="id_pembayaran" id="id_pembayaran_input">

      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="bukti_transfer" class="form-label">Pilih Bukti Transfer</label>
          <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" accept="image/*" required>
          <small class="text-muted">Format: JPG, PNG, JPEG (max 2MB)</small>
        </div>
        <div class="mb-3">
          <label for="keterangan" class="form-label">Keterangan</label>
          <textarea name="keterangan" id="keterangan" class="form-control" placeholder="Contoh: Pembayaran bulan pertama" required></textarea>
        </div>
        <small class="text-muted d-block mt-2">
          *Jumlah bayar dan metode pembayaran otomatis diambil dari data pemesanan.
        </small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Kirim Bukti</button>
      </div>
    </form>
  </div>
</div>


<script>
function openUploadPopup(idBooking, idPembayaran) {
    document.getElementById('id_booking_input').value = idBooking;
    document.getElementById('id_pembayaran_input').value = idPembayaran; // kosong = input baru, ada = upload ulang
    var modal = new bootstrap.Modal(document.getElementById('uploadModal'));
    modal.show();
}
</script>


</div>

 