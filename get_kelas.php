<?php
	include "include/koneksi.php";

	echo "<option value=''>Pilih Kelas</option>";

	$kelas = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama ASC");
	// $dewan1 = $conn->prepare($query);
	// $dewan1->execute();
	// $res1 = $dewan1->get_result();
	while ($rowkelas = mysqli_fetch_array($kelas)) {
		echo "<option value='" . $rowkelas['id_kelas'] . "'>" . $rowkelas['nama'] . "</option>";
	}
?>