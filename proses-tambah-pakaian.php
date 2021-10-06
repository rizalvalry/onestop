<?php
include "include/koneksi.php";

$Id_Pakaian = strtoupper($_POST["Id_Pakaian"]);
$Jenis_Pakaian = $_POST["Jenis_Pakaian"];
$Dry_Clean = $_POST["Dry_Clean"];
$Reparasi = $_POST["Reparasi"];
$Recolour = $_POST["Recolour"];

//cek
$kode_pakaian=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pakaian WHERE Id_Pakaian='$Id_Pakaian' "));
if ($kode_pakaian > 0) {
        echo '<script language="javascript">
              alert ("Kode Pakaian Sudah Ada");
              window.location="pakaian";
              </script>';
              exit();
}

if(empty($_POST["Id_Pakaian"]) || empty($_POST["Jenis_Pakaian"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=tambahdatapakaian.php">';
}else{
	$sql = "INSERT INTO `pakaian` (`Id_Pakaian`, `Jenis_Pakaian`, `Dry_Clean`, `Reparasi`, `Recolour`)
			VALUES ('$Id_Pakaian', '$Jenis_Pakaian', '$Dry_Clean', '$Reparasi', '$Recolour')";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=pakaian.php">';
}

?>
