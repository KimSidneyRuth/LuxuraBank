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
    
    $_SESSION['role'] = 'admin';
    $_SESSION['name'] = $adminData['name'];
   
   
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

$slides = $con->query("SELECT * FROM homepage ORDER BY slide_order ASC");

// Handle delete request
if (isset($_GET['delete'])) {
    $slide_id = $_GET['delete'];
    $con->query("DELETE FROM homepage WHERE slide_id = $slide_id");
    header("Location: admin-customerPageEdit.php");
    exit;
}

// Handle form submission for add/edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $slide_order = $_POST['slide_order'];
    $slide_id = isset($_POST['slide_id']) ? $_POST['slide_id'] : null;

    // Image upload
    if (!empty($_FILES['slide_image']['name'])) {
        $image_name = basename($_FILES["slide_image"]["name"]);
        $target_file = "img/" . $image_name;
        move_uploaded_file($_FILES["slide_image"]["tmp_name"], $target_file);
    }

    // Insert or update slide
    if ($slide_id) {
        // Update
        if (isset($target_file)) {
            $con->query("UPDATE homepage SET slide_image = '$target_file', slide_order = $slide_order WHERE slide_id = $slide_id");
        } else {
            $con->query("UPDATE homepage SET slide_order = $slide_order WHERE slide_id = $slide_id");
        }
    } else {
        // Insert
        $con->query("INSERT INTO homepage (slide_image, slide_order) VALUES ('$target_file', $slide_order)");
    }

    header("Location: admin-customerPageEdit.php");
    exit;

}



?>

<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>  Customer Page| Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <link rel="stylesheet" href="dropdown.css">
    <link rel="stylesheet" href="customer_add_style.css">
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="admin-dash.php" method = "POST"></form>
    <div class="sidebar">
      <div class="logo-details">
       
        <span class="logo_name"><div id="kim" style="text-align: center; margin-bottom: 20px; margin-top:10px">
                 <img src="img/luxura-nav.png" alt="" style="width: 170px;">
                        </div></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="#" class="active">
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
          <a href="#">
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
          <span class="dashboard">Dashboard</span>
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

        <ul class="profile-dropdown-list">
          <li class="profile-dropdown-list-item">
            <a href="admin-accSettings.php">
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
            <a href="logout-user.php">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              Log out
            </a>
          </li>
          <li class="profile-dropdown-list-item">
            <a href="#">
              <i class="fa-solid fa-sliders"></i>
              Settings
            </a>
          </li>
</ul>

</nav>

      <div class="home-content">


      <table class="charts-css line">
  
</table>
<div class="container">
        <!--<div class="section">
            <h2>Logo</h2>
            <p>Choose a logo for the extension</p>
            <div class="options">
                <button class="option">Light</button>
                <button class="option">Dark</button>
                <button class="option">System</button>
            </div>
        </div>
        <div class="section">
            <h2>Font</h2>
            <p>Choose a preferred theme for the extension</p>
            <div class="options">
                <button class="option">Sans Serif</button>
                <button class="option">Slab</button>
                <button class="option">Mono</button>
                <button class="option">Rounded</button>
            </div>
            <div class="color-options">
                <div class="color-circle" style="background-color: #c0a9f0;"></div>
                <div class="color-circle" style="background-color: #b0d4f0;"></div>
                <div class="color-circle" style="background-color: #a9f0c0;"></div>
                <div class="color-circle" style="background-color: #f0c0a9;"></div>
                <div class="color-circle" style="background-color: #f0a9d4;"></div>
            </div>
        </div>
        <div class="section">
            <h2>Weather</h2>
            <p>Choose a unit of measurement that is comfortable for you</p>
            <div class="options">
                <button class="option">°C</button>
                <button class="option">°F</button>
            </div>
        </div>
        <div class="section">
            <h2>Background Color</h2>
            <p>Choose a preferred background color</p>
            <div class="color-options">
                <div class="color-circle" style="background-color: #c0a9f0;"></div>
                <div class="color-circle" style="background-color: #b0d4f0;"></div>
                <div class="color-circle" style="background-color: #a9f0c0;"></div>
                <div class="color-circle" style="background-color: #f0c0a9;"></div>
                <div class="color-circle" style="background-color: #f0a9d4;"></div>
            </div>
        </div>
      
        <div class="section">
    <h2>Slideshow</h2>
    <p>Manage your slideshow images</p>
    
    <!-- Display slides in a table -->
    <table class="slideshow-table">
        <thead>
            <tr>
                <th>Order</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $slides->data_seek(0);
            while ($row = $slides->fetch_assoc()): 
            ?>
                <tr>
                    <td><?php echo $row['slide_order']; ?></td>
                    <td><img src="<?php echo $row['slide_image']; ?>" alt="Slide Image" class="slideshow-image"></td>
                    <td>
                        <a href="admin-customerPageEdit.php?edit=<?php echo $row['slide_id']; ?>" class="action-link edit">Edit</a>
                        <a href="admin-customerPageEdit.php?delete=<?php echo $row['slide_id']; ?>" onclick="return confirm('Are you sure you want to delete this slide?')" class="action-link delete">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Add/Edit form (unchanged) -->
    <h3><?php echo isset($_GET['edit']) ? 'Edit Slide' : 'Add Slide'; ?></h3>
    <form action="admin-customerPageEdit.php" method="POST" enctype="multipart/form-data" class="slide-form">
        <?php if (isset($_GET['edit'])): ?>
            <?php
            $slide_id = $_GET['edit'];
            $slide = $con->query("SELECT * FROM homepage WHERE slide_id = $slide_id")->fetch_assoc();
            ?>
            <input type="hidden" name="slide_id" value="<?php echo $slide['slide_id']; ?>">
        <?php endif; ?>

        <div class="form-group">
            <label for="slide_order">Slide Order:</label>
            <input type="number" name="slide_order" id="slide_order" value="<?php echo isset($slide['slide_order']) ? $slide['slide_order'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="slide_image">Slide Image:</label>
            <input type="file" name="slide_image" id="slide_image" <?php echo isset($slide) ? '' : 'required'; ?>>
        </div>

        <button type="submit" class="submit-btn"><?php echo isset($slide) ? 'Update Slide' : 'Add Slide'; ?></button>
    </form>
</div>

<style>
    /* ... (previous styles remain unchanged) ... */

    .slideshow-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .slideshow-table th,
    .slideshow-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .slideshow-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .slideshow-image {
        max-width: 100px;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .action-link {
        display: inline-block;
        padding: 5px 10px;
        margin: 2px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
    }

    .action-link.edit {
        background-color: #4CAF50;
        color: white;
    }

    .action-link.delete {
        background-color: #f44336;
        color: white;
    }

    .slide-form {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .submit-btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }
</style>
      

    </section>

    <script src = "dropdown.js"></script>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };

      document.querySelectorAll('.option').forEach(button => {
            button.addEventListener('click', function() {
                this.parentNode.querySelectorAll('.option').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });

        document.querySelectorAll('.color-circle').forEach(circle => {
            circle.addEventListener('click', function() {
                this.parentNode.querySelectorAll('.color-circle').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    
    </script>
  </body>
</html>