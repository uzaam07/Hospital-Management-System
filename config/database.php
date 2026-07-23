<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "myhmsdb";

$con = mysqli_connect($host, $user, $password, $database);

if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>
