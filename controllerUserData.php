<?php 
session_start();
require "connection.php";
require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\PHPMailer\PHPMailer\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$email = "";
$name = "";
$userId = "";
$errors = array();

function sendMail($to, $subject, $messageBody) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'luxurabank@gmail.com'; // Replace with your email
        $mail->Password = 'dvck kobd prwp pgjy'; // Replace with your app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('luxurabank@gmail.com', 'LUXURA BANK'); // Adjust sender info
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $messageBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// if user signup button
/*if(isset($_POST['signup'])){
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($con, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $jobTitle = mysqli_real_escape_string($con, $_POST['jobTitle']);
    $employer = mysqli_real_escape_string($con, $_POST['employer']);
    $employmentStatus = mysqli_real_escape_string($con, $_POST['employmentStatus']);
    $employmentLength = mysqli_real_escape_string($con, $_POST['employmentLength']);
    $monthlyIncome = mysqli_real_escape_string($con, $_POST['monthlyIncome']);
    $existingAccounts = mysqli_real_escape_string($con, $_POST['existingAccounts']);
    $otherLoans = mysqli_real_escape_string($con, $_POST['otherLoans']);
    
    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password does not match!";
    }

    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered already exists!";
    }
    if(count($errors) === 0){
        /*$encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users 
        (firstName, middleName, lastName, birthday, email, password, jobTitle, employer, employmentStatus, employmentLength, monthlyIncome, existingAccounts, otherLoans, code, verification_status) 
        VALUES 
        ('$firstName', '$middleName', '$lastName', '$birthday', '$email', '$password', '$jobTitle', '$employer', '$employmentStatus', '$employmentLength', '$monthlyIncome', '$existingAccounts', '$otherLoans', '$code', '$status')";
        
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is <b>$code</b>.  To Access all features, verify your account.";
            if(sendMail($email, $subject, $message)){
                $info = "We've sent a verification code to your email - $email.";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                /*header('location: user-otp.php');
                header('location: login-user.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}*/

function generateUserId()
{
    return str_pad(rand(0, 999999), 6, "0", STR_PAD_LEFT);
}

$error = '';
$success = '';

