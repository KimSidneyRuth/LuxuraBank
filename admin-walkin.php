<?php require_once "controllerUserData.php";


include "connection.php";



if (!isset($_SESSION['name'])) {
    // Redirect to login page if the user is not logged in
 
    header('location: login-user.php');
    exit();
}

$id = $_SESSION['id'];
$query = "SELECT * FROM admin WHERE id = '$id'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $adminData = mysqli_fetch_assoc($result);

    // Store user details in session variables
    $_SESSION['id'] = $adminData['id'];
    $_SESSION['birthday'] = $adminData['birthday'];
    $_SESSION['role'] = 'admin';
    $_SESSION['name'] = $adminData['name'];
    $_SESSION['email'] = $adminData['email'];
   
   
    // Set a default image if no profile image exists
    $adminImage = $adminData['image'] ? 'uploaded_img/' . $adminData['image'] : 'default_user.png';
} else {
    // If user details are not found, exit or redirect to an error page
    exit('User not found.');
}

// Assign user data to variables for display
// Assuming account number is the userId

$name = $_SESSION['name'];
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$bday = $_SESSION['birthday'];
$role = $_SESSION['role'];
$email = $_SESSION['email'];




$query = "SELECT image FROM admin WHERE id = '$id'";
$result = mysqli_query($con, $query) or die('Query failed');
$userData = mysqli_fetch_assoc($result);

// Set a default image if no profile image exists
$userImage = $userData['image'] ? 'uploaded_img/' . $userData['image'] : 'default_user.png';

