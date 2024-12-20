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
          <a href="customer-side.php">
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
          <a href="acc-settings.php" >
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
                <h2><a href="" class="active">Add Acc Type</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="#settings">Manage Acc Type</a></h2>
                <hr align="center">
            </div>-->
            <div class="url">
                <h2><a href="admin-openAcc.php">Open Account</a></h2>
                <hr align="center">
            </div>
            <div class="url">
                <h2><a href="">Manage Acc Openings</a></h2>
                <hr align="center">
            </div>
        </div>
    </div>

    <style>
      .form-container {
            max-width: 1200px;
            margin: 0 auto;
            border: 1px solid #e2e2e2;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 70px;
        }

        .form-header {
            background-color: #d4bee4;
            color: white;
            padding: 15px 20px;
            font-size: 20px;
        }

        .form-content {
            padding: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            color: #333;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-input.readonly {
            background-color: #f5f5f5;
        }

        .editor-container {
            margin-top: 20px;
        }

        .editor-toolbar {
            border: 1px solid #ddd;
            border-bottom: none;
            border-radius: 4px 4px 0 0;
            padding: 8px;
            background-color: #f5f5f5;
        }

        .editor-button {
            padding: 4px 8px;
            background: none;
            border: none;
            margin-right: 4px;
            cursor: pointer;
            color: #666;
        }

        .editor-button:hover {
            background-color: #e0e0e0;
            border-radius: 4px;
        }

        .editor-content {
            border: 1px solid #ddd;
            border-radius: 0 0 4px 4px;
            min-height: 200px;
            padding: 12px;
        }

        .submit-button {
            background-color: #d4bee4;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        .submit-button:hover {
            background-color: #7e57c2;
        }
    </style>
    <form action="admin-acc.php" METHOD= "POST">
    <div class="form-container">
        <div class="form-header">
            Please Fill All the Fields
        </div>
        <div class="form-content">
            <form>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Account Category Name</label>
                        <input type="text" class="form-input" name = "name">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Account Category Rates % Per Year</label>
                        <input type="text" class="form-input" name = "rate" >
                    </div>
                    <div class="form-group">
                        <label class="form-label">Account Category Code</label>
                        <input type="text" class="form-input readonly" readonly name ="code" >
                    </div>
                </div>

                <div class="editor-container">
                    <label class="form-label">Account Category Description</label>
                    <div class="editor-toolbar">
                        <button type="button" class="editor-button">B</button>
                        <button type="button" class="editor-button"><i>I</i></button>
                        <button type="button" class="editor-button">•</button>
                        <button type="button" class="editor-button">1.</button>
                        <button type="button" class="editor-button">⇤</button>
                        <button type="button" class="editor-button">⇥</button>
                        <button type="button" class="editor-button">🔗</button>
                        <button type="button" class="editor-button">↺</button>
                        <button type="button" class="editor-button">?</button>
                    </div>
                    <div class="editor-content" contenteditable="true" name ="description"></div>
                </div>

                <button type="submit" class="submit-button" name = "create_acc_type">Add Account Type</button>
            </form>
        </div>
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
