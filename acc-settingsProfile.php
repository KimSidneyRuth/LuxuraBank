<?php
include "connection.php";
session_start();


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
    $_SESSION['verification_status'] = $userData['verification_status'];


    // Set a default image if no profile image exists
    $userImage = $userData['image'] ? 'uploaded_img/' . $userData['image'] : 'img/default-avatar.png';
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
// Fetch user details, including the image
$query = "SELECT image FROM user WHERE userId = '$userId'";
$result = mysqli_query($con, $query) or die('Query failed');
$userData = mysqli_fetch_assoc($result);

// Set a default image if no profile image exists
$userImage = $userData['image'] ? 'uploaded_img/' . $userData['image'] : 'default_user.png';





?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title> Account Settings | Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <link rel="stylesheet" href="customer_add_style.css">
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
              <a href="acc-info.php">
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
              <a href="#">
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
                <h1><a href="acc-settingsProfile.php" class="active">Profile</a></h1>
                <hr align="center">
            </div>
          
            <div class="url">
                <h1><a href="acc-changePasss.php">Password</a></h1>
                <hr align="center">
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="main">
        <h2>Account Information</h2>
        <div class="card">
            <div class="card-body">
                <a href="acc-editProf.php"><i class="fa fa-pen fa-xs edit"></i></a>
                <table>
                    <tbody>
                        <th rowspan="10">
                            <img src="<?php echo htmlspecialchars($userImage); ?>" 
                                alt="Profile Image" 
                                class="upload_photo" 
                                style=" width: 200px;
                                  height: 200px;
                                  border-radius: 50%;
                                  margin-bottom: 15px;
                                  object-fit: cover;
                                  margin-right:30px;
                                  margin-left:30px;
                            ">
                        </th>
                        <tr>
                            <td>User ID</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($userId); ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars("$userName $mname $lname"); ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <td>Birthday</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($bday); ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($status); ?></td>
                        </tr>
                        <tr>
                            <td>Sex</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($sex); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





 




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
