<html>
    <head>
        <title>Penggunaan Switch - Case</title>
    </head>
    <body>
        Hari ini:
        <?php
            $nama_hari=date("l");
            Switch ($nama_hari)
            {
                Case "Sunday";
                Print("Minggu");
                print "Waktu untuk istirahat";
                Break;
                Case "Monday";
                Print ("Senin <br>");
                print "Meeting awal minggu jam 08:00";
                Break;
                Case "Tuesday";
                Print ("Selasa <br>");
                print "Pembukaan Workshop Diklat";
                Break;
                Case "Wednesday";
                Print ("Rabu <br>");
                print ("Seminar Launching Windows Vista di JHCC");
                Break;
                Case "Thursday";
                Print ("Kamis <br>");
                print ("Pertemuan dengan Mahasiswa");
                Break;
                Case "Friday";
                print ("Jumat <br>");
                print ("Jogging Bersama");
                Break;
                Default;
                Print ("Sabtu <br>");
                print "Survey harga ke Dusit, Mangga Dua";

            }
            //Darren Hoir Putra - 231011400446 - 07TPLM003
            /*Output menghasilkan Hari Jumat karena variabel $nama_hari mengggunakan date=("l") yang akan
             menampilkan nama hari saat ini*/
        ?>
    </body>
</html>