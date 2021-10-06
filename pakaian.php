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
          <a href="#">Data Barang</a>
        </li>
        <li class="breadcrumb-item active">Data Barang</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Data Pakaian</h3>
  <hr>
  <?php if ($_SESSION['role_id']==1) { ?>
  <div class="tombol" >
    <a href="tambahdatapakaian.php"><button type="button" class="btn btn-success btn-md " >Tambah Data </button></a>
  </div>
  <br>
  <?php } ?>
<div class="table-responsive">
  <table id="table" class="table table-striped table-bordered" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th>Kode Pakaian</th>
        <th>Jenis Pakaian</th>
        <th>Harga Dry Clean</th>
        <th>Harga Reparasi</th>
        <th>Harga Recolor</th>
        <?php if ($_SESSION['role_id']==1) { ?>
          <th style="text-align: center;" >Aksi</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php
        include "./include/koneksi.php";
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY Jenis_Pakaian");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
  <tr>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo $hasil['Id_Pakaian']; ?></td>
      <td><?php echo $hasil['Jenis_Pakaian']; ?></td>
      <td><?php echo $hasil['Dry_Clean']; ?></td>
      <td><?php echo $hasil['Reparasi']; ?></td>
      <td><?php echo $hasil['Recolour']; ?></td>
      <?php if ($_SESSION['role_id']==1) { ?>
      <td style="text-align: center;">
      <a href="editdatapakaian.php?edit=<?php echo $hasil['Id_Pakaian']; ?>" class="btn btn-warning">Edit</a>
      <a href="proses-hapus-pakaian.php?hapus=<?php echo $hasil['Id_Pakaian']; ?>" class="btn btn-danger">Hapus</a></td>
      <?php } ?>
  </tr>
  <?php
      $i++;
      }
    ?>

  </tbody>
  </table>
  </div>
<br>
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
