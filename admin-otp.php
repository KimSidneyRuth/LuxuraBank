<?php

$correct_code = "3124"; // Replace with your actual access code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST['otp'];
    if ($entered_code === $correct_code) {
        $_SESSION['access_granted'] = true;
        header("Location: admin-login.php"); // Redirect to the login page
        exit();
    } else {
        $error = "Invalid code. Please try again.";
    }
}
?>

<?php require_once "controllerUserData.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="admin-otp.php" method="POST" autocomplete="off">
                <div id="kim" style="text-align: center; margin-bottom: 20px;">
                 <img src="img/luxura-nav.png" alt="" style="width: 150px;">
                        </div>
                    <h2 class="text-center">Admin Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
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
                        <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>