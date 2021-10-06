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
          <a href="#">Profil Aplikasi</a>
        </li>
        <li class="breadcrumb-item active">Profil Aplikasi</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Profil Aplikasi</h3>
  <hr>
  <br>
  <table id="table" class="table table-striped table-bordered table-responsive" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th>Nama Profil</th>
        <th>Email Profil</th>
        <th>Tag Promo</th>
        <th>No Telp</th>
        <th>Lokasi</th>
        <th>No Rek</th>
        <th>Logo</th>
        <?php if($_SESSION['role_id'] == 1) { ?>
        <th style="text-align: center;" >Aksi</th>
        <?php } ?>
      </tr>
    </thead>

    <tbody>
      <?php
        include "./include/koneksi.php";
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT * FROM profil");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
  <tr>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo $hasil['nama_profil']; ?></td>
      <td><?php echo $hasil['email']; ?></td>
      <td><?php echo $hasil['tag']; ?></td>
      <td><?php echo $hasil['no_telp']; ?></td>
      <td><?php echo $hasil['lokasi']; ?></td>
      <td><?php echo $hasil['no_rekening']; ?></td>
      <td><image src="logo/<?php echo $hasil['gambar'];?>" width="50"> </td>
      <?php if($_SESSION['role_id'] == 1) { ?>
      <td style="text-align: center;"><a data-toggle="modal" data-target="#ModalUserEdit<?php echo $hasil['id']; ?>" class="btn btn-warning">Edit</a></td>
      <?php } ?>   
   </tr>

  <!-- Modal Edit -->
<div class="modal fade" id="ModalUserEdit<?php echo $hasil['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUserEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="ModalUserEditLabel">Edit Profil Aplikasi</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="proses-profil.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama:</label>
            <input type="hidden" class="form-control" name="id" value="<?php echo $hasil['id']; ?>" id="id" disable="true" readonly>
            <input type="text" class="form-control" name="nama_profil" value="<?php echo $hasil['nama_profil']; ?>" id="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $hasil['email']; ?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Tag Promo:</label>
            <textarea class="form-control" name="tag" id="tag"><?php echo $hasil['tag']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No Telp:</label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" value="<?php echo $hasil['no_telp']; ?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No Telp 2:</label>
            <input type="text" class="form-control" name="no_telp2" id="no_telp2" value="<?php echo $hasil['no_telp2']; ?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Lokasi:</label>
            <textarea type="text" class="form-control" name="lokasi" id="lokasi"><?php echo $hasil['lokasi']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">No Rek:</label>
            <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?php echo $hasil['no_rekening']; ?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Logo saat ini:</label>
            <image src="logo/<?php echo $hasil['gambar'];?>" width="100">
            <div class="mb-4"></div>
            <!-- <input name="gambar" type="file" size="30" maxlength="30" onchange="readURL(this);" /> -->
            <input type="file" name="gambar_profil" />
          </div>

          <!-- <div class="form-group">
							<label class="control-label col-sm-4">Preview Gambar</label>
							<div class="col-sm-4">
								<img id="preview_gambar" src="images/slide.png" class="img-thumbnail" />
							</div>
						</div> -->
          
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
    function readURL(input) { // Mulai membaca inputan gambar
		if (input.files && input.files[0]) {
			var reader = new FileReader(); // Membuat variabel reader untuk API FileReader
		 
			reader.onload = function (e) { // Mulai pembacaan file
				$('#preview_gambar') // Tampilkan gambar yang dibaca ke area id #preview_gambar
				.attr('src', e.target.result)
				.width(150); // Menentukan lebar gambar preview (dalam pixel)
				//.height(200); // Jika ingin menentukan lebar gambar silahkan aktifkan perintah pada baris ini
			};
		 
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>

<?php
        include "include/footer.php"
?>

<?php
}else{
	header("location:login/index.php");
}
