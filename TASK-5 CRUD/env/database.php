<?php


// Connect Database
$host = "localhost";
$user = "root";
$password = "";
$dbName = "shop";
try {
    $conn = mysqli_connect($host, $user, $password, $dbName);
} catch (Exception $e) {
    echo $e->getMessage();
}
