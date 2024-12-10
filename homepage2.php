<?php
    
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'banking';
$db = new mysqli($host, $user, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

    $slides = $db->query("SELECT * FROM homepage ORDER BY slide_order ASC");

    /*$settings = [
        'header_color' => '#f9d4d4', // Default color or fetched color
        'logo_image' => 'luxura-nav.png' // Default logo or fetched logo file
    ];

    $settings = $db->query("SELECT * FROM nav_hp WHERE id = 1");*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Luxura Bank</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">


  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

 
  <link href="img/favicon.ico" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">


  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">


  <link href="img/style.css" rel="stylesheet">

 
</head>

<body>

<form action="homepage2.php" method = "POST">


    <div class="slideshow-container">
        <?php 
        $slideCount = 1; // Counter for slides
        foreach ($slides as $slide): 
        ?>
            <div class="mySlides">
                <div class="numbertext"><?= $slideCount ?> / <?= $slides->num_rows ?></div>
                <img src="<?= htmlspecialchars($slide['slide_image']) ?>" style="width:1200px">
                    <div class="overlay-content">
                    <h5 class="text-white text-uppercase mb-6 animated slideInDown">Welcome To Luxura</h5>
                    <h1>Best Carpenter & Craftsman Services</h1>
                    <p>Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                    <a href="" class="btn">Read More</a>
                    <a href="" class="btn">Free Quote</a>
                </div>
            </div>
        <?php 
            $slideCount++; 
        endforeach; 
        ?>
        
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
    </div>

    <style>
      /* General Slideshow Container */


/* Overlay Content */
.overlay-content {
  position: absolute;
  top: 50%;
  left: 60%;
  transform: translate(-50%, -50%);
  color: white;
  text-align: center;
  z-index: 2;
  background-color:rgba(212, 190, 228, 0.5);/* Semi-transparent background */
  padding: 40px; /* Increase padding for a larger area */
  border-radius: 8px;
  width: 90%; /* Set width to occupy more space */
  max-width: 1200px; /* Limit the maximum size for larger screens */
  box-sizing: border-box;
  /*height: 90%*/
}

/* Overlay Text Styling */
.overlay-content h1 {
 
  font-size: 36px;
  margin-bottom: 15px;
}

.overlay-content p {
  font-size: 16px;
  margin-bottom: 20px;
}

.overlay-content .btn {
  display: inline-block;
  padding: 10px 20px;
  margin: 5px;
  font-size: 14px;
  color: white;
  background-color: #D4BEE4;
  text-decoration: none;
  border-radius: 4px;
}

.overlay-content .btn:hover {
  background-color: #0056b3;
}

/* Slideshow Navigation Buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 3px;
  user-select: none;
  background-color: rgba(212, 190, 228, 0.5);;
}

.prev {
  left: 0;
}

.next {
  right: -190px;;
}

.prev:hover, .next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number Text (Optional) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  position: absolute;
  top: 8px;
  right: 16px;
}

    </style>
    
    <br>

    <!-- Dots for each slide -->
    <div style="text-align:center">
        <?php for ($i = 1; $i <= $slides->num_rows; $i++): ?>
            <span class="dot" onclick="currentSlide(<?= $i ?>)"></span> 
        <?php endfor; ?>
    </div>





<header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="index.html"><img src="img/luxura-nav.png" alt="" title="" /></img></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Bell</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Portfolio</a></li>
          <!--<li><a href="#team">Team</a></li>-->
          <li class="menu-has-children"><a href="">Accounts</a>
            <ul>
              <li><a href="#">Savings Account</a></li>

              <li><a href="#">Current Acount</a>
              
               <!--<ul>
                  <li><a href="signup-user.php">Personal</a></li>
                  <li><a href="#">Regular</a></li>
                 
                </ul>-->
              </li>
              <li><a href="#">Retirement Acount</a>
              <li><a href="#">Fixed Deposit Acount</a>
              <li><a href="#">Recurring Deposit Acount</a>
              <li><a href="#">Apply Loan/Credit</a></li>
             
            </ul>
          </li>
          <li><a href="contact.php">Contact Us</a></li>
          <li>
              <a href="login-user.php">Login</a></li>
        </ul>
      </nav>

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-instagram"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
      </nav>
    </div>
        </header>

   
 






  <section class="about" id="about">
    <div class="container text-center">
      <h2>
          About Luxura Bank
        </h2>

      <p>
      Luxura Bank is a premium financial institution focused on delivering high-end, personalized banking experiences. Known for secure digital solutions, it offers services like private banking, wealth management, and exclusive credit options. Luxura Bank caters to affluent clients with benefits such as dedicated advisors and luxury partnerships, blending convenience, privacy, and exclusivity for those who value a refined banking experience.
      </p>

      <div class="row stats-row">
        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">1,890</span> Satisfied Customers
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">79</span> Charities
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">2,463</span> Number of Investors
          </div>
        </div>

        <div class="stats-col text-center col-md-3 col-sm-6">
          <div class="circle">
            <span class="stats-no" data-toggle="counter-up">15</span> Hard Workers
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="block bg-primary block-pd-lg block-bg-overlay text-center" data-bg-img="img/parallax-bg5.jpeg" data-settings='{"stellar-background-ratio": 0.6}' data-toggle="parallax-bg">
    <h2>
        Welcome to a perfect theme
      </h2>

    <p>
      This is the most powerful theme with thousands of options that you have never seen before.
    </p>
    <img alt="Bell - A perfect theme" class="gadgets-img hidden-md-down" src="4parallax1.png">
  </div>

  <section class="features" id="features">
    <div class="container">
      <h2 class="text-center">
          Services
        </h2>
      
    

    <div class="ser-container">
       
        <div class="services-grid">
            <div class="service-card">
                <img src="img/slide9.jpg" alt="General Carpentry" class="service-image">
                <div class="service-content">
                    <h2 class="service-title">Seamless Transaction</h2>
                    <p class="service-description">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
            </div>
            <div class="service-card">
                <img src="img/slide12.jpg"  alt="Furniture Manufacturing" class="service-image">
                <div class="service-content">
                    <h2 class="service-title">Redeem Points</h2>
                    <p class="service-description">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
            </div>
            <div class="service-card">
                <img src="img/slide8.jpg" alt="Furniture Remodeling" class="service-image">
                <div class="service-content">
                    <h2 class="service-title">Secured Future</h2>
                    <p class="service-description">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
            </div>
            <div class="service-card">
                <img src="img/slide10.jpg" alt="Wooden Floor" class="service-image">
                <div class="service-content">
                    <h2 class="service-title">Wooden Floor</h2>
                    <p class="service-description">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
            </div>
            <div class="service-card">
                <img src="img/slide1.jpg" alt="Wooden Furniture" class="service-image">
                <div class="service-content">
                    <h2 class="service-title">Wooden Furniture</h2>
                    <p class="service-description">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
            </div>
            <div class="service-card">
                <img src="img/slide5.jpg" alt="Custom Work" class="service-image">
                <div class="service-content">
                    <h2 class="service-title">Custom Work</h2>
                    <p class="service-description">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
            </div>
        </div>
    </div>

      
  </section>
  <section class="portfolio" id="portfolio">
    <div class="container text-center">
      <h2>
          Portfolio
        </h2>

      <p>
        Voluptua scripserit per ad, laudem viderer sit ex. Ex alia corrumpit voluptatibus usu, sed unum convenire id. Ut cum nisl moderatius, Per nihil dicant commodo an.
      </p>
    </div>

    <div class="portfolio-grid">
      <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-1.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-2.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-3.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-4.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-5.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-6.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-7.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
          <div class="card card-block">
            <a href="#"><img alt="" src="img/porf-8.jpg">
              <div class="portfolio-over">
                <div>
                  <h3 class="card-title">
                    The Dude Rockin'
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
                  </p>
                </div>
              </div></a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="section-title">Contact Us</h2>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-3 col-md-4">
          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>A108 Adam Street<br>New York, NY 535022</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>info@example.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>+1 5589 55488 55s</p>
            </div>

          </div>
        </div>

        <div class="col-lg-5 col-md-8">
          <div class="form">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
              
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="bottom">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-xs-12 text-lg-left text-center">
            <p class="copyright-text">
              © LUXURA Bank
            </p>
            <div class="credits">
             Designed by <a href="#home">LuxuraBank</a>
            </div>
          </div>

          <div class="col-lg-6 col-xs-12 text-lg-right text-center">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="index.html">Home</a>
              </li>

              <li class="list-inline-item">
                <a href="#about">About Us</a>
              </li>

              <li class="list-inline-item">
                <a href="#features">Features</a>
              </li>

              <li class="list-inline-item">
                <a href="#portfolio">Portfolio</a>
              </li>

              <li class="list-inline-item">
                <a href="#contact">Contact</a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </footer>
</form>
  <a class="scrolltop" href="#"><span class="fa fa-angle-up"></span></a>
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/tether/js/tether.min.js"></script>
  <script src="lib/stellar/stellar.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/easing/easing.js"></script>
  <script src="lib/stickyjs/sticky.js"></script>
  <script src="lib/parallax/parallax.js"></script>
  <script src="lib/lockfixed/lockfixed.min.js"></script>
  <script src="js/custom.js"></script>

  <script src="contactform/contactform.js"></script>
  <script src="js/slideshow.js"></script>


</body>
</html>



</form>