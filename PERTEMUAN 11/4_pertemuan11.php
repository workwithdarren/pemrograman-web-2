<?php
$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

$query1 = "INSERT INTO tbl_mhs (FirstName, LastName, Age) VALUES ('Karina', 'Suwandi', '29')";
mysqli_query($con, $query1);

$query2 = "INSERT INTO tbl_mhs (FirstName, LastName, Age) VALUES ('Glenn', 'Gandari', '32')";
mysqli_query($con, $query2);

mysqli_close($con);
?>