
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

          <!-- Pesan Error -->
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
        
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>Data Keluhan</h3>
              <p class="text-subtitle text-muted">Tabel data keluhan penghuni yang dapat diurutkan, dicari, dan dipaginasi secara interaktif.</p>
          </div>

            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Keluhan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    Data Keluhan
                </h5>
                <a href="<?= site_url('user/keluhan/tambah') ?>" 
           class="btn-modern">
            <i class="bi bi-plus-lg"></i> Tambah
        </a>
            </div>
            <div class="card-body">
               <table class="table table-striped" id="table1">
  <thead>
    <tr class="text-center">
      <th>No</th>
      <th>Nama Penghuni</th>
      <th>Pesan Keluhan</th>
      <th>Status</th>
      <th>Dikirim Pada</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($keluhan)) : ?>
      <?php $no = 1; foreach ($keluhan as $k) : ?>
        <tr class="text-center">
          <td><?= $no++ ?></td>
          <td><?= $k->nama_penghuni ?></td>
          <td><?= $k->pesan ?></td>
          <td>
            <?php if ($k->status == 'Menunggu') : ?>
              <span class="badge bg-warning text-dark">Menunggu</span>
            <?php elseif ($k->status == 'Diproses') : ?>
              <span class="badge bg-primary">Diproses</span>
            <?php elseif ($k->status == 'Selesai') : ?>
              <span class="badge bg-success">Selesai</span>
            <?php elseif ($k->status == 'Ditolak') : ?>
              <span class="badge bg-danger">Ditolak</span>
            <?php endif; ?>
          </td>
          <td><?= date('d-m-Y H:i', strtotime($k->created_at)) ?></td>
          <td>
            <!-- Tombol Hapus -->
            <a href="<?= base_url('keluhan/hapus/'.$k->id_keluhan) ?>" 
              class="btn btn-sm btn-danger" 
              title="Hapus" 
              onclick="return confirm('Yakin ingin menghapus keluhan ini?')">
              <i class="bi bi-trash-fill"></i>
            </a>

            <!-- Tombol WhatsApp -->
            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20<?= urlencode($k->nama_penghuni) ?>%20ingin%20menanyakan%20keluhan%20saya%20yang%20berstatus%20<?= urlencode($k->status) ?>."
              target="_blank" 
              class="btn btn-sm btn-success" 
              title="Hubungi Admin via WhatsApp">
              <i class="bi bi-whatsapp"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else : ?>
      <tr>
        <td colspan="6" class="text-center">Belum ada keluhan yang dikirim.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>


            </div>
        </div>

    </section>
</div>

 