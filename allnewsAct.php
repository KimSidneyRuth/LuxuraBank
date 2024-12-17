<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle individual deletion
    if (isset($_POST['delete'])) {
        $id = intval($_POST['delete']);
        
        $sql_delete_news = "DELETE FROM news WHERE id = $id";
        $sql_delete_news_body = "DELETE FROM news_body WHERE id = $id";

        if ($con->query($sql_delete_news) && $con->query($sql_delete_news_body)) {
            header("Location: seeAllNews2.php?message=deleted");
            exit();
        } else {
            header("Location: seeAllNews2.php?message=error");
        }
    }
    // Handle multiple deletion
    elseif (isset($_POST['delete_selected']) && !empty($_POST['delete_ids'])) {
        $ids = $_POST['delete_ids'];
        $id_list = implode(",", array_map('intval', $ids));
        
        $sql_delete_news = "DELETE FROM news WHERE id IN ($id_list)";
        $sql_delete_news_body = "DELETE FROM news_body WHERE id IN ($id_list)";

        if ($con->query($sql_delete_news) && $con->query($sql_delete_news_body)) {
            header("Location: seeAllNews2.php?message=multiple_deleted");
            exit();
        } else {
            header("Location: seeAllNews2.php?message=error");
        }
    }
    // Handle individual update
    elseif (isset($_POST['update'])) {
        $id = intval($_POST['update']);
        header("Location: editNews.php?id=$id");
        exit();
    } else {
        header("Location: seeAllNews2.php?message=error");
    }
}

$con->close();
?>
