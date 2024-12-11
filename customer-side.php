<?php
include "connection.php";
include 'website_background.php';
include 'website_logo.php';

session_start();


if (!isset($_SESSION['firstName'])) {
    // Redirect to login page if the user is not logged in
 
    header('location: login-user.php');
    exit();
}
$_SESSION['accountType'] = $_SESSION['accountType'];
$_SESSION['account_no'] = $_SESSION['account_no'];



// Get the user's name from the session
$userName = $_SESSION['firstName'];
$userId = $_SESSION['userId']; // User ID from the session
$status = $_SESSION['verification_status'];
$acctype = $_SESSION['accountType'];
$acc_no = $_SESSION['account_no'];
$mname = $_SESSION['middleName'];
$lname = $_SESSION['lastName'];
 // User name from the session

// Fetch user details, including the image
$query = "SELECT image FROM user WHERE userId = '$userId'";
$result = mysqli_query($con, $query) or die('Query failed');
$userData = mysqli_fetch_assoc($result);

// Set a default image if no profile image exists
$userImage = $userData['image'] ? 'uploaded_img/' . $userData['image'] : 'default_user.png';

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



    include 'website_color.php';
?>

<style>
 .sidebar{
    position: fixed;
    top:0;
    
 }

 

</style>


<html lang="en" dir="ltr" >
  <head>
    <meta charset="UTF-8" />
    <title> Customer Dashboard | Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
  
    <link rel="stylesheet" href="dropdown.css">
   

    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="customer-side.php" method = "POST"></form>
    <div class="sidebar">
      <div class="logo-details">
       
        <!--<span class="logo_name"><div id="kim" style="text-align: center; margin-bottom: 20px; margin-top:10px">
                 <img src=" lux-nav.png" alt="" style="width: 170px;">
                        </div></span>-->
                        <span>
                        <?php
    // Check if the logo image path is available
    if (isset($logoImagePath) && !empty($logoImagePath)) {
      echo '<img src="' . $logoImagePath . '" alt="Logo" id="logo" style="text-align: center; margin-bottom: 20px; margin-top:10px; width: 170px;"  >';
  } else {
      echo '<p>No logo image found.</p>';
  }
  ?>
                        </span>
      </div>
      
      <ul class="nav-links">
        <li>
          <a href="customer-side.php" class = "active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name" style="color: <?php echo FONT_COLOR; ?>">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span class="links_name" style="color: <?php echo FONT_COLOR; ?>" >Open Account</span>
          </a>
        </li>
        <li>
          <a href="customer-send.php">
            <i class="bx bx-list-ul"></i>
            <span class="links_name" 
            style="color: <?php echo FONT_COLOR; ?>">Transfer</span>
          </a>
        </li>
        <li>
          <a href="customer-side.php">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name"  style="color: <?php echo FONT_COLOR; ?>">Transaction</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name"  style="color: <?php echo FONT_COLOR; ?>">Pay</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-book-alt"></i>
            <span class="links_name"  style="color: <?php echo FONT_COLOR; ?>">Apply Loan</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-gift"></i>
            <span class="links_name"  style="color: <?php echo FONT_COLOR; ?>">Points</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-message"></i>
            <span class="links_name"  style="color: <?php echo FONT_COLOR; ?>">Interest</span>
          </a>
        </li>
        <!--<li>
          <a href="#">
            <i class="bx bx-heart"></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li>-->
        <li>
          <a href="acc-settingsProfile.php">
            <i class="bx bx-cog"></i>
            <span class="links_name"  style="color: <?php echo FONT_COLOR; ?>">Account Settings</span>
          </a>
        </li>
        
        
      </ul>
    </div>
    <section class="home-section" >
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard"  style="color: <?php echo FONT_COLOR; ?>" >Home</span>
        </div>
        <div class="searh-box">
          
          <!--<img src="img/luxura-nav.png" alt="">-->
          <?php
    // Check if the logo image path is available
    if (isset($logoImagePath) && !empty($logoImagePath)) {
      echo '<img src="' . $logoImagePath . '" alt="Logo" id="logo" >';
  } else {
      echo '<p>No logo image found.</p>';
  }
  ?>
        </div>

        <!--<div class="search-box">
          <input type="text" placeholder="Search..." />
          <i class="bx bx-search"></i>
        </div>
        
        <!--<div class="profile-details">
          <img src="default_user.png" alt="" />
          <span class="admin_name"><?php echo htmlspecialchars($userName); ?></span>
          <i class="bx bx-chevron-down"></i>
        
        </div> -->
        <div class="profile-dropdown" >
        <div onclick="toggle()" class="profile-dropdown-btn">
            <div class="profile-img">
            <img src="<?php echo htmlspecialchars($userImage); ?>" alt="Profile Image">
        </div>

          <span
            ><?php echo htmlspecialchars($userName); ?>
            <i class="fa-solid fa-angle-down"></i>
          </span>
        </div>

        <ul class="profile-dropdown-list">
          
      
        <li class="profile-dropdown-list-item">
            <a href="acc-settingsProfile.php">
            <div class="profile-img">
            <img src="<?php echo htmlspecialchars($userImage); ?>" alt="Profile Image">
        </div>
            <span> <?php echo htmlspecialchars($userName); ?></span>
            </a>
            <span class = "status"><?php echo htmlspecialchars($status); ?></span>
          </li>

          <li class="profile-dropdown-list-item">
            <a href="acc-settingsProfile.php"  style="color: <?php echo FONT_COLOR; ?>">
              <i class="fa-regular fa-user"></i>
              User Profile
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="#"  style="color: <?php echo FONT_COLOR; ?>">
              <i class="fa-solid fa-bell"></i>
              Notifications
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="acc-editProf.php"  style="color: <?php echo FONT_COLOR; ?>">
            <i class="fa fa-pen fa-xs edit"></i>
              Update Profile
            </a>
          </li>
          
          <li class="profile-dropdown-list-item">
            <a href="#"  style="color: <?php echo FONT_COLOR; ?>">
              <i class="fa-solid fa-sliders"></i>
              Settings
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="#" style="color: <?php echo FONT_COLOR; ?>">
              <i class="fa-solid fa-lock"  ></i>
              Lock Account
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="logout-user.php"  style="color: <?php echo FONT_COLOR; ?>">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              Log out
            </a>
          </li>
