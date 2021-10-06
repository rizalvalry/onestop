<?php
session_start();
include "include/koneksi.php";
include "pm211/class.phpmailer.php";

$No_Order = $_POST["No_Order"];
$No_Identitas = $_POST["No_Identitas"];
$total_berat = $_POST["total_berat"];
$diskon = $_POST["diskon"];
$dp = $_POST["dp"];
$sisa_bayar = $_POST["sisa_bayar"];
$total_bayar = $_POST["total_bayar"];
// $Tgl_Terima = NOW();
$admin_id = $_POST["admin_id"];
$kelas = $_POST["kelas"];
$skala = $_POST["skala"];
$Email = $_POST["Email"];
$status = "baru";
$payment = $_POST["payment"];

$mail = new PHPMailer;
// $mail->IsSMTP();
$mail->Mailer = "mail";
$mail->SMTPSecure = "tls";
$mail->Host = "smtp.gmail.com"; //hostname masing-masing provider email
$mail->SMTPDebug = 2;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "cawangbsi@gmail.com"; //user email
$mail->Password = "RizalValry12345"; //password email
$mail->SetFrom("cawangbsi@gmail.com","Valry House Services"); //set email pengirim
$mail->Subject = "Info Tagihan"; //subyek email
$mail->AddAddress($Email); //tujuan email
$isiEmail = 'Pakaian kamu Sedang dikerjakan yah, stay keep home stay keep health :)';
$mail->MsgHTML($isiEmail);
// echo $isiEmail;
 if($mail->Send()) echo "";
 else echo "Failed to sending message";


// if(empty($_POST["No_Order"]) || empty($_POST["No_Identitas"]) || empty($_POST["total_berat"]) || empty($_POST["diskon"]) || empty($_POST["total_bayar"]) || empty($_POST["tanggal"])){
// 	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
// 	// echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi.php">';
// }else{
if(empty($_POST["No_Order"]) || empty($_POST["No_Identitas"]) || empty($_POST["total_berat"]) || empty($_POST["total_bayar"])){
	echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
	echo '<meta http-equiv="refresh" content="0; url=tambahdatatransaksi">';
}else{
	$sqlCheck = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
	$hasil = mysqli_fetch_array($sqlCheck);
	$c_No_Order = $hasil['No_Order']+1;
	
	if($c_No_Order != $No_Order) {
		$admin_id = $_SESSION['id'];
		$sqlUpdateDetailTransaksi = mysqli_query($conn, "UPDATE detail_transaksi SET No_Order = '$c_No_Order' WHERE No_Order = '$No_Order' AND admin_id = '$admin_id' ");
		$sqlUpdateHarga = mysqli_query($conn, "UPDATE harga SET no_order = '$c_No_Order' WHERE No_Order = '$No_Order' AND admin_id = '$admin_id' ");
		$No_Order = $c_No_Order;
	}
	$sql = "INSERT INTO `transaksi` (`No_Order`, `No_Identitas`, `Tgl_Terima`, `Tgl_Ambil`, `total_berat`, `diskon`, `dp`, `sisa_bayar`, `Total_Bayar`, `admin_id`, `kelas`, `skala`, `status`, `payment`)
			VALUES ('$No_Order', '$No_Identitas', NOW(), NULL, '$total_berat', '$diskon', '$dp', '$sisa_bayar', '$total_bayar', '$admin_id', '$kelas', '$skala', '$status', '$payment')";
			$kueri = mysqli_query($conn, $sql);
			echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
			echo '<meta http-equiv="refresh" content="0; url=transaksi">';
}

?>


<script>
$.playSound('http://example.org/sound.mp3');
</script>