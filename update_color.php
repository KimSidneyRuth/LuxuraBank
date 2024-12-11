<?php
include 'connection.php';
include 'isadminlogin.php';




// Check if the admin password is correct
$adminPassword = $_POST['password'] ?? '';
$sql = "SELECT password FROM admin LIMIT 1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$correctPassword = $row['password'] ?? '';

if ($adminPassword !== $correctPassword) {
    echo '<script>alert("Incorrect admin password.");window.location.href = "admin-modifyCustomer.php";</script>';
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the new color values from the form
    $newBgColor = $_POST['background_color'];
    $newFontColor = $_POST['font_color'];

    // Assuming your database table for settings is named 'website_settings'
    $updateColorSQL = "UPDATE homepage SET website_color = ?, font_color = ?";

    $stmt = mysqli_prepare($con, $updateColorSQL);
    mysqli_stmt_bind_param($stmt, "ss", $newBgColor, $newFontColor);
    mysqli_stmt_execute($stmt);

    if ($stmt) {
        echo "
        <script>
        alert('Website color and font color updated successfully!')
        window.location.href = 'admin-modifyCustomer.php'; // Redirect back to the modification page
        </script>";
    } else {
        echo "Error updating website color and font color: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($con);
?>