</ul>

     


    
      </nav>
         

      <div class="offers-slideshow">
    <h2  style="color: <?php echo FONT_COLOR; ?>">Exclusive Offers</h2>
    <div class="slideshow-container">
        <?php 
        $slideCount = 1; // Counter for slides
        foreach ($slides as $slide): 
        ?>
        <div class="mySlides">
            <div class="numbertext"><?= $slideCount ?> / <?= $slides->num_rows ?></div>
            <img src="<?= htmlspecialchars($slide['slide_image']) ?>" style="width:1200px">
            <div class="offer-slide">
                <!-- Add any additional content for the slide re -->
            </div>
        </div>
        <?php 
            $slideCount++; 
        endforeach; 
        ?>
    </div>

    <!-- Navigation Dots -->
    <div style="text-align:center">
        <?php for ($i = 1; $i <= $slides->num_rows; $i++): ?>
        <span class="dot" onclick="currentSlide(<?= $i ?>)"></span>
        <?php endfor; ?>
    </div>
</div>

<style>
  .offers-slideshow{
    margin-top: 50px;
  }
  .mySlides {
    margin-top:
     50px;
  display: none;
  margin-left: 50px;

}

.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  position: absolute;
  top: 8px;
  left: 16px;
}

.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active1, .dot:hover {
  background-color: #717171;
}

</style>
      <div class="custdashboard">
       
        <main class="content" >
            <div class="top-section">
                <div class="balance-card">
                    <div class="account-info">
                        <p class="label" ><?php echo htmlspecialchars($acctype); ?> </p>
                        <h3 class="holder-name"> <?php echo htmlspecialchars($userName . ' ' . $mname . ' ' . $lname); ?></h3>
                        <p class="account-number"><?php echo htmlspecialchars($acc_no); ?></p>
                        <button class="more-btn">More</button>
                    </div>
                    <div class="balance-info">
                        <h1 class="amount">00000.00</h1>
                    </div>
                </div>

                <div class="promo-card">
                    <div class="promo-content">
                        <h3>Get instant credit of funds anytime, anywhere.</h3>
                        <p>With 24/7 instant loan transfer, instant and simple</p>
                        <button class="apply-btn">Apply Now</button>
                    </div>
                    <div class="promo-image">
                        <img src="promoo.png" alt="Promotional illustration" class= "img-responsive">
                    </div>
                    <style>
                    .img-responsive{
                    max-width: 100%;
                    height: auto;
                    display: block;
                  }
                      button:hover {
                      background-color: #F3B75B;
                      color: #fff;
                    }

                    </style>
                </div>
            </div>

            <div class="announcements-section">
                <h2>Announcements</h2>
                <ul class="announcements-list">
                    <li>System maintenance on 10th Dec, 2:00 AM to 4:00 AM.</li>
                    <li>New feature: Easy EMI payments available now!</li>
                    <li>Visit our nearest branch for festive loan offers.</li>
                </ul>
            </div>

            <div class="quick-actions">
                <button class="action-btn">
                
                    <img src="img/dollar-bag-euro-on-hand-svgrepo-com.svg" alt="Transfer">
                    <span>Fund Transfer</span>
                </button>
                <button class="action-btn">
                    <img src="img/gift.svg" alt="Bills">
                    <span>Earn Points</span>
                </button>
                <button class="action-btn">
                    <img src="img/coin-stack-money-svgrepo-com.svg" alt="Deposit">
                    <span>View Interest</span>
                </button>
                <button class="action-btn">
                    <img src="img/cc.svg" alt="Credit Card">
                    <span>Pay Credit Card Bill</span>
                </button>
            </div>
            <style>
                .action-btn img {
                width: 50px; /* Set icon size */
                height: 50px;
                filter: grayscale(0.5) brightness(1.2); /* Adjust color for consistency */
                transition: transform 0.3s ease, filter 0.3s ease;
                color: #D4BEE4;
              }
