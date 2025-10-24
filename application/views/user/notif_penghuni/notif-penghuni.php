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
          <h3>Notifikasi Tagihan</h3>
          <p class="text-subtitle text-muted">Lihat semua tagihan dengan status 'belum bayar' untuk user ini.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Notifikasi Tagihan</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Tagihan Belum Bayar</h4>
      </div>
      <div class="card-body">

        <?php
        // Filter tagihan hanya yang status 'belum bayar'
       $tagihan_belum_bayar = array_filter($tagihan, fn($t) => $t->status_booking === 'belum bayar' || $t->status_booking === '');

        ?>

        <?php if (empty($tagihan_belum_bayar)): ?>
          <div class="text-center text-muted py-3">
            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
            Tidak ada tagihan dengan status 'belum bayar'.
          </div>
        <?php else: ?>
          <?php foreach ($tagihan_belum_bayar as $t): ?>
            <div class="border-bottom py-3">
              <div class="d-flex justify-content-between">
                <div>
                  <strong><?= htmlspecialchars($t->nama_penghuni) ?></strong> - Kamar <?= htmlspecialchars($t->nomor_kamar) ?><br>
                  <small class="text-muted">
                    Booking: <?= date('M Y', strtotime($t->bulan_mulai)) ?> s/d <?= date('M Y', strtotime($t->bulan_akhir)) ?> |
                    Total: Rp<?= number_format($t->total_harga, 0, ',', '.') ?>
                  </small><br>

                  <?php if($t->id_pembayaran): ?>
                    <small class="text-muted">
                      Pembayaran: Rp<?= number_format($t->jumlah_bayar, 0, ',', '.') ?> via <?= htmlspecialchars($t->metode_pembayaran) ?> -
                      <?= $t->status_pembayaran ?>
                    </small><br>
                    <small class="text-secondary"><?= date('d M Y, H:i', strtotime($t->pembayaran_created_at)) ?></small>
                  <?php else: ?>
                    <small class="text-warning">Belum melakukan pembayaran</small>
                  <?php endif; ?>
                </div>
                <div class="text-end">
                  <span class="badge bg-danger text-white"><?= ucfirst($t->status_booking) ?></span><br>
                  <a href="<?= site_url('user/pembayaran_user/') ?>" class="btn btn-sm btn-outline-danger mt-2">Detail</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </section>
</div>
