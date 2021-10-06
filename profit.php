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
          <a href="#">Data Profit</a>
        </li>
        <li class="breadcrumb-item active">Data Profit</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Data Profit</h3>
  <hr>

  
  <br>
  <center>
		<a target="_blank" href="export_excel.php" class="btn btn-primary btn-sm">EXPORT KE EXCEL</a>
	</center>
  <table id="table" class="table table-striped table-bordered table-responsive" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th>No. </th>
        <th>profit</th>
     
      </tr>
    </thead>

    <tbody>
      <?php
        include "./include/koneksi.php";
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT sum(Total_Bayar) as total FROM transaksi");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
  <tr>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo $i; ?></td>
      <td><?php echo rupiah($hasil['total']); ?></td>
     
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


<?php
        include "include/footer.php"
?>


<?php
}else{
	header("location:login/index.php");
} ?>
