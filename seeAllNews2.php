<?php


include "connection.php";
session_start();


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




?>

<?php if (isset($_GET['message'])): ?>
    <?php if ($_GET['message'] === 'deleted'): ?>
        <p style="color: green; text-align: center;">News item deleted successfully!</p>
    <?php elseif ($_GET['message'] === 'multiple_deleted'): ?>
        <p style="color: green; text-align: center;">Selected news items deleted successfully!</p>
    <?php elseif ($_GET['message'] === 'error'): ?>
        <p style="color: red; text-align: center;">Error deleting news item(s). Please try again.</p>
    <?php endif; ?>
<?php endif; ?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title> Announcements | Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <link rel="stylesheet" href="dropdown.css">
    <!--<link rel="stylesheet" href="customer_add_style.css">-->
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      .sidebar{
        margin-top: 0;
      }
    </style>
  </head>
  <body>
    <form action="admin-accSettings.php" method = "POST"></form>
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
          <a href="seeAllNews2.php" class="active">
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
          <a href="#">
            <i class="bx bx-heart"></i>
            <span class="links_name">Customer Page</span>
          </a>
        </li>
        <li>
          <a href="admin-accSettings.php">
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
          <span class="dashboard">Announcements</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Search..." />
          <i class="bx bx-search"></i>
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
            #arrow {
            position: absolute;
            top: 0px;

            left: 20px;
            text-decoration: none;
            color: black;
        }

        </style>



</nav>

    <?php
      $select = mysqli_query($con, "SELECT * FROM `admin` WHERE id = '$id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>


<form action="allnewsAct.php" method = "POST" enctype="multipart/form-data">

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

<a href="admin_news.php" id="arrow"> <!-- Arrow Link to Homepage -->
        <svg width="54" height="74" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 12H4" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10 18L4 12L10 6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
<div class="flex-container" style=" margin-top:100px">
      
            <?php
                $sql0 = "SELECT id, title, created FROM news ORDER BY created DESC";
                $result = $con->query($sql0);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $sql1 = "SELECT body FROM news_body WHERE id=$id";
                        $result1 = $con->query($sql1); 
                        ?>

                        <div class="flex-item">
                            <!-- Checkbox for selecting news item -->
                           
                            
                            <div class="flex-container-title">
                                <h1 id="title"><?php echo htmlspecialchars($row["title"]); ?></h1>
                                <input type="checkbox" id="news-checkbox" name="delete_ids[]" value="<?php echo $id; ?>">
                            </div>
                            <div class="flex-container-title">
                                <p id="date">Date: <?php echo date("d/m/Y", strtotime($row["created"])); ?></p>
                            </div>
                            <div class="flex-container-body">
                                <p id="news_body">
                                    <?php 
                                        while($row1 = $result1->fetch_assoc()) {
                                            echo htmlspecialchars($row1["body"]); 
                                        }
                                    ?>
                                </p>
                            </div>
                            
                            <!-- Individual Delete Button -->
                            <div class="flex-container-actions">
                                <button type="submit" name="delete" value="<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                <button type="submit" name="update" value="<?php echo $id; ?>">Update</button>
                            </div>
                        </div>
                       
                    <?php }
                } else {
                    echo "No news available! Please post some.";
                }
                $con->close();
            ?>
            <!-- Button to delete all selected items -->
            <button  type="submit" id="delete_selected" onclick="return confirm('Are you sure you want to delete the selected news items?');">Delete Selected</button>
        </form>
    </section>
    </div>


</form>
<style>
      .sidebar{
      position: fixed;
      top:0;
      }
      /* New styles for announcements */
      .flex-container {
       
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 20px;
        background-color: #f0e6f5;
      }
      .flex-item {
        flex: 1 1 300px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        font-family: 'Poppins', sans-serif;
      }
      .flex-container-title {
        background-color: #d4bee4;
        padding: 15px;
        color: #333;
      }
      .flex-container-title h1 {
        font-size: 1.2rem;
        margin-bottom: 5px;
      }
      .flex-container-title p {
        font-size: 0.9rem;
        color: #666;
      }
      .flex-container-body {
        padding: 15px;
        color: #333;
      }
      .flex-container-actions {
        padding: 15px;
        text-align: right;
      }
      .flex-container-actions button {
        padding: 8px 15px;
        margin-left: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        transition: background-color 0.3s ease;
      }
      .flex-container-actions button:first-child {
        background-color: #ff6b6b;
        color: white;
      }
      .flex-container-actions button:last-child {
        background-color: #4ecdc4;
        color: white;
      }
      .flex-container-actions button:hover {
        opacity: 0.9;
      }


      #delete_selected {
    display: block;
    margin: 20px auto;
    padding: 10px 20px;
    background-color: #d4bee4;
    color: #333;
    border: none;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.1s ease;
}

#delete_selected:hover {
    background-color: #c3a4d8;
}

#delete_selected:active {
    transform: scale(0.98);
}


#flex-container-title {
    display: flex;
    align-items: center; /* Aligns items vertically */
    background-color: #d4bee4;
    padding: 15px;
    color: #333;
}


#news-checkbox {
    position: absolute;
    top:50px;
    left:1000px;
    margin-right: 10px; /* Space between checkbox and title */
    cursor: pointer; /* Change cursor to pointer for better UX */
    width: 20px; /* Adjust size of checkbox */
    height: 20px; /* Adjust size of checkbox */
}
    

      
    </style>

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