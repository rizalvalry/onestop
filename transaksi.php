<?php
session_start();
if(isset($_SESSION['id'])){
?>

<?php
      include "include/header.php";
    ?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Transaksi</a>
        </li>
        <li class="breadcrumb-item active">Transaksi</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Data Transaksi</h3>
  <hr>
  <br>
  <div class="table-responsive">
  <table id="table" class="table" >
    <thead>
      <tr style="background-color: #e9ecef;">
        <th style="text-align: center;">No</th>
        <th>No. Order</th>
        <th>Nama</th>
        <th>Tanggal Terima</th>
        <th>Tanggal Ambil</th>
        <th>Item</th>
        <th>Diskon</th>
        <th>Total Bayar</th>
        <th style="text-align: center;" >Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php
        include "./include/koneksi.php";
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT transaksi.No_Order, transaksi.Tgl_Terima, pelanggan.Nama, transaksi.Tgl_Ambil, transaksi.total_berat, transaksi.diskon, transaksi.Total_Bayar, transaksi.status, transaksi.sisa_bayar FROM transaksi left join pelanggan ON transaksi.No_Identitas = pelanggan.No_Identitas ORDER BY transaksi.No_Order DESC");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
     <?php if ($hasil['status'] == "baru"){ ?>
  <tr style="background-color: #e49199;">
      <?php } elseif($hasil['status'] == "proses") { ?>
        <tr class="bg-warning"> 
          <?php } else { ?>
            <tr> 
      <?php } ?>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo $hasil['No_Order']; ?></td>
      <td><?php echo $hasil['Nama']; ?></td>
      <td><?php echo $hasil['Tgl_Terima']; ?></td>
      <td><?php echo $hasil['Tgl_Ambil']; ?></td>
      <td><?php echo $hasil['total_berat']; ?></td>
      <td><?php echo $hasil['diskon']; ?></td>
      <td><?php echo rupiah($hasil['Total_Bayar']); ?></td>
      <td style="text-align: center;">
      <?php if ($hasil['Tgl_Ambil'] == "" AND $hasil['status'] == "proses"){ ?>

      <a type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#ModalBayar<?php echo $hasil['No_Order']; ?>" ><span class="glyphicon glyphicon-repeat" ></span> Konfirmasi</a>
      <a href="cektransaksi.php?cek=<?php echo $hasil['No_Order']; ?>" class="btn btn-warning btn-sm">Lihat</a>
      <a href="download-laporan.php?cetak=<?php echo $hasil['No_Order']; ?>" class="btn btn-info btn-sm">Cetak</a>
      
      <!-- Modal Konfirmasi bayar -->
  <div class="modal fade bd-example-modal-sm" id="ModalBayar<?php echo $hasil['No_Order']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
  
  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3><?php echo $hasil['No_Order']; ?> : <?php echo $hasil['Nama']; ?></h3>
			</div>
			<div class="modal-body">
      <form>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12 ml-auto">
							<p>
              <label for="recipient-name" class="col-form-label">Sisa Bayar:</label>
                <input type="text" class="form-control" value="<?php echo $hasil['sisa_bayar']; ?>" id="totalbayar<?php echo $hasil['No_Order']; ?>">
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 ml-auto">
							<p>
              <label for="recipient-name" class="col-form-label">Terima Uang:</label>
                <input type="text" class="form-control" id="totalterima<?php echo $hasil['No_Order']; ?>">
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 ml-auto">
							<p>
              <label for="recipient-name" class="col-form-label">Kembalian:</label>
              <input type="text" class="form-control" id="totalkembalian<?php echo $hasil['No_Order']; ?>" data-a-sign="Rp. " data-a-dec="," data-a-sep=".">
							</p>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-md-12 ml-auto">
							<p>
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
							</p>
						</div>
					</div> -->
				</div>
			</div>
			<div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <a href="proses-konfirmasi.php?No_Order=<?php echo $hasil['No_Order']; ?>" class="btn btn-primary">Konfirmasi</a>
                </div>
      </form>
		</div>
	</div>

  </div>
        <!-- end konfirmasi -->    

      <?php } elseif($hasil['Tgl_Ambil'] == "" AND $hasil['status'] == "baru") { ?>
        <a href="cektransaksi.php?cek=<?php echo $hasil['No_Order']; ?>" class="btn btn-warning btn-sm">Lihat</a>
        <?php if($_SESSION['role_id'] == 1) { ?>
        <a href="proses-hapus-transaksi.php?hapus=<?php echo $hasil['No_Order']; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
        <?php } ?>
      
        <?php } else { ?>
          <a href="#" class="btn btn-primary btn-sm disabled" aria-disabled="true"><span class="glyphicon glyphicon-ok-sign" ></span> Selesai</a>
          <a href="cektransaksi.php?cek=<?php echo $hasil['No_Order']; ?>" class="btn btn-warning btn-sm">Lihat</a>
          <a href="download-laporan.php?cetak=<?php echo $hasil['No_Order']; ?>" class="btn btn-info btn-sm">Cetak</a>
          <?php if($_SESSION['role_id'] == 1) { ?>
          <a href="proses-hapus-transaksi.php?hapus=<?php echo $hasil['No_Order']; ?>" class="btn btn-danger btn-sm">Hapus</a></td>
          <?php } ?>

          <?php } ?>
    </tr>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#totalterima<?php echo $hasil['No_Order']; ?>, #totalbayar<?php echo $hasil['No_Order']; ?>").keyup(function() {
                var totalbayar  = $("#totalbayar<?php echo $hasil['No_Order']; ?>").val();
                var totalterima = $("#totalterima<?php echo $hasil['No_Order']; ?>").val();
    
                var total = totalterima - totalbayar;
                $("#totalkembalian<?php echo $hasil['No_Order']; ?>").val(total);
            });
        });
    </script>
    
  <?php
      $i++;
      }
    ?>

  </tbody>
  </table>  

</div>
  <br>
  <br>
</div>
</div>



<script>
    $(document).ready(function() {
	   $('#table').DataTable();
	} );
</script>
<?php
        include "include/footer.php"
?>
<?php
}else{
	header("location:login/index.php");
}
