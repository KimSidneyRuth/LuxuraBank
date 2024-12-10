
<?php

require_once 'db.php'; 
// Fetch slides for display
$slides = $db->query("SELECT * FROM homepage ORDER BY slide_order ASC");

// Handle delete request
if (isset($_GET['delete'])) {
    $slide_id = $_GET['delete'];
    $db->query("DELETE FROM homepage WHERE slide_id = $slide_id");
    header("Location:hpedit.php");
}

// Handle form submission for add/edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $slide_order = $_POST['slide_order'];
    $slide_id = isset($_POST['slide_id']) ? $_POST['slide_id'] : null;

    // Image upload
    if (!empty($_FILES['slide_image']['name'])) {
        $image_name = basename($_FILES["slide_image"]["name"]);
        $target_file = "img/" . $image_name;
        move_uploaded_file($_FILES["slide_image"]["tmp_name"], $target_file);
    }

    // Insert or update slide
    if ($slide_id) {
        // Update
        if (isset($target_file)) {
            $db->query("UPDATE homepage SET slide_image = '$target_file', slide_order = $slide_order WHERE slide_id = $slide_id");
        } else {
            $db->query("UPDATE homepage SET slide_order = $slide_order WHERE slide_id = $slide_id");
        }
    } else {
        // Insert
        $db->query("INSERT INTO homepage (slide_image, slide_order) VALUES ('$target_file', $slide_order)");
    }

    header("Location: hpedit.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Slides</title>
</head>
<body>

<h2>Manage Slides</h2>

<!-- Display slides in a table -->
<table border="1">
    <tr>
        <th>Order</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $slides->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['slide_order']; ?></td>
            <td><img src="<?php echo $row['slide_image']; ?>" width="100" alt="Slide Image"></td>
            <td>
                <a href="hpedit.php?edit=<?php echo $row['slide_id']; ?>">Edit</a> |
                <a href="hpedit.php?delete=<?php echo $row['slide_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<!-- Add/Edit form -->
<h3><?php echo isset($_GET['edit']) ? 'Edit Slide' : 'Add Slide'; ?></h3>
<form action="hpedit.php" method="POST" enctype="multipart/form-data">
    <?php if (isset($_GET['edit'])): ?>
        <?php
        $slide_id = $_GET['edit'];
        $slide = $db->query("SELECT * FROM homepage WHERE slide_id = $slide_id")->fetch_assoc();
        ?>
        <input type="hidden" name="slide_id" value="<?php echo $slide['slide_id']; ?>">
    <?php endif; ?>

    <label for="slide_order">Slide Order:</label>
    <input type="number" name="slide_order" value="<?php echo isset($slide['slide_order']) ? $slide['slide_order'] : ''; ?>" required>
    <br><br>

    <label for="slide_image">Slide Image:</label>
    <input type="file" name="slide_image" <?php echo isset($slide) ? '' : 'required'; ?>>
    <br><br>

    <button type="submit"><?php echo isset($slide) ? 'Update Slide' : 'Add Slide'; ?></button>
    <a href="homepage2.php">Home</a>
</form>

</body>
</html>
