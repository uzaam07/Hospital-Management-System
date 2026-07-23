<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Hospital Management System</title>

    <link rel="shortcut icon"
        href="images/favicon.png">

    <link rel="stylesheet"
        href="assets/css/style1.css">

    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="vendor/fontawesome/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap"
        rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">

    <div class="container">

        <a class="navbar-brand"
            href="#">

            <i class="fa fa-user-plus"></i>

            GLOBAL HOSPITAL

        </a>

        <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse"
            id="navbarResponsive">

            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link"
                        href="index.php">
                        HOME
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        href="services.html">
                        ABOUT US
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                        href="contact.html">
                        CONTACT
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>

<div class="container register">

<div class="row">

<div class="col-md-3 register-left">

<h3>Welcome</h3>

<p>

Hospital Management System

</p>

</div>

<div class="col-md-9 register-right">

<ul class="nav nav-tabs nav-justified"
    id="myTab">

<li class="nav-item">

<a class="nav-link active"
data-toggle="tab"
href="#patient">

Patient

</a>

</li>

<li class="nav-item">

<a class="nav-link"
data-toggle="tab"
href="#doctor">

Doctor

</a>

</li>

<li class="nav-item">

<a class="nav-link"
data-toggle="tab"
href="#admin">

Admin

</a>

</li>

</ul>

<div class="tab-content">

<!-- ================= PATIENT ================= -->

<div class="tab-pane fade show active"
id="patient">

<h3 class="register-heading">

Patient Registration

</h3>

<form action="includes/func2.php"
method="POST">

<div class="row register-form">

<div class="col-md-6">

<div class="form-group">

<input
type="text"
name="fname"
class="form-control"
placeholder="First Name"
required>

</div>

<div class="form-group">

<input
type="email"
name="email"
class="form-control"
placeholder="Email"
required>

</div>

<div class="form-group">

<input
type="password"
name="password"
class="form-control"
placeholder="Password"
required>

</div>

<div class="form-group">

<label>

<input
type="radio"
name="gender"
value="Male"
checked>

Male

</label>

<label class="ml-3">

<input
type="radio"
name="gender"
value="Female">

Female

</label>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<input
type="text"
name="lname"
class="form-control"
placeholder="Last Name"
required>

</div>

<div class="form-group">

<input
type="text"
name="contact"
class="form-control"
placeholder="Contact Number"
required>

</div>

<div class="form-group">

<input
type="password"
name="cpassword"
class="form-control"
placeholder="Confirm Password"
required>

</div>

<input
type="submit"
name="patsub1"
class="btnRegister"
value="Register">

</div>

</div>

</form>

</div>

<!-- ================= DOCTOR ================= -->

<div class="tab-pane fade"
id="doctor">

<h3 class="register-heading">

Doctor Login

</h3>

<form
action="includes/func1.php"
method="POST">

<div class="row register-form">

<div class="col-md-6">

<div class="form-group">

<input
type="text"
name="username3"
class="form-control"
placeholder="Username"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<input
type="password"
name="password3"
class="form-control"
placeholder="Password"
required>

</div>

<input
type="submit"
name="docsub1"
class="btnRegister"
value="Login">

</div>

</div>

</form>

</div>
  
<!-- ================= ADMIN LOGIN ================= -->

        <div class="tab-pane fade"
            id="admin">

            <h3 class="register-heading">
                Admin Login
            </h3>

            <form action="includes/func3.php"
                method="POST">

                <div class="row register-form">

                    <div class="col-md-6">

                        <div class="form-group">

                            <input
                                type="text"
                                name="username1"
                                class="form-control"
                                placeholder="Username"
                                required>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">

                            <input
                                type="password"
                                name="password2"
                                class="form-control"
                                placeholder="Password"
                                required>

                        </div>

                        <input
                            type="submit"
                            name="adsub"
                            class="btnRegister"
                            value="Login">

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

</div>

</div>

<script>

function validatePassword(){

    var pass=document.getElementsByName("password")[0].value;
    var cpass=document.getElementsByName("cpassword")[0].value;

    if(pass!=cpass){

        alert("Passwords do not match!");

        return false;

    }

    return true;

}

</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
