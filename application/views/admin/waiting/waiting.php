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

  .table th, .table td {
    vertical-align: middle;
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
              <h3>Waiting List</h3>
              <p class="text-subtitle text-muted">Daftar calon penghuni yang sedang menunggu ketersediaan kamar.</p>
            </div>
            
            <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Waiting List</li>
                </ol>
              </nav>
            </div>
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

        <section class="section">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0">Data Waiting List</h5>
              <a href="javascript:void(0)" class="btn-modern" data-bs-toggle="modal" data-bs-target="#tambahWaiting">
                <i class="bi bi-plus-lg"></i> Tambah
              </a>
            </div>

           <div class="card-body">
  <table class="table table-striped table-hover align-middle" id="table1">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Lengkap</th>
        <th>No. HP</th>
        <th>Tanggal Daftar</th>
        <th>Status</th>
        <th>Catatan</th>
        <th>Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php if (!empty($waiting_list)) : ?>
        <?php $no = 1; // inisialisasi nomor urut ?>
        <?php foreach ($waiting_list as $w) : ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $w->nama_lengkap ?></td>
            <td><?= $w->no_hp ?></td>
            <td><?= date('d-m-Y H:i:s', strtotime($w->tanggal_daftar)) ?></td>
            <td>
              <?php if ($w->status == 'menunggu') : ?>
                <span class="badge bg-warning text-dark">Menunggu</span>
              <?php elseif ($w->status == 'diterima') : ?>
                <span class="badge bg-success">Diterima</span>
              <?php else : ?>
                <span class="badge bg-danger">Batal</span>
              <?php endif; ?>
            </td>
            <td><?= !empty($w->catatan) ? $w->catatan : '-' ?></td>
            <td>
              <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailWaiting<?= $w->id_waiting ?>">
                <i class="bi bi-eye"></i> Detail
              </button>
              <a href="<?= site_url('admin/waiting/edit/'.$w->id_waiting) ?>" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil"></i> Edit
              </a>
              <button onclick="hapusWaiting(<?= $w->id_waiting ?>)" class="btn btn-danger btn-sm">
  <i class="bi bi-trash"></i> Hapus
</button>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="8" class="text-center text-muted">Belum ada data waiting list</td>
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

  <!-- MODAL DETAIL -->
<?php if (!empty($waiting_list)) : ?>
  <?php foreach ($waiting_list as $w) : ?>
    <div class="modal fade" id="detailWaiting<?= $w->id_waiting ?>" tabindex="-1" aria-labelledby="detailWaitingLabel<?= $w->id_waiting ?>" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-info text-white">
            <h5 class="modal-title" id="detailWaitingLabel<?= $w->id_waiting ?>">Detail Waiting List</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <table class="table table-borderless mb-0">
              <tr>
                <th style="width: 40%;">Nama Lengkap</th>
                <td><?= $w->nama_lengkap ?></td>
              </tr>
              <tr>
                <th>Email</th>
                <td><?= $w->email ?></td>
              </tr>
              <tr>
                <th>No. HP</th>
                <td>
  <?= $w->no_hp ?>
  <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $w->no_hp) ?>" 
     target="_blank" 
     class="btn btn-success btn-sm ms-1" 
     title="Chat WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>
</td>

              </tr>
              <tr>
                <th>Tanggal Daftar</th>
                <td><?= date('d-m-Y H:i:s', strtotime($w->tanggal_daftar)) ?></td>
              </tr>
              <tr>
                <th>Status</th>
                <td>
                  <?php if ($w->status == 'menunggu') : ?>
                    <span class="badge bg-warning text-dark">Menunggu</span>
                  <?php elseif ($w->status == 'diterima') : ?>
                    <span class="badge bg-success">Diterima</span>
                  <?php else : ?>
                    <span class="badge bg-danger">Batal</span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th>Catatan</th>
                <td><?= !empty($w->catatan) ? $w->catatan : '-' ?></td>
              </tr>
            </table>
          </div>

          

        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>


  <!-- MODAL TAMBAH -->
  <div class="modal fade" id="tambahWaiting" tabindex="-1" aria-labelledby="tambahWaitingLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="<?= site_url('admin/waiting_list/simpan') ?>" method="post" class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="tambahWaitingLabel">Tambah Waiting List</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
               value="<?= $this->security->get_csrf_hash(); ?>">

        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="contoh@email.com">
          </div>
          <div class="mb-3">
            <label class="form-label">No. HP</label>
            <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx">
          </div>
          <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="2" placeholder="Tambahkan catatan (opsional)"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</body>
