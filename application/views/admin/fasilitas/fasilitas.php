
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


<style>
  .chat-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #4f46e5, #3b82f6); 
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;   
    line-height: 1;
    box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
    transition: all 0.3s ease;
    z-index: 9999;
    text-decoration: none;
  }

  .chat-btn:hover {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    box-shadow: 0 6px 14px rgba(59, 130, 246, 0.4);
    color: #fff;
  }

  .chat-btn i {
    display: flex;
    align-items: center;
    justify-content: center;
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
                <h3>Data Fasilitas</h3>
                <p class="text-subtitle text-muted">Tabel data fasilitas yang dapat diurutkan, dicari, dan dipaginasi secara interaktif.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fasilitas</li>
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
            <h5 class="card-title">Data Fasilitas Kos</h5>
           <a href="#" class="btn-modern" data-bs-toggle="modal" data-bs-target="#modalTambahFasilitas">
                <i class="bi bi-plus-lg"></i> Tambah 
            </a>

        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Nama Fasilitas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($fasilitas)) : ?>
                        <?php $no = 1; foreach ($fasilitas as $f) : ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $f->nama_fasilitas ?></td>
                                <td>
                                    <a href="<?= site_url('admin/fasilitas/edit/'.$f->id_fasilitas) ?>" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="<?= site_url('admin/fasilitas/hapus/'.$f->id_fasilitas) ?>" 
                                       class="btn btn-sm btn-danger" 
                                       title="Hapus"
                                       onclick="return confirm('Yakin ingin menghapus fasilitas ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data fasilitas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

</div>


    <div class="modal fade" id="modalTambahFasilitas" tabindex="-1" aria-labelledby="modalTambahFasilitasLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= site_url('admin/fasilitas/tambah_aksi') ?>" method="post">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalTambahFasilitasLabel">Tambah Fasilitas Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                            value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="form-group mb-3">
                            <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas" id="nama_fasilitas" class="form-control" placeholder="Masukkan nama fasilitas">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

 