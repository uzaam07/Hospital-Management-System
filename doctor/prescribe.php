<?php
session_start();

include("../config/database.php");

if (!isset($_SESSION['dname'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = intval($_GET['id']);
$doctor = $_SESSION['dname'];

$query = mysqli_query($con,
"SELECT * FROM appointmenttb
WHERE ID='$id'
AND doctor='$doctor'");

if(mysqli_num_rows($query)==0)
{
    die("Appointment not found.");
}

$row = mysqli_fetch_assoc($query);

$pid      = $row['pid'];
$fname    = $row['fname'];
$lname    = $row['lname'];
$appdate  = $row['appdate'];
$apptime  = $row['apptime'];
?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Prescription</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-header bg-primary text-white">

<h4>

Patient Prescription

</h4>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th>Patient ID</th>

<td><?php echo $pid; ?></td>

</tr>

<tr>

<th>Patient Name</th>

<td>

<?php echo $fname." ".$lname; ?>

</td>

</tr>

<tr>

<th>Doctor</th>

<td>

<?php echo $doctor; ?>

</td>

</tr>

<tr>

<th>Appointment Date</th>

<td>

<?php echo $appdate; ?>

</td>

</tr>

<tr>

<th>Appointment Time</th>

<td>

<?php echo $apptime; ?>

</td>

</tr>

</table>

<form method="POST">

<div class="form-group">

<label>Disease</label>

<input
type="text"
name="disease"
class="form-control"
required>

</div>

<div class="form-group">

<label>Allergy</label>

<input
type="text"
name="allergy"
class="form-control">

</div>

<div class="form-group">

<label>Prescription</label>

<textarea
name="prescription"
rows="6"
class="form-control"
required></textarea>

</div>

<button
type="submit"
name="save"
class="btn btn-success">

Save Prescription

</button>

<a href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

<?php

if(isset($_POST['save']))
{

$disease=mysqli_real_escape_string($con,$_POST['disease']);

$allergy=mysqli_real_escape_string($con,$_POST['allergy']);

$prescription=mysqli_real_escape_string($con,$_POST['prescription']);

$sql=mysqli_query($con,

"INSERT INTO prestb
(
ID,
pid,
doctor,
fname,
lname,
appdate,
apptime,
disease,
allergy,
prescription
)

VALUES
(
'$id',
'$pid',
'$doctor',
'$fname',
'$lname',
'$appdate',
'$apptime',
'$disease',
'$allergy',
'$prescription'
)"

);

if($sql)
{

echo "

<div class='alert alert-success mt-3'>

Prescription Saved Successfully.

</div>

";

}
else
{

echo "

<div class='alert alert-danger mt-3'>

Unable to Save Prescription.

</div>

";

}

}

?>

</div>

</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
