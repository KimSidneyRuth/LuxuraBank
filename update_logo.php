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

// Check if a logo image file is uploaded
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["logo"]) && !empty($_FILES["logo"]["name"])) {
    $targetDirectory = "picuploads/";
    $targetFile = $targetDirectory . basename($_FILES["logo"]["name"]);

    // Allow only certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (!in_array($imageFileType, $allowedFormats)) {
        die("Invalid file format.");
    }

    // Upload the file
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $targetFile)) {
        // Update the database with the new logo image path
        $updateSQL = "UPDATE homepage SET logo_image = ? LIMIT 1"; // Assuming there is only one row in the table

        $stmt = mysqli_prepare($con, $updateSQL);
        mysqli_stmt_bind_param($stmt, "s", $targetFile);
        mysqli_stmt_execute($stmt);

        if ($stmt) {
            echo "
            <script>
            alert('Logo updated successfully!')
            window.location.href = 'admin-modifyCustomer.php';  // Redirect to the modify_customer page
            </script>";
        } else {
            echo "Error updating logo: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Error moving uploaded file.");
    }
} else {
    // No file uploaded, handle this case if needed
    echo "No logo image file uploaded.";
}

// Close the database connection
mysqli_close($con);
?>
