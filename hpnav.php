<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'banking';
$db = new mysqli($host, $user, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
$settings = [
    'header_color' => '#FFFFFF', // Default color or fetched color
    'logo_image' => 'your-logo.png' // Default logo or fetched logo file
];

// Fetch current settings
$settings = $db->query("SELECT * FROM nav_hp WHERE id = 1");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $logo_image = $_FILES['logo_image']['name'];
    $header_color = $_POST['header_color'];

    // If a new logo is uploaded, save the file
    if ($logo_image) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($logo_image);
        move_uploaded_file($_FILES['logo_image']['tmp_name'], $target_file);
        
        // Update logo image in database
        $db->query("UPDATE nav_hp SET logo_image='$logo_image', header_color='$header_color' WHERE id=1");
    } else {
        // If no new logo, update only header color
        $db->query("UPDATE nav_hp SET header_color='$header_color' WHERE id=1");
    }

    header('Location: hpnav.php'); // Redirect after saving
}

?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin - Header Settings</title>
</head>
<body>
    <h1>Update Header Settings</h1>
    <form method="POST" enctype="multipart/form-data">
    <label for="logo_image">Logo Image</label>
    <input type="file" name="logo_image" accept="image/*"><br><br>
    <button style="background-color: blue;" type="submit">Save Changes</button>
    <label for="header_color">Header Background Color (Hex)</label>
    <input type="text" name="header_color" value="<?php echo $settings['header_color']; ?>" placeholder="#FFFFFF" required>

   

    
</form>
</body>
</html>
