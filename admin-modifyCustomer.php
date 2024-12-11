<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Customer Page</title>

    <style>
                            body {
    font-family:'Times New Roman', Times, serif;
    background-color: white;
    margin: 0;
    padding: 0;
}

h2 {
    color: black;
    text-align: center;
    font-size: 60px;
}

.bg-updater,
.color-updater,
.logo-updater,
.slideshow-updater {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 20px;
    padding: 20px;
    box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
}

form {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 8px;
    color: black;
    font-size: 30px;
}

input[type="file"],
input[type="color"] {
    width: 40%;
    height: 50px;
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
    font-size: 30px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 30px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.checkbox-label {
    display: inline-block;
    margin-right: 10px;
    color: #555;
    padding: 10px;
}

.checkbox-label input {
    margin-right: 35px;
    font-size: 40px;
    transform: scale(1.5);
}

#arrow {
            position: absolute;
            top: 20px;
            left: 20px;
            text-decoration: none;
            color: black;
        }
    </style>
   

   <script>
function validatePassword(form) {
    var password = prompt("Please enter the admin password:");

    // Check if the password is correct
    if (password !== null) {
        // Add an input field to the form to store the entered password
        var passwordInput = document.createElement("input");
        passwordInput.type = "hidden";
        passwordInput.name = "password";
        passwordInput.value = password;
        form.appendChild(passwordInput);

        // Submit the form
        form.submit();
    } else {
        // Display an error message
        alert("Incorrect admin password. Form submission aborted.");
    }
}

</script>

</head>
<body>

<?php

include 'connection.php';
include 'isadminlogin.php'; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which form was submitted and include the corresponding update script
    if (isset($_POST["update_logo"])) {
        include 'update_logo.php';
    } elseif (isset($_POST["update_slideshow"])) {
        include 'update_slideshow.php';
    } elseif (isset($_POST["update_captions"])) {
        include 'update_captions.php';
    } elseif (isset($_POST["update_background"])) {
        include 'update_bg.php';
    } elseif (isset($_POST["update_color"])) {
        include 'update_color.php';
    }
}

?>
 <a href="admin-dash.php" id="arrow"> <!-- Arrow Link to Homepage -->
        <svg width="54" height="74" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20 12H4" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10 18L4 12L10 6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
<h2>Customer Page Modification</h2>

<div class="bg-updater">

<!-- Form for changing website background -->
<form action="update_bg.php" method="post" enctype="multipart/form-data">
    <label for="background">Upload Background Image:</label>
    <input type="file" name="background_image" accept="image/*"><br>

    <input type="submit" value="Update Background" onclick="validatePassword(this.form)">
</form>
<!-- Form for removing website background -->
<form action="remove_background.php" method="post">
    <input type="submit" value="Remove Background" onclick="validatePassword(this.form)">
</form>

</div>

<div class="color-updater">
    <!-- Form for changing website color background and font color -->
    <form action="update_color.php" method="post">
        <label for="background_color">Website Background Color:</label>
        <input type="color" name="background_color"><br>

        <label for="font_color">Website Font Color:</label>
        <input type="color" name="font_color"><br>

        <input type="submit" value="Update Color" onclick="validatePassword(this.form)">
    </form>
</div>


<div class="logo-updater">
<!-- Form for changing the logo -->
<form action="admin-modifyCustomer.php" method="post" enctype="multipart/form-data">
    <label for="logo">New Logo:</label>
    <input type="file" name="logo" accept="image/*"><br>
    <input type="submit" name="update_logo" value="Update Logo" onclick="validatePassword(this.form)">
</form>
</div>

<div class="slideshow-updater">
<!-- Form for updating slideshow -->
<form action="update_slideshow.php" method="post" enctype="multipart/form-data">
    <?php
    // Fetch the current slideshow images from the database
    $sql = "SELECT slideshow_image1, slideshow_image2, slideshow_image3 FROM homepage LIMIT 1"; // Assuming there is only one row in the table
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_assoc($result);

    for ($i = 1; $i <= 3; $i++) {
        echo '<label for="image_' . $i . '">Image ' . $i . ':</label>';
        echo '<input type="file" name="image_' . $i . '">';

        echo '<input type="hidden" name="current_image_' . $i . '" value="' . $row['slideshow_image' . $i] . '">';

        echo '<label for="update_image_' . $i . '">Update Image ' . $i . ':</label>';
        echo '<input type="checkbox" name="update_image_' . $i . '" checked><br>';
    }
    ?>

    <input type="submit" value="Update Slideshow" onclick="validatePassword(this.form)">
</form>

</div>

</body>
</html>