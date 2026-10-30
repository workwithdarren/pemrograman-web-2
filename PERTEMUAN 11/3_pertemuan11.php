<?php
$conn = mysqli_connect("localhost", "root", "", "lat_dbase");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "CREATE TABLE IF NOT EXISTS tbl_mhs (
    mhsID INT NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(15),
    LastName VARCHAR(15),
    Age INT,
    PRIMARY KEY(mhsID)
)";

if (mysqli_query($conn, $sql)) {
    echo "Tabel berhasil dibuat.<br>";
} else {
    echo "Gagal membuat tabel: " . mysqli_error($conn) . "<br>";
}

$sql_insert = "INSERT INTO tbl_mhs (FirstName, LastName, Age) VALUES ('Anjar', 'Prabowo', 25)";

if (mysqli_query($conn, $sql_insert)) {
    echo "Data berhasil ditambahkan.";
} else {
    echo "Gagal menambahkan data: " . mysqli_error($conn);
}

// Tutup koneksi
mysqli_close($conn);
?>