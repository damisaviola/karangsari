
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
                <h3>Data Pemesanan</h3>
                <p class="text-subtitle text-muted">Tabel daftar pemesanan yang dapat diurutkan, dicari, dan dipaginasi secara interaktif oleh admin.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pemesanan</li>
                    </ol>
                </nav>
            </div>
             <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('error'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $this->session->flashdata('success'); ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Data Pemesanan
                </h5>
                <a href="<?= site_url('admin/pemesanan/tambah_pemesanan') ?>" 
           class="btn-modern">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
            </div>
             <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                     <tr>
                                    <th style="width: 7%;">ID</th>
                                    <th style="width: 15%;">Nama</th>
                                    <th style="width: 10%;">No. Kamar</th>
                                    <th style="width: 12%;">Mulai</th>
                                    <th style="width: 12%;">Akhir</th>
                                    <th style="width: 13%;">Status</th>
                                    <th style="width: 13%;">Total</th>
                                    <th style="width: 13%;">Dibuat</th>
                                    <th style="width: 10%;">Aksi</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($booking)) : ?>
                                        <?php foreach ($booking as $b) : ?>
                                            <tr>
                                                <td><?= $b->id_booking ?></td>
                                                <td><?= $b->nama_penghuni ?></td>
                                                <td><?= $b->nomor_kamar ?></td>
                                                <td><?= date('Y-m', strtotime($b->bulan_mulai)) ?></td>
                                                <td><?= date('Y-m', strtotime($b->bulan_akhir)) ?></td>
                                               <td>
    <?php if ($b->status_pembayaran == 'lunas') : ?>
        <span class="badge bg-success">Lunas</span>
    <?php elseif ($b->status_pembayaran == 'pending') : ?>
        <span class="badge bg-warning text-dark">Pending</span>
    <?php elseif ($b->status_pembayaran == 'selesai') : ?>
        <span class="badge bg-secondary">Selesai</span>
    <?php else : ?>
        <span class="badge bg-danger">Belum Bayar</span>
    <?php endif; ?>
</td>

                                                <td>Rp <?= number_format($b->total_harga, 0, ',', '.') ?></td>
                                                <td><?= date('d-m-Y H:i', strtotime($b->created_at)) ?></td>
                                                <td>
                                                    <a href="<?= site_url('admin/pemesanan/edit/'.$b->id_booking) ?>" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <a href="<?= site_url('admin/pemesanan/perpanjang/'.$b->id_booking) ?>" class="btn btn-sm btn-info">
                                                        <i class="bi bi-clock-history"></i> Perpanjang
                                                    </a>
                                                    <a href="<?= site_url('admin/pemesanan/hapus/'.$b->id_booking) ?>"
                                                       class="btn btn-sm btn-danger"
                                                       onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </a>
                                                    <?php if ($b->status_pembayaran == 'lunas') : ?>
        <a href="<?= site_url('admin/pemesanan/selesai/'.$b->id_booking) ?>"
           class="btn btn-sm btn-success"
           onclick="return confirm('Tandai booking ini sebagai selesai? Kamar akan otomatis tersedia kembali.')">
            <i class="bi bi-check-circle"></i> Selesai
        </a>
    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">
                                                Belum ada data pemesanan
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
        </div>

    </section>
</div>

 