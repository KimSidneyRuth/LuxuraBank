
<?php
// Include the database connection
include 'connection.php';

// Initialize logo image path
$logoImagePath = 'img/luxura-nav.png';

// Fetch the logo image from the database
$sql = "SELECT logo_image FROM homepage LIMIT 1";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Set the logo image path
    $logoImagePath =  $row['logo_image'];
    echo '<p>Logo Image Path: ' . $logoImagePath . '</p>';
var_dump(file_exists($logoImagePath));

}


?>
