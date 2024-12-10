<?php

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'banking';
$db = new mysqli($host, $user, $password, $database);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>