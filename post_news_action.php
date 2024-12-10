<?php
    //include "validate_admin.php";
    include "connection.php";
    //include "header.php";
   
 //include "user_navbar.php";
    //include "admin_sidebar.php";
    //include "session_timeout.php";
?>

<!DOCTYPE html>
<html>
<head>
 
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="action_style_news.css">
</head>


<body>
   
 <div class="flex-container">
        <div class="flex-item">
            <?php
            $headline = mysqli_real_escape_string($con, $_POST["headline"]);
      
      $news_details = mysqli_real_escape_string($con, $_POST["news_details"]);

            $sql0 = "INSERT INTO news (title, created)
          
  VALUES('$headline', NOW())";

            $sql1 = "INSERT INTO news_body (body)
            VALUES('$news_details')"; ?>

      
      <?php
            if (($con->query($sql0) === TRUE) && ($con->query($sql1) === TRUE)) { ?>
                <p id="info">
<?php echo "News posted successfully !\n"; ?></p>
            <?php
            } else { ?>
                <p id="info">
<?php
                echo "Server Error !<br>";
                echo "Error: " . $sql0 . "<br>" . $con->error . "<br>";
     
           echo "Error: " . $sql1 . "<br>" . $con->error . "<br>"; ?></p>
            <?php
            }

            $con->close();
       
     ?>
        </div>

        <div class="flex-item">
            <a href="admin_news.php" class="button">Post Again</a>
        </div>

  
  </div>

</body>
</html>
