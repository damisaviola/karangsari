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
       <?php if ($this->uri->uri_string() == 'admin/kamar' || $this->uri->uri_string() == 'admin/kamar/tambah_kamar') : ?>
            <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>
        <?php endif; ?>

        <?php if ($this->uri->uri_string() == 'admin/kamar') : ?>
            <script src="<?= base_url('assets/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
            <script src="<?= base_url('assets/dist/assets/static/js/pages/simple-datatables.js') ?>"></script>
        <?php endif; ?>

        

 



        
        <!-- Load JS untuk halaman add kamar -->
        <script src="<?= base_url('assets/dist/assets/extensions/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/parsleyjs/parsley.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/static/js/pages/parsley.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function hapusKamar(id) {
    // Pertama, ambil data status kamar dari server
    fetch('<?= base_url('admin/kamar/get_status/') ?>' + id)
        .then(res => res.json())
        .then(data => {
            if (data.status === 'dihuni') {
                Swal.fire({
                    title: 'Tidak dapat dihapus!',
                    text: 'Kamar ini masih dihuni. Silakan kosongkan terlebih dahulu sebelum menghapus.',
                    icon: 'warning',
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Mengerti'
                });
            } else {
                // Jika kamar tidak dihuni, baru tampilkan konfirmasi hapus
                Swal.fire({
                    title: 'Yakin ingin menghapus kamar ini?',
                    text: "Data kamar yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('<?= base_url('admin/kamar/delete/') ?>' + id, {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: '<?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>'
                        })
                        .then(res => res.ok ? res.text() : Promise.reject(res))
                        .then(() => {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Kamar berhasil dihapus.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            setTimeout(() => location.reload(), 2000);
                        })
                        .catch(() => {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus kamar.',
                                icon: 'error',
                                confirmButtonColor: '#d33'
                            });
                        });
                    }
                });
            }
        })
        .catch(() => {
            Swal.fire({
                title: 'Error!',
                text: 'Gagal memeriksa status kamar.',
                icon: 'error'
            });
        });
}
</script>






</body>

</html>