// Generate User ID
$generatedUserId = generateUserId();
if (isset($_POST['Register'])) {
    $userId = mysqli_real_escape_string($con, $_POST['userId']);
    $firstName = mysqli_real_escape_string($con, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($con, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($con, $_POST['lastName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phone-number']);
    $accountType = mysqli_real_escape_string($con, $_POST['account-type']);
    $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
    $sex = mysqli_real_escape_string($con, $_POST['sex']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirm-password']);

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match!";
    } else {
        $email_check = "SELECT * FROM user WHERE email = '$email'";
        $res = mysqli_query($con, $email_check);
        if (mysqli_num_rows($res) > 0) {
            $error = "Email already exists!";
        } else {
           
            $status = "notverified";
          
           $acc_no = rand(9999999999, 111111111);
            $insertQuery = "INSERT INTO user (userId, firstName, lastName,middleName, email, accountType, account_no, phoneNumber, birthday, sex, password, verification_status) 
                            VALUES ('$userId', '$firstName', '$lastName', '$middleName', '$email', '$accountType', '$acc_no','$phoneNumber', '$birthday', '$sex', '$password', '$status')";

            $data_check = mysqli_query($con, $insertQuery);
            if ($data_check) {
                $subject = "Sucessfully Registered!";
                $message = "Dear, $firstName, you are now registerd in Luxura Bank. Your user id is <b>$userId</b>.  To access all features, verify your account.";
                $message2 = "Dear, $firstName, your account number is  <b>$acc_no</b> . Keep your information secured. To access all features, verify your account.";
                if(sendMail($email, $subject, $message, $message2)){
                    
                    $info = "We've sent your account number to your email - $email.";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['accountType'] = $user_data['accountType'];
                    $_SESSION['account_no'] = $_SESSION['account_no'];
                    /*header('location: user-otp.php');*/
                    header('location: login-user.php');
                    exit();
                }
                if ($data_check) {
                    $subject = "Account Number";
                    $message = "Dear, $firstName, your account number is  <b>$acc_no</b> for your . Keep your information secured. To access all features, verify your account.";
                    if(sendMail($email, $subject, $message)){
                        
                        $info = "We've sent your account number to your email - $email.";
                        $_SESSION['info'] = $info;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        $_SESSION['accountType'] = $user_data['accountType'];
                        /*header('location: user-otp.php');*/
                        header('location: login-user.php');
                        echo "alert('Registered Successfully')";
                        exit();
                    }
            } else {
                $error = "Failed to register user!";
            }
        }
    }
}
}




// if user click verification code submit button
/*if (isset($_POST['check'])) {
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM user WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    
    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $status = 'verified';
        $update_otp = "UPDATE users SET code = 0, verification_status = '$status' WHERE code = $otp_code";
        
        if (mysqli_query($con, $update_otp)) {
            $_SESSION['firstName'] = $fetch_data['firstName'];
            $_SESSION['email'] = $fetch_data['email'];
            header('location: home.php');
            exit();
        } else {
            $errors['otp-error'] = "Failed while updating code!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}*/
// if user click continue button in forgot password form
if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM user WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111);
        $insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($con, $insert_code);
        if($run_query){
            $subject = "Password Reset Code";
            $message = "Your password reset code is <b>$code</b>";
            if(sendMail($email, $subject, $message)){
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

// if user click check reset otp button
if(isset($_POST['check-reset-otp'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM user WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// if user click change password button
if(isset($_POST['change-password'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        /*$encpass = password_hash($password, PASSWORD_BCRYPT);*/
        $update_pass = "UPDATE user SET code = $code, password = '$password' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if($run_query){
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}


/*if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if email exists in the database
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);
    
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $stored_pass = $fetch['password']; // Get plain text password from DB
        $status = $fetch['verification_status'];

        // Compare the entered password with the plain text password stored in DB
        if ($password === $stored_pass) {
            // Check if email is verified
            if ($status == 'verified') {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: home.php');
                
            } else {
                $info = "It looks like you haven't verified your email - $email";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
                exit();
            }
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It looks like you're not yet a member! Click on the signup link to register.";
    }
}
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if email exists in the database
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $stored_pass = $fetch['password'];
        /*$status = $fetch['verification_status'];

        // Compare the entered password with the stored password
        if ($password === $stored_pass) {
            // Login successful
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            // Check if email is verified
            /*if ($status != 'verified') {
                $info = "Please verify your email to access all features.";
                $_SESSION['info'] = $info;
            }

            header('location: home.php');
            exit();
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It looks like you're not yet a member! Click on the signup link to register.";
    }
}*/
/*if (isset($_POST['login'])) {
    $name = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if email exists in the database
    $check_email = "SELECT * FROM users WHERE firstName = '$name'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $stored_pass = $fetch['password'];
        $status = $fetch['verification_status']; // Assuming 'verification_status' column exists

        // Compare the entered password with the stored password
        if ($password === $stored_pass) {
            // Login successful
            $_SESSION['email'] = $name;
            $_SESSION['password'] = $password;

            // Check if email is not verified
            /*if ($status != 'verified') {
                $_SESSION['info'] = "Please verify your email to access all features.";
                header('location: user-otp.php'); // Redirect to a verification page
            } else {
                header('location: home.php'); // Redirect to home if verified
            }
            header('location: home.php');
            exit();
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It looks like you're not yet a member! Click on the signup link to register.";
    }
}*/
/*if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $usertype = $_POST['usertype'] ?? 'user'; // Default to 'user' if not set
    $username = mysqli_real_escape_string($con, $_POST['email']);
    

    if ($usertype === 'admin') {
        // Skip email check and handle admin login independently
        $admin_check = "SELECT * FROM users WHERE firstName = '$username' AND usertype = 'admin'";
        $res = mysqli_query($con, $admin_check);

        if (mysqli_num_rows($res) > 0) {
            $fetch = mysqli_fetch_assoc($res);
            $stored_pass = $fetch['password'];

            // Verify password for admin
            if ($password === $stored_pass) {
                $_SESSION['email'] = $email;
                $_SESSION['usertype'] = 'admin';
                header('location: creditcard.php'); // Go to admin page
                exit();
            } else {
                $errors['login-error'] = "Incorrect admin password!";
            }
        } else {
            $errors['login-error'] = "Admin account not found with this email!";
        }
    } else {
        // Regular user login logic
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);

        if (mysqli_num_rows($res) > 0) {
            $fetch = mysqli_fetch_assoc($res);
            $stored_pass = $fetch['password'];
            $status = $fetch['verification_status'];

            if ($password === $stored_pass) {
                $_SESSION['email'] = $email;
                header('location: homepage.php');


                /*if ($status != 'verified') {
                    $_SESSION['info'] = "Please verify your email.";
                    header('location: verification_page.php');
                } else {
                    header('location: homepage.php');
                }
                exit();
            } else {
                $errors['login-error'] = "Incorrect email or password!";
            }
        } else {
            $errors['$email'] = "Not a registered member! Click signup to register.";
        }
    }
}*/
/*if (isset($_POST['login'])) {
    $id = mysqli_real_escape_string($con, $_POST['userId']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

   
        

    
    
    // Query to check if email exists in the database
    $check_email = "SELECT * FROM user WHERE userId = '$id'";
    $res = mysqli_query($con, $check_email);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $stored_pass = $fetch['password'];
        $status = $fetch['verification_status']; // Ensure 'verification_status' column exists
        $usertype = $fetch['usertype']; // Ensure 'usertype' column exists with 'user' or 'admin' values

        // Compare entered password with stored password
        if ($password === $stored_pass) {
            $_SESSION['firstName'] = $name;

            // Redirect based on user type and verification status
            if ($usertype === 'admin') {
                // Admin login: skip verification and redirect directly
                header('location: creditcard.php');
            } else if ($usertype === 'user') {
                // User login: check if verified
                if ($status != 'verified') {
                    $_SESSION['info'] = "Please verify your email to access all features.";
                    header('location: verification_page.php'); // Replace with the actual verification page for users
                } else {
                    header('location: homepage.php'); // Redirect verified users to homepage
                }
            } else {
                $errors['login-error'] = "Unrecognized user type!";
            }
            exit();
        } else {
            $errors['login-error'] = "Incorrect email or password!";
        }
    } else {
        $errors['name'] = "It looks like you're not yet a member! Click on the signup link to register.";
    }
}*/





// Handle verification code generation and sending
if (isset($_POST['verify'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $check_email = "SELECT * FROM user WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);

    if (mysqli_num_rows($run_sql) > 0) {
        $code = rand(999999, 111111); // Generate random 6-digit code
        $insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
        $run_query = mysqli_query($con, $insert_code);

        if ($run_query) {
            $subject = "Your Verification Code";
            $message = "Good day! Your verification code is <b>$code</b>. Enjoy seamless bank transactions!";
            
            if (sendMail($email, $subject, $message)) {
                $info = "We've sent your verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: confirmVerification.php'); // Redirect to verification page
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending the verification code!";
            }
        } else {
            $errors['db-error'] = "Something went wrong! Please try again.";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}

// Handle verification code submission
if (isset($_POST['check'])) {
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $email = $_SESSION['email']; // Retrieve the email from session

    $check_code = "SELECT * FROM user WHERE code = $otp_code AND email = '$email'";
    $code_res = mysqli_query($con, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        $update_status = "UPDATE user SET verification_status = 'verified' WHERE email = '$email'";
        $update_res = mysqli_query($con, $update_status);

        if ($update_res) {
            $_SESSION['info'] = "Your account has been successfully verified!";
            header('location: acc-editProf.php'); // Redirect to account settings page
            exit();
        } else {
            $errors['db-error'] = "Failed to update verification status!";
        }
    } else {
        $errors['otp-error'] = "Invalid verification code!";
    }
}



if (isset($_POST['login'])) {
    
    $id = isset($_POST['userId']) ? mysqli_real_escape_string($con, $_POST['userId']) : null;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($con, $_POST['password']) : null;

    if (empty($id) || empty($password)) {
        echo "User ID and Password are required!";
        exit();
    }

   
    $admin_query = "SELECT * FROM admin WHERE id = '$id'";
    $admin_result = mysqli_query($con, $admin_query);

    if (mysqli_num_rows($admin_result) > 0) {
       
        $admin_data = mysqli_fetch_assoc($admin_result);
        if ($password === $admin_data['password']) { // Use password_verify() if passwords are hashed
           
            $_SESSION['id'] = $admin_data['id'];
            $_SESSION['role'] = 'admin';
            $_SESSION['name'] = $admin_data['name'];
            echo "alert('Login Successfully')";
            header('location: admin-dash.php'); // Redirect admin to dashboard
            exit();
        } else {
           
        }
    } else {
        // Query the user table
        $user_query = "SELECT * FROM user WHERE userId = '$id'";
        $user_result = mysqli_query($con, $user_query);

        if (mysqli_num_rows($user_result) > 0) {
            // Regular user found
            $user_data = mysqli_fetch_assoc($user_result);
            if ($password === $user_data['password']) { 
                
                $_SESSION['userId'] = $user_data['userId'];
                $_SESSION['role'] = 'user';
                $_SESSION['firstName'] = $user_data['firstName'];
                $_SESSION['middleName'] = $user_data['middleName'];
                $_SESSION['lastName'] = $user_data['lastName'];
                $_SESSION['birthday'] = $user_data['birthday'];
                $_SESSION['sex'] = $user_data['sex'];
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['middleName'] = $user_data['middleName'];
                $_SESSION['accountType'] = $user_data['accountType'];
                $_SESSION['account_no'] = $user_data['account_no'];
                $_SESSION['verification_status'] = $user_data['verification_status'];
                $_SESSION['middleName'] = $user_data['middleName'];
                $userImage = $user_data['image'] ? 'uploaded_img/' . $user_data['image'] : 'img/default-avatar.png';


                header('location: customer-side.php'); 
                exit();
            } 
        } else {
            $errors['login-error'] = "Unrecognized user type!";
            exit();
        }
    } 
    $errors['login-error'] = "Incorrect Password or User ID!";

}
    




if(isset($_POST['login-ad'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to check admin credentials
    $admin_check = "SELECT * FROM users WHERE firstName = '$username' AND usertype = 'admin'";
    $res = mysqli_query($con, $admin_check);

    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $stored_pass = $fetch['password'];

        // Check if the entered password matches
        if ($password === $stored_pass) {
            // Successful admin login
            $_SESSION['firstName'] = $username;
            $_SESSION['usertype'] = 'admin';
            header('location: creditcard.php'); // Redirect to admin-specific page
            exit();
        } else {
            // Password mismatch
            return "Incorrect admin password!";
        }
    } else {
        // Admin account not found
        return "Admin account not found with this email!";
    }
}






// if login now button click
if(isset($_POST['login-now'])){
    /*header('Location: login-user.php');*/
    header('Location: home.php');

}
?>
