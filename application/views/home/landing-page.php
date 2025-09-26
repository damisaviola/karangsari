<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Karangsari Exclusive</title>
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
            <h1 class="mb-0 site-logo m-0 p-0"><a href="index.html" class="mb-0">Warehouse</a></h1>
          </div>

          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="#home-section" class="nav-link">Beranda</a></li>
                 <li><a href="#booking-section" class="nav-link">Pesan</a></li>
                <li><a href="#properties-section" class="nav-link">Galeri</a></li>
                <li><a href="#about-section" class="nav-link">Tentang</a></li>
                <li><a href="#contact-section" class="nav-link">Kontak</a></li>
                <li><a href="#agents-section" class="nav-link">Daftar</a></li>
                <li><a href="#agents-section" class="nav-link">Masuk</a></li>
              </ul>
            </nav>
          </div>


          <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white float-right"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

    
<!-- Site Block Wrap -->
<div class="site-block-wrap position-relative">
  <!-- Carousel -->
  <div class="owl-carousel with-dots">

    <!-- Slide 1 -->
    <div class="site-blocks-cover overlay overlay-2" style="background-image: url(assets/home/images/hero_1.jpg);" data-aos="fade" id="home-section">
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
          <div class="col-md-8 col-lg-6">
            <h1 class="text-shadow mb-4">Buy & Sell Property Here</h1>
            <p class="mb-4 text-shadow lead">
              Free website template for Real Estate websites by 
              <a href="https://free-template.co/" target="_blank" class="text-white">Free-Template.co</a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="site-blocks-cover overlay overlay-2" style="background-image: url(assets/home/images/hero_2.jpg);" data-aos="fade" id="home-section">
      <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
          <div class="col-md-8 col-lg-6">
            <h1 class="text-shadow mb-4">Find Your Perfect Property For Your Home</h1>
            <p class="mb-4 text-shadow lead">
              Free website template for Real Estate websites by 
              <a href="https://free-template.co/" target="_blank" class="text-white">Free-Template.co</a>
            </p>
          </div>
        </div>
      </div>
    </div>

  </div> 
</div> 


<section id="booking-section" class="booking-section" style="position: relative; z-index: 10; margin-top: -120px;">
  <div class="container">
    <div class="booking-form-wrapper mx-auto shadow-lg p-5 rounded-5 bg-white" style="max-width: 800px; border-radius: 2rem;">
      <?php if($this->session->flashdata('error')): ?>
  <div class="alert alert-danger">
    <?= $this->session->flashdata('error'); ?>
  </div>
<?php endif; ?>
      <form action="<?= base_url('home/create2') ?>" method="get" class="row g-4 align-items-end">
        
        <!-- Check In -->
        <div class="col-12 col-md-6 mb-3 mb-md-0">
          <label class="form-label fw-semibold" style="font-size: 0.95rem;">CHECK IN</label>
          <div class="input-card p-3 rounded-4 border bg-light d-flex align-items-center">
            <input type="date" name="check_in" class="form-control border-0  bg-light w-100 h-100" placeholder="Check In">
          </div>
        </div>

        <!-- Check Out -->
        <div class="col-12 col-md-6">
          <label class="form-label fw-semibold " style="font-size: 0.95rem;">CHECK OUT</label>
          <div class="input-card p-3 rounded-4 border bg-light d-flex align-items-center">
            <input type="date" name="check_out" class="form-control border-0 bg-light w-100 h-100" placeholder="Check Out">
          </div>
        </div>

        <!-- Submit Button -->
        <div class="col-12 d-grid mt-3">
          <button type="submit" class="btn btn-primary py-3 fw-semibold text-uppercase shadow-sm">
            Cari kamar
          </button>
        </div>

      </form>
    </div>
  </div>
</section>

<style>

    
.input-card {
  transition: all 0.2s ease-in-out;
}
.input-card:hover {
  border-color: #007bff;
  box-shadow: 0 4px 15px rgba(0, 123, 255, 0.15);
}
.input-card input:focus {
  background-color: #e6f0ff;
  outline: none;
  box-shadow: none;
}

