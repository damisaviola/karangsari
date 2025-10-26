
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
            <?php elseif ($b->status_pembayaran == 'perpanjang') : ?>
              <span class="badge bg-info text-dark">Perpanjangan</span>
            <?php elseif ($b->status_pembayaran == 'dibatalkan') : ?>
              <span class="badge bg-danger">Dibatalkan</span>
            <?php else : ?>
              <span class="badge bg-danger">Belum Bayar</span>
            <?php endif; ?>
          </td>

          <td>Rp <?= number_format($b->total_harga, 0, ',', '.') ?></td>
          <td><?= date('d-m-Y H:i', strtotime($b->created_at)) ?></td>

          <td>
           

          <a href="javascript:void(0);" 
   class="btn btn-sm btn-info btn-detail"
   data-id="<?= $b->id_booking ?>"
   data-nama="<?= htmlspecialchars($b->nama_penghuni) ?>"
   data-kamar="<?= htmlspecialchars($b->nomor_kamar) ?>"
   data-mulai="<?= date('Y-m', strtotime($b->bulan_mulai)) ?>"
   data-akhir="<?= date('Y-m', strtotime($b->bulan_akhir)) ?>"
   data-total="<?= $b->total_harga ?>"
   data-status="<?= $b->status_pembayaran ?>"
   data-dibuat="<?= date('d-m-Y H:i', strtotime($b->created_at)) ?>"
   data-diperbarui="<?= date('d-m-Y H:i', strtotime($b->updated_at)) ?>"
   data-parent="<?= $b->parent_booking_id ?>"
   data-perpanjang="<?= $b->jumlah_perpanjangan ?>">
  <i class="bi bi-eye"></i> Detail
</a>



            <?php if ($b->status_pembayaran == 'lunas') : ?>
              <a href="javascript:void(0);" 
                 onclick="openPerpanjangModal('<?= $b->id_booking ?>', 
                                              '<?= date('Y-m', strtotime($b->bulan_akhir)) ?>', 
                                              '<?= $b->total_harga ?>')" 
                 class="btn btn-sm btn-info">
                <i class="bi bi-clock-history"></i> Perpanjang
              </a>
            <?php endif; ?>

            <?php if ($b->status_pembayaran == 'belum bayar') : ?>
              <a href="<?= site_url('admin/pemesanan/batalkan/'.$b->id_booking) ?>"
                 class="btn btn-sm btn-danger"
                 onclick="return confirm('Yakin ingin membatalkan pemesanan ini?')">
                <i class="bi bi-x-circle"></i> Batalkan
              </a>
            <?php endif; ?>

            <?php if ($b->status_pembayaran == 'lunas') : ?>
              <a href="<?= site_url('admin/pemesanan/selesai/'.$b->id_booking) ?>"
                 class="btn btn-sm btn-success"
                 onclick="return confirm('Tandai booking ini sebagai selesai? Kamar akan otomatis tersedia kembali.')">
                <i class="bi bi-check-circle"></i> Selesai
              </a>
            <?php endif; ?>

           <?php if(!empty($b->parent_booking_id) && strtolower($b->status_pembayaran) === 'belum bayar'): ?>
    <a href="<?= site_url('admin/pemesanan/hapus_booking/'.$b->id_booking) ?>"
       class="btn btn-sm btn-secondary"
       onclick="return confirm('Yakin ingin membatalkan booking perpanjangan ini?')">
       <i class="bi bi-trash"></i> Hapus
    </a>
<?php else: ?>
    
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

<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalDetailLabel">Detail Pemesanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
          <tr><th>ID Booking</th><td id="detail_id_booking"></td></tr>
          <tr><th>Nama Penghuni</th><td id="detail_nama"></td></tr>
          <tr><th>Kamar</th><td id="detail_kamar"></td></tr>
          <tr><th>Bulan Mulai</th><td id="detail_mulai"></td></tr>
          <tr><th>Bulan Akhir</th><td id="detail_akhir"></td></tr>
          <tr><th>Status </th><td><span id="detail_status" class="badge bg-secondary"></span></td></tr>
          <tr><th>Total Bayar</th><td id="detail_total"></td></tr>
          <tr><th>Parent Booking ID</th><td id="detail_parent_id">-</td></tr>
          <tr><th>Jumlah Perpanjangan</th><td id="detail_perpanjangan">-</td></tr>
          <tr><th>Dibuat Pada</th><td id="detail_dibuat"></td></tr>
          <tr><th>Diperbarui Pada</th><td id="detail_diperbarui"></td></tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>



                            <!-- Modal Perpanjang -->
<!-- Modal Perpanjangan -->

<!-- Modal Perpanjangan -->
<div class="modal fade" id="modalPerpanjang" tabindex="-1" aria-labelledby="modalPerpanjangLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= site_url('admin/pemesanan/perpanjang_action') ?>" method="post">
        
        <!-- CSRF -->
        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" 
               value="<?= $this->security->get_csrf_hash(); ?>">

        <!-- ID Booking Lama -->
        <input type="hidden" name="id_booking_lama" id="id_booking_lama">

        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="modalPerpanjangLabel">Perpanjang Sewa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <!-- Bulan mulai baru -->
          <div class="mb-3">
            <label for="bulan_mulai_baru" class="form-label">Bulan Mulai Baru</label>
            <input type="month" class="form-control" name="bulan_mulai_baru" id="bulan_mulai_baru" readonly>
          </div>

          <!-- Bulan akhir baru -->
          <div class="mb-3">
            <label for="bulan_akhir_baru" class="form-label">Bulan Akhir Baru</label>
            <input type="month" class="form-control" name="bulan_akhir_baru" id="bulan_akhir_baru" required>
            <small class="text-muted">Pilih bulan akhir sewa baru.</small>
          </div>

          <!-- Harga per bulan -->
          <div class="mb-3">
            <label for="harga_per_bulan" class="form-label">Harga per Bulan</label>
            <input type="number" class="form-control" id="harga_per_bulan" name="harga_per_bulan" readonly>
          </div>

          <!-- Total harga -->
          <div class="mb-3">
            <label for="total_harga_baru" class="form-label">Total yang Harus Dibayar</label>
            <input type="number" class="form-control" id="total_harga_baru" name="total_harga_baru" readonly>
            <div id="total_rupiah" class="mt-1 fw-bold text-success"></div>
          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Perpanjang Sekarang</button>
        </div>
      </form>
    </div>
  </div>
</div>






                        </div>
                    </div>
        </div>

    </section>
</div>

 