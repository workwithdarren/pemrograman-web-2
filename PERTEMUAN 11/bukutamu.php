<?php
$conn = mysqli_connect("localhost", "root", "", "db_bukutamu");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];

    $sql = "INSERT INTO bukutamu (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil disimpan!'); window.location='tampil.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Buku Tamu</title>
</head>
<body>
    <h2>Form Buku Tamu</h2>
    <form action="" method="POST">
        <table border="0" cellpadding="5">
            <tr>
                <td>Nama</td>
                <td>: <input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: <input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Pesan</td>
                <td>: <textarea name="pesan" rows="4" cols="30" required></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="submit">Simpan</button>
                    <a href="tampil.php">Lihat Buku Tamu</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>