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
    echo '<script>alert("Incorrect admin password.");window.location.href = "admin-mdifyCustomer.php";</script>';
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch the current background image path from the database
    $sql = "SELECT background_image FROM homepage LIMIT 1";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Delete the current background image file
        $currentImagePath =  $row['background_image'];
        if (file_exists($currentImagePath)) {
            unlink($currentImagePath); // Remove the file
        }

        // Update the database to remove the background image
        $updateSQL = "UPDATE homepage SET background_image = NULL LIMIT 1"; // Assuming there is only one row in the table
        $updateResult = mysqli_query($con, $updateSQL);

        if ($updateResult) {
            echo '<script>alert("Background Removed.");window.location.href = "admin-modifyCustomer.php";</script>';
        } else {
            echo "Error removing background image: " . mysqli_error($con);
        }
    } else {
        echo "No background image found in the database.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
