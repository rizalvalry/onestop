<?php
session_start();
if(isset($_SESSION['id'])){
?>

    <?php
      include "include/header.php";
    ?>


<div class="content-wrapper">
    <div class="container-fluid">
  <h3>Form Edit Data Pelanggan</h3>
  <hr>
  <br>
  <?php
    include "./include/koneksi.php";
    $No_Identitas = $_GET['edit'];

    $sql = mysqli_query($conn, "SELECT * FROM pelanggan WHERE No_Identitas='".$No_Identitas."'");
    while ($hasil = mysqli_fetch_array($sql)) {
 ?>
        <form action="proses-edit-pelanggan.php" method="POST" >
              <div class="form-group">
                <label>No. Identitas</label>
                <input type="text" class="form-control" name="No_Identitas" placeholder="No. Identitas" style="width: 250px" readonly="readonly" value="<?php echo $hasil['No_Identitas']; ?>" >
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="Nama" placeholder="Nama" style="width: 250px" value="<?php echo $hasil['Nama']; ?>" >
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="Alamat" placeholder="Alamat" style="width: 250px" value="<?php echo $hasil['Alamat']; ?>" >
              </div>
              <div class="form-group">
                <label>No. Hp</label>
                <input type="text" class="form-control" name="No_Hp" placeholder="No. Hp" style="width: 250px" value="<?php echo $hasil['No_Hp']; ?>" >
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="Email" placeholder="Email" style="width: 250px" value="<?php echo $hasil['Email']; ?>" >
              </div>
              <input type="submit" name="submit" value="Simpan" class="btn btn-success">
              <a href="pelanggan.php"><input type="button" class="btn btn-default" value="Batal" ></a>
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