.announcements-section, .offers-slideshow {
                background-color: var(--card-background);
                padding: 1.5rem;
                border-radius: 1rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
            }

            .announcements-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .announcements-list li {
                margin-bottom: 0.5rem;
            }

            .slideshow-container {
                overflow: hidden;
                position: relative;
            }

            .offer-slide {
                display: none;
                text-align: center;
            }

            .offer-slide.active {
                display: block;
            }

            .slideshow-controls {
                display: flex;
                justify-content: space-between;
                margin-top: 1rem;
            }

            .prev-btn, .next-btn {
                background-color: var(--primary-color);
                color: #fff;
                border: none;
                padding: 0.5rem 1rem;
                border-radius: 0.5rem;
                cursor: pointer;
            }
            img{
              width: 100%;
            }

            </style>
             
      
           


            <div class="bottom-section">
                <div class="transactions-section">
                    <h2>Recent Transactions</h2>
                    <div class="transactions-list">
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <p class="date">Today</p>
                                <p class="merchant">KFC Restaurant</p>
                            </div>
                            <p class="amount debit">-600 Rs</p>
                        </div>
                        <!-- Repeat transaction items -->
                    </div>
                    <button class="more-btn">More</button>
                </div>

                <div class="statement-section">
                    <h2>Statement</h2>
                    <div class="quick-statement">
                        <button class="statement-btn">
                            <span>Generate</span>
                            <p>Last Month Statement</p>
                        </button>
                        <button class="statement-btn">
                            <span>Generate</span>
                            <p>Last Quarter Statement</p>
                        </button>
                        <button class="statement-btn">
                            <span>Generate</span>
                            <p>Last Year Statement</p>
                        </button>
                    </div>
                    <div class="custom-statement">
                        <p>Generate Statement for specific period:</p>
                        <div class="date-inputs">
                            <input type="date" placeholder="From Date">
                            <input type="date" placeholder="To Date">
                        </div>
                        <div class="format-options">
                            <p>Choose the format you want</p>
                            <div class="format-buttons">
                                <button class="format-btn">PDF</button>
                                <button class="format-btn">XLS</button>
                                <button class="format-btn">CSV</button>
                            </div>
                        </div>
                        <button class="generate-btn">Generate</button>
                    </div>
                </div>
            </div>
        </main>


        </section>

          

   


    <script>




document.addEventListener('DOMContentLoaded', function() {
    // Handle quick action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add animation class
            this.classList.add('clicked');
            setTimeout(() => {
                this.classList.remove('clicked');
            }, 200);
        });
    });

    // Handle format selection
    const formatButtons = document.querySelectorAll('.format-btn');
    formatButtons.forEach(button => {
        button.addEventListener('click', function() {
            formatButtons.forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    // Handle statement generation
    const generateBtn = document.querySelector('.generate-btn');
    generateBtn.addEventListener('click', function() {
        const fromDate = document.querySelector('input[type="date"]:first-of-type').value;
        const toDate = document.querySelector('input[type="date"]:last-of-type').value;
        const selectedFormat = document.querySelector('.format-btn.selected');

        if (!fromDate || !toDate) {
            alert('Please select both dates');
            return;
        }

        if (!selectedFormat) {
            alert('Please select a format');
            return;
        }

        // Here you would typically make an API call to generate the statement
        console.log('Generating statement...', {
            fromDate,
            toDate,
            format: selectedFormat.textContent
        });

        // Show loading state
        this.textContent = 'Generating...';
        this.disabled = true;

        // Simulate API call
        setTimeout(() => {
            this.textContent = 'Generate';
            this.disabled = false;
            alert('Statement generated successfully!');
        }, 2000);
    });

    // Add hover effect to transaction items
    const transactionItems = document.querySelectorAll('.transaction-item');
    transactionItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        item.addEventListener('mouseleave', function() {
            this.style.backgroundColor = 'transparent';
        });
    });
});



let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 5000); // Change slide every 5 seconds
}




      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };


      function toggleDropdown() {
    const dropdownMenu = document.querySelector('.profile-details .dropdown-menu');
    dropdownMenu.style.display =
        dropdownMenu.style.display === 'block' ? 'none' : 'block';
}

// Close the dropdown if clicked outside
document.addEventListener('click', (e) => {
    const profileDetails = document.querySelector('.profile-details');
    const dropdownMenu = document.querySelector('.profile-details .dropdown-menu');

    if (!profileDetails.contains(e.target)) {
        dropdownMenu.style.display = 'none';
    }
});

    </script>
    <script src = "dropdown.js"></script>
  </body>
</html>
