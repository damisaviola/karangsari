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
                        <h3>Daftar Refund</h3>
                        <p class="text-subtitle text-muted">Tabel daftar refund yang telah dilakukan oleh penghuni dan diproses oleh admin.</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Refund</li>
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
                        <h5 class="card-title">Data Refund</h5>
                        <a href="javascript:void(0)" class="btn-modern" data-bs-toggle="modal" data-bs-target="#tambahRefundModal">
                            <i class="bi bi-plus-lg"></i> Tambah 
                        </a>
                    </div>


                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penghuni</th>
                                    <th>Jumlah Refund</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Tanggal Refund</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                           <tbody>
<?php if(!empty($refunds)): ?>
    <?php $no = 1; foreach($refunds as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row->nama_penghuni) ?></td>
            <td>Rp<?= number_format($row->jumlah_refund, 0, ',', '.') ?></td>
            <td><?= htmlspecialchars($row->metode_refund) ?></td>
            <td>
                <?php if($row->status == 'Diproses'): ?>
                    <span class="badge bg-warning text-dark">Diproses</span>
                <?php elseif($row->status == 'Selesai'): ?>
                    <span class="badge bg-success">Selesai</span>
                <?php else: ?>
                    <span class="badge bg-danger">Dibatalkan</span>
                <?php endif; ?>
            </td>
            <td><?= date('d M Y, H:i', strtotime($row->tanggal_refund)) ?></td>
            <td>
                <!-- Tombol Detail -->
                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailRefund<?= $row->id_refund ?>">
                    <i class="fas fa-eye"></i>
                </button>

                <!-- Tombol Selesai (hanya untuk yang Diproses) -->
                <?php if($row->status == 'Diproses'): ?>
                    <a href="<?= site_url('admin/refund/selesai/'.$row->id_refund) ?>" 
                       class="btn btn-sm btn-success" 
                       onclick="return confirm('Yakin ingin menyelesaikan refund ini?');">
                       <i class="fas fa-check"></i> Selesai
                    </a>
                <?php else: ?>
                    <span class="text-muted">Tidak bisa diubah</span>
                <?php endif; ?>

                <!-- Hapus (opsional, bisa dihapus jika tidak diperlukan) -->
                <a href="<?= site_url('admin/refund/delete/'.$row->id_refund) ?>" 
                   class="btn btn-sm btn-danger" 
                   onclick="return confirm('Yakin ingin menghapus refund ini?');">
                   <i class="fas fa-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="7" class="text-center">Belum ada data refund</td>
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
<!-- Modal Tambah Refund -->
<!-- Tombol -->
<div class="card-header d-flex justify-content-between align-items-center">
  <h5 class="card-title">Data Refund</h5>
  <a href="javascript:void(0)" class="btn-modern" data-bs-toggle="modal" data-bs-target="#tambahRefundModal">
    <i class="bi bi-plus-lg"></i> Tambah Refund
  </a>
</div>

<!-- Modal Tambah Refund -->
<div class="modal fade" id="tambahRefundModal" tabindex="-1" aria-labelledby="tambahRefundLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahRefundLabel">Tambah Refund</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= site_url('admin/refund/tambah') ?>" method="post">
        <div class="modal-body">

          <!-- Dropdown ID Booking -->
          <div class="mb-3">
            <label for="id_booking" class="form-label">Pilih ID Booking (Lunas)</label>
            <select class="form-select" id="id_booking" name="id_booking" required>
              <option value="">-- Pilih Booking --</option>
              <?php foreach ($bookings_lunas as $b): ?>
                <option value="<?= $b->id_booking ?>"><?= $b->id_booking ?> - <?= $b->nama_penghuni ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Data Otomatis -->
          <div id="detailBooking" style="display: none;">
            <div class="mb-3">
              <label class="form-label">Nama Penghuni</label>
              <input type="text" class="form-control" id="nama_penghuni" readonly>
            </div>

            <div class="mb-3">
              <label class="form-label">Total Harga</label>
              <input type="text" class="form-control" id="total_harga" readonly>
            </div>

            <div class="mb-3">
              <label class="form-label">Tanggal Booking</label>
              <input type="text" class="form-control" id="tanggal_booking" readonly>
            </div>
          </div>

          <!-- Metode Refund -->
          <div class="mb-3">
            <label for="metode_refund" class="form-label">Metode Refund</label>
            <select class="form-select" id="metode_refund" name="metode_refund" required>
              <option value="">-- Pilih Metode --</option>
              <option value="Transfer Bank">Transfer Bank</option>
              <option value="Tunai">Tunai</option>
            </select>
          </div>

          <!-- Alasan Refund -->
          <div class="mb-3">
            <label for="alasan" class="form-label">Alasan Refund</label>
            <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
          </div>

          <!-- Jumlah Refund -->
          <div class="mb-3">
            <label for="jumlah_refund_display" class="form-label">Jumlah Refund</label>
            <input type="text" class="form-control" id="jumlah_refund_display" readonly>
            <!-- Nilai mentah untuk backend -->
            <input type="hidden" id="jumlah_refund" name="jumlah_refund">
          </div>

          <!-- CSRF Token -->
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
                 value="<?= $this->security->get_csrf_hash(); ?>" />

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>


