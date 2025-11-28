<div id="main">
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">x
        <h3>Profile Statistics</h3>
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
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="row">
                     <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldCalendar"></i>
                                    </div>
                                    
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Booking</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_booking_aktif ?></h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                 <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldTick-Square"></i>
                                    </div>

                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Lunas</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_lunas ?></h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                 <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldSwap"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Perpanjangan</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_perpanjangan ?></h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                 <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon red mb-2">
                                        <i class="iconly-boldClose-Square"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Belum Lunas</h6>
                                    <h6 class="font-extrabold mb-0"><?= $total_belum_lunas ?></h6>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-12 col-lg-3">
                <?php if ($this->session->userdata('logged_in')): ?>
                    <div class="card mb-3">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" alt="Face 1">
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold"><?= html_escape($this->session->userdata('nama')); ?></h5>
                                    <p class="text-muted mb-0">
                                        <a href="mailto:<?= html_escape(strtolower($this->session->userdata('email'))); ?>">
                                            <?= html_escape(strtolower($this->session->userdata('email'))); ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Detail Pemesanan Aktif Full Width -->
        <section class="row mt-4">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-header bg-primary text-white">
                        <h4>Detail Pemesanan Aktif</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($bookings)): ?>
                            <?php foreach($bookings as $booking_aktif): ?>
                                <div class="border rounded p-3 mb-3">
                                    <div class="row mb-2">
                                        <div class="col-6"><strong>Kamar:</strong> <?= html_escape($booking_aktif->nomor_kamar) ?></div>
                                        <div class="col-6 text-end"><strong>Status:</strong> <?= ucfirst($booking_aktif->status_pembayaran) ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6"><strong>Bulan Mulai:</strong> <?= date('F Y', strtotime($booking_aktif->bulan_mulai)) ?></div>
                                        <div class="col-6 text-end"><strong>Bulan Akhir:</strong> <?= date('F Y', strtotime($booking_aktif->bulan_akhir)) ?></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6"><strong>Total Bayar:</strong> Rp <?= number_format($booking_aktif->total_harga, 0, ',', '.') ?></div>
                                        <div class="col-6 text-end"><strong>Jumlah Perpanjangan:</strong> <?= $booking_aktif->jumlah_perpanjangan ?></div>
                                    </div>

                                    <?php if ($booking_aktif->status_pembayaran === 'lunas' && $booking_aktif->jumlah_perpanjangan == 0): ?>
                                      <form action="<?= site_url('user/dashboard/checkout/' . $booking_aktif->id_booking) ?>" 
                                            method="post" 
                                            onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan pemesanan ini?');">
                                            
                                            <!-- CSRF Protection -->
                                            <input type="hidden" 
                                                name="<?= $this->security->get_csrf_token_name(); ?>" 
                                                value="<?= $this->security->get_csrf_hash(); ?>" />

                                            <!-- Tombol Checkout -->
                                            <button type="submit" class="btn btn-success w-100 mt-3">
                                                <i class="bi bi-box-arrow-right"></i> Check Out / Selesai
                                            </button>
                                        </form>

                                    <?php elseif ($booking_aktif->jumlah_perpanjangan > 0): ?>
                                        <div class="alert alert-info mt-3 mb-0">
                                            Booking ini adalah perpanjangan. Silakan cek detail pembayaran tambahan jika ada.
                                        </div>
                                    <?php else: ?>
                                        <div class="alert alert-warning mt-3 mb-0">
                                            Pembayaran belum lunas, silakan selesaikan pembayaran terlebih dahulu.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info mb-0">
                                Tidak ada pemesanan aktif.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
