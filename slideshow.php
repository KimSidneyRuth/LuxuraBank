<?php
include "connection.php";.
$slides = $con->query("SELECT * FROM homepage ORDER BY slide_order ASC");

// Handle delete request
if (isset($_GET['delete'])) {
    $slide_id = $_GET['delete'];
    $con->query("DELETE FROM homepage WHERE slide_id = $slide_id");
    header("Location: admin-customerPageEdit.php");
    exit;
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
            $con->query("UPDATE homepage SET slide_image = '$target_file', slide_order = $slide_order WHERE slide_id = $slide_id");
        } else {
            $con->query("UPDATE homepage SET slide_order = $slide_order WHERE slide_id = $slide_id");
        }
    } else {
        // Insert
        $con->query("INSERT INTO homepage (slide_image, slide_order) VALUES ('$target_file', $slide_order)");
    }

    header("Location: admin-customerPageEdit.php");
    exit;

}