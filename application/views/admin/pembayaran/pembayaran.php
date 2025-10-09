
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
                <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <!-- Pesan Sukses -->
        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>
                <h3>Data Pembayaran</h3>
                <p class="text-subtitle text-muted">Tabel daftar pembayaran yang dapat diurutkan, dicari, dan dipaginasi secara interaktif oleh admin.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
             <div class="card-body">
             <table class="table table-striped align-middle" id="table1">
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
                <?php $no = 1; foreach ($pembayaran as $p) : 
                    $status = $p->status_pembayaran;
                    if ($status == 'Diterima') $status = 'Lunas';
                ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $p->id_booking ?></td>
                    <td><?= $p->nama_penghuni ?></td>
                    <td>
                        <?= !empty($p->tanggal_bayar) 
                            ? date('d-m-Y', strtotime($p->tanggal_bayar)) 
                            : '<span class="text-muted">-</span>' ?>
                    </td>
                    <td>Rp <?= number_format($p->jumlah_bayar ?? 0, 0, ',', '.') ?></td>
                    <td><?= ucfirst($p->metode_pembayaran ?? '-') ?></td>
                    <td>
                        <?php if ($status == 'Lunas') : ?>
                            <span class="badge bg-success">Lunas</span>
                        <?php elseif ($status == 'Menunggu Verifikasi') : ?>
                            <span class="badge bg-warning text-dark">Menunggu</span>
                        <?php elseif ($status == 'Ditolak') : ?>
                            <span class="badge bg-danger">Ditolak</span>
                        <?php else : ?>
                            <span class="badge bg-secondary">Belum Bayar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!empty($p->bukti_transfer)) : ?>
                            <a href="<?= base_url('uploads/bukti_transfer/'.$p->bukti_transfer) ?>" 
                            target="_blank" 
                            class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                        <?php else : ?>
                            <span class="text-muted">Belum Ada</span>
                        <?php endif; ?>
                    </td>
                    <td><?= !empty($p->created_at) ? date('d-m-Y H:i', strtotime($p->created_at)) : '-' ?></td>
                    <td>
                        <?php if ($status == 'Menunggu Verifikasi') : ?>
                            <a href="<?= site_url('admin/pembayaran/verifikasi/'.$p->id_pembayaran) ?>" 
                            class="btn btn-sm btn-success">
                                <i class="bi bi-check-circle"></i> Verifikasi
                            </a>
                            <a href="<?= site_url('admin/pembayaran/tolak/'.$p->id_pembayaran) ?>" 
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin ingin menolak pembayaran ini?')">
                                <i class="bi bi-x-circle"></i> Tolak
                            </a>
                        <?php elseif ($status == 'Lunas') : ?>
                            <button class="btn btn-sm btn-success" disabled>
                                <i class="bi bi-check-circle-fill"></i> Lunas
                            </button>
                        <?php elseif ($status == 'Ditolak') : ?>
                            <button class="btn btn-sm btn-danger" disabled>
                                <i class="bi bi-x-circle-fill"></i> Ditolak
                            </button>
                        <?php else : ?>
                            <button class="btn btn-sm btn-secondary" disabled>
                                <i class="bi bi-dash-circle"></i> Belum Bayar
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="10" class="text-center text-muted">Belum ada data pembayaran</td>
                </tr>
            <?php endif; ?>
        </tbody>
</table>

     </div>
 </div>
        </div>

    </section>
</div>

 