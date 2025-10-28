

</div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            
<div class="page-heading">
    <h3>Profile Statistics</h3>
</div> 
<div class="page-content"> 
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="row">
                                <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Belum Bayar</h6>
    <h6 class="font-extrabold mb-0"><?= $jumlah_belum_bayar ?></h6>
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
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Penghuni Aktif</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_penghuni_aktif ?></h6>
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
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Nonaktif</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_penghuni_nonaktif ?></h6>
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
                                        <i class="iconly-boldHome"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                    <h6 class="text-muted font-semibold">Kamar Tersedia</h6>
                                    <h6 class="font-extrabold mb-0"><?= $jumlah_kamar_tersedia ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                
            

                <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Statistik Pemesanan Kamar per Bulan</h4>
            </div>
            <div class="card-body">
                <canvas id="bookingChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Profile Visit</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-primary" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="<?= base_url('assets/dist/assets/static/images/bootstrap-icons.svg#circle-fill') ?>"
`                                            />
                                        </svg>
                                        <h5 class="mb-0 ms-3">Europe</h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-0 text-end">862</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-europe"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-success" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="<?= base_url('assets/dist/assets/static/images/bootstrap-icons.svg#circle-fill') ?>"
`                                            />
                                        </svg>
                                        <h5 class="mb-0 ms-3">America</h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-0 text-end">375</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-america"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="d-flex align-items-center">
                                        <svg class="bi text-danger" width="32" height="32" fill="blue"
                                            style="width:10px">
                                            <use
                                                xlink:href="<?= base_url('assets/dist/assets/static/images/bootstrap-icons.svg#circle-fill') ?>" />
                                        </svg>
                                        <h5 class="mb-0 ms-3">Indonesia</h5>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <h5 class="mb-0 text-end">1025</h5>
                                </div>
                                <div class="col-12">
                                    <div id="chart-indonesia"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-8">
   <div class="card">
    <div class="card-header">
        <h4>Pemesanan Terbaru</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-lg">
                <thead>
                    <tr class="text-center">
                        <th>Nama Penghuni</th>
                        <th>Nomor Kamar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($latest_booking)) : ?>
                        <?php foreach ($latest_booking as $b) : ?>
                            <tr class="text-center">
                                <td class="text-start">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="<?= base_url('assets/dist/assets/compiled/jpg/' . rand(1, 6) . '.jpg') ?>" alt="avatar">
                                        </div>
                                        <p class="font-bold ms-3 mb-0"><?= htmlspecialchars($b->nama_penghuni) ?></p>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($b->nomor_kamar) ?></td>
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

                                <td class="text-center">

                                    <!-- Tombol Batalkan -->
                                    <?php if ($b->status_pembayaran == 'belum bayar') : ?>
                                        <a href="<?= site_url('admin/pemesanan/batalkan/'.$b->id_booking) ?>"
                                           class="btn btn-sm btn-danger mt-1"
                                           onclick="return confirm('Yakin ingin membatalkan pemesanan ini?')">
                                            <i class="bi bi-x-circle"></i> Batalkan
                                        </a>
                                    <?php endif; ?>

                                    <!-- Tombol Selesai -->
                                    <?php if ($b->status_pembayaran == 'lunas') : ?>
                                        <a href="<?= site_url('admin/pemesanan/selesai/'.$b->id_booking) ?>"
                                           class="btn btn-sm btn-success mt-1"
                                           onclick="return confirm('Tandai booking ini sebagai selesai? Kamar akan otomatis tersedia kembali.')">
                                            <i class="bi bi-check-circle"></i> Selesai
                                        </a>
                                    <?php endif; ?>

                                    <!-- Tombol Hapus (khusus perpanjangan belum bayar) -->
                                    <?php if (!empty($b->parent_booking_id) && strtolower($b->status_pembayaran) === 'belum bayar'): ?>
                                        <a href="<?= site_url('admin/pemesanan/hapus_booking/'.$b->id_booking) ?>"
                                           class="btn btn-sm btn-secondary mt-1"
                                           onclick="return confirm('Yakin ingin membatalkan booking perpanjangan ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada pemesanan terbaru</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

            </div>
        </div>
        <div class="col-12 col-lg-3">
                                <div class="card">
                                    <div class="card-body py-4 px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img src="<?= base_url('assets/dist/assets/compiled/jpg/1.jpg') ?>" alt="Face 1">
                                            </div>
                                        <div class="ms-3 name">
                        <h5 class="font-bold">
                            <?= $this->session->userdata('nama_lengkap'); ?>
                        </h5>
                        <h6 class="text-muted mb-0">
                            @<?= $this->session->userdata('username'); ?>
                        </h6>
                    </div>

                    </div>
                </div>
            </div>
           <div class="card">
    <div class="card-header">
        <h4>Penghuni</h4>
    </div>
    <div class="card-content pb-4">
        <?php if (!empty($penghuni)) : ?>
            <?php foreach ($penghuni as $row) : ?>
                <div class="recent-message d-flex px-4 py-3 align-items-center">
                    <div class="avatar avatar-lg">
                        <img src="<?= base_url('assets/dist/assets/compiled/jpg/2.jpg') ?>" alt="Profile Picture">
                    </div>
                    <div class="name ms-4">
                        <h5 class="mb-1"><?= htmlspecialchars($row->nama) ?></h5>
                        <h6 class="text-muted mb-0"><?= htmlspecialchars($row->email) ?></h6>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="text-center py-3">
                <p class="text-muted">Belum ada data penghuni.</p>
            </div>
        <?php endif; ?>

        <div class="px-4">
            <a href="<?= base_url('admin/penghuni') ?>" class="btn btn-block btn-xl btn-outline-primary font-bold mt-3">
                Lihat Semua Penghuni
            </a>
        </div>
    </div>
</div>

    <div class="card">
                <div class="card-header">
                    <h4>Tingkat Hunian</h4>
                </div>
                <div class="card-body">
                    <canvas id="chartTingkatHunian" width="100%" height="350"></canvas>
                </div>
</div>

        </div>
    </section>
</div>

</body>

</html>