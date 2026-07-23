<?php
session_start();

include("../config/database.php");
include("../includes/newfunc.php");

if (!isset($_SESSION['pid'])) {
    header("Location: ../index.php");
    exit();
}

$pid = $_SESSION['pid'];

$query = mysqli_query($con, "SELECT * FROM patreg WHERE pid='$pid'");
$user = mysqli_fetch_assoc($query);

$fname = $user['fname'];
$lname = $user['lname'];
$email = $user['email'];
$contact = $user['contact'];
$gender = $user['gender'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Patient Dashboard</title>

    <link rel="stylesheet"
        href="../assets/css/style.css">

    <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <a class="navbar-brand" href="#">
        Hospital Management System
    </a>

    <div class="ml-auto">

        <span class="text-white mr-3">

            Welcome,
            <?php echo $fname . " " . $lname; ?>

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

Patient Panel

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

<a href="#appointment"
class="nav-link text-white">

<i class="fa fa-calendar"></i>

Book Appointment

</a>

</li>

<li class="nav-item">

<a href="#history"
class="nav-link text-white">

<i class="fa fa-history"></i>

Appointment History

</a>

</li>

<li class="nav-item">

<a href="#prescription"
class="nav-link text-white">

<i class="fa fa-file-medical"></i>

Prescriptions

</a>

</li>

</ul>

</div>

<!-- Main Content -->

<div class="col-md-9">

<section id="dashboard">

<div class="card mt-4">

<div class="card-header bg-primary text-white">

Dashboard

</div>

<div class="card-body">

<h4>

Welcome

<?php echo $fname; ?>

</h4>

<table class="table table-bordered mt-4">

<tr>

<th>Patient ID</th>

<td><?php echo $pid; ?></td>

</tr>

<tr>

<th>Name</th>

<td>

<?php

echo $fname." ".$lname;

?>

</td>

</tr>

<tr>

<th>Email</th>

<td><?php echo $email; ?></td>

</tr>

<tr>

<th>Contact</th>

<td><?php echo $contact; ?></td>

</tr>

<tr>

<th>Gender</th>

<td><?php echo $gender; ?></td>

</tr>

</table>

</div>

</div>

</section>

<!-- Appointment Form -->

<section id="appointment">

<div class="card mt-4">

<div class="card-header bg-success text-white">

Book Appointment

</div>

<div class="card-body">

<form method="POST">

<div class="form-group">

<label>

Doctor Specialization

</label>

<select
class="form-control"
id="spec"
name="spec">

<option>

Select

</option>

<?php

display_specs();

?>

</select>

</div>

<div class="form-group">

<label>

Doctor

</label>

<select
class="form-control"
id="doctor"
name="doctor">

<option>

Select Doctor

</option>

<?php

display_docs();

?>

</select>

</div>

<div class="form-group">

<label>

Consultation Fee

</label>

<input
type="text"
class="form-control"
id="docFees"
name="docFees"
readonly>

</div>

<div class="form-group">

<label>

Appointment Date

</label>

<input
type="date"
class="form-control"
name="appdate"
required>

</div>

<div class="form-group">

<label>

Appointment Time

</label>

<input
type="time"
class="form-control"
name="apptime"
required>

</div>

<button
type="submit"
name="app-submit"
class="btn btn-primary">

Book Appointment

</button>

</form>

<?php

if(isset($_POST['app-submit'])){

$doctor=$_POST['doctor'];
$docFees=$_POST['docFees'];
$appdate=$_POST['appdate'];
$apptime=$_POST['apptime'];

mysqli_query(
$con,
"INSERT INTO appointmenttb
(pid,fname,lname,gender,email,contact,doctor,docFees,appdate,apptime)
VALUES
('$pid','$fname','$lname','$gender','$email','$contact',
'$doctor','$docFees','$appdate','$apptime')");

echo "<div class='alert alert-success mt-3'>
Appointment Booked Successfully
</div>";

}

?>

</div>

</div>

</section>

<!-- ===================================================== -->
<!-- APPOINTMENT HISTORY -->
<!-- ===================================================== -->

<section id="history">

<div class="card mt-4">

<div class="card-header bg-info text-white">

Appointment History

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="thead-dark">

<tr>

<th>ID</th>
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

$result=mysqli_query($con,
"SELECT * FROM appointmenttb
WHERE pid='$pid'
ORDER BY appdate DESC");

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['ID']; ?></td>

<td><?php echo $row['doctor']; ?></td>

<td><?php echo $row['appdate']; ?></td>

<td><?php echo $row['apptime']; ?></td>

<td>₹ <?php echo $row['docFees']; ?></td>

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

<?php

if($row['userStatus']==1 && $row['doctorStatus']==1)
{

?>

<a href="?cancel=<?php echo $row['ID']; ?>"
class="btn btn-danger btn-sm">

Cancel

</a>

<?php

}
else
{

echo "N/A";

}

?>

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

if(isset($_GET['cancel']))
{

$id=$_GET['cancel'];

mysqli_query($con,
"UPDATE appointmenttb
SET userStatus='0'
WHERE ID='$id'");

echo "<script>

alert('Appointment Cancelled');

window.location='dashboard.php';

</script>";

}

?>

<!-- ===================================================== -->
<!-- PRESCRIPTION HISTORY -->
<!-- ===================================================== -->

<section id="prescription">

<div class="card mt-4">

<div class="card-header bg-warning">

Prescription History

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Doctor</th>
<th>Disease</th>
<th>Allergy</th>
<th>Prescription</th>
<th>Date</th>

</tr>

</thead>

<tbody>

<?php

$query=mysqli_query($con,
"SELECT * FROM prestb
WHERE pid='$pid'
ORDER BY appdate DESC");

while($row=mysqli_fetch_assoc($query))
{

?>

<tr>

<td><?php echo $row['doctor']; ?></td>

<td><?php echo $row['disease']; ?></td>

<td><?php echo $row['allergy']; ?></td>

<td><?php echo $row['prescription']; ?></td>

<td><?php echo $row['appdate']; ?></td>

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

<script>

$("#doctor").change(function(){

var fee=$(this).find(":selected").attr("data-value");

$("#docFees").val(fee);

});

$("#spec").change(function(){

var spec=$(this).val();

$("#doctor option").each(function(){

if($(this).attr("data-spec")==spec || $(this).val()=="")
{

$(this).show();

}

else
{

$(this).hide();

}

});

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
