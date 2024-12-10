<?php


include 'connection.php';

?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title> Admin Dashboard | Luxura Bank</title>
    <link rel="stylesheet" href="admin-dash.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="customer_add_style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <form action="admin_news.php" method = "POST"></form>
    <div class="sidebar">
      <div class="logo-details">
       
        <span class="logo_name"><div id="kim" style="text-align: center; margin-bottom: 20px; margin-top:10px">
                 <img src="img/luxura-nav.png" alt="" style="width: 170px;">
                        </div></span>
      </div>
      <ul class="nav-links">
        <li>
          <a href="#">
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
          <a href="admin_news.php" class = "active">
            <i class="bx bx-calendar"></i>
            <span class="links_name">Announcements</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-coin-stack"></i>
            <span class="links_name">Stock</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-book-alt"></i>
            <span class="links_name">Total order</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-user"></i>
            <span class="links_name">Team</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-message"></i>
            <span class="links_name">Messages</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-heart"></i>
            <span class="links_name">Favrorites</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="bx bx-cog"></i>
            <span class="links_name">Setting</span>
          </a>
        </li>
        <li class="log_out">
          <a href="logout-user.php">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Announcement</span>
        </div>
        <div class="search-box">
          <input type="text" placeholder="Search..." />
          <i class="bx bx-search"></i>
        </div>
        <div class="profile-details">
          <img src="images/slide2.png" alt="" />
          <span class="admin_name">Administrator</span>
          <i class="bx bx-chevron-down"></i>
        </div>
      </nav>
     
<html>


<body>
   
 <form class="news_form" action="post_news_action.php" method="post">
        <div class="flex-container">
            <div class=container>
      
          <label>News Headline :</label><br>
                <input name="headline" size="50" type="text" required />
            </div>
        </div>

   
     <div class="flex-container">
            <div class=container>
                <label>Details :</label><br>
                
<textarea name="news_details" style="height: 200px; width: 60vw;" required /></textarea>
            </div>
        </div>



     
   <div class="flex-container">
            <div class="container">
                <button type="submit">Submit</button>
                
            </div>


 
           <div class="container">
                <button type="reset" class="reset" onclick="return confirmReset();">Reset</button>
            

    

        </div>
       

    </form>

    <script>
    function confirmReset() {
        return confirm('Do you really want to reset?')
    }
   
 </script>
  <div class="container">
            <form action="seeAllNews.php" method = "POST">
            <button type="see">All News</button>
                </form>

        </div>

</body>
</html>

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
  </body>
</html>
