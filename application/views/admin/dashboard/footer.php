
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
</body>

</html>