<?php require_once "controllerUserData.php"; 

/*if (!isset($_SESSION['access_granted']) || $_SESSION['access_granted'] !== true) {
    header("Location: admin-otp.php"); // Redirect if access code is not entered
    exit();
}*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <form action="admin-login.php" method="POST" autocomplete="">
                <div id="kim" style="text-align: center; margin-bottom: 20px;">
                 <img src="img/luxura-nav.png" alt="" style="width: 150px;">
                        </div>
                    <h2 class="text-center">Admin Login</h2>
                    <p class="text-center">Login with your username and password.</p>
                    
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="tel" name="userId" placeholder="Username" required value="<?php echo $userId ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login-ad" value="Login">
                    </div>
                   
                    
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>