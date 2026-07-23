<?php

session_start();
include("../config/database.php");

if (isset($_POST['docsub1'])) {

    $username = mysqli_real_escape_string($con, $_POST['username3']);
    $password = mysqli_real_escape_string($con, $_POST['password3']);

    $query = mysqli_query(
        $con,
        "SELECT * FROM doctb
         WHERE username='$username'
         AND password='$password'"
    );

    if (mysqli_num_rows($query) == 1) {

        $row = mysqli_fetch_assoc($query);

        $_SESSION['dname'] = $row['username'];

        header("Location: ../doctor/dashboard.php");
        exit();
    } else {

        echo "<script>
                alert('Invalid Doctor Credentials');
                window.location='../index.php';
              </script>";
    }
}

function checkDoctorSession()
{
    if (!isset($_SESSION['dname'])) {
        header("Location: ../index.php");
        exit();
    }
}

?>