if(isset($_POST['save'])){
    $id = $_SESSION['id'];
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $bday = mysqli_real_escape_string($con, $_POST['birthday']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
 
    mysqli_query($con, "UPDATE admin SET name = '$name', birthday = '$bday', email = '$email'  WHERE id = '$id'") or die('query failed');
    
    $_SESSION['admin']['name'] = $name;
    $_SESSION['admin']['birthday'] = $bday;
    $_SESSION['admin']['email'] = $email;
 

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
                $image_update_query = mysqli_query($con, "UPDATE `admin` SET image = '$update_image' WHERE id = '$id'") or die('Query failed: ' . mysqli_error($con));
                
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

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title> Accounts| Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <link rel="stylesheet" href="dropdown.css">
    <!--<link rel="stylesheet" href="hp.css">
    <!--<link rel="stylesheet" href="customer_add_style.css">-->
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="admin-walfin.php" method = "POST"></form>
    <div class="sidebar">
      <div class="logo-details">
       
        <span class="logo_name"><div id="kim" style="text-align: center; margin-bottom: 20px; margin-top:10px">
                 <img src="img/luxura-nav.png" alt="" style="width: 170px;">
                        </div></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="admin-dash.php" >
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="admin-customerstable.php">
            <i class="bx bx-user"></i>
            <span class="links_name">Accounts</span>
          </a>
        </li>
        <li>
                <a href="#" class="active">
                    <i class="bx bx-list-ul"></i>
                    <span class="links_name">Walk-In</span>
                </a>
                
            </li>
           
        <li>
          <a href="#">
            <i class="bx bx-gift"></i>
            <span class="links_name">Pointing System</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Offers</span>
          </a>
        </li>
        <li>
          <a href="seeAllNews2.php">
            <i class="bx bx-bell"></i>
            <span class="links_name">Announcements</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-folder"></i>
            <span class="links_name">Reports</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-time"></i>
            <span class="links_name">Payment History</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart"></i>
            <span class="links_name">Customer Page</span>
          </a>
        </li>
        <li>
          <a href="#">
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
          <span class="dashboard">Walk-In</span>
        </div>
        <div class="searh-box">
          
          <img src="img/luxura-nav.png" alt="">
        </div>
        <div class="profile-dropdown">
        <div onclick="toggle()" class="profile-dropdown-btn">
            <div class="profile-img">
            <img src="<?php echo htmlspecialchars($adminImage); ?>" alt="Profile Image">
        </div>

          <span
            ><?php echo htmlspecialchars($name); ?>
            <i class="fa-solid fa-angle-down"></i>
          </span>
        </div>

        <ul class="profile-dropdown-list">
          <li class="profile-dropdown-list-item">
            <a href="admin-accSettings.php">
              <i class="fa-regular fa-user"></i>
              User Profile
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="admin-editProf.php">
            <i class="fa fa-pen fa-xs edit"></i>
              Update Profile
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="logout-user.php">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              Log out
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="#settings">
              <i class="fa-solid fa-sliders"></i>
              Settings
            </a>
          </li>


</ul>

<style>
            .profile-dropdown-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-right: 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            width: 220px;
            border-radius: 50px;
            color: var(--black);
            /* background-color: white;
            box-shadow: var(--shadow); */

            cursor: pointer;
            border: 1px solid var(--secondary);
            transition: box-shadow 0.2s ease-in, background-color 0.2s ease-in,
                border 0.3s;
            }
        </style>



</nav>

<div class="container">
    <!-- Sidenav -->
    <div class="sidenav">
        <div class="sidenav-url">
            <div class="url">
                <h2><a href="#">Loan/Credit</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="#settings"class="active">Open Account</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="#settings">Deposit</a></h2>
                <hr align="center">
            </div>
            
        </div>
    </div>
     <?php
      $select = mysqli_query($con, "SELECT * FROM `admin` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>


<form action="admin-editProf.php" method = "POST" enctype="multipart/form-data">

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
        <label for="upload-photo">Upload a photo...</label>
        <input type="file" id="upload-photo" name ="upload_photo">
        <button class="btn save" name = "upload">Upload</button>
        <div class="user-info">
            <div class="info-item">
                <span class="label">User ID:</span>
                <span class="value" id="userId"><?php echo $generatedUserId; ?></span>

            </div>
        
        </div>



    </div>
 

    <!-- Right Section: Profile Info -->
    <div class="profile-info">
        <h2 class>Open Account</h2>
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

$errors = [];
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
                <label for="firstName">First Name*</label>
                <input type="text" name="fname" placeholder="Enter first name.">

            </div>
          
        
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter email address">
            </div>
            <div class="form-group">
                <label for="firstName">Middle Name*</label>
                <input type="text" name="mname" placeholder="Enter middle name">

            </div>
            <div class="form-group">
                <label for="bday">Birthday</label>
                <input type="date" name="birthday" placeholder="Enter birthday">
            </div>
            <div class="form-group">
                <label for="firstName">Last Name*</label>
                <input type="text" name="lname" placeholder="Enter last name">

            </div>
            <div class="form-group">
                <label for="firstName">Valid ID Number*</label>
                <input type="text" name="lname" placeholder="Enter valid id number">

</div>
            

            <div class="form-group">
            <label>Account Type *</label>
          <div class="custom_select">
            <select id="account-type" name="account-type" title="(Select your type of account)" required>
              <option>--Select type of account--</option>
              <option value="Checking Account">Checking Account</option>
              <option value="Savings-Account">Savings Account</option>
              <option value="Credit Account">Salary Account</option>
              <option value="Fixed-Deposit-Account">Fixed Deposit Account</option>
              <option value="CreditCard">Credit Card</option>
            </select>
          </div>
          <div class="form-group">
                <label>Confirm Password *</label>
            <input type="password"  class="input" id="confirm-password" name="confirm-password"
                placeholder="Confirm password" autocomplete="off"
                title="(Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters)"
                maxlength="100" minlength="8" required>
            </div>
            

          <div class="form-group">
                <label for="">Sex *</label>
                <input type="radio" name="sex" id="radio" value="Male">Male
                <input type="radio" name="sex" id="radio" value="Female">Female

            </div>

            </div>
            <div class="form-group">
            <label>Password *</label>
                <input type="password" class="input" id="password" name="password" placeholder="Create your password min 8 characters"
                    autocomplete="off"
                    title="(Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters)"
                    maxlength="100" minlength="8" required>

            </div>
           
            
            
        

        <!-- Buttons -->
        <div class="buttons">
            <button class="btn cancel">Cancel</button>
            <button class="btn save" name = "Register">Save</button>
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
input, select{
    width: 100%;
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

    </script>
    <script src = "dropdown.js"></script>
  

</body>
</html>