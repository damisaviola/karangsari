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
       <?php if ($this->uri->uri_string() == 'admin/refund' || $this->uri->uri_string() == 'admin/refund') : ?>
            <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>
        <?php endif; ?>

        <?php if ($this->uri->uri_string() == 'admin/refund') : ?>
            <script src="<?= base_url('assets/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
            <script src="<?= base_url('assets/dist/assets/static/js/pages/simple-datatables.js') ?>"></script>
        <?php endif; ?>

        


        
        <!-- Load JS untuk halaman add kamar -->
        <script src="<?= base_url('assets/dist/assets/extensions/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/parsleyjs/parsley.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/static/js/pages/parsley.js') ?>"></script>
        <script>
        const csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
        const csrfHash = '<?= $this->security->get_csrf_hash(); ?>';
        </script>

           <script>
document.getElementById('id_booking').addEventListener('change', function() {
  const id_booking = this.value;

  if (id_booking) {
    fetch("<?= site_url('admin/refund/get_detail_booking/') ?>" + id_booking)
      .then(res => res.json())
      .then(data => {
        if (data && !data.error) {
          // Tampilkan detail
          document.getElementById('detailBooking').style.display = 'block';

          // Isi field otomatis
          document.getElementById('nama_penghuni').value = data.nama_penghuni;

          // Format angka jadi rupiah untuk tampilannya
          const formattedHarga = new Intl.NumberFormat('id-ID').format(data.total_harga);
          document.getElementById('total_harga').value = 'Rp ' + formattedHarga;
          document.getElementById('jumlah_refund_display').value = 'Rp ' + formattedHarga; // input readonly untuk user

          // Hidden input untuk dikirim ke backend sebagai angka mentah
          document.getElementById('jumlah_refund').value = data.total_harga;

          document.getElementById('tanggal_booking').value = data.tanggal_booking;

        } else {
          document.getElementById('detailBooking').style.display = 'none';
          alert('Data booking tidak ditemukan.');
        }
      })
      .catch(() => {
        alert('Terjadi kesalahan koneksi ke server.');
      });
  } else {
    // Kosongkan semua field jika tidak ada booking yang dipilih
    document.getElementById('detailBooking').style.display = 'none';
    document.getElementById('nama_penghuni').value = '';
    document.getElementById('total_harga').value = '';
    document.getElementById('tanggal_booking').value = '';
    document.getElementById('jumlah_refund_display').value = '';
    document.getElementById('jumlah_refund').value = '';
  }
});
</script>






</body>

</html>