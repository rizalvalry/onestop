<?php
 header('Content-Type: application/json; charset=utf8');
  
  //koneksi kedatabase penjualan
  include "./include/koneksi.php";


 $sql= mysqli_query($conn, "SELECT status, count(*) as number FROM transaksi GROUP BY status");

 $array=array();
 while($data=mysqli_fetch_array($sql)) $array[]=$data; 

 //mengubah data array menjadi format json
 echo json_encode($array);
?>