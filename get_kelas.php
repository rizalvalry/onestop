<?php
	include "include/koneksi.php";

	echo "<option value=''>Pilih Kelas</option>";

	$query = mysqli_query($conn, "SELECT * FROM kelas ORDER BY nama ASC");
	// $dewan1 = $conn->prepare($query);
	// $dewan1->execute();
	// $res1 = $dewan1->get_result();
	while ($row = mysqli_fetch_array($query)) {
		echo "<option value='" . $row['id_kelas'] . "'>" . $row['nama'] . "</option>";
	}
?>