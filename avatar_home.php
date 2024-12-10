

<?php

/*include 'connection.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:avatar-login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:avatar-login.php');
}*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="avatar.css">

</head>
<body>
   
<div class="container">

   <div class="profile">
      <?php
         $select = mysqli_query($con, "SELECT * FROM `user` WHERE userId = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['Image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['Image'].'">';
         }
      ?>
      <h3><?php echo $fetch['firstName']; ?></h3>
      <a href="avatar_updateProf.php" class="btn">update profile</a>
      <a href="avatar_home.php?logout=<?php echo $user_id; ?>" class="delete-btn">logout</a>
      <p>new <a href="avatar-login.php">login</a> or <a href="avatar_register.php">register</a></p>
   </div>

</div>

</body>
</html>