<?php
include "include/koneksi.php";
$id = "AM";


//PERINTAH MENGECEK AGAR TIDAK TERDAPAT USER YANG SAMA
$cek_user=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pakaian WHERE Id_Pakaian='$id' "));
if ($cek_user > 0) {
        echo '<script language="javascript">
              alert ("User Sudah Ada Yang Menggunakan");
              window.location="cek.php";
              </script>';
              exit();
}


// $cekdulu= "select * from table_anda where username='$_POST[un]'"; //username dan $_POST[un] diganti sesuai dengan yang kalian gunakan
// $prosescek= mysqli_query($conn, $cekdulu);
// if (mysqli_num_rows($prosescek)>0) { //proses mengingatkan data sudah ada
//     echo "<script>alert('Username Sudah Digunakan');history.go(-1) </script>";
// }
// else { //proses menambahkan data, tambahkan sesuai dengan yang kalian gunakan
 
// }