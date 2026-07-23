<?php
session_start();

include("../config/database.php");

if (!isset($_SESSION['dname'])) {
    header("Location: ../index.php");
    exit();
}

$doctor = $_SESSION['dname'];

$totalAppointments = mysqli_num_rows(
    mysqli_query($con, "SELECT * FROM appointmenttb WHERE doctor='$doctor'")
);

$todayAppointments = mysqli_num_rows(
    mysqli_query(
        $con,
        "SELECT * FROM appointmenttb
         WHERE doctor='$doctor'
         AND appdate=CURDATE()
         AND userStatus=1
         AND doctorStatus=1"
    )
);

$totalPatients = mysqli_num_rows(
    mysqli_query(
        $con,
        "SELECT DISTINCT pid FROM appointmenttb
         WHERE doctor='$doctor'"
    )
);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Doctor Dashboard</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

<a class="navbar-brand">

Hospital Management System

</a>

<div class="ml-auto">

<span class="text-white mr-3">

Welcome Dr.

<?php echo $doctor; ?>

</span>

<a href="../logout1.php"
class="btn btn-danger">

Logout

</a>

</div>

</nav>

<div class="container-fluid">

<div class="row">

<!-- Sidebar -->

<div class="col-md-3 bg-dark text-white vh-100">

<h4 class="mt-4">

Doctor Panel

</h4>

<hr>

<ul class="nav flex-column">

<li class="nav-item">

<a href="#dashboard"
class="nav-link text-white">

<i class="fa fa-home"></i>

Dashboard

</a>

</li>

<li class="nav-item">

<a href="#appointments"
class="nav-link text-white">

<i class="fa fa-calendar"></i>

Appointments

</a>

</li>

<li class="nav-item">

<a href="#patients"
class="nav-link text-white">

<i class="fa fa-user"></i>

Patients

</a>

</li>

<li class="nav-item">

<a href="#search"
class="nav-link text-white">

<i class="fa fa-search"></i>

Search Patient

</a>

</li>

</ul>

</div>

<!-- Main Content -->

<div class="col-md-9">

<section id="dashboard">

<div class="row mt-4">

<div class="col-md-4">

<div class="card bg-primary text-white">

<div class="card-body text-center">

<h2>

<?php echo $totalAppointments; ?>

</h2>

<h5>

Total Appointments

</h5>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-success text-white">

<div class="card-body text-center">

<h2>

<?php echo $todayAppointments; ?>

</h2>

<h5>

Today's Appointments

</h5>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-warning text-dark">

<div class="card-body text-center">

<h2>

<?php echo $totalPatients; ?>

</h2>

<h5>

Patients

</h5>

</div>

</div>

</div>

</div>

</section>

<!-- Appointment List -->

<section id="appointments">

<div class="card mt-4">

<div class="card-header bg-info text-white">

Today's Appointment List

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="thead-dark">

<tr>

<th>ID</th>

<th>Patient</th>

<th>Gender</th>

<th>Contact</th>

<th>Date</th>

<th>Time</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query(
$con,
"SELECT *
FROM appointmenttb
WHERE doctor='$doctor'
ORDER BY appdate DESC"
);

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['ID']; ?></td>

<td>

<?php

echo $row['fname']." ".$row['lname'];

?>

</td>

<td><?php echo $row['gender']; ?></td>

<td><?php echo $row['contact']; ?></td>

<td><?php echo $row['appdate']; ?></td>

<td><?php echo $row['apptime']; ?></td>

<td>

<a
href="prescribe.php?id=<?php echo $row['ID']; ?>"
class="btn btn-success btn-sm">

Prescription

</a>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</section>

<!-- ===================================================== -->
<!-- PATIENT SEARCH -->
<!-- ===================================================== -->

<section id="search">

<div class="card mt-4">

<div class="card-header bg-secondary text-white">

Search Patient

</div>

<div class="card-body">

<form method="POST">

<div class="row">

<div class="col-md-10">

<input
type="text"
name="search"
class="form-control"
placeholder="Enter Patient ID / Name / Email">

</div>

<div class="col-md-2">

<button
type="submit"
name="searchbtn"
class="btn btn-primary btn-block">

Search

</button>

</div>

</div>

</form>

<br>

<?php

if(isset($_POST['searchbtn']))
{

$search=mysqli_real_escape_string($con,$_POST['search']);

$sql=mysqli_query($con,

"SELECT DISTINCT
appointmenttb.pid,
appointmenttb.fname,
appointmenttb.lname,
appointmenttb.gender,
appointmenttb.email,
appointmenttb.contact
FROM appointmenttb
WHERE doctor='$doctor'
AND
(
appointmenttb.pid LIKE '%$search%'
OR
appointmenttb.fname LIKE '%$search%'
OR
appointmenttb.lname LIKE '%$search%'
OR
appointmenttb.email LIKE '%$search%'
)"

);

?>

<table class="table table-bordered table-striped">

<thead class="thead-dark">

<tr>

<th>Patient ID</th>
<th>Name</th>
<th>Gender</th>
<th>Email</th>
<th>Contact</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($sql))
{

?>

<tr>

<td><?php echo $row['pid']; ?></td>

<td>

<?php

echo $row['fname']." ".$row['lname'];

?>

</td>

<td><?php echo $row['gender']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['contact']; ?></td>

</tr>

<?php

}

?>

</tbody>

</table>

<?php

}

?>

</div>

</div>

</section>

<!-- ===================================================== -->
<!-- RECENT PRESCRIPTIONS -->
<!-- ===================================================== -->

<section id="prescriptions">

<div class="card mt-4">

<div class="card-header bg-warning">

Recent Prescriptions

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>Patient</th>
<th>Disease</th>
<th>Prescription</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php

$result=mysqli_query($con,

"SELECT *
FROM prestb
WHERE doctor='$doctor'
ORDER BY appdate DESC
LIMIT 10"

);

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td>

<?php

echo $row['fname']." ".$row['lname'];

?>

</td>

<td>

<?php echo $row['disease']; ?>

</td>

<td>

<?php echo $row['prescription']; ?>

</td>

<td>

<?php echo $row['appdate']; ?>

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</section>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
