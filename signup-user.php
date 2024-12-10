<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="new.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 form">
                <form action="signup-user.php" method="POST" autocomplete="">
                <div id="kim" style="text-align: center; margin-bottom: 20px;">
                 <img src="img/luxura-nav.png" alt="" style="width: 150px;">
                        </div>

                    <h2 class="text-center">Signup Form</h2>
                    <p class="text-center">It's quick and easy.</p>
                    
                    <?php
                    if (count($errors) == 1) {
                        ?>
                        <div class="alert alert-danger text-center">
                    <?php
                    // Loop through each error message in the $errors array and display it
                                    foreach ($errors as $showerror) {
                                        echo $showerror . "<br>";
                        }
                                            ?>
                        </div>
                        <?php
                    } elseif (count($errors) > 1) {
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach ($errors as $showerror) {
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    
                    <!-- Personal Information -->
                    <div class="form-group">
                        <input class="form-control" type="text" name="firstName" placeholder="First Name" >
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="middleName" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="firstName" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="middleName" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="firstName" placeholder="First Name" >
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="middleName" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="firstName" placeholder="First Name" >
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="middleName" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="middleName" placeholder="Middle Name">
                    </div>
             

                    <div id="kim" style="text-align: center; margin-bottom: 20px;">
                 <img src="img/luxura-nav.png" alt="" style="width: 150px;">
                        </div>

                    <h2 class="text-center">Create You Account</h2>
                    <p class="text-center">It's quick and easy.</p>
                 
                 
                    <h3>Personal Information</h3>

                    
                    <div class="form-group">
                        <input class="form-control" type="text" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="middleName" placeholder="Middle Name">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="lastName" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="date" name="birthday" placeholder="Birthday" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password" required>
                    </div>
                    
                    <!-- Employment Information -->
                    <h3>Employment Information</h3>
                    <div class="form-group">
                        <input class="form-control" type="text" name="jobTitle" placeholder="Job Title" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="employer" placeholder="Employer" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="employmentStatus" placeholder="Employment Status" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="employmentLength" placeholder="Length of Employment" required>
                    </div>
                    
                    <!-- Financial Information -->
                    <h3>Financial Information</h3>
                    <div class="form-group">
                        <input class="form-control" type="number" name="monthlyIncome" placeholder="Monthly Income" required>
                    </div>
                    
                    <!-- Banking Information -->
                    <h3>Banking Information</h3>
                    <div class="form-group">
                        <label>Existing Accounts:</label>
                        <input class="form-control" type="text" name="existingAccounts">
                    </div>
                    <div class="form-group">
                        <label>Other Credit Cards or Loans:</label>
                        <input class="form-control" type="text" name="otherLoans">
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-group">
                        <input class="form-control button btn-primary" type="submit" name="signup" value="Submit">
                    </div>
                    
                    <div class="link login-link text-center">Already a member? <a href="login-user.php">Login here</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
