<?php require_once "controllerUserData.php"; 

if (isset($_SESSION['login-error'])) {
    echo "<p style='color: red;'>" . $_SESSION['login-error'] . "</p>";
    unset($_SESSION['login-error']); // Clear error after displaying
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
            <form action="login-user.php" method="POST">
                <div id="kim" style="text-align: center; margin-bottom: 20px;">
                 <img src="img/luxura-nav.png" alt="" style="width: 150px;">
                        </div>

                    <h2 class="text-center">Sign In</h2>
                    <p class="text-center">Login with your user id and password.</p>
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
                    <!--<div class="form-group">
                        <input class="form-control" type="text" name="email" placeholder="Email Address" required value="<?php echo $email ?>">
                    </div>-->
                    <div class="form-group">
                        <input class="form-control" type="tel" id="userId" name="userId" placeholder="User ID" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="link forget-pass text-left"><a href="forgot-password.php">Forgot password?</a></div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                    <div class="link login-link text-center">Not yet a member? <a href="signup-user2.php">Signup now</a></div>
                    <!--<div class="link login-link text-center"><a href="admin-login.php">Login as Admin</a></div>-->
                    
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>