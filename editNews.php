<?php

include "connection.php";

if (!isset($_GET['id'])) {
    die("Invalid request!");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM news n JOIN news_body nb ON n.id = nb.id WHERE n.id = $id";
$result = $con->query($sql);

if ($result->num_rows === 0) {
    die("Announcement not found!");
}

$news = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $con->real_escape_string($_POST['title']);
    $body = $con->real_escape_string($_POST['body']);

    $sql_update_news = "UPDATE news SET title = '$title' WHERE id = $id";
    $sql_update_news_body = "UPDATE news_body SET body = '$body' WHERE id = $id";

    if ($con->query($sql_update_news) && $con->query($sql_update_news_body)) {
        header("Location: seeAllNews2.php?message=updated");
        exit();
    } else {
        echo "Error updating news: " . $con->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Announcement</title>
    <style>
        /* General Styles */

/* Form Container */
.editNews {
    position: absolute;
    top:150px;
    left:480px;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px 30px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    width: 400px;
}

h1 {
    font-size: 1.8em;
    color: #4a90e2;
    margin-bottom: 20px;
    text-align: center;
}

/* Input Fields */
input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0 20px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 1em;
    font-family: inherit;
}

textarea {
    resize: vertical;
}

/* Buttons */
button {
    background-color: #4a90e2;
    color: #ffffff;
    border: none;
    padding: 10px 15px;
    font-size: 1em;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background-color: #357abd;
}

/* Cancel Button as a Link */
a {
    display: block;
    margin-top: 10px;
    text-decoration: none;
    color: #777;
    text-align: center;
    font-size: 0.9em;
}

a:hover {
    color: #4a90e2;
}

/* Responsive Design */
@media (max-width: 480px) {
    form {
        width: 90%;
        padding: 15px;
    }

    button {
        padding: 8px;
    }
}

    </style>
</head>
<body>
    <div class ="editNews">
    <h1>Edit Announcement</h1>
    <form action="" method="POST" >
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($news['title']); ?>" required>
        <br><br>

        <label for="body">Body:</label>
        <textarea id="body" name="body" rows="5" cols="30" required><?php echo htmlspecialchars($news['body']); ?></textarea>
        <br><br>

        <button type="submit">Save Changes</button>
        <a href="seeAllNews2.php">Cancel</a>
    </form>
</div>
</body>
</html>
