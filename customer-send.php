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





?>

<style>

</style>


<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title> Send Money| Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    
    <link rel="stylesheet" href="dropdown.css">
   

    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
       

        .trans-container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 78px;
        }

        h2 {
            font-size: 24px;
  color: #333;
  margin-bottom: 20px;
  border-bottom: 2px solid #D4BEE4;
 
  padding-bottom: 5px;
  text-align: center;
            
        }

        .trans-form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color:#D4BEE4;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #f3b75b;
        }

        .trans-section {
            margin-bottom: 20px;
           
            flex: 1;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
            min-width: 300px;
        }
        .trans-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .section-title {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
            font-size: 18px;
            color: #2c3e50;
        }
        .sidebar{
            position: fixed;
            top: 0;
        }
 
        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
        }
    </style>
  </head>
  <body>
    <form action="customer-side.php" method = "POST"></form>
    <div class="sidebar">
      <div class="logo-details">
       
        <span class="logo_name"><div id="kim" style="text-align: center; margin-bottom: 20px; margin-top:10px">
                 <img src="img/luxura-nav.png" alt="" style="width: 170px;">
                        </div></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="customer-side.php">
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
          <a href="#" class = "active">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Transfer</span>
          </a>
        </li>
        <li>
          <a href="#">
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
          <span class="dashboard">Transfer Money</span>
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
      
      <div class="trans-container">
        <h2>Transfer Money</h2>
        <form id="transferForm">
    
            <div class="trans-section">
                <h2 class="section-title">Sender's Information</h2>
                <div class="trans-form-group">
                    <label for="senderName">Full Name:</label>
                    <input type="text" id="senderName" name="senderName" required>
                </div>
                <div class="form-group">
                    <label for="senderAccount">Account Number:</label>
                    <input type="text" id="senderAccount" name="senderAccount" required>
                </div>
            </div>

            <div class="trans-section">
                <h2 class="section-title">Recipient's Information</h2>
                <div class="trans-form-group">
                    <label for="recipientName">Full Name:</label>
                    <input type="text" id="recipientName" name="recipientName" required>
                </div>
                <div class="trans-form-group">
                    <label for="recipientAccount">Account Number:</label>
                    <input type="text" id="recipientAccount" name="recipientAccount" required>
                </div>
                
            </div>

            <div class="trans-section">
                <h2 class="section-title">Transfer Details</h2>
                <div class="trans-form-group">
                    <label for="amount">Amount:</label>
                    <input type="number" id="amount" name="amount" min="0.01" step="0.01" required>
                </div>
              
                <div class="trans-form-group">
                    <label for="description">Description (Optional):</label>
                    <input type="text" id="description" name="description">
                </div>
            </div>

            <button type="submit" class="btn">Transfer Money</button>
        </form>
    </div>
      
      
                    


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
