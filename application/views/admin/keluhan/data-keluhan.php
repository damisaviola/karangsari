<body>
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

            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <h3>Data Keluhan Penghuni</h3>
            <p class="text-subtitle text-muted">Daftar keluhan yang dikirim oleh penghuni, beserta status dan waktu pengiriman.</p>
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
          <div class="card-body">
            <table class="table table-striped align-middle" id="table1">
              <thead>
                <tr class="text-center">
                  <th style="width: 5%;">#</th>
                  <th style="width: 20%;">Penghuni</th>
                  <th style="width: 15%;">Status</th>
                  <th style="width: 20%;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!empty($keluhan)): ?>
                  <?php $no = 1; foreach ($keluhan as $k): ?>
                    <tr class="text-center">
                      <td><?= $no++ ?></td>
                      <td><?= $k->nama_penghuni ?></td>
                      <td>
                        <?php if ($k->status == 'Menunggu'): ?>
                          <span class="badge bg-warning text-dark">Menunggu</span>
                        <?php elseif ($k->status == 'Diproses'): ?>
                          <span class="badge bg-primary">Diproses</span>
                        <?php elseif ($k->status == 'Selesai'): ?>
                          <span class="badge bg-success">Selesai</span>
                        <?php else: ?>
                          <span class="badge bg-secondary">Tidak Diketahui</span>
                        <?php endif; ?>
                      </td>
                      <td>
                        <!-- Tombol Detail -->
                        <button 
                          class="btn btn-sm btn-outline-primary" 
                          data-bs-toggle="modal" 
                          data-bs-target="#detailKeluhan<?= $k->id_keluhan ?>">
                          <i class="bi bi-eye"></i> Detail
                        </button>

                        <!-- Tombol Ubah Status -->
                        <?php if ($k->status == 'Menunggu'): ?>
                          <a href="<?= site_url('keluhan/update_status/'.$k->id_keluhan.'/Diproses') ?>" 
                             class="btn btn-sm btn-warning"
                             onclick="return confirm('Ubah status menjadi Diproses?')">
                             <i class="bi bi-arrow-repeat"></i> Proses
                          </a>
                        <?php elseif ($k->status == 'Diproses'): ?>
                          <a href="<?= site_url('admin/keluhan/update_status/'.$k->id_keluhan.'/Selesai') ?>" 
                             class="btn btn-sm btn-success"
                             onclick="return confirm('Ubah status menjadi Selesai?')">
                             <i class="bi bi-check-circle"></i> Selesai
                          </a>
                        <?php elseif ($k->status == 'Selesai'): ?>
                          <button class="btn btn-sm btn-secondary" disabled>
                            <i class="bi bi-check-circle-fill"></i> Selesai
                          </button>
                        <?php endif; ?>
                      </td>
                    </tr>

                    <!-- Modal Detail Keluhan -->
                    <div class="modal fade" id="detailKeluhan<?= $k->id_keluhan ?>" tabindex="-1" aria-labelledby="detailLabel<?= $k->id_keluhan ?>" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="detailLabel<?= $k->id_keluhan ?>">Detail Keluhan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <div class="modal-body">
                            <p><strong>Nama Penghuni:</strong> <?= htmlspecialchars($k->nama_penghuni) ?></p>
                            <p><strong>Pesan Keluhan:</strong><br><?= nl2br(htmlspecialchars($k->pesan)) ?></p>
                            <p><strong>Status:</strong>
                              <?php if ($k->status == 'Menunggu'): ?>
                                <span class="badge bg-warning text-dark">Menunggu</span>
                              <?php elseif ($k->status == 'Diproses'): ?>
                                <span class="badge bg-primary">Diproses</span>
                              <?php elseif ($k->status == 'Selesai'): ?>
                                <span class="badge bg-success">Selesai</span>
                              <?php else: ?>
                                <span class="badge bg-secondary">Tidak Diketahui</span>
                              <?php endif; ?>
                            </p>
                            <p><strong>Dikirim Pada:</strong> <?= date('d-m-Y H:i', strtotime($k->created_at)) ?></p>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data keluhan.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
