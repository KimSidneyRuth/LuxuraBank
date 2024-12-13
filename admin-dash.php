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



?>

<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title> Admin Dashboard | Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <link rel="stylesheet" href="dropdown.css">
    <!--<link rel="stylesheet" href="customer_add_style.css">
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
          <a href="admin-dash.php" class="active">
            <i class="bx bx-grid-alt"></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="admin-openAcc.php">
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
        <div class="overview-boxes">
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Order</div>
              <div class="number">40,876</div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bx-user user"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Sales</div>
              <div class="number">38,876</div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bxs-user user two"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Profit</div>
              <div class="number">$12,876</div>
              <div class="indicator">
                <i class="bx bx-up-arrow-alt"></i>
                <span class="text">Up from yesterday</span>
              </div>
            </div>
            <i class="bx bx-user user three"></i>
          </div>
          <div class="box">
            <div class="right-side">
              <div class="box-topic">Total Return</div>
              <div class="number">11,086</div>
              <div class="indicator">
                <i class="bx bx-down-arrow-alt down"></i>
                <span class="text">Down From Today</span>
              </div>
            </div>
            <i class="bx bxs-user user four"></i>
          </div>
        </div>

        <div class="sales-boxes">
          <div class="recent-sales box">
            <div class="title">Top 10 Highest Investors</div>
            <div class="sales-details">
              <ul class="details">
                <li class="topic">Date</li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
                <li><a href="#">02 Jan 2021</a></li>
              </ul>
              <ul class="details">
                <li class="topic">Customer</li>
                <li><a href="#">Alex Doe</a></li>
                <li><a href="#">David Mart</a></li>
                <li><a href="#">Roe Parter</a></li>
                <li><a href="#">Diana Penty</a></li>
                <li><a href="#">Martin Paw</a></li>
                <li><a href="#">Doe Alex</a></li>
                <li><a href="#">Aiana Lexa</a></li>
                <li><a href="#">Rexel Mags</a></li>
                <li><a href="#">Tiana Loths</a></li>
              </ul>
              <ul class="details">
                <li class="topic">Account Number</li>
                <li><a href="#">Delivered</a></li>
                <li><a href="#">Pending</a></li>
                <li><a href="#">Returned</a></li>
                <li><a href="#">Delivered</a></li>
                <li><a href="#">Pending</a></li>
                <li><a href="#">Returned</a></li>
                <li><a href="#">Delivered</a></li>
                <li><a href="#">Pending</a></li>
                <li><a href="#">Delivered</a></li>
              </ul>
              <ul class="details">
                <li class="topic">Amount</li>
                <li><a href="#">$204.98</a></li>
                <li><a href="#">$24.55</a></li>
                <li><a href="#">$25.88</a></li>
                <li><a href="#">$170.66</a></li>
                <li><a href="#">$56.56</a></li>
                <li><a href="#">$44.95</a></li>
                <li><a href="#">$67.33</a></li>
                <li><a href="#">$23.53</a></li>
                <li><a href="#">$46.52</a></li>
              </ul>
            </div>
            <div class="button">
              <a href="#">See All</a>
            </div>
          </div>
          <div class="top-sales box">
            <div class="title">Top Seling Product</div>
            <ul class="top-sales-details">
              <li>
                <a href="#">
                  <img src="images/sunglasses.jpg" alt="" />
                  <span class="product">Vuitton Sunglasses</span>
                </a>
                <span class="price">$1107</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/jeans.jpg" alt="" />
                  <span class="product">Hourglass Jeans </span>
                </a>
                <span class="price">$1567</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/nike-min.jpg" alt="" />
                  <span class="product">Nike Sport Shoe</span>
                </a>
                <span class="price">$1234</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/scarves.jpg" alt="" />
                  <span class="product">Hermes Silk Scarves.</span>
                </a>
                <span class="price">$2312</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/blueBag.jpg" alt="" />
                  <span class="product">Succi Ladies Bag</span>
                </a>
                <span class="price">$1456</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/bag.jpg" alt="" />
                  <span class="product">Gucci Womens's Bags</span>
                </a>
                <span class="price">$2345</span>
              </li>

              <li>
                <a href="#">
                  <img src="images/addidas.jpg" alt="" />
                  <span class="product">Addidas Running Shoe</span>
                </a>
                <span class="price">$2345</span>
              </li>
              <li>
                <a href="#">
                  <img src="images/shirt.jpg" alt="" />
                  <span class="product">Bilack Wear's Shirt</span>
                </a>
                <span class="price">$1245</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      

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
    </script>
  </body>
</html>
