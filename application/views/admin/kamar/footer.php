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
       <?php if ($this->uri->uri_string() == 'admin/kamar' || $this->uri->uri_string() == 'admin/kamar/tambah_kamar') : ?>
            <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>
        <?php endif; ?>

        <?php if ($this->uri->uri_string() == 'admin/kamar') : ?>
            <script src="<?= base_url('assets/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
            <script src="<?= base_url('assets/dist/assets/static/js/pages/simple-datatables.js') ?>"></script>
        <?php endif; ?>

        


        <script src="<?= base_url('assets/dist/assets/extensions/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/parsleyjs/parsley.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/static/js/pages/parsley.js') ?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
        function hapusKamar(id) {
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

        <script>
        function editKamar(id) {
        const modal = new bootstrap.Modal(document.getElementById('editKamarModal'));
        modal.show();

        const form = document.getElementById('formEditKamar');
        form.reset();
        document.getElementById('edit_fasilitas_list').innerHTML = '<div class="text-muted">Memuat fasilitas...</div>';

        fetch(`<?= base_url('admin/kamar/getById/') ?>${id}`)
            .then(response => response.json())
            .then(data => {
            if (data && data.kamar) {
                document.getElementById('edit_id_kamar').value = data.kamar.id_kamar;
                document.getElementById('edit_nomor_kamar').value = data.kamar.nomor_kamar;
                document.getElementById('edit_lantai').value = data.kamar.lantai;
                const hargaFormatted = Math.floor(data.kamar.harga);
                document.getElementById('edit_harga').value = hargaFormatted;
                document.getElementById('edit_status').value = data.kamar.status;
                document.getElementById('edit_deskripsi').value = data.kamar.deskripsi;

                let fasilitasHTML = '<div class="row">';
                data.fasilitas_all.forEach(f => {
                const checked = data.fasilitas_kamar.includes(String(f.id_fasilitas)) ? 'checked' : '';
                fasilitasHTML += `
                    <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="fasilitas[]" value="${f.id_fasilitas}" id="fasilitas_${f.id_fasilitas}" ${checked}>
                        <label class="form-check-label" for="fasilitas_${f.id_fasilitas}">${f.nama_fasilitas}</label>
                    </div>
                    </div>
                `;
                });
                fasilitasHTML += '</div>';
                document.getElementById('edit_fasilitas_list').innerHTML = fasilitasHTML;
            } else {
                document.getElementById('edit_fasilitas_list').innerHTML = '<div class="text-danger">Data kamar tidak ditemukan.</div>';
            }
            })
            .catch(() => {
            document.getElementById('edit_fasilitas_list').innerHTML = '<div class="text-danger">Gagal memuat data fasilitas.</div>';
            });
        }

        // Handle submit form edit
        document.getElementById('formEditKamar').addEventListener('submit', function(e) {
        e.preventDefault();

        const btn = document.getElementById('btnUpdate');
        const spinner = document.getElementById('spinnerEdit');
        const text = document.getElementById('textEdit');

        spinner.classList.remove('d-none');
        text.textContent = 'Menyimpan...';
        btn.disabled = true;

        const formData = new FormData(this);
        formData.append('<?= $this->security->get_csrf_token_name(); ?>', '<?= $this->security->get_csrf_hash(); ?>');

        fetch('<?= base_url('admin/kamar/update') ?>', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            spinner.classList.add('d-none');
            text.textContent = 'Simpan Perubahan';
            btn.disabled = false;

            if (res.status === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data kamar berhasil diperbarui.',
                showConfirmButton: false,
                timer: 1800
            }).then(() => {
                location.reload();
            });
            } else {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal memperbarui data kamar.',
            });
            }
        })
        .catch(() => {
            spinner.classList.add('d-none');
            text.textContent = 'Simpan Perubahan';
            btn.disabled = false;
            Swal.fire({
            icon: 'error',
            title: 'Kesalahan!',
            text: 'Terjadi kesalahan koneksi atau CSRF token tidak valid.',
            });
        });
        });
        </script>


</body>

</html>