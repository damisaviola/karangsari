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
                        <h3>Data Penghuni</h3>
                        <p class="text-subtitle text-muted">Tabel daftar penghuni kos yang dapat diurutkan, dicari, dan dipaginasi secara interaktif oleh admin.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Penghuni</li>
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
                        <h5 class="card-title">Data Penghuni kos</h5>
                        <a href="<?= site_url('admin/penghuni/tambah_penghuni') ?>" class="btn-modern">
                            <i class="bi bi-plus-lg"></i> Tambah
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($penghuni)): ?>
                                    <?php $no=1; foreach($penghuni as $row): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row->nama ?></td>
                                            
                                            <td><?= $row->no_hp ?></td>
                                        
                                            <td>
                                                <?php if($row->status == 'aktif'): ?>
                                                    <span class="badge bg-success">Aktif</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">Nonaktif</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <!-- Tombol Detail -->
                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailPenghuni<?= $row->id_penghuni ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                <!-- Hapus -->
                                                <button type="button" class="btn btn-sm btn-danger btn-hapus" data-id="<?= $row->id_penghuni ?>" data-nama="<?= $row->nama ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data penghuni</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal Looping di LUAR TABLE -->
<?php if(!empty($penghuni)): ?>
    <?php foreach($penghuni as $row): ?>
        <div class="modal fade" id="detailPenghuni<?= $row->id_penghuni ?>" tabindex="-1" aria-labelledby="detailPenghuniLabel<?= $row->id_penghuni ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="detailPenghuniLabel<?= $row->id_penghuni ?>">Detail Penghuni</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-borderless mb-0">
                            <tr><th style="width:40%">ID Penghuni</th><td><?= $row->id_penghuni ?></td></tr>
                            <tr><th style="width:40%">Nama</th><td><?= $row->nama ?></td></tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <?= $row->email ?>
                                    <a href="mailto:<?= $row->email ?>" class="ms-2 text-primary" title="Kirim Email">
                                        <i class="bi bi-envelope-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                    <th>No HP</th>
                                    <td>
                                        <?= $row->no_hp ?>
                                        <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $row->no_hp) ?>" target="_blank" class="ms-2 text-success" title="Chat WA">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                    </td>
                                </tr>
                            <tr><th>Alamat</th><td><?= $row->alamat ?></td></tr>
                            <tr>
                            <th>Status</th>
                            <td>
                                <?php if($row->status == 'aktif'): ?>
                                    <span class="btn btn-success btn-sm">Aktif</span>
                                <?php else: ?>
                                    <span class="btn btn-danger btn-sm">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>

                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
