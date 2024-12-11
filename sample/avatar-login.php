<?php

/*include 'connection.php';
session_start();

if(isset($_POST['submit'])){

   $userId = mysqli_real_escape_string($con, $_POST['userId']);
   $pass = mysqli_real_escape_string($con, md5($_POST['password']));

   $select = mysqli_query($con, "SELECT * FROM `user` WHERE userId = '$userId' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['userId'] = $row['userIid'];
      header('location:avatar_home.php');
   }else{
      $message[] = 'incorrect email or password!';
   }*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="avatar.css">

</head>
<body>
   
<div class="form-container">

   <form action="avatar-login.php" method="post" enctype="multipart/form-data">
      <h3>login now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="tel" name="userId" placeholder="enter id" class="box" required>
      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="submit" name="submit" value="login now" class="btn">
      <p>don't have an account? <a href="avatar_register.php">regiser now</a></p>
   </form>

</div>

</body>
</html>