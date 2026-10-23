<?php
$servername='localhost';

$dbusername='root';
$dbpassword='';
$link=mysqli_connect("$servername", "$dbusername", "$dbpassword") or die ("Gabisa Konek ke Server");
if ($link)
    {
        echo "ok, koneksi berhasil wak";
    }
?>