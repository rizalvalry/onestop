<?php
session_start();
if(isset($_SESSION['id'])){
?>


    <?php
      include "include/header.php";
    ?>



<div class="content-wrapper">
    <div class="container-fluid">
  <h3>Form Edit Data Pakaian</h3>
  <hr>
  <br>
  <?php
    include "./include/koneksi.php";
    $Id_Pakaian = $_GET['edit'];

    $sql = mysqli_query($conn, "SELECT * FROM pakaian WHERE Id_Pakaian='".$Id_Pakaian."'");
    while ($hasil = mysqli_fetch_array($sql)) {
 ?>
        <form action="proses-edit-pakaian.php" method="POST" >
                <div class="form-group">
                  <label>Kode Pakaian</label>
                  <input type="text" class="form-control" name="Id_Pakaian" placeholder="Kode Pakaian" style="width: 250px" readonly="readonly" value="<?php echo $hasil['Id_Pakaian']; ?>" >
                </div>
                <div class="form-group">
                  <label>Jenis Pakaian</label>
                  <input type="text" class="form-control" name="Jenis_Pakaian" placeholder="Jenis Pakaian" style="width: 250px" value="<?php echo $hasil['Jenis_Pakaian']; ?>" >
                </div>
                <div class="form-group">
                  <label>Harga Dry_Clean</label>
                  <input type="text" class="form-control" name="Dry_Clean" placeholder="Harga Dry_Clean" style="width: 250px" value="<?php echo $hasil['Dry_Clean']; ?>" >
                </div>
                <div class="form-group">
                  <label>Harga Reparasi</label>
                  <input type="text" class="form-control" name="Reparasi" placeholder="Harga Reparasi" style="width: 250px" value="<?php echo $hasil['Reparasi']; ?>" >
                </div>
                <div class="form-group">
                  <label>Harga Recolour</label>
                  <input type="text" class="form-control" name="Recolour" placeholder="Harga Recolour" style="width: 250px" value="<?php echo $hasil['Recolour']; ?>" >
                </div>
              <input type="submit" name="submit" value="Simpan" class="btn btn-success">
              <a href="pakaian.php"><input type="button" class="btn btn-default" value="Batal" ></a>
              </form>
            <?php
          } ?>
</div>
</div>
<?php
        include "include/footer.php"
?>
<?php
}else{
	header("location:login/index.php");
}
