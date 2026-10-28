<?php
$con = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}

$sql = "DELETE FROM tbl_mhs WHERE LastName = 'Prabowo'";
$result = mysqli_query($con, $sql);

if ($result) {
    $deleted_rows = mysqli_affected_rows($con);
    echo "Berhasil menghapus $deleted_rows data dengan LastName 'Prabowo'.";
} else {
    echo "Gagal menghapus data: " . mysqli_error($con);
}

mysqli_close($con);
?>