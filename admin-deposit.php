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
    
     <?php
      $select = mysqli_query($con, "SELECT * FROM `admin` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>


<form action="admin-deposit.php" method = "POST" enctype="multipart/form-data">

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

<div class="edit-profile-container" style="width:75vw">
    <!-- Left Section: Profile Photo -->
    <div class="sidenav">
        <div class="sidenav-url">
            
            <div class="url">
                <h2><a href="admin-walkin.php">Open Account</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-deposit.php" class="active">Deposit</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-withdraw.php">Withdraw</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-applyLoan.php" >Loan/Credit</a></h2>
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
     <h1>Deposit</h1>
        <form id="depositForm">
            <div class="section">
                <h2 class="section-title">Client Information</h2>
                <div class="dform-group">
                    <label for="accountNumber">Account Number:</label>
                    <input type="text" id="accountNumber" name="accountNumber" required>
                </div>
                <div class="dform-group">
                    <label for="customerName">Client Name:</label>
                    <input type="text" id="customerName" name="customerName" required>
                </div>
                <div class="dform-group">
                    <label for="idType">ID Type:</label>
                    <select id="idType" name="idType" required>
                        <option value="">Select ID Type</option>
                        <option value="driverLicense">Driver's License</option>
                        <option value="passport">Passport</option>
                        <option value="nationalId">National ID</option>
                    </select>
                </div>
                <div class="dform-group">
                    <label for="idNumber">ID Number:</label>
                    <input type="text" id="idNumber" name="idNumber" required>
                </div>
            </div>

            <div class="dsection">
                <h2 class="section-title">Deposit Information</h2>
               
                <div class="dform-group">
                    <label for="amount">Deposit Amount (₱):</label>
                    <input type="number" id="amount" name="amount" min="5,000.00" step="0.01" required>
                </div>
                <div id="checkDetails" style="display: none;">
                    <div class="dform-group">
                        <label for="checkNumber">Check Number:</label>
                        <input type="text" id="checkNumber" name="checkNumber">
                    </div>
                    <div class="dform-group">
                        <label for="bankName">Issuing Bank:</label>
                        <input type="text" id="bankName" name="bankName">
                    </div>
                </div>
            </div>

            <div class="summary">
                <h3>Transaction Summary</h3>
                <p><strong>Account Number:</strong> <span id="summaryAccount"></span></p>
                <p><strong>Customer Name:</strong> <span id="summaryName"></span></p>
                <p><strong>Deposit Method:</strong> <span id="summaryMethod"></span></p>
                <p><strong>Deposit Amount:</strong> ₱<span id="summaryAmount"></span></p>
            </div>

            <div style="text-align: right; margin-top: 20px;">
                <button type="button" class="btn btn-secondary" style="margin-right: 10px;">Cancel</button>
                <button type="submit" class="btn">Complete Deposit</button>
            </div>
        </form>
    </div>

</form>
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
        .dform-group {
            margin-bottom: 20px;
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
            .deposit-methods {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-secondary {
            background-color: #95a5a6;
        }

        .btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .deposit-method {
            flex: 1;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .deposit-method:hover {
            background-color: #f9f9f9;
        }

        .deposit-method.active {
            background-color: #e0f7fa;
            border-color: #3498db;
        }

        .dsection {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .section-title {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 20px;
            color: #2c3e50;
        }

        .summary {
            background-color: #e8f5e9;
            padding: 20px;
            border-radius: 4px;
            margin-top: 30px;
        }

        .summary h3 {
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .summary p {
            margin-bottom: 5px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .deposit-methods {
                flex-direction: column;
            }
        }
        }
</style>
        </section>


    <script>
          document.addEventListener('DOMContentLoaded', function () {
            const depositMethods = document.querySelectorAll('.deposit-method');
            const checkDetails = document.getElementById('checkDetails');
            const form = document.getElementById('depositForm');
            const amountInput = document.getElementById('amount');
            const minimumDeposit = 5000; // Minimum deposit amount in pesos

            depositMethods.forEach(method => {
                method.addEventListener('click', function () {
                    depositMethods.forEach(m => m.classList.remove('active'));
                    this.classList.add('active');
                    checkDetails.style.display = this.dataset.method === 'check' ? 'block' : 'none';
                    document.getElementById('summaryMethod').textContent = this.textContent;
                });
            });
         form.addEventListener('input', function () {
                document.getElementById('summaryAccount').textContent = document.getElementById('accountNumber').value;
                document.getElementById('summaryName').textContent = document.getElementById('customerName').value;
                document.getElementById('summaryAmount').textContent = amountInput.value;
            });

            form.addEventListener('submit', function (e) {
                const depositAmount = parseFloat(amountInput.value);

                if (depositAmount < minimumDeposit) {
                    e.preventDefault();
                    alert(`Deposit amount must be at least ₱${minimumDeposit.toLocaleString()}.`);
                }
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

    </script>
    <script src = "dropdown.js"></script>
  

</body>
</html>