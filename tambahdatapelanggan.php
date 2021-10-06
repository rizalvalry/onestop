<?php
session_start();
if(isset($_SESSION['id'])){
?>

    <?php
      include "include/header.php";
    ?>



<div class="content-wrapper">
    <div class="container-fluid">
  <h3>Form Tambah Data Pelanggan</h3>
  <hr>
  <br>
        <form action="proses-tambah-pelanggan.php" method="POST" >
                <div class="form-group">
                  <label>No. Identitas</label>
                  <input type="text" class="form-control" name="No_Identitas" placeholder="No. Identitas" style="width: 250px" >
                </div>
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="Nama" placeholder="Nama" style="width: 250px" >
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control" name="Alamat" placeholder="Alamat" style="width: 250px" >
                </div>
                <div class="form-group">
                  <label>No. Hp</label>
                  <input type="text" class="form-control" name="No_Hp" placeholder="No. Hp" style="width: 250px" >
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" name="Email" placeholder="Email" style="width: 250px" >
                </div>
              <input type="submit" name="submit" value="Simpan" class="btn btn-success">
              <a href="pakaian.php"><input type="button" class="btn btn-default" value="Batal" ></a>
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
