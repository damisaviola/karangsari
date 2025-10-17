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
          <h3>Notifikasi</h3>
          <p class="text-subtitle text-muted">Lihat semua aktivitas terbaru dari penghuni dan pembayaran.</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
          <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Notifikasi</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>

    <section class="section">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Daftar Notifikasi</h4>
        </div>
        <div class="card-body">

          <?php if (empty($keluhan) && empty($pembayaran)): ?>
            <div class="text-center text-muted py-3">
              <i class="bi bi-inbox fs-2 d-block mb-2"></i>
              Tidak ada notifikasi saat ini.
            </div>
          <?php endif; ?>

          <!-- Notifikasi Keluhan -->
          <?php if (!empty($keluhan)): ?>
            <h5 class="mt-3 mb-3"><i class="bi bi-chat-dots-fill text-primary me-2"></i>Keluhan Penghuni</h5>
            <?php foreach ($keluhan as $k): ?>
              <div class="border-bottom py-3">
                <div class="d-flex justify-content-between">
                  <div>
                    <strong><?= htmlspecialchars($k->nama_penghuni) ?></strong><br>
                    <small class="text-muted"><?= htmlspecialchars($k->pesan) ?></small><br>
                    <small class="text-secondary"><?= date('d M Y, H:i', strtotime($k->created_at)) ?></small>
                  </div>
                  <div class="text-end">
                    <?php if ($k->status == 'Menunggu'): ?>
                      <span class="badge bg-warning text-dark">Menunggu</span>
                    <?php elseif ($k->status == 'Diproses'): ?>
                      <span class="badge bg-info text-dark">Diproses</span>
                    <?php else: ?>
                      <span class="badge bg-success">Selesai</span>
                    <?php endif; ?><br>
                    <a href="<?= site_url('admin/keluhan') ?>" class="btn btn-sm btn-outline-primary mt-2">Detail</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

          <!-- Notifikasi Pembayaran -->
        <?php if (!empty($pembayaran)): ?>
        <h5 class="mt-4 mb-3"><i class="bi bi-cash-stack text-success me-2"></i>Pembayaran Menunggu Verifikasi</h5>
        <?php foreach ($pembayaran as $p): ?>
            <div class="border-bottom py-3">
            <div class="d-flex justify-content-between">
                <div>
                <strong><?= htmlspecialchars($p->nama_penghuni) ?></strong><br>
                <small class="text-muted">
                    Pembayaran sebesar <strong>Rp<?= number_format($p->jumlah_bayar, 0, ',', '.') ?></strong> sedang menunggu verifikasi.
                </small><br>
                <small class="text-secondary"><?= date('d M Y, H:i', strtotime($p->tanggal_bayar)) ?></small>
                </div>
                <div class="text-end">
                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span><br>
                <a href="<?= site_url('admin/pembayaran/') ?>" class="btn btn-sm btn-outline-warning mt-2">Detail</a>
                </div>
            </div>
            </div>
        <?php endforeach; ?>
        <?php else: ?>
        <div class="text-center text-muted py-3">
            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
            Tidak ada pembayaran yang menunggu verifikasi.
        </div>
        <?php endif; ?>

                </div>
            </div>
            </section>
        </div>

        
        </div>
