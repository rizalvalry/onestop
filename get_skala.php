<?php
	include "./include/koneksi.php";
	$kelas = $_POST['kelas'];

	echo "<option value=''>Pilih Skala</option>";

	$query = "SELECT * FROM skala WHERE id_kelas=? ORDER BY nama ASC";
	$dewan1 = $conn->prepare($query);
	$dewan1->bind_param("i", $kelas);
	$dewan1->execute();
	$res1 = $dewan1->get_result();
	while ($row = $res1->fetch_assoc()) {
		echo "<option value='" . $row['id_skala'] . "'>" . $row['nama'] . "</option>";
	}
?>