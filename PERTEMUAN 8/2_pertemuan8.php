<!DOCTYPE html>
<html>
<head>
    <title>Contoh Penggunaan UDF</title>
</head>
<body>
<!-- Menentukan Form Input -->
<form method="POST" action="">
    Masukkan Bilangan Pertama : <br>
    <input type="number" step="any" name="A" size="10" required><br>
    Masukkan Bilangan Kedua : <br>
    <input type="number" step="any" name="B" size="10" required> <br><br>
    <input type="submit" name="hitung" value="Hitung">
</form>

<!-- Membandingkan 2 buah bilangan yang diinput -->
<?php
if (isset($_POST['hitung'])) {
    // Mengambil data input dan menyimpannya ke variabel
    $A = $_POST["A"];
    $B = $_POST["B"];

    // Definisi User Defined Function (UDF)
    function jumlah($A, $B) {
        $jumlahbil = $A + $B;
        return $jumlahbil;
    }

    function kurang($A, $B) {
        $kurangbil = $A - $B;
        return $kurangbil;
    }

    function kali($A, $B) {
        $kalibil = $A * $B;
        return $kalibil;
    }

    function bagi($A, $B) {
        if ($B == 0) {
            return "Tidak dapat dibagi dengan nol";
        }
        $bagibil = $A / $B;
        return $bagibil;
    }

    // Output Hasil
    echo "<br>";
    echo "Bilangan Pertama : " . $A;
    echo "<br>";
    echo "Bilangan Kedua : " . $B;
    echo "<br><br>";

    // Penjumlahan
    echo "Hasil Penjumlahan 2 buah bilangan:<br>";
    $jumlahbil = jumlah($A, $B);
    printf("Penjumlahan antara : %d + %d = %d", $A, $B, $jumlahbil);
    echo "<br><br>";

    // Pengurangan
    echo "Hasil Pengurangan 2 buah bilangan:<br>";
    $kurangbil = kurang($A, $B);
    printf("Pengurangan antara : %d - %d = %d", $A, $B, $kurangbil);
    echo "<br><br>";

    // Perkalian
    echo "Hasil Perkalian 2 buah bilangan:<br>";
    $kalibil = kali($A, $B);
    printf("Perkalian antara : %d * %d = %d", $A, $B, $kalibil);
    echo "<br><br>";

    // Pembagian
    echo "Hasil Pembagian 2 buah bilangan:<br>";
    $bagibil = bagi($A, $B);
    if (is_numeric($bagibil)) {
        printf("Pembagian antara : %g / %g = %.2f", $A, $B, $bagibil);
    } else {
        echo $bagibil;
    }
    echo "<br><br>";
}
?>
</body>
</html>