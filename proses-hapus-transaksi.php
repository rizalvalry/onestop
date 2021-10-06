<?php
// Load file koneksi.php
include "include/koneksi.php";
// Ambil data NIS yang dikirim oleh index.php melalui URL
$No_Order = $_GET['hapus'];

// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
$query = "DELETE FROM transaksi WHERE No_Order='".$No_Order."'";
$query2 = "DELETE FROM detail_transaksi WHERE No_Order='".$No_Order."'";
$query3 = "DELETE FROM harga WHERE no_order='".$No_Order."'";
$sql = mysqli_query($conn, $query);
$sql2 = mysqli_query($conn, $query2);
$sql3 = mysqli_query($conn, $query3);
 // Eksekusi/Jalankan query dari variabel $query
if($sql and $sql2 and $sql3){ // Cek jika proses simpan ke database sukses atau tidak
  echo "<script language='javascript'>alert('Berhasil di Hapus');</script>";
  echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';
}else{
  // Jika Gagal, Lakukan :
  echo "<script language='javascript'>alert('Gagal di Hapus');</script>";
	echo '<meta http-equiv="refresh" content="0; url=transaksi.php">';
}
?>
