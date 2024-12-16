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

// Fetch user details, including the image
$query = "SELECT image FROM user WHERE userId = '$userId'";
$result = mysqli_query($con, $query) or die('Query failed');
$userData = mysqli_fetch_assoc($result);

// Set a default image if no profile image exists
$userImage = $userData['image'] ? 'uploaded_img/' . $userData['image'] : 'default_user.png';

if(isset($_POST['save'])){
    $userId = $_SESSION['userId'];
    $fname = mysqli_real_escape_string($con, $_POST['firstName']);
    $mname = mysqli_real_escape_string($con, $_POST['middleName']);
    $lname = mysqli_real_escape_string($con, $_POST['lastName']);
    $phone = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    $bday = mysqli_real_escape_string($con, $_POST['birthday']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
 
    mysqli_query($con, "UPDATE user SET firstName = '$fname', middleName = '$mname', lastName = '$lname', phoneNumber = '$phone',email = '$email'  WHERE userId = '$userId'") or die('query failed');
    
    $_SESSION['user']['firstName'] = $fname;
    $_SESSION['user']['middleName'] = $mname;
    $_SESSION['user']['lastName'] = $lname;
    $_SESSION['user']['phoneNumber'] = $phone;
    $_SESSION['user']['birthday'] = $bday;
    $_SESSION['user']['email'] = $email;
 

 }

 if (isset($_POST['upload'])) {
    $message = [];

    // File upload logic
    if (isset($_FILES['upload_photo']) && $_FILES['upload_photo']['error'] == 0) {
        $update_image = $_FILES["upload_photo"]['name'];
        $update_image_size = $_FILES['upload_photo']['size'];
        $update_image_tmp_name = $_FILES['upload_photo']['tmp_name'];
        $update_image_folder = 'uploaded_img/' . $update_image;

        // Check if the image is not empty
        if (!empty($update_image)) {
            // Check if the image size is within the limit
            if ($update_image_size > 2000000) {
                $message[] = 'Image is too large';
            } else {
                // Database update logic here
                $image_update_query = mysqli_query($con, "UPDATE `user` SET image = '$update_image' WHERE userId = '$userId'") or die('Query failed: ' . mysqli_error($con));
                
                if ($image_update_query) {
                    // Move the uploaded file to the desired folder
                    move_uploaded_file($update_image_tmp_name, $update_image_folder);
                    $_SESSION['info'] = 'Image updated successfully!';
                }
            }
        }
    } else {
        $errors[] = 'No file uploaded or error with upload.';
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

  
  <form action="acc-editProf.php" method = "POST" enctype="multipart/form-data">

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
    <!-- Sidenav -->
    <div class="sidenav">
        <div class="sidenav-url">
            <div class="url">
                <h2><a href="acc-settingsProf.php" class="active">Profile</a></h2>
                <hr align="center">
            </div>
            
            <div class="url">
                <h2><a href="acc-pass.php">Password</a></h2>
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


<form action="acc-editProf.php" method = "POST" enctype="multipart/form-data">

    <?php
         if($fetch['image'] == ''){
            echo '<img src="default-user.png">';
         }else{
            
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>

<div class="edit-profile-container">
    <!-- Left Section: Profile Photo -->
    <div class="profile-photo">
        <img src="<?php echo htmlspecialchars($userImage); ?> "alt="Profile Photo">
        <label for="upload-photo">Upload a different photo...</label>
        <input type="file" id="upload-photo" name ="upload_photo">
        <button class="btn save" name = "upload">Upload</button>
        <div class="user-info">
            <div class="info-item">
                <span class="label">User ID:</span>
                <span class="value" name = "userId"><?php echo htmlspecialchars($userId); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Account Type:</span>
                <span class="value"><?php echo htmlspecialchars($acctype); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Account Number:</span>
                <span class="value"><?php echo htmlspecialchars($acc_no); ?></span>
            </div>
            <div class="info-item">
                <span class="label">Verification Status:</span>
                <span class="value"><?php echo htmlspecialchars($status); ?></span>
            </div>
            <?php if ($status !== 'verified') : ?>
                <div class="link"><a href="verifyAcc.php">Verify your account!</a></div>
            <?php endif; ?>
        </div>



    </div>
 

    <!-- Right Section: Profile Info -->
    <div class="profile-info">
        <h2 class>Edit Profile</h2>
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
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" placeholder="Enter first name" value="<?php echo htmlspecialchars($userName); ?>">

            </div>
            <div class="form-group">
                <label for="middleName">Middle</label>
                <input type="text" name="middleName" placeholder="Enter last name" value="<?php echo htmlspecialchars($mname); ?>">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" placeholder="Enter last name" value="<?php echo htmlspecialchars($lname); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter email address" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label for="bday">Birthday</label>
                <input type="date" name="birthday" placeholder="Enter email address" value="<?php echo htmlspecialchars($bday); ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phoneNumber" placeholder="Enter phone number" value="<?php echo htmlspecialchars($phone); ?>">
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" placeholder="Enter address">
            </div>
           
        </div>

        <!-- Buttons -->
        <div class="buttons">
            <button class="btn cancel">Cancel</button>
            <button class="btn save" name = "save">Save</button>
        </div>
    </div>
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

        .btn.save {
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
