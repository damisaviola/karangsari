
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            // Pastikan SweetAlert sudah dimuat
            if (typeof Swal === 'undefined') {
            console.error('SweetAlert belum dimuat.');
            window.location.href = "<?= site_url('admin/auth/login/logout') ?>";
            return;
            }

            Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin keluar dari sistem?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#435ebe',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            backdrop: true,
            focusCancel: false,
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                title: 'Logout Berhasil',
                text: 'Anda akan dialihkan...',
                icon: 'success',
                showConfirmButton: false,
                timer: 1300,
                willClose: () => {
                    window.location.href = "<?= site_url('admin/auth/login/logout') ?>";
                }
                });
            }
            });
        }
        </script>

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

<script>
  const tingkatHunian = <?= json_encode($tingkat_hunian) ?>; // Contoh hasil dari model: [3, 5]

  const ctxHunian = document.getElementById('chartTingkatHunian');
  if (ctxHunian) {
    const total = tingkatHunian.reduce((a, b) => a + b, 0);
    const persenTerisi = total > 0 ? ((tingkatHunian[0] / total) * 100).toFixed(1) : 0;

    new Chart(ctxHunian.getContext('2d'), {
      type: 'doughnut',
      data: {
        labels: ['Kamar Terisi (Lunas)', 'Kamar Kosong'],
        datasets: [{
          data: tingkatHunian,
          backgroundColor: ['#435ebe', '#e0e0e0'],
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        cutout: '60%',
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              color: '#333'
            }
          },
          title: {
            display: true,
            font: {
              size: 16
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                const label = context.label || '';
                const value = context.raw;
                const percent = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                return `${label}: ${percent}% (${value} kamar)`;
              }
            }
          }
        }
      },
      plugins: [{
        id: 'centerText',
        afterDraw(chart) {
          const { ctx, chartArea: { width, height } } = chart;
          ctx.save();
          ctx.font = 'bold 20px Poppins, sans-serif';
          ctx.fillStyle = '#435ebe';
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          ctx.fillText(persenTerisi + '%', width / 2, height / 2);
        }
      }]
    });
  }
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('bookingTrendChart');
    if (ctx) {
        const bookingTrend = new Chart(ctx.getContext('2d'), {
            type: 'line',
            data: {
                labels: <?= json_encode($booking_trend['labels']) ?>,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: <?= json_encode($booking_trend['values']) ?>,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#4e73df'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }
});
</script>



</body>

</html>