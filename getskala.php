<?php 
    include "./include/koneksi.php";
    $kelas =isset($_GET['kelas'])?$_GET['kelas']:""; 
    if($kelas!="") 
    { 
        $sql=mysqli_query($conn, "SELECT * FROM skala WHERE id_kelas='$kelas'"); 
      
?>
  <select class="form-control" name="id_skala" id="skala" >
        <option value="0">---Pilih Skala---</option>
            <?php 
                while($row=mysqli_fetch_array($sql)) 
                    { 
            ?>
        <option value="<?php echo $row['id_skala'];?>"><?php echo $row['nama_skala'];?></option>
            <?php 
                    } 
            ?>
  </select>
<?php 
    } 
?>