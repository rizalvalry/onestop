<?php
include "include/koneksi.php";

$No_Identitas = $_POST["No_Identitas"];
$Nama = $_POST["Nama"];
$Alamat = $_POST["Alamat"];
$No_Hp = $_POST["No_Hp"];
$Email = $_POST["Email"];

//cek
$kode_pelanggan=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pelanggan WHERE No_Identitas='$No_Identitas' "));
if ($kode_pelanggan > 0) {
        echo '<script language="javascript">
              alert ("Nomor Identitas Customer Sudah Ada");
              window.location="pelanggan";
              </script>';
              exit();
}

if(empty($_POST["No_Identitas"]) || empty($_POST["Nama"]) || empty($_POST["Alamat"]) || empty($_POST["No_Hp"]) || empty($_POST["Email"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=tambahdatapelanggan.php">';
}else{
	$sql = "INSERT INTO `pelanggan` (`No_Identitas`, `Nama`, `Alamat`, `No_Hp`, `Email`)
			VALUES ('$No_Identitas', '$Nama', '$Alamat', '$No_Hp', '$Email')";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=pelanggan.php">';
}
?>
