<section class="container mt-5">
    <h3 class="mb-4">Hasil Pencarian Kamar</h3>

    <?php if(empty($available_rooms)): ?>
        <div class="alert alert-warning">Maaf, tidak ada kamar tersedia dari <?= $check_in ?> sampai <?= $check_out ?>.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach($available_rooms as $kamar): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Kamar <?= $kamar->nomor_kamar ?></h5>
                            <p class="card-text">Lantai: <?= $kamar->lantai ?></p>
                            <p class="card-text">Harga: Rp <?= number_format($kamar->harga) ?> Per Bulan</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
