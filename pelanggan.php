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
          <a href="#">Data Pelanggan</a>
        </li>
        <li class="breadcrumb-item active">Data Pelanggan</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Data Pelanggan</h3>
  <hr>
  <div class="tombol" >
    <a href="tambahdatapelanggan.php"><button type="button" class="btn btn-success btn-md " >Tambah Data </button></a>
  </div>
  <br>
  <table id="table" class="table table-striped table-bordered table-responsive" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th>No. Identitas</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No. Hp</th>
        <th style="text-align: center;" >Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php
        include "./include/koneksi.php";
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY `No_Identitas`");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
  <tr>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo $hasil['No_Identitas']; ?></td>
      <td><?php echo $hasil['Nama']; ?></td>
      <td><?php echo $hasil['Alamat']; ?></td>
      <td><?php echo $hasil['No_Hp']; ?></td>
      <td style="text-align: center;">
        <a href="editdatapelanggan.php?edit=<?php echo $hasil['No_Identitas']; ?>" class="btn btn-warning">Edit</a>
        <?php if ($_SESSION['role_id']==1) { ?>
        <a href="proses-hapus-pelanggan.php?hapus=<?php echo $hasil['No_Identitas']; ?>" class="btn btn-danger">Hapus</a>
        <?php } ?>
      </td>
  </tr>
  <?php
      $i++;
      }
    ?>

  </tbody>
  </table>
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
