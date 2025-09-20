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
       <?php if ($this->uri->uri_string() == 'admin/penghuni' || $this->uri->uri_string() == 'admin/kamar/tambah_kamar') : ?>
            <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>
        <?php endif; ?>

        <?php if ($this->uri->uri_string() == 'admin/penghuni') : ?>
            <script src="<?= base_url('assets/dist/assets/extensions/simple-datatables/umd/simple-datatables.js') ?>"></script>
            <script src="<?= base_url('assets/dist/assets/static/js/pages/simple-datatables.js') ?>"></script>
        <?php endif; ?>




        
        <!-- Load JS untuk halaman add kamar -->
        <script src="<?= base_url('assets/dist/assets/extensions/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/extensions/parsleyjs/parsley.min.js') ?>"></script>
        <script src="<?= base_url('assets/dist/assets/static/js/pages/parsley.js') ?>"></script>




<script>
  const chatBtn = document.querySelector('.chat-btn'); 
  const chatSidebar = document.getElementById('chatbox-sidebar');

  // tombol untuk membuka sidebar
  chatBtn.addEventListener('click', function(e){
    e.preventDefault();
    chatSidebar.classList.add('show');
  });

  // tombol close di sidebar
  const chatClose = chatSidebar.querySelector('.chat-close-icon');
  chatClose.addEventListener('click', function() {
    chatSidebar.classList.remove('show');
  });
  
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatBtn = document.querySelector('.chat-btn');
    const chatSidebar = document.getElementById('chatbox-sidebar');
    const chatClose = chatSidebar.querySelector('.chat-close-icon');

    // Sidebar menu Mail (misal Inbox) yang ingin diberi active
    const inboxMenu = document.getElementById('inbox-menu');

    // Tampilkan sidebar & sembunyikan tombol chat
    chatBtn.addEventListener('click', function(e) {
        e.preventDefault();
        chatSidebar.classList.add('show');
        chatBtn.style.display = 'none'; // sembunyikan tombol

        // Aktifkan menu Inbox
        inboxMenu.classList.add('active');
    });

    // Tutup sidebar & tampilkan tombol chat lagi
    chatClose.addEventListener('click', function() {
        chatSidebar.classList.remove('show');
        chatBtn.style.display = 'block'; // tampilkan tombol

        // Hilangkan active dari menu Inbox
        inboxMenu.classList.remove('active');
    });
});
</script>

</body>

</html>