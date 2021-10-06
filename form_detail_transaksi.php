<?php
session_start();
include "./include/koneksi.php";

// $id = stripslashes(strip_tags(htmlspecialchars($_POST['id'] ,ENT_QUOTES)));
// $nama_mahasiswa = stripslashes(strip_tags(htmlspecialchars($_POST['nama_mahasiswa'] ,ENT_QUOTES)));
// $jenkel = stripslashes(strip_tags(htmlspecialchars($_POST['jenkel'] ,ENT_QUOTES)));
// $alamat = stripslashes(strip_tags(htmlspecialchars($_POST['alamat'] ,ENT_QUOTES)));
// $jurusan = stripslashes(strip_tags(htmlspecialchars($_POST['jurusan'] ,ENT_QUOTES)));
// $tanggal_masuk = stripslashes(strip_tags(htmlspecialchars($_POST['tanggal_masuk'] ,ENT_QUOTES)));
$No_Order = $_POST["No_Order"];
$Id_Pakaian = $_POST["Id_Pakaian"];
$Jumlah_Pakaian = $_POST["Jumlah_Pakaian"];
$Id_Laundry = $_POST["Id_Laundry"];
$admin_id = $_SESSION['id'];
// $Jumlah_Laundry = $_POST["Jumlah_Laundry"];

// //validasi
// if (trim($_POST['Id_Pakaian']) == '') {
// 	$error[] = '- Jenis Pakaian harus di isi';
// }
// if (trim($_POST['Jumlah_Pakaian']) == '') {
// 	$error[] = '- Jumlah Pakaian harus di isi';
// }
// if (trim($_POST['Id_Laundry']) == '') {
// 	$error[] = '- Jenis Laundry harus di isi';
// }
// if (isset($error)) {
// 	// var_dump($error);
// 	// die();
// 	echo '<b>Error</b>: <br />'.implode('<br />', $error);
//<!--<script type="text/javascript">setTimeout("location.href='tambahdatatransaksi.php';",500);</script> -->

// if ($id == "") {
$Laundry_Satuan = array('3','4','5');
if (in_array($Id_Laundry, $Laundry_Satuan, TRUE)) {
	// check di tabel harga sudah ada
	$cek_detail_transaksi=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE no_order='$No_Order' AND Id_Laundry='$Id_Laundry' AND Id_Pakaian='$Id_Pakaian' AND admin_id = '".$admin_id."' "));

	if($cek_detail_transaksi < 1) {
		$query = mysqli_query($conn, "INSERT INTO `detail_transaksi` (`No_Order`, `Id_Pakaian`, `Id_Laundry`, `Jumlah_Pakaian`, `admin_id`)
										VALUES ('$No_Order', '$Id_Pakaian', '$Id_Laundry', '$Jumlah_Pakaian', '$admin_id')");
	} else {
		$query = mysqli_query($conn, "UPDATE `detail_transaksi` SET `Jumlah_Pakaian` = `Jumlah_Pakaian` + $Jumlah_Pakaian
										WHERE `Id_Laundry` = '$Id_Laundry' AND `No_Order` = '$No_Order' AND `Id_Pakaian` = '$Id_Pakaian' AND `admin_id` = '$admin_id' ");
	}

	// ambil harga satuan pakaian
	$query = mysqli_query($conn, "SELECT * FROM pakaian WHERE Id_Pakaian='$Id_Pakaian' ");
	$pakaian = mysqli_fetch_array($query);
	if($Id_Laundry==3) $harga_pakaian = $pakaian['Dry_Clean'];
	if($Id_Laundry==4) $harga_pakaian = $pakaian['Reparasi'];
	if($Id_Laundry==5) $harga_pakaian = $pakaian['Recolour'];
	$total_harga = $Jumlah_Pakaian * $harga_pakaian;

	// check di tabel harga sudah ada
	$cek_harga=mysqli_num_rows(mysqli_query($conn, "SELECT * FROM harga WHERE no_order='$No_Order' AND Id_Laundry='$Id_Laundry' AND Id_Pakaian='$Id_Pakaian' AND admin_id = '".$admin_id."' "));

	if($cek_harga < 1) {
		// cek jika no order belum ada 
		$kueri = mysqli_query($conn, "INSERT INTO `harga` (`no_order`, `total_berat`, `total_harga`, `Id_Laundry`, `Id_Pakaian`, `admin_id`)
										VALUES ('$No_Order', '$Jumlah_Pakaian', '$total_harga', '$Id_Laundry', '$Id_Pakaian', '$admin_id')");
	} else {
		// cek jika id laundry sudah ada
		$kueri = mysqli_query($conn, "UPDATE harga SET total_berat = total_berat + $Jumlah_Pakaian, total_harga = total_harga + $total_harga 
										WHERE Id_Laundry = '$Id_Laundry' AND no_order = '$No_Order' AND Id_Pakaian = '$Id_Pakaian' AND admin_id = '$admin_id' ");
	}

} else {
	$query = "INSERT INTO `detail_transaksi` (`No_Order`, `Id_Pakaian`, `Id_Laundry`, `Jumlah_Pakaian`, `admin_id`)
				VALUES ('$No_Order', '$Id_Pakaian', '$Id_Laundry', '$Jumlah_Pakaian', '$admin_id')";
	$dewan1 = $conn->prepare($query);
	$dewan1->execute();
}
// }

echo json_encode(['success' => $harga_pakaian]);

$conn->close();
?>
