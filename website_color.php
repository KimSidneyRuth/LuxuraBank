<?php
include 'connection.php';

// Fetch website color from the database
$colorQuery = "SELECT website_color, font_color FROM homepage LIMIT 1";
$colorResult = mysqli_query($con, $colorQuery);

if ($colorResult && mysqli_num_rows($colorResult) > 0) {
    $row = mysqli_fetch_assoc($colorResult);
    define('WEBSITE_COLOR', $row['website_color']);
    define('FONT_COLOR', $row['font_color']);

} else {
    // Default color if not found in the database
    define('WEBSITE_COLOR', '#ffffff'); // Change this to your default color
    define('FONT_COLOR', '#000000');
}

// Close the database connection
mysqli_close($con);
?>
