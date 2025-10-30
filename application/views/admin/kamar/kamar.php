
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
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($kamar)) : ?>
            <?php $no = 1; foreach ($kamar as $k) : ?>
                <tr class="text-center">
                    <td><?= $no++ ?></td>
                    <td><?= $k->nomor_kamar ?></td>
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
                    <td>


                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailKamar<?= $k->id_kamar ?>">
        <i class="bi bi-eye"></i>
    </button>

                        <a href="javascript:void(0)" 
   class="btn btn-sm btn-danger"
   onclick="hapusKamar(<?= $k->id_kamar ?>)">
   <i class="bi bi-trash-fill"></i> Hapus
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


<?php foreach ($kamar as $k) : ?>
<div class="modal fade" id="detailKamar<?= $k->id_kamar ?>" tabindex="-1" aria-labelledby="detailKamarLabel<?= $k->id_kamar ?>" aria-hidden="true">
    <div class="modal-dialog modal-l"> 
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailKamarLabel<?= $k->id_kamar ?>">Detail Kamar <?= $k->nomor_kamar ?></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover table-striped table-sm">
                    <tbody>
                        <tr>
                            <th style="width: 200px;">Nomor Kamar</th>
                            <td><?= $k->nomor_kamar ?></td>
                        </tr>
                        <tr>
                            <th>Lantai</th>
                            <td><?= $k->lantai ?></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp <?= number_format($k->harga, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if ($k->status == 'tersedia') : ?>
                                    <span class="badge bg-success">Tersedia</span>
                                <?php elseif ($k->status == 'dihuni') : ?>
                                    <span class="badge bg-warning text-dark">Dihuni</span>
                                <?php else : ?>
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td><?= $k->deskripsi ?></td>
                        </tr>
                        <tr>
                            <th>Fasilitas</th>
                            <td>
                                <?php 
                                $fasilitas = $this->Kamar_model->getFasilitasByKamar($k->id_kamar);
                                if(!empty($fasilitas)){
                                    echo '<ul class="mb-0">';
                                    foreach($fasilitas as $f){
                                        echo '<li>'.$f->nama_fasilitas.'</li>';
                                    }
                                    echo '</ul>';
                                } else {
                                    echo 'Tidak ada fasilitas';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td><?= $k->created_at ?></td>
                        </tr>
                        <tr>
                            <th>Diubah</th>
                            <td><?= $k->updated_at ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>



            </div>
        </div>

    </section>
</div>

 