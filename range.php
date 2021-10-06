<!DOCTYPE html>
<html>
<head>
	<title>Date Range PHP</title>
</head>
<body>
	<h3>MySQL- Get Data Between Two Dates</h3>
	
	<h4>Sales Report</h4>

	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Products</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$koneksi = mysqli_connect('localhost','root','','db_date') or die (mysqli_error());
				$sql = "SELECT * FROM tbl_sales";
				$query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));
				
				$no = 1;

				while($data = mysqli_fetch_array($query)){?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $data['product'];?></td>
						<td><?php echo $data['tanggal'];?></td>
					</tr>

					<?php $no++; ?>
				
				<?php }
			?>
		</tbody>
	</table>
		
	<br>	

	<form action="" method="post">
		<input type="date" name="tgl1">
		<input type="date" name="tgl2">
		<input type="submit" name="tampilkan" value="TAMPILKAN">
	</form>
	
	<h3>Hasil Sorting by Tanggal</h3>
	<p>Akan ditampilkan dibawah ini!<i>(filenya proses akan disatukan langsung dengan isset PHP)</i></p>
	
	<?php
		if(isset($_POST["tampilkan"])){
			$dt1 = $_POST["tgl1"];
			$dt2 = $_POST["tgl2"];

			$no = 1;

			$sql = "SELECT * FROM tbl_sales WHERE tanggal BETWEEN '$dt1' AND '$dt2'";
			$query = mysqli_query($koneksi,$sql) or die (mysqli_error($koneksi));

			echo "<table border='1'>
					<thead>
						<tr>
							<th>No</th>
							<th>Products</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>";

					while($data = mysqli_fetch_array($query)){?>
						
						<tr>
							<td><?php echo $no;?></td>
							<td><?php echo $data['product'];?></td>
							<td><?php echo $data['tanggal'];?></td>
						</tr>

						<?php $no++; ?>

					<?php }

			echo "	</tbody>
				  </table>";

		}
			
	?>

</body>
</html>