<?php

include("../config/database.php");

function display_specs()
{
    global $con;

    $query = mysqli_query(
        $con,
        "SELECT DISTINCT spec FROM doctb"
    );

    while ($row = mysqli_fetch_assoc($query)) {

        echo "<option value='".$row['spec']."'>
                ".$row['spec']."
              </option>";
    }
}

function display_docs()
{
    global $con;

    $query = mysqli_query(
        $con,
        "SELECT * FROM doctb"
    );

    while ($row = mysqli_fetch_assoc($query)) {

        echo "<option
                value='".$row['username']."'
                data-spec='".$row['spec']."'
                data-value='".$row['docFees']."'>
                ".$row['username']."
              </option>";
    }
}

function getDoctorCount()
{
    global $con;

    $query = mysqli_query(
        $con,
        "SELECT COUNT(*) as total FROM doctb"
    );

    $row = mysqli_fetch_assoc($query);

    return $row['total'];
}

function getPatientCount()
{
    global $con;

    $query = mysqli_query(
        $con,
        "SELECT COUNT(*) as total FROM patreg"
    );

    $row = mysqli_fetch_assoc($query);

    return $row['total'];
}

function getAppointmentCount()
{
    global $con;

    $query = mysqli_query(
        $con,
        "SELECT COUNT(*) as total FROM appointmenttb"
    );

    $row = mysqli_fetch_assoc($query);

    return $row['total'];
}

?>
