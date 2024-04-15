<?php include 'session.php'; ?>
<?php
  if (!isset($_SESSION['customer'])) {
    header('location: http://localhost/gleetech/home');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>GLEE Tech Solutions Provider Co.</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="assets/css/variables.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

 <body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top" data-scrollto-offset="0" style="background-color:#1a2226;">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <div class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/icon.png">
        <h1 style="font-size:30px;margin-top:5px;color: whitesmoke;">GLEE Tech</h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.html" style="color:whitesmoke;">Home</a></li>
          <li><a class="nav-link scrollto" href="index.html#about" style="color:whitesmoke;">About</a></li>
          <li><a class="nav-link scrollto" href="index.html#services" style="color:whitesmoke;">Services</a></li>
          <li><a class="nav-link scrollto" href="index.html#contact" style="color:whitesmoke;">Contact Us</a></li>
          <li><a class="nav-link scrollto" href="../service_request" style="color:whitesmoke;">My Service Request</a></li>
          <li><a class="nav-link scrollto" href="signout" style="color:whitesmoke;">Sign-Out</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->

      <a class="btn-getstarted scrollto" href="index.html#about">Get Started</a>

    </div>
  </header><!-- End Header -->
  <?php
    if(isset($_SESSION['error'])){
      echo
      "<section id='error_alert'>
        <div class='alert alert-danger alert-dismissible container d-flex flex-column position-relative' style='margin-top:30px;'>  
                  <h4><i class='icon fa fa-warning'></i> Error</h4>
                   ".$_SESSION['error']."
                   <div style='text-align: right;'><button onclick='closedErrorPrompt();' class='btn btn-danger'>Close</button></div>
        </div>
      </section>";
       unset($_SESSION['error']);
    }
     if(isset($_SESSION['success'])){
      echo
      "<section  id='success_alert'>
        <div class='alert alert-success alert-dismissible container d-flex flex-column position-relative' style='margin-top:30px;'>          
                  <h4><i class='icon fa fa-warning'></i> Success</h4>
                   ".$_SESSION['success']."
                   <div style='text-align: right;'><button onclick='closedSuccessPrompt();' class='btn btn-success'>Close</button></div>
        </div>
      </section>";
       unset($_SESSION['success']);
    }
  ?>

  <section id="hero-animated" class="hero-animated d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
      <img src="assets/img/home-img.png" class="img-fluid animated">
      <h2>Welcome to <span>GLEE Tech Solutions Provider Co.</span></h2>
      <p>"Trust the Experts in Installation and Repair Services"</p>
    </div>
  </section>

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <p>At GLEE Tech, we specialize in providing reliable and professional services for CCTV Installation and Repair, Solar Power Installation, Computer, Printer and TV Repair Services. With years of experience in the industry, we have established ourselves as a trusted provider of technology solutions for both residential and commercial clients.</p>
          <br>
          <p>Our team of skilled technicians delivers reliable, efficient services tailored to your needs. We stay up-to-date with the latest advancements to offer you innovative solutions that ensure security, energy efficiency, and seamless technology integration.</p>
          <br>
          <p>Customer satisfaction is our priority. From initial consultation to installation, maintenance, and support, our friendly staff is here for you.</p>
        </div>

        <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-5">
            <div class="about-img">
              <img src="assets/img/about_us.png" class="img-fluid" alt="">
            </div>
          </div>

          <div class="col-lg-7">
            <h3 class="pt-0 pt-lg-5">Why choose us?</h3>

            <p><b>Expertise:</b> Our team consists of trained technicians with extensive experience in their respective fields.</p>
            <br>
            <p><b>Quality Products:</b> We partner with reputable manufacturers and suppliers to ensure that we provide you with the best quality products available. We believe in using reliable and durable equipment that delivers optimal performance.</p>
            <br>
            <p><b>Customized Solutions:</b> We understand that every client has unique requirements. That's why we offer personalized solutions tailored to meet your specific needs and budget. We work closely with you to design and implement the ideal system for your property or business.</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Services</h2>
          <p>We offers services from installation to repair services</p>
        </div>

        <div class="row gy-5">
          <!--computer repair and setup-->
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="service-item">
              <div class="img">
                <img src="assets/img/computer_repair.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-pc-display"></i>
                </div>
                <h3>Computer Repair and Setup</h3>
                <p><b>Repair:</b> diagnosing hardware issues, troubleshooting software problems, virus and malware removal, data recovery, hardware upgrades, </p>
                <br>
                <p><b>Setup:</b> hardware assembly, operating system installation, driver installation, software installation, network setup, user accounts and settings, system updates and security.</p>
                <br>
                <p></p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <!--cctv installation and setup-->
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                <img src="assets/img/cctv.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-webcam-fill"></i>
                </div>
                <h3>CCTV Installation and Repair</h3>
                <p><b>Installation:</b> planning and site survey, camera selection and placement, wiring and connectivity, recording device setup, power supply and surge protection, monitoring and remote access, testing and configuration, warranty.</p>
                <br>
                <p><b>Repair:</b> camera repair, recording device repair, cabling and connectivity, power supply, system configuration and software, professional assistance, regular maintenance.</p>               
              </div>
            </div>
          </div><!-- End Service Item -->

          <!--laptop board level repair-->
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="service-item">
              <div class="img">
                <img src="assets/img/motherboard.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-motherboard"></i>
                </div>
                <h3>Laptop Board Level Repair</h3>
                <p>Also known as component-level repair or motherboard repair, involves diagnosing and fixing issues at the electronic component level on a laptop's motherboard. Board level repair focuses on identifying and replacing faulty or damaged individual components, such as capacitors, resistors, integrated circuits (ICs), or connectors.</p>
              </div>
            </div>
          </div><!-- End Service Item -->

          <!--solar power installation-->
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="700">
            <div class="service-item">
              <div class="img">
                <img src="assets/img/solar_power.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-columns-gap"></i>
                </div>
                <h3>Solar Power Installation</h3>
                <p><b>Inclusions</b> site assessment and planning, solar panel installation, inverter installation, electrical connections and safety measures, system testing and commissioning, warranty.</p>               
              </div>
            </div>
          </div><!-- End Service Item -->

          <!--LCD/LED/Plasma TV repair-->
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="service-item">
              <div class="img">
                <img src="assets/img/tv.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-tv"></i>
                </div>
                <h3>LCD/LED/Plasma TV Repair</h3>
                <p><b>Repair:</b> no power or power cycling, no display or distorted image, sound issues, connectivity problems, remote control or button mulfunctions, other TV related problems.</p> </div>
            </div>
          </div><!-- End Service Item -->

          <!--printer repair-->
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                <img src="assets/img/printer.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <i class="bi bi-printer"></i>
                </div>
                <h3>Printer Repair</h3>
                <p><b>Repair:</b> paper jams, print quality problems, connectivity problems, error messages, slow printing or no response.</p>
              </div>
            </div>
          </div><!-- End Service Item -->
        </div>
      </div>
    </section><!-- End Services Section -->

    <!-- ======= Contact Us Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Contact us today to discuss your requirements and let us be your trusted partner in fulfilling your service needs. We look forward to serving you!</p>
        </div>

      </div>

      <div class="map"> 
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3255.0364322749047!2d121.59140908348674!3d14.02320162726742!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd4dea9680fcff%3A0x161351f5d22183c4!2sGLEE%20TECH%20SOLUTIONS%20PROVIDER%20CO.!5e0!3m2!1sen!2sph!4v1686237538716!5m2!1sen!2sph" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Google Maps -->

      <div class="container">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            <div class="info">
              <h3>Get in touch</h3>
              
              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>56 Luis Palad cor. C.M. Recto St., Tayabas City, 4327 Quezon</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>contact-us@gleetechsolutionsproviderco.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+639338154244</p>
                </div>
              </div><!-- End Info Item -->

             <div class="info-item d-flex">
                <i class="bi bi-clock flex-shrink-0"></i>
                <div>
                  <h4>Opening Hours:</h4>
                  <p>Monday - Saturday</p>
                  <p>9:00 AM - 6:00 PM</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-8">
            <form id="contact_submit_form" method="post" action="contact.php" role="form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" maxlength="50" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email_add" id="email_add" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="number" class="form-control" name="phone" id="phone" data-maxlength="11" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" placeholder="Contact No." required>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" id="message"placeholder="Message" rows="10" required></textarea>
              </div>
              <div class="form-group mt-3" style="text-align: right;">
                <input type="submit" name="send" id="send" value="Send" class="btn btn-info" style="color:white;" ></input>
              </div>    
            </form>        

           <div id="results">
           <!-- All data will display here  -->
           </div>

          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-legal text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div class="copyright">
            &copy; Copyright <strong><span>GLEE Tech Solutions Provider Co.</span></strong>. All Rights Reserved
          </div>
        </div>

        <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
          <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
          <a href="https://www.facebook.com/GleeTechSolutions/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>      
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

<script type="text/javascript">
    $(function(){
      $('#contact_submit_form').submit(function(e){
        e.preventDefault();
          $.ajax({
            type:"POST",
            url: "contact.php",
            data: $(this).serialize(),
            success: function(data){
            }
          }); 
      });    
    });

    function closedErrorPrompt()
    {
      document.getElementById("error_alert").hidden=true;
    }

    function closedSuccessPrompt()
    {
      document.getElementById("success_alert").hidden=true;
    }

</script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>