.btn-primary {
  transition: all 0.2s;
}
.btn-primary:hover {
  background-color: #0069d9;
  box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

.booking-form-wrapper {
  border-radius: 2rem; 
}

@media (max-width: 767.98px) {
  .booking-form-wrapper {
    padding: 2rem;
  }
  .input-card {
    padding: 1.25rem;
  }
  .form-label {
    margin-bottom: 0.5rem;
  }
  .btn-primary {
    font-size: 1rem;
  }

  .col-12.mb-3 {
    margin-bottom: 1rem !important;
  }
}
</style>


  <div class="site-section" id="properties-section">
      <div class="container">
        <div class="row large-gutters">
          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
            <div class="ftco-media-1">
              <div class="ftco-media-1-inner">
                <a href="<?= base_url('property-single') ?>" class="d-inline-block mb-4">
                  <img src="<?= base_url('assets/home/images/property_1.jpg') ?>" 
                      alt="Free website template by Free-Template.co" 
                      class="img-fluid">
              </a>
                  <div class="ftco-media-details">
                  <h3>HD17 19 Utica Ave.</h3>
                  <p>New York - USA</p>
                  <strong>$20,000,000</strong>
                </div>
  
              </div> 
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
              <div class="ftco-media-1">
                  <div class="ftco-media-1-inner">
                   <a href="<?= base_url('property-single') ?>" class="d-inline-block mb-4">
                    <img src="<?= base_url('assets/home/images/property_1.jpg') ?>" 
                        alt="Free website template by Free-Template.co" 
                        class="img-fluid">
                    </a>
                    <div class="ftco-media-details">
                      <h3>HD17 19 Utica Ave.</h3>
                      <p>New York - USA</p>
                      <strong>$20,000,000</strong>
                    </div>
      
                  </div> 
                </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
              <div class="ftco-media-1">
                  <div class="ftco-media-1-inner">
                    <a href="property-single.html" class="d-inline-block mb-4"><img src="assets/home/images/property_3.jpg" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                    <div class="ftco-media-details">
                      <h3>HD17 19 Utica Ave.</h3>
                      <p>New York - USA</p>
                      <strong>$20,000,000</strong>
                    </div>
      
                  </div> 
                </div>
          </div>

          <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
              <div class="ftco-media-1">
                <div class="ftco-media-1-inner">
                  <a href="property-single.html" class="d-inline-block mb-4"><img src="assets/home/images/property_1.jpg" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                  <div class="ftco-media-details">
                    <h3>HD17 19 Utica Ave.</h3>
                    <p>New York - USA</p>
                    <strong>$20,000,000</strong>
                  </div>
    
                </div> 
              </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                <div class="ftco-media-1">
                    <div class="ftco-media-1-inner">
                      <a href="property-single.html" class="d-inline-block mb-4"><img src="assets/home/images/property_2.jpg" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                      <div class="ftco-media-details">
                        <h3>HD17 19 Utica Ave.</h3>
                        <p>New York - USA</p>
                        <strong>$20,000,000</strong>
                      </div>
        
                    </div> 
                  </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-5 ">
                <div class="ftco-media-1">
                    <div class="ftco-media-1-inner">
                      <a href="property-single.html" class="d-inline-block mb-4"><img src="assets/home/images/property_3.jpg" alt="Free website template by Free-Template.co" class="img-fluid"></a>
                      <div class="ftco-media-details">
                        <h3>HD17 19 Utica Ave.</h3>
                        <p>New York - USA</p>
                        <strong>$20,000,000</strong>
                      </div>
        
                    </div> 
                  </div>
            </div>

        </div>
      </div>
    </div>
    
    <section class="py-5 bg-primary site-section how-it-works" id="howitworks-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-md-7 text-center">
            <h2 class="section-title mb-3 text-black">How It Works</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 text-center">
            <div class="pr-5 first-step">
              <span class="text-black">01.</span>
              <span class="custom-icon flaticon-house text-black"></span>
              <h3 class="text-black">Find Property.</h3>
              <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>

          <div class="col-md-4 text-center">
            <div class="pr-5 second-step">
              <span class="text-black">02.</span>
              <span class="custom-icon flaticon-coin text-black"></span>
              <h3 class="text-dark">Buy Property.</h3>
              <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>

          <div class="col-md-4 text-center">
            <div class="pr-5">
              <span class="text-black">03.</span>
              <span class="custom-icon flaticon-home text-black"></span>
              <h3 class="text-dark">Outstanding Houses.</h3>
              <p class="text-black">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>  
    </section>



    <section class="site-section" id="about-section">
      <div class="container">
        <div class="row large-gutters">
          <div class="col-lg-6 mb-5">
              <div class="owl-carousel slide-one-item with-dots">
                    <div><img src="<?= base_url('assets/home/images/img_1.jpg') ?>" alt="Free website template by Free-Template.co" class="img-fluid"></div>
                    <div><img src="<?= base_url('assets/home/images/img_2.jpg') ?>" alt="Free website template by Free-Template.co" class="img-fluid"></div>
                    <div><img src="<?= base_url('assets/home/images/img_3.jpg') ?>" alt="Free website template by Free-Template.co" class="img-fluid"></div>
                </div>
          </div>

          <div class="col-lg-6 ml-auto">
            <h2 class="section-title mb-3">Warehouse Real Estate Template</h2>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <p>Est qui eos quasi ratione nostrum excepturi id recusandae fugit omnis ullam pariatur itaque nisi voluptas impedit  Quo suscipit omnis iste velit maxime.</p>

                <ul class="list-unstyled ul-check success">
                  <li>Placeat maxime animi minus</li>
                  <li>Dolore qui placeat maxime</li>
                  <li>Consectetur adipisicing</li>
                  <li>Lorem ipsum dolor</li>
                  <li>Placeat molestias animi</li>
                </ul>

                <p><a href="#" class="btn btn-primary mr-2 mb-2">Learn More</a></p>
            
          </div>
        </div>
      </div>
    </section>

    

    <section class="site-section bg-light" id="services-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Services</h2>
          </div>
        </div>
        <div class="row align-items-stretch">
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-house"></span></div>
              <div>
                <h3>Find Property</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-coin"></span></div>
              <div>
                <h3>Buy Property</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-home"></span></div>
              <div>
                <h3>Beautiful Home</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>


          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-flat"></span></div>
              <div>
                <h3>Buildings &amp; Lands</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-location"></span></div>
              <div>
                <h3>Property Locator</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 mb-4 mb-lg-4" data-aos="fade-up" data-aos-delay="500">
            <div class="unit-4 d-flex">
              <div class="unit-4-icon mr-4"><span class="text-primary flaticon-mobile-phone"></span></div>
              <div>
                <h3>Mobile Apps</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis quis molestiae vitae eligendi at.</p>
                <p><a href="#">Learn More</a></p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="site-section testimonial-wrap" id="testimonials-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Testimonials<h2>
          </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="ftco-testimonial-1">
                  <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                    <img src="assets/home/images/person_1.jpg" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                    <div>
                      <h3>Allison Holmes</h3>
                      <span>Customer</span>
                    </div>
                  </div>
                  <div>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6 mb-4">
                  <div class="ftco-testimonial-1">
                      <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                        <img src="assets/home/images/person_2.jpg" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                        <div>
                          <h3>James Phelps</h3>
                          <span>Customer</span>
                        </div>
                      </div>
                      <div>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                      </div>
                    </div>
              </div> 

              <div class="col-md-6 mb-4">
                  <div class="ftco-testimonial-1">
                    <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                      <img src="assets/home/images/person_3.jpg" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                      <div>
                        <h3>Nestor Helsin</h3>
                        <span>Customer</span>
                      </div>
                    </div>
                    <div>
                      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="ftco-testimonial-1">
                        <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
                          <img src="assets/home/images/person_1.jpg" alt="Free website template by Free-Template.co" class="img-fluid mr-3">
                          <div>
                            <h3>Allison Holmes</h3>
                            <span>Customer</span>
                          </div>
                        </div>
                        <div>
                          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
                        </div>
                      </div>
                </div> 
        </div>
      </div>
    </section>

    
    <section class="site-section bg-light bg-image" id="contact-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h2 class="section-title mb-3">Kontak Kami</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-7 mb-5">

            

            <form action="#" class="p-5 bg-white">
              
              <h2 class="h4 text-black mb-5">Get In Touch</h2> 

              <div class="row form-group">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">First Name</label>
                  <input type="text" id="fname" class="form-control">
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">Last Name</label>
                  <input type="text" id="lname" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="email" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Subject</label> 
                  <input type="subject" id="subject" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Message</label> 
                  <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white">
                </div>
              </div>

  
            </form>
          </div>
          <div class="col-md-5">
            
            <div class="p-4 mb-3 bg-white">
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">203 Fake St. Mountain View, San Francisco, California, USA</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+1 232 3235 324</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#">youremail@domain.com</a></p>

            </div>
            
          </div>
        </div>
      </div>
    </section>

    
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