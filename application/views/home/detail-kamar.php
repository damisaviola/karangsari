<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Detail Kamar</title>
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
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    
      <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-6 col-xl-2">
          <h1 class="mb-0 site-logo m-0 p-0"><a href="<?= base_url() ?>" class="mb-0">Warehouse</a></h1>
        </div>

        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">
            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
              <li><a href="<?= base_url() ?>#home-section" class="nav-link">Home</a></li>
              <li><a href="<?= base_url() ?>#properties-section" class="nav-link active">Properties</a></li>
              <li><a href="<?= base_url() ?>#agents-section" class="nav-link">Agents</a></li>
              <li><a href="<?= base_url() ?>#about-section" class="nav-link">About</a></li>
              <li><a href="<?= base_url() ?>#news-section" class="nav-link">News</a></li>
              <li><a href="<?= base_url() ?>#contact-section" class="nav-link">Contact</a></li>
            </ul>
          </nav>
        </div>

        <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3">
          <a href="#" class="site-menu-toggle js-menu-toggle text-white float-right"><span class="icon-menu h3"></span></a>
        </div>
      </div>
    </div>
  </header>


    
    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url('<?= base_url('assets/home/images/hero_1.jpg') ?>');" data-aos="fade">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-5 mx-auto mt-lg-5 text-center">
        <h1><?= 'Kamar '.$room['nomor_kamar'].' - Lantai '.$room['lantai'] ?></h1>
        <p class="mb-5"><strong class="text-white">Rp <?= number_format($room['harga'], 0, ',', '.') ?></strong></p>
      </div>
    </div>
  </div>

  <a href="#property-details" class="smoothscroll arrow-down"><span class="icon-arrow_downward"></span></a>
</div>
  

    
    
<div class="site-section" id="property-details">
  <div class="container">
    <div class="row">

      <!-- Carousel Gambar Kamar -->
      <div class="col-lg-7 mb-4 mb-lg-0">
        <div class="owl-carousel slide-one-item with-dots rounded shadow-sm">
          <?php if(!empty($room['images'])): ?>
            <?php foreach($room['images'] as $img): ?>
              <div><img src="<?= base_url('uploads/kamar/'.$img) ?>" alt="Kamar Image" class="img-fluid rounded"></div>
            <?php endforeach; ?>
          <?php else: ?>
            <div><img src="<?= base_url('assets/home/images/property_1.jpg') ?>" alt="Kamar Image" class="img-fluid rounded"></div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Detail Kamar & Info Admin -->
      <div class="col-lg-5 pl-lg-5 ml-auto">
        <div class="card shadow-sm rounded-lg mb-4">
          <div class="card-body">
            <h3 class="card-title text-primary mb-4">Detail Kamar</h3>

            <p class="mb-2"><strong>Nomor Kamar:</strong> <?= $room['nomor_kamar'] ?></p>
            <p class="mb-2"><strong>Lantai:</strong> <?= $room['lantai'] ?></p>
            <p class="mb-2"><strong>Harga:</strong> <span class="text-success h5">Rp <?= number_format($room['harga'], 0, ',', '.') ?></span></p>
            <p class="mb-3"><?= $room['deskripsi'] ?></p>

            <h5 class="text-primary mb-3">Fasilitas:</h5>
            <div class="d-flex flex-wrap mb-3">
              <?php if(!empty($room['fasilitas'])): ?>
                <?php foreach($room['fasilitas'] as $f): ?>
                  <span class="badge badge-pill badge-primary mr-2 mb-2"><?= $f ?></span>
                <?php endforeach; ?>
              <?php else: ?>
                <span class="text-muted">Tidak ada fasilitas terdaftar</span>
              <?php endif; ?>
            </div>

            <!-- Tombol Pesan -->
            <?php if ($this->session->userdata('user_id')): ?>
              <a href="<?= base_url('pemesanan/create/'.$room['id']) ?>" 
                 class="btn btn-primary btn-block rounded-pill">Pesan Sekarang</a>
            <?php else: ?>
               <a href="<?= base_url('user/auth/login') ?>" 
                  class="btn btn-secondary btn-block rounded-pill">
                  Login untuk Pesan
                </a>
            <?php endif; ?>
          </div>
        </div>

        <!-- Info Admin -->
        <div class="card shadow-sm rounded-lg">
          <div class="card-body text-center">
            <img src="<?= base_url('assets/home/images/person_1.jpg') ?>" alt="Admin Kos" class="rounded-circle mb-3" style="width:100px;height:100px;object-fit:cover;">
            <h4 class="text-black">Admin Kos</h4>
            <p class="text-muted mb-2">Kontak Pemilik</p>
            <p class="mb-3">Informasi kontak dan deskripsi pemilik kos atau admin bisa ditampilkan di sini.</p>
            <a href="tel:+62123456789" class="btn btn-outline-primary btn-block rounded-pill">Hubungi Admin</a>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<style>

.card {
  border-radius: 1rem; 
  box-shadow: 0 10px 20px rgba(0,0,0,0.08);
}


.badge-primary {
  background-color: #007bff;
  color: #fff;
  font-size: 0.9rem;
  padding: 0.5em 0.75em;
  border-radius: 50px;
}

.btn-block {
  display: block;
  width: 100%;
}

.btn-primary:hover {
  background-color: #0069d9;
  transition: 0.3s;
}

.btn-outline-primary:hover {
  background-color: #007bff;
  color: #fff;
  transition: 0.3s;
}

/* Responsive untuk mobile */
@media (max-width: 991px) {
  .btn-block {
    width: 100%;
  }
}
</style>


    
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">About Us</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque facere laudantium magnam voluptatum autem. Amet aliquid nesciunt veritatis aliquam.</p>
              </div>
              <div class="col-md-3 mx-auto">
                <h2 class="footer-heading mb-4">Quick Links</h2>
                <ul class="list-unstyled">
                  <li><a href="#">About Us</a></li>
                  <li><a href="#">Services</a></li>
                  <li><a href="#">Testimonials</a></li>
                  <li><a href="#">Contact Us</a></li>
                </ul>
              </div>
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="mb-4">
              <h2 class="footer-heading mb-4">Subscribe Newsletter</h2>
            <form action="#" method="post" class="footer-subscribe">
              <div class="input-group mb-3">
                <input type="text" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" aria-label="Enter Email" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary text-black" type="button" id="button-addon2">Send</button>
                </div>
              </div>
            </form>  
            </div>
            
            <div class="">
              <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href="#" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href="#" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
            </div>


          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <!-- Link back to Free-Template.co can't be removed. Template is licensed under CC BY 3.0. -->
            <p class="copyright"><small>&copy; <script>document.write(new Date().getFullYear());</script> Warehouse. All Rights Reserved.  Design by <a href="https://free-template.co" target="_blank">Free-Template.co</a></small></p>
            </div>
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