<?php
    if(!isset($_GET['page'])){
        $_GET['page'] = 1;
    }
    echo "<img src='img/slide" . $_GET['page'] . ".jpg' width='1200' height='1200'> &nbsp;";

   /*$lastpicindex = $_GET['page']*2;

    for($x = $lastpicindex-1; $x<=$lastpicindex; $x++){
        echo "<img src='porf-" . $_GET['page'] . ".jpg' width='200' height='200'> &nbsp;";
    }*/

    for($x=1; $x<=6; $x++){
        echo "<a href='pagination.php?page=" . $x . "'>" . $x . "</a>";
    }
?>
