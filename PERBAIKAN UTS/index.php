<?php
$host = "localhost";
$user = "root";     
$pass = "";         
$db   = "db_pendaftaran";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS PHP - Pendaftaran Mahasiswa</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px;
            background: #f4f4f4;
        }

        .container {
            width: 1000px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: center;
            font-size: 14px;
        }

        input[type=text],
        input[type=number],
        input[type=date] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .btn {
            background: blue;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }

        .btn:hover {
            background: darkblue;
        }

        .info {
            margin-top: 20px;
            padding: 10px;
            background: #eef;
            border-radius: 5px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-weight: bold;
        }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

<div class="container">

    <h2>FORM PENDAFTARAN MAHASISWA BARU</h2>

    <?php
    if (isset($_POST['simpan'])) {

        $tgl_input     = mysqli_real_escape_string($koneksi, $_POST['tgl_input']);
        $kode          = mysqli_real_escape_string($koneksi, strtoupper($_POST['kode']));
        $nama          = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jk            = mysqli_real_escape_string($koneksi, $_POST['jk']);
        $asal_sekolah  = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
        $pekerjaan_ortu = mysqli_real_escape_string($koneksi, $_POST['pekerjaan_ortu']);
        $tempat_lahir  = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
        $tgl_lahir     = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);

        $mat  = (int)$_POST['mat'];
        $bing = (int)$_POST['bing'];
        $umum = (int)$_POST['umum'];

        $rata = ($mat + $bing + $umum) / 3;

        if ($rata >= 70) {
            $keterangan = "Lulus";
        } elseif ($rata >= 60) {
            $keterangan = "Cadangan";
        } else {
            $keterangan = "Tidak Lulus";
        }

        $kode_awal = substr($kode, 0, 1);

        if ($kode_awal == "A") {
            $tempat_tes = "Gedung A";
        } elseif ($kode_awal == "B") {
            $tempat_tes = "Gedung B";
        } elseif ($kode_awal == "V") {
            $tempat_tes = "Viktor";
        } else {
            $tempat_tes = "Tidak Diketahui";
        }

        $query_insert = "INSERT INTO pendaftar 
            (tgl_input, kode, nama, jk, asal_sekolah, pekerjaan_ortu, tempat_lahir, tgl_lahir, mat, bing, umum, rata_rata, keterangan, tempat_tes) 
            VALUES 
            ('$tgl_input', '$kode', '$nama', '$jk', '$asal_sekolah', '$pekerjaan_ortu', '$tempat_lahir', '$tgl_lahir', '$mat', '$bing', '$umum', '$rata', '$keterangan', '$tempat_tes')";

        if (mysqli_query($koneksi, $query_insert)) {
            echo "<div class='alert alert-success'>Data pendaftar berhasil disimpan ke database!</div>";
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data: " . mysqli_error($koneksi) . "</div>";
        }
    }
    ?>

    <form method="POST">
        <label>Tanggal Input</label>
        <input type="date" name="tgl_input" required>

        <label>Kode Pendaftaran</label>
        <input type="text" name="kode" placeholder="Contoh : A2" required>

        <label>Nama Pendaftar</label>
        <input type="text" name="nama" required>

        <label>Jenis Kelamin</label><br>
        <input type="radio" name="jk" value="Laki-Laki" required> Laki-Laki
        <input type="radio" name="jk" value="Perempuan"> Perempuan
        <br><br>

        <label>Asal Sekolah</label>
        <input type="text" name="asal_sekolah" required>

        <label>Pekerjaan Orang Tua</label>
        <input type="text" name="pekerjaan_ortu" required>

        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" required>

        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" required>

        <label>Matematika</label>
        <input type="number" name="mat" min="0" max="100" required>

        <label>Bahasa Inggris</label>
        <input type="number" name="bing" min="0" max="100" required>

        <label>Umum</label>
        <input type="number" name="umum" min="0" max="100" required>

        <button type="submit" name="simpan" class="btn">SIMPAN</button>
    </form>

    <?php
    $query_select = "SELECT * FROM pendaftar ORDER BY id DESC";
    $result = mysqli_query($koneksi, $query_select);

    $total_pendaftar = mysqli_num_rows($result);
    
    $query_lulus = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftar WHERE keterangan='Lulus'");
    $jumlah_lulus = mysqli_fetch_assoc($query_lulus)['total'];

    $query_cadangan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftar WHERE keterangan='Cadangan'");
    $jumlah_cadangan = mysqli_fetch_assoc($query_cadangan)['total'];

    $query_tidak_lulus = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pendaftar WHERE keterangan='Tidak Lulus'");
    $jumlah_tidak_lulus = mysqli_fetch_assoc($query_tidak_lulus)['total'];
    ?>

    <h3 style="margin-top: 30px;">Data Pendaftar Tersimpan</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>JK</th>
                <th>TTL</th>
                <th>Asal Sekolah</th>
                <th>Pekerjaan Ortu</th>
                <th>Tempat Tes</th>
                <th>MAT</th>
                <th>B. Ing</th>
                <th>Umum</th>
                <th>Rata-rata</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($total_pendaftar > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // Format tanggal lahir ke d-m-Y
                    $tgl_lahir_formatted = date('d-m-Y', strtotime($row['tgl_lahir']));
                    
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".htmlspecialchars($row['kode'])."</td>";
                    echo "<td>".htmlspecialchars($row['nama'])."</td>";
                    echo "<td>".htmlspecialchars($row['jk'])."</td>";
                    echo "<td>".htmlspecialchars($row['tempat_lahir']).", ".$tgl_lahir_formatted."</td>";
                    echo "<td>".htmlspecialchars($row['asal_sekolah'])."</td>";
                    echo "<td>".htmlspecialchars($row['pekerjaan_ortu'])."</td>";
                    echo "<td>".htmlspecialchars($row['tempat_tes'])."</td>";
                    echo "<td>".$row['mat']."</td>";
                    echo "<td>".$row['bing']."</td>";
                    echo "<td>".$row['umum']."</td>";
                    echo "<td>".number_format($row['rata_rata'], 2)."</td>";
                    echo "<td>".htmlspecialchars($row['keterangan'])."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13'>Belum ada data pendaftar.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div class="info">
        <h3>Rekap Data Keseluruhan:</h3>
        <p>Jumlah Pendaftar : <b><?= $total_pendaftar; ?></b></p>
        <p>Jumlah Peserta Lulus : <b><?= $jumlah_lulus; ?></b></p>
        <p>Jumlah Peserta Cadangan : <b><?= $jumlah_cadangan; ?></b></p>
        <p>Jumlah Tidak Lulus : <b><?= $jumlah_tidak_lulus; ?></b></p>
    </div>

    <div class="info">
        <h3>Keterangan Acuan:</h3>
        <p><b>Kode Tempat Tes:</b></p>
        <ul>
            <li>A = Gedung A</li>
            <li>B = Gedung B</li>
            <li>V = Viktor</li>
        </ul>

        <p><b>Hasil Seleksi:</b></p>
        <ul>
            <li>Rata-rata &ge; 70 = Lulus</li>
            <li>Rata-rata 60 - 69 = Cadangan</li>
            <li>Rata-rata &lt; 60 = Tidak Lulus</li>
        </ul>
    </div>

</div>

</body>
</html>