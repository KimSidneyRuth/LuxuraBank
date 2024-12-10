<?php
include "connection.php";
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




?>

<style>
 .sidebar{
    position: fixed;
    top:0;
 }
</style>


<html lang="en" dir="ltr">
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
       
        <span class="logo_name"><div id="kim" style="text-align: center; margin-bottom: 20px; margin-top:10px">
                 <img src=" lux-nav.png" alt="" style="width: 170px;">
                        </div></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="customer-side.php" class = "active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span class="links_name">Open Account</span>
          </a>
        </li>
        <li>
          <a href="customer-send.php">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Transfer</span>
          </a>
        </li>
        <li>
          <a href="customer-side.php">
            <i class="bx bx-pie-chart-alt-2"></i>
            <span class="links_name">Transaction</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Pay</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-book-alt"></i>
            <span class="links_name">Apply Loan</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-gift"></i>
            <span class="links_name">Points</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-message"></i>
            <span class="links_name">Interest</span>
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
            <span class="links_name">Account Settings</span>
          </a>
        </li>
        
        
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Home</span>
        </div>
        <div class="searh-box">
          
          <img src="img/luxura-nav.png" alt="">
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
        <div class="profile-dropdown">
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
            <a href="acc-settingsProfile.php">
              <i class="fa-regular fa-user"></i>
              User Profile
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="acc-editProf.php">
            <i class="fa fa-pen fa-xs edit"></i>
              Update Profile
            </a>
          </li>
          
          <li class="profile-dropdown-list-item">
            <a href="#">
              <i class="fa-solid fa-sliders"></i>
              Settings
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="#">
              <i class="fa-solid fa-lock"></i>
              Lock Account
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="logout-user.php">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              Log out
            </a>
          </li>
</ul>

     


    
      </nav>
      
      <div class="custdashboard">
        <!--<nav class="custnavbar">
            <div class="logo">
                <span>Bank</span>
            </div>
            <div class="nav-links">
                <a href="#" class="active">HOME</a>
                <a href="#">BANKING</a>
                <a href="#">CREDIT CARD</a>
                <a href="#">INVESTMENTS</a>
                <a href="#">PERSONAL LOAN</a>
                <a href="#">HOME LOAN</a>
            </div>
            <div class="nav-icons">
                <button class="icon-btn"><img src="/placeholder.svg" alt="notifications"></button>
                <button class="icon-btn"><img src="/placeholder.svg" alt="profile"></button>
                <button class="icon-btn"><img src="/placeholder.svg" alt="settings"></button>
            </div>
        </nav>-->

        <main class="content">
            <div class="top-section">
                <div class="balance-card">
                    <div class="account-info">
                        <p class="label"><?php echo htmlspecialchars($acctype); ?></p>
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
             <!--<div class="offers-slideshow">
                <h2>Exclusive Offers</h2>
                <div class="slideshow-container">
                    <div class="offer-slide active">
                        <img src="img/offer1.png" alt="Offer 1">
                        <p>Get 5% cashback on all debit card transactions!</p>
                    </div>
                    <div class="offer-slide">
                        <img src="img/offer2.png" alt="Offer 2">
                        <p>Earn double reward points on credit card spends above $500.</p>
                    </div>
                    <div class="offer-slide">
                        <img src="offer3.jpg" alt="Offer 3">
                        <p>Avail personal loans at 7.5% p.a. limited time offer!</p>
                    </div>
                </div>
                <div class="slideshow-controls">
                    <button class="prev-btn">❮</button>
                    <button class="next-btn">❯</button>
                </div>
            </div>-->
      
              

      <div class="offers-slideshow">
        <?php 
        $slideCount = 1; // Counter for slides
        foreach ($slides as $slide): 
        ?>
         <h2>Exclusive Offers</h2>
            <div class="slideshow-container">
                <div class="numbertext"><?= $slideCount ?> / <?= $slides->num_rows ?></div>
                <img src="<?= htmlspecialchars($slide['slide_image']) ?>" style="width:1200px">
                    <div class="offer-slide">
                    
                  
                </div>
            </div>
        <?php 
            $slideCount++; 
        endforeach; 
        ?>
        
        <a class="prev-btn" onclick="plusSlides(-1)">❮</a>
        <a class="next-btn" onclick="plusSlides(1)">❯</a>
    </div>


               <!-- Dots for each slide -->
    <div style="text-align:center">
        <?php for ($i = 1; $i <= $slides->num_rows; $i++): ?>
            <span class="dot" onclick="currentSlide(<?= $i ?>)"></span> 
        <?php endfor; ?>
    </div>


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



document.addEventListener('DOMContentLoaded', () => {
                const slides = document.querySelectorAll('.offer-slide');
                let currentSlide = 0;

                const showSlide = (index) => {
                    slides.forEach((slide, i) => {
                        slide.classList.toggle('active', i === index);
                    });
                };

                document.querySelector('.prev-btn').addEventListener('click', () => {
                    currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1;
                    showSlide(currentSlide);
                });

                document.querySelector('.next-btn').addEventListener('click', () => {
                    currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0;
                    showSlide(currentSlide);
                });

                showSlide(currentSlide);
            });
      



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
