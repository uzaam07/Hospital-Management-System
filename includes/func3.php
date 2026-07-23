<?php

session_start();
include("../config/database.php");

if (isset($_POST['adsub'])) {

    $username = $_POST['username1'];
    $password = $_POST['password2'];

    $query = mysqli_query(
        $con,
        "SELECT * FROM admintb
         WHERE username='$username'
         AND password='$password'"
    );

    if (mysqli_num_rows($query) == 1) {

        $_SESSION['admin'] = $username;

        header("Location: ../admin/dashboard.php");
        exit();
    } else {

        echo "<script>
                alert('Invalid Admin Credentials');
                window.location='../index.php';
              </script>";
    }
}

?>
