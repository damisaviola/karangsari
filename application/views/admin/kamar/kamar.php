
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


<a href="<?= site_url('admin/chat') ?>" class="chat-btn">
  <i class="bi bi-chat-dots-fill"></i>
</a>

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
                <h3>Data Kamar</h3>
                <p class="text-subtitle text-muted">Tabel data kamar yang dapat diurutkan, dicari, dan dipaginasi secara interaktif.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kamar</li>
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
                    Data Kamar
                </h5>
                <a href="<?= site_url('admin/kamar/tambah_kamar') ?>" 
           class="btn-modern">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
            </div>
            <div class="card-body">
               <table class="table table-striped" id="table1">
    <thead>
        <tr class="text-center">
            <th>No.</th>
            <th>Nomor Kamar</th>
            <th>Lantai</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($kamar)) : ?>
            <?php $no = 1; foreach ($kamar as $k) : ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $k->nomor_kamar ?></td>
                    <td><?= $k->lantai ?></td>
                    <td>Rp <?= number_format($k->harga ?? 0, 0, ',', '.') ?></td>
                    <td>
                        <?php if ($k->status == 'tersedia') : ?>
                            <span class="badge bg-success">Tersedia</span>
                        <?php elseif ($k->status == 'dihuni') : ?>
                            <span class="badge bg-warning text-dark">Dihuni</span>
                        <?php else : ?>
                            <span class="badge bg-secondary">Tidak Aktif</span>
                        <?php endif; ?>
                    </td>
                    <td><?= !empty($k->created_at) ? date('d-m-Y H:i', strtotime($k->created_at)) : '-' ?></td>
                    <td>
                        <a href="<?= base_url('kamar/edit/'.$k->id_kamar) ?>" 
                        class="btn btn-sm btn-warning" 
                        title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <a href="<?= base_url('kamar/delete/'.$k->id_kamar) ?>" 
                        class="btn btn-sm btn-danger" 
                        title="Hapus" 
                        onclick="return confirm('Apakah yakin ingin menghapus kamar ini?')">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="8" class="text-center">Belum ada data kamar</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

            </div>
        </div>

    </section>
</div>

 