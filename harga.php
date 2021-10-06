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
          <a href="#">Data Harga</a>
        </li>
        <li class="breadcrumb-item active">Data Harga</li>
      </ol>
      <!-- Icon Cards-->
  
 


<div class="container">
  <h3>Data Harga Laundry Kilo</h3>
  <hr>

  <br>

<table id="tablehargakiloan" class="table table-striped table-bordered table-responsive" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th style="text-align: center;">Id</th>
        <th>Tipe</th>
        <th>Harga</th>
        <?php if($_SESSION['role_id'] == 1) { ?>
        <th>Aksi</th>
        <?php } ?>
      </tr>
    </thead>

    <tbody>
      <?php
        include "./include/koneksi.php";
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT *
        FROM laundry
        where Id_Laundry in (1,2,6)");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
  <tr>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo $hasil['Id_Laundry']; ?></td>
      <td><?php echo $hasil['Jenis_Laundry']; ?></td>
      <td><?php echo rupiah($hasil['Harga']); ?></td>
      <?php if($_SESSION['role_id'] == 1) { ?>
      <td style="text-align: center;"><a data-toggle="modal" data-target="#ModalHargaEdit<?php echo $hasil['Id_Laundry']; ?>" class="btn btn-warning">Edit</a></td>
     <?php } ?>
  </tr>

  <!-- Modal Edit -->
<div class="modal fade" id="ModalHargaEdit<?php echo $hasil['Id_Laundry']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalHargaEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="ModalHargaEditLabel">Edit Pakaian</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="proses-harga.php" method="post">
        <input type="hidden" class="form-control" name="Id_Laundry" value="<?php echo $hasil['Id_Laundry']; ?>" disable="true" readonly>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Jenis Pakaian:</label>
            <input type="text" class="form-control" value="<?php echo $hasil['Jenis_Laundry']; ?>" readonly>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Harga:</label>
            <input type="text" class="form-control" id="harga" name="Harga" value="<?php echo $hasil['Harga']; ?>">
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="updatedata" class="btn btn-primary">Submit</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
    <!-- end Edit -->

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
	   $('#tablehargakiloan').DataTable();
	  //  $('#tablejasa').DataTable();
	} );
</script>
<?php
        include "include/footer.php"
?>


<?php
}else{
	header("location:login/index.php");
} ?>
