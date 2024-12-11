<!-- website_background.php -->

<?php
// Include the database connection
include 'connection.php';

// Initialize background image path
$backgroundImagePath = 'path/to/default/background.jpg';

// Fetch the background image from the database
$sql = "SELECT background_image FROM homepage LIMIT 1";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Set the background image path
    $backgroundImagePath =  $row['background_image'];
}


?>

<style>
    body {
        background-image: url('<?php echo $backgroundImagePath; ?>');
        /*background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;*/
    }
</style>
