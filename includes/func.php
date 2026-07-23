<?php

session_start();
include("../config/database.php");

if (isset($_POST['patsub'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = mysqli_query(
        $con,
        "SELECT * FROM patreg 
         WHERE email='$email' 
         AND password='$password'"
    );

    if (mysqli_num_rows($query) == 1) {

        $row = mysqli_fetch_assoc($query);

        $_SESSION['pid'] = $row['pid'];
        $_SESSION['fname'] = $row['fname'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['gender'] = $row['gender'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['contact'] = $row['contact'];

        header("Location: ../patient/dashboard.php");
        exit();
    } else {

        echo "<script>
                alert('Invalid Email or Password');
                window.location='../index.php';
              </script>";
    }
}

function checkPatientSession()
{
    if (!isset($_SESSION['pid'])) {
        header("Location: ../index.php");
        exit();
    }
}

?>
