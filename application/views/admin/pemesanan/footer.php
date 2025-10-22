           <footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2025 &copy; Karangsari</p>
        </div>
    </div>
</footer>
        </div>
    </div>


        <script src="<?= base_url('assets/dist/assets/extensions/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/filepond-plugin-image-crop/filepond-plugin-image-crop.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/filepond-plugin-image-filter/filepond-plugin-image-filter.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/filepond/filepond.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/toastify-js/src/toastify.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/static/js/pages/filepond.js') ?>"></script>

        <!-- Load JS -->
        <script src="<?= base_url('assets/dist/assets/static/js/components/dark.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
       <?php if ($this->uri->uri_string() == 'admin/pemesanan' || $this->uri->uri_string() == 'admin/kamar/tambah_kamar') : ?>
            <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>
        <?php endif; ?>

        <?php if ($this->uri->uri_string() == 'admin/pemesanan') : ?>
            <script src="<?= base_url('assets/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
            <script src="<?= base_url('assets/dist/assets/static/js/pages/simple-datatables.js') ?>"></script>
        <?php endif; ?>




        
        <!-- Load JS untuk halaman add kamar -->
        <script src="<?= base_url('assets/dist/assets/extensions/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/parsleyjs/parsley.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/static/js/pages/parsley.js') ?>"></script>


<script>
function openPerpanjangModal(id_booking, bulan_akhir_lama) {
    // Set data ke input modal
    document.getElementById('id_booking_lama').value = id_booking;
    document.getElementById('bulan_mulai_baru').value = bulan_akhir_lama;

    // Harga tetap: 1.200.000 per bulan
    var harga_per_bulan = 1200000;

    document.getElementById('harga_per_bulan').value = harga_per_bulan;

    // Bayar awal = 1 bulan
    document.getElementById('total_harga_baru').value = harga_per_bulan;
    document.getElementById('total_rupiah').innerText = formatRupiah(harga_per_bulan);

    // Tampilkan modal
    var modal = new bootstrap.Modal(document.getElementById('modalPerpanjang'));
    modal.show();
}

// Format ke Rupiah
function formatRupiah(angka) {
    return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
}

// Hitung total bayar saat bulan_akhir diubah
document.addEventListener('DOMContentLoaded', function() {
    var bulanAkhirInput = document.getElementById('bulan_akhir_baru');

    if (bulanAkhirInput) {
        bulanAkhirInput.addEventListener('change', function() {
            var bulanMulai = new Date(document.getElementById('bulan_mulai_baru').value + '-01');
            var bulanAkhir = new Date(this.value + '-01');

            var diffBulan = (bulanAkhir.getFullYear() - bulanMulai.getFullYear()) * 12
                          + (bulanAkhir.getMonth() - bulanMulai.getMonth());

            var hargaPerBulan = 1200000; // Tetap 1.200.000
            var totalBayar = diffBulan <= 0 ? hargaPerBulan : hargaPerBulan * diffBulan;

            document.getElementById('total_harga_baru').value = totalBayar;
            document.getElementById('total_rupiah').innerText = formatRupiah(totalBayar);
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const links = document.querySelectorAll('.btn-detail');

  links.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();

      const id = this.dataset.id;
      const nama = this.dataset.nama;
      const kamar = this.dataset.kamar;
      const mulai = this.dataset.mulai;
      const akhir = this.dataset.akhir;
      const total = this.dataset.total;
      const status = this.dataset.status;
      const dibuat = this.dataset.dibuat;
      const diperbarui = this.dataset.diperbarui;
      const parent = this.dataset.parent;
      const perpanjang = this.dataset.perpanjang;

      openDetailModal(id, nama, kamar, mulai, akhir, total, status, dibuat, diperbarui, parent, perpanjang);
    });
  });
});

function formatRupiah(angka) {
  return new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
  }).format(angka);
}

function openDetailModal(id, nama, kamar, mulai, akhir, total, status, dibuat, diperbarui, parentId, perpanjangan) {
  document.getElementById('detail_id_booking').textContent = id;
  document.getElementById('detail_nama').textContent = nama;
  document.getElementById('detail_kamar').textContent = kamar;
  document.getElementById('detail_mulai').textContent = mulai;
  document.getElementById('detail_akhir').textContent = akhir;
  document.getElementById('detail_total').textContent = formatRupiah(total);
  document.getElementById('detail_dibuat').textContent = dibuat;
  document.getElementById('detail_diperbarui').textContent = diperbarui;
  document.getElementById('detail_parent_id').textContent = parentId ? parentId : '-';
  document.getElementById('detail_perpanjangan').textContent = perpanjangan > 0 ? perpanjangan + ' kali' : '-';

  const statusEl = document.getElementById('detail_status');
  statusEl.textContent = status;
  statusEl.className = 'badge';
  switch (status.toLowerCase()) {
    case 'lunas':
      statusEl.classList.add('bg-success');
      break;
    case 'pending':
      statusEl.classList.add('bg-warning', 'text-dark');
      break;
    case 'perpanjang':
      statusEl.classList.add('bg-info', 'text-dark');
      break;
    case 'dibatalkan':
      statusEl.classList.add('bg-danger');
      break;
    case 'selesai':
      statusEl.classList.add('bg-secondary');
      break;
    default:
      statusEl.classList.add('bg-dark');
  }

  const modal = new bootstrap.Modal(document.getElementById('modalDetail'));
  modal.show();
}
</script>












</body>

</html>