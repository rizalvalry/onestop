<?php
session_start();
if(isset($_SESSION['id'])){
?>


    <?php
      include "include/header.php";
    ?>


<div class="content-wrapper">
    <div class="container-fluid">
  <h3>Form Tambah Data Pakaian</h3>
  <hr>
  <br>
        <form action="proses-tambah-pakaian.php" method="POST" >

                <div class="form-group">
                  <label>Kode Pakaian</label>
                  <input type="text" class="form-control"  onkeyup="this.value = this.value.toUpperCase();" name="Id_Pakaian" placeholder="Kode Pakaian" style="width: 250px" >
                </div>
                <div class="form-group">
                  <label>Jenis Pakaian</label>
                  <input type="text" class="form-control" name="Jenis_Pakaian" placeholder="Jenis Pakaian" style="width: 250px" >
                </div>
                <div class="form-group">
                <label>Harga Dry_Clean</label>
                  <input type="text" class="form-control" name="Dry_Clean" placeholder="Harga Dry_Clean" style="width: 250px" >
                </div>
                <div class="form-group">
                <label>Harga Reparasi</label>
                  <input type="text" class="form-control" name="Reparasi" placeholder="Harga Reparasi" style="width: 250px" >
                </div>
                <div class="form-group">
                <label>Harga Recolour</label>
                  <input type="text" class="form-control" name="Recolour" placeholder="Harga Recolour" style="width: 250px" >
                </div>
              <input type="submit" name="submit" value="Simpan" class="btn btn-success">
              <a href="pakaian"><input type="button" class="btn btn-default" value="Batal" ></a>
              </form>
</div>
</div>

<?php
        include "include/footer.php"
?>
<?php
}else{
	header("location:login/index.php");
}
