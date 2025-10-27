
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

  chatBtn.addEventListener('click', function(e){
    e.preventDefault();
    chatSidebar.classList.add('show');
  });

  const chatClose = chatSidebar.querySelector('.chat-close-icon');
  chatClose.addEventListener('click', function() {
    chatSidebar.classList.remove('show');
  });
</script>


<script>
function confirmLogout(e) {
    e.preventDefault(); 

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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = <?php echo $chart_data; ?>;

    const namaBulan = [
        'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];

    const labels = chartData.map(item => namaBulan[item.bulan - 1]);
    const data = chartData.map(item => item.total);

    const ctx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Booking per Bulan',
                data: data,
                borderWidth: 1,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>

</html>