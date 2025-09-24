<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Warehouse — Free Website Template by Free-Template.co</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />

    <link rel="shortcut icon" href="ftco-32x32.png">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900|Oswald:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/home/fonts/icomoon/style.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/home/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/css/jquery-ui.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/css/owl.theme.default.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/home/css/jquery.fancybox.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/css/bootstrap-datepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/fonts/flaticon/font/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/css/aos.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/home/css/style.css') ?>">

    <style>
      .room-card {
        border-radius: 1rem; 
        overflow: hidden; 
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2); 
      }
      .room-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35); 
      }
      .room-card img {
        width: 100%;
        height: 200px; 
        object-fit: cover;
        display: block;
      }
      .card-body {
        padding: 1rem;
        background: #fff;
      }
      /* Navbar mobile fix */
      .site-mobile-menu {
        background: #222;
      }
      .site-mobile-menu a {
        color: #fff;
        font-size: 18px;
        display: block;
        padding: 10px 15px;
      }
      /* Footer mobile friendly */
      .footer-heading {
        font-size: 1.2rem;
      }
      @media (max-width: 767.98px) {
        .card-body h5 {
          font-size: 1rem;
        }
        .card-body p {
          font-size: 0.9rem;
        }
        .footer-subscribe input {
          font-size: 0.9rem;
        }
      }
    </style>
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <!-- Mobile Menu -->
    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    <!-- Navbar -->
    <header class="site-navbar py-3 js-sticky-header site-navbar-target" role="banner">
      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="index.html" class="mb-0">Warehouse</a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.html#home-section" class="nav-link">Home</a></li>
                <li><a href="index.html#properties-section" class="nav-link active">Properties</a></li>
                <li><a href="index.html#agents-section" class="nav-link">Agents</a></li>
                <li><a href="index.html#about-section" class="nav-link">About</a></li>
                <li><a href="index.html#news-section" class="nav-link">News</a></li>
                <li><a href="index.html#contact-section" class="nav-link">Contact</a></li>
              </ul>
            </nav>
          </div>

          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3">
            <a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3 text-dark"></span></a>
          </div>

        </div>
      </div>
    </header>

    <!-- Hero -->
    <div class="site-blocks-cover inner-page-cover overlay" 
     style="background-image: url('<?= base_url('assets/home/images/hero_1.jpg') ?>');" 
     data-aos="fade">

      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-8 mx-auto mt-lg-5">
            <h1 class="text-white">Daftar Kamar Tersedia</h1>
            <p class="mb-5"><strong class="text-white">Warehouse Kost & Apartemen</strong></p>
          </div>
        </div>
      </div>
      <a href="#property-details" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
    </div>  

    <!-- Property Section -->
    <div class="site-section" id="property-details">
      <div class="container">
        <div class="row g-4">

          <?php if(empty($available_rooms)): ?>
            <div class="col-12">
              <div class="alert alert-warning text-center">
                Maaf, tidak ada kamar tersedia dari <?= $check_in ?> sampai <?= $check_out ?>.
              </div>
            </div>
          <?php else: ?>
            <?php foreach($available_rooms as $kamar): ?>
              <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card room-card shadow-sm h-100">
                  <?php if(!empty($kamar->gambar)): ?>
                    <img src="uploads/<?= $kamar->gambar ?>" alt="Kamar <?= $kamar->nomor_kamar ?>">
                  <?php else: ?>
                    <img src="<?= base_url('assets/home/images/property_3.jpg') ?>" alt="Default Room">
                  <?php endif; ?>
                  <div class="card-body">
                    <h5 class="card-title">Kamar <?= $kamar->nomor_kamar ?></h5>
                    <p class="card-text mb-1">Lantai: <?= $kamar->lantai ?></p>
                    <p class="card-text mb-1">Harga: Rp <?= number_format($kamar->harga) ?> / Bulan</p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer bg-dark text-light pt-5 pb-3">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mb-4">
            <div class="row">
              <div class="col-md-6 mb-3">
                <h2 class="footer-heading mb-3">About Us</h2>
                <p>Kami menyediakan kost dan apartemen dengan fasilitas modern dan harga terjangkau.</p>
              </div>
              <div class="col-md-6 mb-3">
                <h2 class="footer-heading mb-3">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4">
            <h2 class="footer-heading mb-3">Subscribe Newsletter</h2>
            <form action="#" method="post" class="footer-subscribe">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary bg-transparent text-light" placeholder="Enter Email">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">Send</button>
                </div>
              </div>
            </form>  
            <h2 class="footer-heading mb-3">Follow Us</h2>
            <a href="#" class="pr-3 text-light"><span class="icon-facebook"></span></a>
            <a href="#" class="pr-3 text-light"><span class="icon-twitter"></span></a>
            <a href="#" class="pr-3 text-light"><span class="icon-instagram"></span></a>
            <a href="#" class="pr-3 text-light"><span class="icon-linkedin"></span></a>
          </div>
        </div>
        <div class="row pt-4 text-center">
          <div class="col-12">
            <p class="mb-0 small">&copy; <script>document.write(new Date().getFullYear());</script> Warehouse. All Rights Reserved. Design by <a href="https://free-template.co" target="_blank" class="text-primary">Free-Template.co</a></p>
          </div>
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->

  <a href="#top" class="gototop"><span class="icon-angle-double-up"></span></a> 

  <script src="<?= base_url('assets/home/js/jquery-3.3.1.min.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/jquery-ui.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/owl.carousel.min.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/jquery.countdown.min.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/bootstrap-datepicker.min.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/jquery.easing.1.3.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/aos.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/jquery.fancybox.min.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/jquery.sticky.js') ?>"></script>
  <script src="<?= base_url('assets/home/js/main.js') ?>"></script>

  </body>
</html>
