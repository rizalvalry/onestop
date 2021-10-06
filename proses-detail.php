<?php
session_start();
include "include/koneksi.php";

if(isset($_POST['updatedatasetrika']) || isset($_POST['updatecucisetrika']) || isset($_POST['updatedryclean']) || isset($_POST['updatereparasi']) || isset($_POST['updaterecolor']) || isset($_POST['updatecuci'])) {

	$id_laundry = $_POST['Id_Laundry'];
	$id = $_POST['no_order'];
	$total_berat = $_POST["total_berat"];
	$total_harga = $_POST["total_harga"];
	$admin_id = $_SESSION['id'];

	$cek_harga=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harga WHERE no_order='$id' AND Id_Laundry='$id_laundry' AND admin_id = '".$admin_id."' "));
	$cek_detail_transaksi=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE no_order='$id' AND Id_Laundry='$id_laundry' AND admin_id = '".$admin_id."' "));
	// $cek_id=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harga WHERE Id_Laundry='$id_laundry' "));

	if($cek_detail_transaksi < 1){
		echo "<script language='javascript'>alert('Detail Transaksi Kosong, Harga Gagal Ditambahkan');</script>";
		echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi">';
		return;
	}

	if(empty($_POST["no_order"]) || empty($_POST["total_berat"]) || empty($_POST["total_harga"])){
		echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
		echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi">';
	} elseif($cek_harga < 1) {
		// cek jika no order belum ada 
		$sql = "INSERT INTO `harga` (`no_order`, `total_berat`, `total_harga`, `Id_Laundry`, `admin_id`)
		VALUES ('$id', '$total_berat', '$total_harga', '$id_laundry', '$admin_id')";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi.php">';
	} else {
		// cek jika id laundry sudah ada
		$sql = "UPDATE harga SET total_berat='$total_berat', total_harga='$total_harga' WHERE Id_Laundry = '$id_laundry' AND no_order = '$id' AND admin_id = '$admin_id' ";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di Update');</script>";
			echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi">';
	
	}
} else {
	echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi.php">';
}
?>
