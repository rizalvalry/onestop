<?php
	include "./include/koneksi.php";
	$kelas = $_POST['kelas'];

	echo "<option value=''>Pilih Skala</option>";

	$skala = mysqli_query($conn, "SELECT * FROM skala WHERE id_kelas=? ORDER BY nama ASC");
	// $dewan1 = $conn->prepare($query);
	// $dewan1->bind_param("i", $kelas);
	// $dewan1->execute();
	// $res1 = $dewan1->get_result();
	while ($rowskala = mysqli_fetch_array($skala)) {
		echo "<option value='" . $rowskala['id_skala'] . "'>" . $rowskala['nama'] . "</option>";
	}
?>