<?php
session_start();

include("../config/database.php");
include("../includes/newfunc.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}

$admin = $_SESSION['admin'];

$totalDoctors = getDoctorCount();
$totalPatients = getPatientCount();
$totalAppointments = getAppointmentCount();

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

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

Administrator

</span>

<a href="../logout.php"
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

Admin Panel

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

<a href="#doctors"
class="nav-link text-white">

<i class="fa fa-user-md"></i>

Doctors

</a>

</li>

<li class="nav-item">

<a href="#patients"
class="nav-link text-white">

<i class="fa fa-users"></i>

Patients

</a>

</li>

<li class="nav-item">

<a href="#appointments"
class="nav-link text-white">

<i class="fa fa-calendar"></i>

Appointments

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

<?php echo $totalDoctors; ?>

</h2>

<h5>

Doctors

</h5>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card bg-success text-white">

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

<div class="col-md-4">

<div class="card bg-warning text-dark">

<div class="card-body text-center">

<h2>

<?php echo $totalAppointments; ?>

</h2>

<h5>

Appointments

</h5>

</div>

</div>

</div>

</div>

</section>

<!-- ======================================== -->
<!-- DOCTOR LIST -->
<!-- ======================================== -->

<section id="doctors">

<div class="card mt-4">

<div class="card-header bg-info text-white">

Registered Doctors

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="thead-dark">

<tr>

<th>Username</th>

<th>Email</th>

<th>Specialization</th>

<th>Consultation Fee</th>

<th>Contact</th>

<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$query = mysqli_query($con,
"SELECT * FROM doctb");

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['username']; ?></td>

<td><?php echo $row['email']; ?></td>

<td><?php echo $row['spec']; ?></td>

<td>

₹ <?php echo $row['docFees']; ?>

</td>

<td>

<?php echo $row['contact']; ?>

</td>

<td>

<a
href="?deldoc=<?php echo urlencode($row['username']); ?>"
class="btn btn-danger btn-sm">

Delete

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

<?php

/* ==========================================================
   DELETE DOCTOR
========================================================== */

if(isset($_GET['deldoc']))
{

$username=mysqli_real_escape_string($con,$_GET['deldoc']);

mysqli_query($con,
"DELETE FROM doctb
WHERE username='$username'");

echo "

<script>

alert('Doctor Deleted Successfully');

window.location='dashboard.php';

</script>

";

}

?>

<!-- ==========================================================
PATIENT MANAGEMENT
========================================================== -->

<section id="patients">

<div class="card mt-4">

<div class="card-header bg-success text-white">

Registered Patients

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="thead-dark">

<tr>

<th>ID</th>
<th>Name</th>
<th>Gender</th>
<th>Email</th>
<th>Contact</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($con,
"SELECT * FROM patreg
ORDER BY pid DESC");

while($row=mysqli_fetch_assoc($query))
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

<td>

<a
href="?delpat=<?php echo $row['pid']; ?>"
class="btn btn-danger btn-sm">

Delete

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

<?php

/* ==========================================================
DELETE PATIENT
========================================================== */

if(isset($_GET['delpat']))
{

$id=$_GET['delpat'];

mysqli_query($con,
"DELETE FROM patreg
WHERE pid='$id'");

echo "

<script>

alert('Patient Deleted Successfully');

window.location='dashboard.php';

</script>

";

}

?>

<!-- ==========================================================
PATIENT SEARCH
========================================================== -->

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
placeholder="Search by ID, Name or Email">

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

$result=mysqli_query($con,

"SELECT *
FROM patreg

WHERE

pid LIKE '%$search%'

OR

fname LIKE '%$search%'

OR

lname LIKE '%$search%'

OR

email LIKE '%$search%'"

);

?>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Contact</th>

</tr>

</thead>

<tbody>

<?php

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['pid']; ?></td>

<td>

<?php

echo $row['fname']." ".$row['lname'];

?>

</td>

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

<!-- ==========================================================
APPOINTMENT MANAGEMENT
========================================================== -->

<section id="appointments">

<div class="card mt-4">

<div class="card-header bg-warning">

All Appointments

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="thead-dark">

<tr>

<th>ID</th>
<th>Patient</th>
<th>Doctor</th>
<th>Date</th>
<th>Time</th>
<th>Fee</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($con,

"SELECT *
FROM appointmenttb
ORDER BY appdate DESC, apptime DESC");

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

<td><?php echo $row['doctor']; ?></td>

<td><?php echo $row['appdate']; ?></td>

<td><?php echo $row['apptime']; ?></td>

<td>

₹ <?php echo $row['docFees']; ?>

</td>

<td>

<?php

if($row['userStatus']==1 && $row['doctorStatus']==1)
{

echo "<span class='badge badge-success'>Active</span>";

}
else
{

echo "<span class='badge badge-danger'>Cancelled</span>";

}

?>

</td>

<td>

<a
href="?delapp=<?php echo $row['ID']; ?>"
class="btn btn-danger btn-sm">

Delete

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

<?php

/* ==========================================================
DELETE APPOINTMENT
========================================================== */

if(isset($_GET['delapp']))
{

$id=(int)$_GET['delapp'];

mysqli_query($con,
"DELETE FROM appointmenttb
WHERE ID='$id'");

echo "

<script>

alert('Appointment Deleted Successfully');

window.location='dashboard.php';

</script>

";

}

?>

<!-- ==========================================================
SYSTEM SUMMARY
========================================================== -->

<section class="mt-5">

<div class="card">

<div class="card-header bg-dark text-white">

System Summary

</div>

<div class="card-body">

<div class="row text-center">

<div class="col-md-4">

<h3><?php echo getDoctorCount(); ?></h3>

<p>Total Doctors</p>

</div>

<div class="col-md-4">

<h3><?php echo getPatientCount(); ?></h3>

<p>Total Patients</p>

</div>

<div class="col-md-4">

<h3><?php echo getAppointmentCount(); ?></h3>

<p>Total Appointments</p>

</div>

</div>

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
