<?php
session_start();
include "include/koneksi.php";

if(isset($_POST['updatedata']) AND $_SESSION['role_id'] == 1)
{   
	$id = $_POST['Id_Laundry'];
	$harga = $_POST["Harga"];

	if(empty($_POST["Harga"])){
		echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
		echo '<meta http-equiv="refresh" content="0; url=harga">';
	}else{
		$sql = "UPDATE laundry SET Harga='$harga' WHERE Id_Laundry = '$id'";
					$kueri = mysqli_query($conn, $sql);
					echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
					echo '<meta http-equiv="refresh" content="0; url=harga">';
		}
} 

?>