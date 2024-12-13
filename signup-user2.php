<?php require_once 'controllerUserData.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Account</title>
    
    <link rel="stylesheet" href="img/signup.css">
</head>
<body>
  <div class="wrapper">
   <div id="kim" style="text-align: center; margin-bottom: 20px;">
                 <img src="img/luxura-nav.png" alt="" style="width: 200px;">
                        </div>


    <hr>
    <hr>
        <h4 class="subtitle">Registration - New User</h4>
        <h6 class="asterisk">Mandatory fields are marked with an asterisk (*)</h6>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        <?php if (isset($success)) { echo "<p style='color: green;'>$success</p>"; }?>

    <form action="signup-user2.php" method = "POST">
      <div class="form">

        <!--<div class="inputfield">
          <label for="">Account Number *</label>
          <input type="tel" class="input" name="account-number" id="account-number" maxlength="11"
            placeholder="Enter your account number" pattern="[3]{1}[8]{1}[0][0-9]{8}"
            title="(Account Number is available in your passbook and/or statement of account)" required>
          

        </div>-->
        <div class="inputfield">
          <label for="">First Name *</label>
          <input type="text" class="input" name="firstName" id="fname" maxlength="100"
            placeholder="First Name">
            <!--title="(Account Number is available in your passbook and/or statement of account)" required>-->

        </div>
        <div class="inputfield">
          <label for="">Middle Name </label>
          <input type="text" class="input" name="middleName" id="mname" maxlength="50"
            placeholder="Middle Name">
            <!--title="(Account Number is available in your passbook and/or statement of account)" required>-->

        </div>
        <div class="inputfield">
          <label for="">Last Name *</label>
          <input type="text" class="input" name="lastName" id="mname" maxlength="50"
            placeholder="Last Name">
            <!--title="(Account Number is available in your passbook and/or statement of account)" required>-->

        </div>
        <div class="inputfield">
          <label for="">Address *</label>
          <input type="text" class="input" name="address"
            placeholder="Enter Address"
            title="(Please enter your address)">
        </div>
        
        <div class="inputfield">
          <label for="">Email Address *</label>
          <input type="text" class="input" name="email"
            placeholder="KimPee@gmail.com"
            title="(Please enter your email address)">
        </div>
        <div class="inputfield">
          <label for="">Valid ID Number*</label>
          <input type="text" class="input" name="validID"
            placeholder="Valid ID Number"
            title="(Please enter your valid id number)">
        </div>


        <div class="inputfield">
          <label for="">Phone Number *</label>
          <div class="custom-select" id="phone-codes">
            <select id="phone-code">
              <option value="+63">+63</option>
            </select>
          </div>
          <input type="tel" class="input" name="phone-number" maxlength="10" id="phone-number"
            placeholder="Enter your phone number" pattern="[7-9]{1}[0-9]{9}"
            title="(Please enter your registered phone number)">
        </div>

        <div class="inputfield">
          <label>Account Type *</label>
          <div class="custom_select">
            <select id="account-type" name="account-type" title="(Select your type of account)" required>
              <option>--Select type of account--</option>
              <option value="Checking Account">Checking Account</option>
              <option value="Savings-Account">Savings Account</option>
              <option value="Credit Account">Salary Account</option>
              <option value="Fixed-Deposit-Account">Fixed Deposit Account</option>
            </select>
          </div>
        </div>

        <div class="inputfield">
          <label for="">Birthdate*</label>
          <input type="date" class="input" name="birthday"
            placeholder="Enter your birthday"
           >
        </div>

        <div class="inputfield">
          <label for="">Sex *</label>
          <input type="radio" name="sex" id="radio" value="Male">Male
          <input type="radio" name="sex" id="radio" value="Female">Female
        </div>

        <div class="inputfield">
                    <label for="userId">User ID *</label>
                    <input type="text" id="userId" name="userId" class="input" value="<?php echo $generatedUserId; ?>" readonly>
                </div>

        <div class="inputfield">
          <label>Password *</label>
          <input type="password" class="input" id="password" name="password" placeholder="Create your password min 8 characters"
            autocomplete="off"
            title="(Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters)"
            maxlength="100" minlength="8" required>
        </div>

        <div class="inputfield">
          <label>Confirm Password *</label>
          <input type="password"  class="input" id="confirm-password" name="confirm-password"
            placeholder="Confirm password" autocomplete="off"
            title="(Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters)"
            maxlength="100" minlength="8" required>
        </div>
        <p id="message"></p>
       

   
        


        <div class="inputfield btns" id="btn">
          <button type="submit" name="Register" class="btn" onsubmit = checkPassword()>Register</button>
          <button type="reset" value="Reset" class="btn">Reset</button>
        </div>
        <div class="link">Already a member? <a href="login-user.php">Login here</a></div>
      </div>
    </form>
  
</div>
  <!--<script src="signup.js"></script>-->

</body>

    

</html>