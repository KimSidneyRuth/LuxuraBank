<?php 

include "connection.php";
session_start();




if (!isset($_SESSION['id'])) {

 
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




if (isset($_POST['create_acc_type'])) {

    //Register  account type
    $name = $_POST['name'];
    $description = $_POST['description'];
    $rate = $_POST['rate'];
    $code = $_POST['code'];

    //Insert Captured information to a database table
    $query = "INSERT INTO acc_types (name, description, rate, code) VALUES (?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    //bind paramaters
    $rc = $stmt->bind_param('ssss', $name, $description, $rate, $code);
    $stmt->execute();

    //declare a varible which will be passed to alert function
    if ($stmt) {
        alert("success", "Account Category Created!");
    } else {
        alert("error", "Please Try Again!");
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
          <a href="admin-dash.php">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="admin-clients.php" class = "active">
            <i class="bx bx-user"></i>
            <span class="links_name">Clients</span>
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
          <a href="admin-customerPage">
            <i class="bx bx-book-alt"></i>
            <span class="links_name">Announcements</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span class="links_name">Reports</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-message"></i>
            <span class="links_name">Payment History</span>
          </a>
        </li>
        <li>
          <a href="admin-customerPageEdit.php">
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
          <span class="dashboard">Clients</span>
        </div>
        <div class="searh-box">
          
          <img src="img/luxura-nav.png" alt="">
        </div>

        <div class="profile-dropdown">
        <div onclick="toggle()" class="profile-dropdown-btn">
            <div class="profile-img">
            <img src="<?php echo htmlspecialchars($adminImage); ?>" alt="Profile Image">
        </div>

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

          <span
            ><?php echo htmlspecialchars($name); ?>
            <i class="fa-solid fa-angle-down"></i>
          </span>
        </div>

        <ul class="profile-dropdown-list">
          
      
        <li class="profile-dropdown-list-item">
            <a href="acc-info.php">
            <div class="profile-img">
            <img src="<?php echo htmlspecialchars($adminImage); ?>" alt="Profile Image">
        </div>
            <span> <?php echo htmlspecialchars($name); ?></span>
            </a>
           
            
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
            <!--<div class="url">
                <h2><a href="">Add Acc Type</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="#settings">Manage Acc Type</a></h2>
                <hr align="center">
            </div>-->
          
        </div>
    </div>
    <style>
        .ulo {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-top: 70px
            
        }

        /* Header section styling */
        .head {
            font-size: 18px;
            font-weight: bold;
            color: #6a1b9a;
            margin-bottom: 20px;
        }

        /* Search bar styling */
        .search {
            margin-bottom: 15px;
        }

        .search input {
            padding: 8px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        /* Header row style */
        table th {
            background-color: #6a1b9a;
            color: white;
        }

        /* Alternating row colors */
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Button styling */
        .btn {
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>

   
    <form action="admin-openAcc.php" METHOD= "POST">
    
    <!--apply the picture in this section-->

    <div class="ulo">
        <!-- Header section to display title -->
        <div class="head">Select any action options to manage your clients.</div>

        <!-- Search bar to filter table entries -->
        <div class="search">
            <label for="search">Search:</label>
            <input type="text" id="search" placeholder="Enter search term...">
        </div>

        <!-- Table to display client details -->
        <table>
            <thead>
                <tr> 
                    <th>#</th>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Account Type</th>
                
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id = "results">
            <?php
                                            //Fetching all the clients to the table.
                                            include "connection.php";

                                          
                                        
                                            $ret = "SELECT * FROM  user ORDER BY RAND() ";
                                            $stmt = $con->prepare($ret);
                                            $stmt->execute(); //ok
                                            $res = $stmt->get_result();
                                            $cnt = 1;

                                            while ($row = $res->fetch_object()) {


                                            ?>
                                            <tr>
                                            <th scope="row" class="align-middle"><?php echo $cnt; ?></th>
                                            <td class="align-middle"><?php echo $row->userId; ?></td>
                                                    <td><?php   echo $row->firstName 
        . (isset($row->middleName) && !empty($row->middleName) ? ' ' . $row->middleName : '') 
        . (isset($row->lastName) && !empty($row->lastName) ? ' ' . $row->lastName : ''); ?></td>
                                                    <td><?php echo $row->accountType; ?></td>
                                                    <td><?php echo $row->phoneNumber; ?></td>
                                                    <td><?php echo $row->email; ?></td>
                                                    <td><?php echo $row->Address; ?></td>
                                                    
                                                    <td>
                                                    <button class="btn">Open Account</button>
                                                    </td>

</tr>

<?php $cnt = $cnt + 1;
} ?>
               
            </tbody>
        </table>
    </div>

    
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
