<?php require_once "withdraw.php";


include "connection.php";
session_start();



if (!isset($_SESSION['id'])) {
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
    
     <?php
      $select = mysqli_query($con, "SELECT * FROM `admin` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>


<form action="admin-withdraw.php" method = "POST" enctype="multipart/form-data">

  

<div class="edit-profile-container" style="width:75vw">
    <!-- Left Section: Profile Photo -->
    <div class="sidenav">
        <div class="sidenav-url">
            
            <div class="url">
                <h2><a href="admin-walkin.php">Open Account</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-deposit.php">Deposit</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-withdraw.php" class="active">Withdraw</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-applyLoan.php">Loan/Credit</a></h2>
                <hr align="center">
            </div>
            
        </div>
    </div>
 

    <!-- Right Section: Profile Info -->
    <div class="profile-info">
       
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
     
    

     <div class="dcontainer">
        <h1>Withdraw Money</h1>
        <form id="withdrawForm">
            <label for="accNumber">Account Number:</label>
            <input type="text" id="acc_no" name="acc_no" required>

            <label for="accName">Account Name:</label>
            <input type="text" id="c-name" name="c-ame" required>

            <label for="amount">Withdrawal Amount:</label>
            <input type="number" id="amount" name="amount" min="5,000.00" step="0.01" required>

            <!--<label for="purpose">Transaction Purpose (optional):</label>
            <input type="text" id="purpose" name="purpose">

            <label for="approvalCode">Approval Code:</label>
            <input type="text" id="approvalCode" name="approvalCode" required>-->

            <button type="submit" id="withdrawButton">Submit Withdrawal Request</button>
        </form>
        <div id="message" class="message" style="display: none;"></div>
        <div id="adminApproval">
            <h2>Admin Approval</h2>
            <input type="password" id="adminPassword" placeholder="Enter admin password">
            <button id="approveButton">Approve Transaction</button>
        </div>
    </div>

    <style>
    
     .dcontainer {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 1rem;
           
        }
        button {
            padding: 0.5rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
        button:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        .message {
            margin-top: 1rem;
            padding: 0.5rem;
            border-radius: 4px;
            text-align: center;
        }
        .error {
            background-color: #ffebee;
            color: #c62828;
        }
        .success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        #adminApproval {
            display: none;
            margin-top: 1rem;
        }
    </style>
        </section>



    <script>

document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('withdrawForm');
            const withdrawButton = document.getElementById('withdrawButton');
            const messageDiv = document.getElementById('message');
            const adminApprovalDiv = document.getElementById('adminApproval');
            const adminPasswordInput = document.getElementById('adminPassword');
            const approveButton = document.getElementById('approveButton');

            // Simulated admin password
            const ADMIN_PASSWORD = 'admin123';

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const accNumber = document.getElementById('accNumber').value;
                const accName = document.getElementById('accName').value;
                const amount = parseFloat(document.getElementById('amount').value);
                const purpose = document.getElementById('purpose').value;
                const approvalCode = document.getElementById('approvalCode').value;

                if (!accNumber || !accName || isNaN(amount) || amount <= 0 || !approvalCode) {
                    showMessage('Please fill all required fields with valid information.', 'error');
                    return;
                }

                withdrawButton.disabled = true;
                withdrawButton.textContent = 'Processing...';

                // Simulate initial processing
                setTimeout(function() {
                    showMessage('Withdrawal request submitted. Waiting for admin approval.', 'success');
                    adminApprovalDiv.style.display = 'block';
                    withdrawButton.style.display = 'none';
                }, 1500);
            });

            approveButton.addEventListener('click', function() {
                const adminPassword = adminPasswordInput.value;

                if (adminPassword !== ADMIN_PASSWORD) {
                    showMessage('Invalid admin password. Approval failed.', 'error');
                    return;
                }

                approveButton.disabled = true;
                approveButton.textContent = 'Approving...';

                // Simulate final approval process
                setTimeout(function() {
                    const success = Math.random() < 0.8; // 80% success rate
                    if (success) {
                        showMessage('Withdrawal approved and processed successfully!', 'success');
                    } else {
                        showMessage('Withdrawal approval failed. Please try again.', 'error');
                    }
                    resetForm();
                }, 1500);
            });

            function showMessage(text, type) {
                messageDiv.textContent = text;
                messageDiv.className = `message ${type}`;
                messageDiv.style.display = 'block';
            }

            function resetForm() {
                form.reset();
                withdrawButton.disabled = false;
                withdrawButton.textContent = 'Submit Withdrawal Request';
                withdrawButton.style.display = 'block';
                adminApprovalDiv.style.display = 'none';
                approveButton.disabled = false;
                approveButton.textContent = 'Approve Transaction';
                adminPasswordInput.value = '';
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

    </script>
    <script src = "dropdown.js"></script>
  

</body>
</html>