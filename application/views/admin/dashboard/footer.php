
            <footer>
    <div class="footer clearfix mb-0 text-muted">
    </div>
</footer>
        </div>
    </div>
    <script src="<?= base_url('assets/dist/assets/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('assets/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>

    <!-- Need: Apexcharts -->
    <script src="<?= base_url('assets/dist/assets/extensions/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/assets/static/js/pages/dashboard.js') ?>"></script>

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmLogout(e) {
    e.preventDefault(); // mencegah default href

    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda akan logout dari sistem!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= site_url('admin/auth/login/logout') ?>";
        }
    });
}
</script>

</body>

</html>