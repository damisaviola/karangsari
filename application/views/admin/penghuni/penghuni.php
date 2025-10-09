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
                <h3>Data penghuni</h3>
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
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Data Penghuni kos
                </h5>
                <a href="<?= site_url('admin/kamar/tambah_kamar') ?>" 
           class="btn-modern">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Alamat</th>
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
                    <td><?= $row->email ?></td>
                    <td><?= $row->no_hp ?></td>
                    <td><?= $row->alamat ?></td>
                    <td>
                        <?php if($row->status == 'aktif'): ?>
                            <span class="badge bg-success">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Nonaktif</span>
                        <?php endif; ?>
                    </td>
                    <td>

                        <a href="<?= base_url('penghuni/detail/'.$row->id_penghuni) ?>" 
                           class="btn btn-sm btn-info" title="Detail">
                            <i class="fas fa-eye"></i>
                        </a>

                        <!-- Edit -->
                        <a href="<?= base_url('penghuni/edit/'.$row->id_penghuni) ?>" 
                           class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Hapus -->
                        <a href="<?= base_url('penghuni/delete/'.$row->id_penghuni) ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Yakin ingin menghapus penghuni ini?');" 
                           title="Hapus">
                            <i class="fas fa-trash"></i>
                        </a>
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

 