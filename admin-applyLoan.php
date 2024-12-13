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


<form action="admin-applyLoan.php" method = "POST" enctype="multipart/form-data">

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
                <h2><a href="admin-deposit.php">Deposit</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-withdraw.php">Withdraw</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="admin-applyLoan.php"  class="active">Loan/Credit</a></h2>
                <hr align="center">
            </div>
            
        </div>
    </div>
 

    <!-- Right Section: Profile Info -->
    <div class="profile-info">
        <h2 class>Apply for a Loan or Credit Card</h2>
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
        <div class="lcontainer">
        <h1>Apply for a Loan or Credit Card</h1>
        <div class="tabs">
            <div class="tab active" id="loanTab">Loan Application</div>
            <div class="tab" id="creditCardTab">Credit Card Application</div>
        </div>
        <form id="applicationForm">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>

            <label for="ssn">Social Security Number:</label>
            <input type="text" id="ssn" name="ssn" required pattern="\d{3}-\d{2}-\d{4}" placeholder="123-45-6789">

            <label for="income">Annual Income:</label>
            <input type="number" id="income" name="income" required min="0" step="1000">

            <label for="employmentStatus">Employment Status:</label>
            <select id="employmentStatus" name="employmentStatus" required>
                <option value="">Select an option</option>
                <option value="fullTime">Full-time</option>
                <option value="partTime">Part-time</option>
                <option value="selfEmployed">Self-employed</option>
                <option value="unemployed">Unemployed</option>
                <option value="retired">Retired</option>
            </select>

            <div id="loanFields">
                <label for="loanAmount">Loan Amount:</label>
                <input type="number" id="loanAmount" name="loanAmount" min="1000" step="100">

                <label for="loanPurpose">Loan Purpose:</label>
                <select id="loanPurpose" name="loanPurpose">
                    <option value="">Select an option</option>
                    <option value="personal">Personal</option>
                    <option value="business">Business</option>
                    <option value="homeImprovement">Home Improvement</option>
                    <option value="debtConsolidation">Debt Consolidation</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div id="creditCardFields" style="display: none;">
                <div class="credit-card">
                    <div class="card-logo">BANK</div>
                    <div class="card-number">**** **** **** ****</div>
                    <div class="card-holder">FULL NAME</div>
                    <div class="card-expiry">MM/YY</div>
                </div>

                <label for="cardType">Preferred Card Type:</label>
                <select id="cardType" name="cardType">
                    <option value="">Select an option</option>
                    <option value="rewards">Rewards Card</option>
                    <option value="cashback">Cashback Card</option>
                    <option value="lowInterest">Low Interest Card</option>
                    <option value="student">Student Card</option>
                    <option value="secured">Secured Card</option>
                </select>
            </div>

            <button type="submit">Submit Application</button>
        </form>
    </div>
    <style>
       .lcontainer {
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
        .tabs {
            display: flex;
            margin-bottom: 2rem;
        }

        .tab {
            flex: 1;
            padding: 1rem;
            text-align: center;
            background-color: #ecf0f1;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .tab:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .tab:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .tab.active {
            background-color: #3498db;
            color: #fff;
        }

        form {
            display: grid;
            gap: 1rem;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        button {
            background-color: #2ecc71;
            color: #fff;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #27ae60;
        }

        .credit-card {
            width: 300px;
            height: 180px;
            background: linear-gradient(45deg, #1a5f7a, #159895);
            border-radius: 10px;
            padding: 20px;
            color: white;
            position: relative;
            margin: 2rem auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-number {
            font-size: 1.4em;
            letter-spacing: 2px;
            margin-top: 40px;
        }

        .card-holder {
            font-size: 0.9em;
            margin-top: 20px;
        }

        .card-expiry {
            font-size: 0.9em;
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .card-logo {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.5em;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .lcontainer {
                padding: 1rem;
            }

            .tabs {
                flex-direction: column;
            }

            .tab:first-child, .tab:last-child {
                border-radius: 0;
            }

            .credit-card {
                width: 100%;
                height: auto;
                aspect-ratio: 16 / 9;
            }
        }
    </style>




           
           


 

</form>

        </section>


    <script>

const loanTab = document.getElementById('loanTab');
        const creditCardTab = document.getElementById('creditCardTab');
        const loanFields = document.getElementById('loanFields');
        const creditCardFields = document.getElementById('creditCardFields');
        const fullNameInput = document.getElementById('fullName');
        const cardHolder = document.querySelector('.card-holder');

        loanTab.addEventListener('click', () => {
            loanTab.classList.add('active');
            creditCardTab.classList.remove('active');
            loanFields.style.display = 'block';
            creditCardFields.style.display = 'none';
        });

        creditCardTab.addEventListener('click', () => {
            creditCardTab.classList.add('active');
            loanTab.classList.remove('active');
            creditCardFields.style.display = 'block';
            loanFields.style.display = 'none';
        });

        fullNameInput.addEventListener('input', (e) => {
            cardHolder.textContent = e.target.value.toUpperCase() || 'FULL NAME';
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