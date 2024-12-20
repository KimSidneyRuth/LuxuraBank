<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Luxura Bank</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700|Roboto:400,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Bell
    Theme URL: https://bootstrapmade.com/bell-free-bootstrap-4-template/
    Author: BootstrapMade.com
    Author URL: https://bootstrapmade.com
  ======================================================= -->
</head>

<body>
  <!-- Page Content
    ================================================== -->
<form action="homepage.php" method = "POST">
  <!-- Hero -->

  <!--<section class="hero">
   <div class="container text-center">
      <div class="row">
        <div class="col-md-12">
          <a class="hero-brand" href="homepage.html" title="Home"><img alt="Bell Logo" src="img/white.png"></a>
        </div>
      </div>

      <div class="col-md-12">
        <h1>
            A theme with personality
          </h1>

        <p class="tagline">
          This is a powerful theme with some great features that you can use in your future projects.
        </p>
        <a class="btn btn-full" href="#about">Get Started Now</a>
      </div>
    </div>-->

  

  <div class="slideshow-container">
    

    <div class="mySlides">
      <div class="numbertext">1 / 3</div>
      <img src="img/slide1.jpg" style="width:1200px">
    
    </div>
    
    <div class="mySlides">
      <div class="numbertext">2 / 6</div>
      <img src="img/slide10.jpg" style="width:1200px">
      
    </div>
    
    <div class="mySlides">
      <div class="numbertext">3 / 6</div>
      <img src="img/slide9.jpg" style="width: 1200px">
      
    </div>
    <div class="mySlides">
      <div class="numbertext">4 / 6</div>
      <img src="img/slide5.jpg" style="width: 1200px">
      
    </div>
    <div class="mySlides">
      <div class="numbertext">5 / 6</div>
      <img src="img/slide7.jpg" style="width: 1200px">
      
    </div>
    <div class="mySlides">
      <div class="numbertext">6 / 6</div>
      <img src="img/slide8.jpg" style="width: 1200px">
      
    </div>
    
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>
    
    </div>
    <br>
    
    <div style="text-align:center">
      <span class="dot" onclick="currentSlide(1)"></span> 
      <span class="dot" onclick="currentSlide(2)"></span> 
      <span class="dot" onclick="currentSlide(3)"></span> 
    </div>
   
  
  <!-- /Hero -->

  <!-- Header -->
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
              <li><a href="#">Checking Account</a></li>

              <li class="menu-has-children"><a href="#">Savings Acount</a>
              
                <ul>
                  <li><a href="signup-user.php">Personal</a></li>
                  <li><a href="#">Regular</a></li>
                  <!--<li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>-->
                </ul>
              </li>
              <li><a href="#">Apply Loan/Credit</a></li>
              <!--<li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>-->
            </ul>
          </li>
          <li><a href="#contact">Contact Us</a></li>
          <li>
              <a href="login-user.php">Login</a></li>
        </ul>
      </nav>
      <!-- #nav-menu-container -->

      <nav class="nav social-nav pull-right d-none d-lg-inline">
        <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-instagram"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
      </nav>
    </div>
  </header>
  <!-- #header -->

  <!-- About -->

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
  <!-- /About -->
  <!-- Parallax -->

  <div class="block bg-primary block-pd-lg block-bg-overlay text-center" data-bg-img="img/parallax-bg5.jpeg" data-settings='{"stellar-background-ratio": 0.6}' data-toggle="parallax-bg">
    <h2>
        Welcome to a perfect theme
      </h2>

    <p>
      This is the most powerful theme with thousands of options that you have never seen before.
    </p>
    <img alt="Bell - A perfect theme" class="gadgets-img hidden-md-down" src="4parallax1.png">
  </div>
  <!-- /Parallax -->
  <!-- Features -->

  <section class="features" id="features">
    <div class="container">
      <h2 class="text-center">
          Services
        </h2>

      <div class="row">
        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fas fa-hand-holding-usd"></span>

              </div>
            </div>

            <div>
              <h3>
                  Transfer
                </h3>

              <p>
                Easily transfer funds between accounts or to others securely and in real time.
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fas fa-coins"></span> <span class="fas fa-arrow-down"></span>
              </div>
            </div>

            <div>
              <h3>
                 Deposit
                </h3>

              <p>
                Deposit funds into your account quickly and securely to increase your balance and meet your financial goals
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fas fa-wallet"></span>


              </div>
            </div>

            <div>
              <h3>
                  Withdraw
                </h3>

              <p>
                Withdraw funds from your account instantly, whether through ATM, branch, or online banking.
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fas fa-arrow-down"></span> <span class="fas fa-piggy-bank"></span>

              </div>
            </div>

            <div>
              <h3>
                  Save
                </h3>

              <p>
                Save money effortlessly with our secure accounts, designed to help you grow your savings over time.
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fas fa-credit-card"></span>
              </div>
            </div>

            <div>
              <h3>
                  Loans
                </h3>

              <p>
                Get the funds you need with flexible loan options, competitive rates, and a simple application process.
              </p>
            </div>
          </div>
        </div>

        <div class="feature-col col-lg-4 col-xs-12">
          <div class="card card-block text-center">
            <div>
              <div class="feature-icon">
                <span class="fas fa-gift"></span>

              </div>
            </div>

            <div>
              <h3>
                 Earn Points
                </h3>

              <p>
                Earn points on every transaction and redeem them for rewards, discounts, and exclusive offers.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Features -->
  <!-- Call to Action -->

 <!--<section class="cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-sm-12 text-lg-left text-center">
          <h2>
              Call to Action Section
            </h2>

          <p>
            Lorem ipsum dolor sit amet, nec ad nisl mandamus imperdiet, ut corpora cotidieque cum. Et brute iracundia his, est eu idque dictas gubergren
          </p>
        </div>

        <div class="col-lg-3 col-sm-12 text-lg-right text-center">
          <a class="btn btn-ghost" href="#">Buy This Theme</a>
        </div>
      </div>
    </div>
  </section>
  </Call to Action -->
  <!-- Portfolio -->

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
  <!-- /Portfolio -->
  <!-- Team -->

 <!--<section class="team" id="team">
    <div class="container">
      <h2 class="text-center">
          Meet our team
        </h2>

      <div class="row">
        <div class="col-sm-3 col-xs-6">
          <div class="card card-block">
            <a href="#"><img alt="" class="team-img" src="img/team-1.jpg">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
            </nav>

            <p>
              Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
            </p>
          </div>
          </a>
        </div>
      </div>

      <div class="col-sm-3 col-xs-6">
        <div class="card card-block">
          <a href="#"><img alt="" class="team-img" src="img/team-2.jpg">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
          </nav>

          <p>
            Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
          </p>
        </div>
        </a>
      </div>
    </div>

    <div class="col-sm-3 col-xs-6">
      <div class="card card-block">
        <a href="#"><img alt="" class="team-img" src="img/team-3.jpg">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
        </nav>

        <p>
          Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
        </p>
      </div>
      </a>
    </div>
    </div>

    <div class="col-sm-3 col-xs-6">
      <div class="card card-block">
        <a href="#"><img alt="" class="team-img" src="img/team-4.jpg">
              <div class="card-title-wrap">
                <span class="card-title">Sergio Fez</span> <span class="card-text">Art Director</span>
              </div>

              <div class="team-over">
                <h4 class="hidden-md-down">
                  Connect with me
                </h4>

                <nav class="social-nav">
                  <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-linkedin"></i></a> <a href="#"><i class="fa fa-envelope"></i></a>
        </nav>

        <p>
          Lorem ipsum dolor sit amet, eu sed suas eruditi honestatis.
        </p>
      </div>
      </a>
    </div>
    </div>
    </div>
    </div>
  </section>
  <!-- /Team -->
  <!-- @component: footer -->

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
              <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Bell
              -->
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

              <!--<li class="list-inline-item">
                <a href="#team">Team</a>
              </li>-->

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


  <!-- Required JavaScript Libraries -->
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

  <!-- Template Specisifc Custom Javascript File -->
  <script src="js/custom.js"></script>

  <script src="contactform/contactform.js"></script>
  <script src="js/slideshow.js"></script>


</body>
</html>
