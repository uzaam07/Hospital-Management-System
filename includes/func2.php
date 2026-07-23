<?php

include("../config/database.php");

if (isset($_POST['patsub1'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    $check = mysqli_query(
        $con,
        "SELECT * FROM patreg WHERE email='$email'"
    );

    if (mysqli_num_rows($check) > 0) {

        echo "<script>
                alert('Email Already Registered');
                window.location='../index.php';
              </script>";
        exit();
    }

    $query = mysqli_query(
        $con,
        "INSERT INTO patreg
        (fname,lname,gender,email,contact,password)
        VALUES
        ('$fname','$lname','$gender',
         '$email','$contact','$password')"
    );

    if ($query) {

        echo "<script>
                alert('Registration Successful');
                window.location='../index.php';
              </script>";
    } else {

        echo "<script>
                alert('Registration Failed');
                window.location='../index.php';
              </script>";
    }
}

?>
