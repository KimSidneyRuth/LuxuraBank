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
    <title> Customer Dashboard | Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <!--<link rel="stylesheet" href="customer_add_style.css">-->
    <link rel="stylesheet" href="dropdown.css">
    <link rel="stylesheet" href="send.css">
   

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
                 <img src="img/luxura-nav.png" alt="" style="width: 170px;">
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
          <a href="#">
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
<div class="container">
    
    </div>

<div class="send-container">
    <div class="profile-info">
            <h2>Fill All Fields</h2>
            <form id="moneyTransferForm" action="customer-transfermoney.php" method="post">
                <div class="form grid">
                <div class="form-group">
                    <label for="clientName">Client Name</label>
                    <input type="text" id="clientName" name="clientName" value="KIM SIDNEY RUTH BBAYOT PASCUAL" readonly>
                </div>
            </div> 
            <div class="form grid">
                <div class="form-group">
                    <label for="clientNationalId">Client National ID No.</label>
                    <input type="text" id="clientNationalId" name="clientNationalId" value="293724" readonly>
                </div>
                </div> 
                <div class="form-group">
                    <label for="clientPhone">Client Phone Number</label>
                    <input type="tel" id="clientPhone" name="clientPhone" value="09558876693" readonly>
                </div>

                <div class="form-group">
                    <label for="accountName">Account Name</label>
                    <input type="text" id="accountName" name="accountName" value="Kim Sidney Ruth" readonly>
                </div>

                <div class="form-group">
                    <label for="accountNumber">Account Number</label>
                    <input type="text" id="accountNumber" name="accountNumber" value="619028347" readonly>
                </div>

                <div class="form-group">
                    <label for="accountType">Account Type | Category</label>
                    <input type="text" id="accountType" name="accountType" value="Current account" readonly>
                </div>

                <div class="form-group">
                    <label for="transactionCode">Transaction Code</label>
                    <input type="text" id="transactionCode" name="transactionCode" value="AijU5sqkPVlTNpemHfg7" readonly>
                </div>

                <div class="form-group">
                    <label for="amountTransferred">Amount Transferred($)</label>
                    <input type="number" id="amountTransferred" name="amountTransferred" required>
                </div>

                <div class="form-group">
                    <label for="receivingAccountNumber">Receiving Account Number</label>
                    <select id="receivingAccountNumber" name="receivingAccountNumber" required>
                        <option value="">Select Receiving Account</option>
                        <option value="acc1">Account 1</option>
                        <option value="acc2">Account 2</option>
                        <option value="acc3">Account 3</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="receivingAccountName">Receiving Account Name</label>
                    <input type="text" id="receivingAccountName" name="receivingAccountName" required>
                </div>

                <div class="form-group">
                    <label for="receivingAccountHolder">Receiving Account Holder</label>
                    <input type="text" id="receivingAccountHolder" name="receivingAccountHolder" required>
                </div>

                <button type="submit">Transfer Funds</button>
            </form>
            </div> 
     
       
    </div>
</div>
    

       
 </section>  

         

   


    <script>

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('moneyTransferForm');
    const amountInput = document.getElementById('amountTransferred');
    const receivingAccountSelect = document.getElementById('receivingAccountNumber');
    const receivingAccountName = document.getElementById('receivingAccountName');
    const receivingAccountHolder = document.getElementById('receivingAccountHolder');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        if (validateForm()) {
            // Simulate form submission
            alert('Transfer initiated successfully!');
            form.reset();
        }
    });

    receivingAccountSelect.addEventListener('change', function() {
        // Simulate fetching account details
        if (this.value) {
            receivingAccountName.value = `Account ${this.value.slice(-1)}`;
            receivingAccountHolder.value = `Holder ${this.value.slice(-1)}`;
        } else {
            receivingAccountName.value = '';
            receivingAccountHolder.value = '';
        }
    });

    function validateForm() {
        let isValid = true;

        if (amountInput.value <= 0) {
            alert('Please enter a valid amount.');
            isValid = false;
        }

        if (!receivingAccountSelect.value) {
            alert('Please select a receiving account.');
            isValid = false;
        }

        if (!receivingAccountName.value) {
            alert('Please enter the receiving account name.');
            isValid = false;
        }

        if (!receivingAccountHolder.value) {
            alert('Please enter the receiving account holder.');
            isValid = false;
        }

        return isValid;
    }
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
