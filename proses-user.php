<?php
include "include/koneksi.php";

if(isset($_POST['updatedata']))
{   
	$id = $_POST['id'];
	
	$nama = $_POST["nama"];
	$email = $_POST["email"];
	$no_hp = $_POST["no_hp"];
	$pass = $_POST["pass"];

	if(empty($_POST["nama"]) || empty($_POST["email"]) || empty($_POST["no_hp"]) || empty($_POST["pass"])){
		echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
		echo '<meta http-equiv="refresh" content="0; url=user">';
	}else{
		$sql = "UPDATE admin SET nama='$nama', email='$email', no_hp='$no_hp', pass='$pass' WHERE id = '$id'";
					$kueri = mysqli_query($conn, $sql);
					echo "<script language='javascript'>alert('Berhasil di Edit');</script>";
					echo '<meta http-equiv="refresh" content="0; url=user">';
		}
} elseif(isset($_POST['simpandata'])) {

	$nama = $_POST["nama"];
	$email = $_POST["email"];
	$no_hp = $_POST["no_hp"];
	$pass = $_POST["pass"];
	$role_id = $_POST["role_id"];
	$is_active = $_POST["is_active"];

	if(empty($_POST["nama"]) || empty($_POST["email"]) || empty($_POST["no_hp"]) || empty($_POST["pass"])){
		echo "<script language='javascript'>alert('Gagal di tambahkan');</script>";
		echo '<meta http-equiv="refresh" content="0; url=user">';
	}else{
		$sql = "INSERT INTO admin (nama, email, no_hp, pass, role_id, is_active, created)
				VALUES ('$nama', '$email', '$no_hp', '$pass', '$role_id', '$is_active', NOW())";

				$kueri = mysqli_query($conn, $sql);
				echo "<script language='javascript'>alert('Berhasil di tambahkan');</script>";
				echo '<meta http-equiv="refresh" content="0; url=user">';
	}
} else {
	$id = $_GET['hapus'];

	// Query untuk menghapus data siswa berdasarkan NIS yang dikirim
	$query = "DELETE FROM admin WHERE id='".$id."'";
	$sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
	echo "<script language='javascript'>alert('Berhasil di Hapus');</script>";
	echo '<meta http-equiv="refresh" content="0; url=user">';
	}else{
	// Jika Gagal, Lakukan :
	echo "<script language='javascript'>alert('Gagal di Hapus');</script>";
		echo '<meta http-equiv="refresh" content="0; url=user">';
	}
}
?>
