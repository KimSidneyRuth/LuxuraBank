<?php require_once 'controllerUserData.php';




if (!isset($_SESSION['firstName'])) {
    // Redirect to login page if the user is not logged in
 
    header('location: login-user.php');
    exit();
}

$userId = $_SESSION['userId'];
$query = "SELECT * FROM user WHERE userId = '$userId'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);

    // Store user details in session variables
    $_SESSION['userId'] = $userData['userId'];
    
    $_SESSION['role'] = 'user';
    $_SESSION['firstName'] = $userData['firstName'];
    $_SESSION['middleName'] = $userData['middleName'];
    $_SESSION['lastName'] = $userData['lastName'];
    $_SESSION['birthday'] = $userData['birthday'];
    $_SESSION['sex'] = $userData['sex'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION['accountType'] = $userData['accountType'];
    $_SESSION['verification_status'] = $userData['verification_status'];
    $_SESSION['account_no'] = $userData['account_no'];
    $_SESSION['phoneNumber'] = $userData['phoneNumber'];
    $_SESSION['password'] = $userData['password'];

    // Set a default image if no profile image exists
    $userImage = $userData['image'] ? 'uploaded_img/' . $userData['image'] : 'default_user.png';
} else {
    // If user details are not found, exit or redirect to an error page
    exit('User not found.');
}

// Assign user data to variables for display
// Assuming account number is the userId
$userName = $_SESSION['firstName'];
$mname = $_SESSION['middleName'];
$lname = $_SESSION['lastName'];
$bday = $_SESSION['birthday'];
$sex = $_SESSION['sex'];
$status = $_SESSION['verification_status'];
$email = $_SESSION['email'];
$acctype = $_SESSION['accountType'];
$acc_no = $_SESSION['account_no']; 
$phone = $_SESSION['phoneNumber']; 
$password = $_SESSION['password']; 
// Fetch user details, including the image
$query = "SELECT image FROM user WHERE userId = '$userId'";
$result = mysqli_query($con, $query) or die('Query failed');
$userData = mysqli_fetch_assoc($result);

// Set a default image if no profile image exists
$userImage = $userData['image'] ? 'uploaded_img/' . $userData['image'] : 'default_user.png';

if(isset($_POST['verify_code'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['newPassword']);
    $cpassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    } else {
        if(strlen($password) < 8) {
            $errors['password'] = "Password must be at least 8 characters long!";
        } else {
            $code = 0;
            $email = $_SESSION['email']; 
            $encpass = $password;  // Ensure password is hashed
            $update_pass = "UPDATE user SET password_code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
               // $_SESSION['info'] = "Your password has been changed.";
                echo "<script>
                        alert('Your password has been successfully changed.');
                        window.location.href = 'acc-pass.php';
                      </script>";
                
            } else {
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
}







 
?>

<style>

</style>


<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Profile| Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <!--<link rel="stylesheet" href="customer_add_style.css">-->
    <link rel="stylesheet" href="css2.css">



    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>

  
 
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
            <span class="links_name">Accounts</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-list-ul"></i>
            <span class="links_name">Walk-In</span>
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
            <span class="links_name">Transfer</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-book-alt"></i>
            <span class="links_name">Pay Bills</span>
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
          <a href="acc-settings.php" class = "active">
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
          <span class="dashboard">Account Settings</span>
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
            <a href="acc-info.php">
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
            <a href="acc-settings.php">
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
    <!-- Sidenav -->
    <div class="sidenav">
        <div class="sidenav-url">
            <div class="url">
                <h2><a href="acc-settingsProfile.php">Profile</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="#settings">Settings</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="acc-pass.php" class="active">Password</a></h2>
                <hr align="center">
            </div>
        </div>
    </div>

    <?php
      $select = mysqli_query($con, "SELECT * FROM `user` WHERE userId = '$userId'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>


<form action="changePass.php" method = "POST" enctype="multipart/form-data">



<div class="edit-profile-container">
   
 

    <!-- Right Section: Profile Info -->
    <div class="profile-info">
        <h2 class>Change Password</h2>
        
        <?php
if (isset($_SESSION['info'])) {
    ?>
    <div class="alert alert-success text-center">
        <?php echo $_SESSION['info']; ?>
    </div>
    <?php
    unset($_SESSION['info']); // Clear the session message after showing it
}
?>

<!-- Display Error Messages -->
<?php
if (count($errors) > 0) {
    ?>
    <div class="alert alert-danger text-center">
        <?php
        foreach ($errors as $showerror) {
            echo $showerror . '<br>'; // Display each error on a new line
        }
        ?>
    </div>
    <?php
}
?>

<div class="form-grid">
    <div class="form-group">
        <label for="verification_code">Enter Verification Code</label>
        <input type="text" name="verification_code" placeholder="Enter verification code" required>
    </div>
</div>

<div class="form-grid">
    <div class="form-group">
        <label for="newPassword">New Password</label>
        <input type="password" name="newPassword" placeholder="Enter new password" required>
    </div>
</div>

<div class="form-grid">
    <div class="form-group">
        <label for="confirmPassword">Confirm New Password</label>
        <input type="password" name="confirmPassword" placeholder="Confirm new password" required>
    </div>
</div>

<!-- Buttons to verify the code and change password -->
<div class="buttons">
    <button class="btn cancel">Cancel</button>
    <button class="btn verify_code" name="verify_code">Verify Code & Change Password</button>
</div>

<style>

body {
            margin: 0;
            padding: 0;
        }
        .edit-profile-container {
            display: flex;
  gap: 30px;
  max-width: 1200px;
  margin: 30px auto;
  font-family: Arial, sans-serif;
  background-color: #f8f9fa;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-top: 70px;
        }

.btn.send_code {
  background-color: #D4BEE4;
  color: #fff;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius: 3px;
}
.btn.verify_code {
  background-color: #D4BEE4;
  color: #fff;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius: 3px;
}
.btn.cancel {
    background-color: #D4BEE4;
    color: #fff;
  border: none;
  cursor: pointer;
  width: 100%;
  border-radius: 3px;

}
.btn.change:hover {
  background-color: #F3B75B;

}


        </style>

</form>


</section>
   


    <script>
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
