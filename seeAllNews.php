<?php
include "connection.php";
?>

<!-- Success Message Display -->
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
<html>
<head>
<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin-dash.css">
    <!--<link rel="stylesheet" href="news_newstyle.css">-->
 
    
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

    
    </div>
    <div class="flex-container">
        <form method="post" action="allnewsAct.php">
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
                            <input type="checkbox" name="delete_ids[]" value="<?php echo $id; ?>">
                            
                            <div class="flex-container-title">
                                <h1 id="title"><?php echo htmlspecialchars($row["title"]); ?></h1>
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
            <button type="submit" name="delete_selected" onclick="return confirm('Are you sure you want to delete the selected news items?');">Delete Selected</button>
        </form>

        <style>
    body, html {
    height: 100%;
    background-size: cover;
    margin: 0;
}

.flex-container {
    display: flex;
    flex-wrap: wrap;
    width: auto;
    height: auto;
    position: relative;
    top: 70px;
}

.flex-item {
    flex: 1 1 550px;
    background-color: #EEEEEE;
    max-height: 65vh;
    margin: 10px;
    overflow-y: auto;
    box-shadow: 2px 3px 8px #888888;
    border-radius: 4px;
}

.flex-container-title {
    display: flex;
    background-color: #2E7D32;
    padding: 10px;
    align-items: center;
}

.flex-container-body {
    display: flex;
    background-color: #EEEEEE;
    padding: 20px;
}

h1#title {
    font-family: 'Roboto', sans-serif;
    color: #FAFAFA;
    margin-left: 20px;
}

p#date, p#news_body {
    font-family: 'Roboto', sans-serif;
    margin-left: 20px;
}

p#date {
    font-size: 20px;
    color: #FAFAFA;
}

p#news_body {
    font-size: 24px;
}

</style>
    </section>
    </div>


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
