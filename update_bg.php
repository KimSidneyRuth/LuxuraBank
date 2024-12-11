<style>
     #imeds {
            width: 440px;
            height: 440px;
            margin-left: 420px;
         
        }

        .success-message {
            margin-top: 10px;
            margin-bottom: 13px;
            font-size: 85px;
            color: green;
            text-align: center;
        }

        #home-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 18px 42px;
            border-radius: 5px;
            text-align: center;
         
        }
</style>
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
    // Check if a file was uploaded
    if (isset($_FILES['background_image']) && $_FILES['background_image']['error'] === UPLOAD_ERR_OK) {
        // Define the directory where the uploaded images will be stored
        $uploadDirectory = "picuploads/";
        // Ensure the directory exists, or create it if not
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        // Generate a unique filename to avoid overwriting existing files
        $uniqueFilename = uniqid('background_') . '_' . $_FILES['background_image']['name'];
        $targetFile = $uploadDirectory . $uniqueFilename;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['background_image']['tmp_name'], $targetFile)) {
            // Update the background image URL in the database
            $updateSQL = "UPDATE homepage SET background_image = '$targetFile'";
            mysqli_query($con, $updateSQL);

            
            echo '<script>alert("Changes Saved");window.location.href = "modify_customer.php";</script>';
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
mysqli_close($con);
?>
