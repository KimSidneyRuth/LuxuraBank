<?php
require "connection.php";

// Function to generate a 6-digit User ID
function generateUserId()
{
    return str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);
}

// Generate User ID
$generatedUserId = generateUserId();

// Handle form submission
if (isset($_POST['register'])) {
    $userId = mysqli_real_escape_string($con, $_POST['userId']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phone-number']);
    $accountType = mysqli_real_escape_string($con, $_POST['account-type']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm-password']);

    // Error checks
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match!";
    } else {
        // Insert user data into the database
        $insertQuery = "INSERT INTO user (userId, firstName, lastName, email, phoneNumber, accountType, password) 
                        VALUES ('$userId', '$firstName', '$lastName', '$email', '$phoneNumber', '$accountType', '$password')";

        if ($con->query($insertQuery)) {
            $success = "Registration successful! Your User ID is $userId.";
        } else {
            $error = "Error: " . $con->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Your Account</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="wrapper">
        <div id="kim" style="text-align: center; margin-bottom: 20px;">
            <img src="img/luxura-nav.png" alt="" style="width: 200px;">
        </div>
        <hr>
        <h4 class="subtitle">Registration - New User</h4>
        <h6 class="asterisk">Mandatory fields are marked with an asterisk (*)</h6>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <?php if (isset($success)) { echo "<p style='color: green;'>$success</p>"; } ?>
        <form method="POST" action="">
            <div class="form">

                <!-- Auto-generated User ID -->
                <div class="inputfield">
                    <label for="userid">User ID *</label>
                    <input type="text" id="userId" name="userId" class="input" value="<?php echo $generatedUserId; ?>" readonly>
                </div>

                <!-- First Name -->
                <div class="inputfield">
                    <label for="firstName">First Name *</label>
                    <input type="text" id="firstName" name="firstName" class="input" placeholder="First Name" required>
                </div>

                <!-- Last Name -->
                <div class="inputfield">
                    <label for="lastName">Last Name *</label>
                    <input type="text" id="lastName" name="lastName" class="input" placeholder="Last Name" required>
                </div>

                <!-- Email -->
                <div class="inputfield">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" class="input" placeholder="example@gmail.com" required>
                </div>

                <!-- Mobile Number -->
                <div class="inputfield">
                    <label for="phone-number">Mobile Number *</label>
                    <input type="tel" id="phone-number" name="phone-number" class="input" placeholder="Enter your phone number" required>
                </div>

                <!-- Account Type -->
                <div class="inputfield">
                    <label for="account-type">Account Type *</label>
                    <select id="account-type" name="account-type" class="input" required>
                        <option value="">--Select Account Type--</option>
                        <option value="Checking Account">Checking Account</option>
                        <option value="Savings Account">Savings Account</option>
                        <option value="Credit Account">Credit Account</option>
                        <option value="Fixed Deposit Account">Fixed Deposit Account</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="inputfield">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" class="input" placeholder="Create a password" required>
                </div>

                <!-- Confirm Password -->
                <div class="inputfield">
                    <label for="confirm-password">Confirm Password *</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="input" placeholder="Confirm your password" required>
                </div>

                <!-- Submit and Reset Buttons -->
                <div class="inputfield btns">
                    <button type="submit" name="register" class="btn">Register</button>
                    <button type="reset" class="btn">Reset</button>
                </div>

            </div>
        </form>
    </div>
</body>
</html>
