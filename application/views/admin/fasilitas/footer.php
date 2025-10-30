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

        <script src="<?= base_url('assets/dist/assets/static/js/components/dark.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
       <?php if ($this->uri->uri_string() == 'admin/fasilitas' || $this->uri->uri_string() == 'admin/fasilitas') : ?>
            <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>
        <?php endif; ?>

        <?php if ($this->uri->uri_string() == 'admin/fasilitas') : ?>
            <script src="<?= base_url('assets/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
            <script src="<?= base_url('assets/dist/assets/static/js/pages/simple-datatables.js') ?>"></script>
        <?php endif; ?>

        
        <!-- Load JS untuk halaman add kamar -->
        <script src="<?= base_url('assets/dist/assets/extensions/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/parsleyjs/parsley.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/static/js/pages/parsley.js') ?>"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function hapusFasilitas(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data fasilitas ini akan dihapus permanen!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('<?= base_url('admin/fasilitas/hapus/') ?>' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: '<?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>'
            })
            .then(res => {
                if (res.ok) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Fasilitas telah dihapus.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => location.reload());
                } else {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Error!', 'Tidak dapat terhubung ke server.', 'error');
            });
        }
    });
}
</script>
</body>

</html>