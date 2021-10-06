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
          <a href="#">Data User</a>
        </li>
        <li class="breadcrumb-item active">Data User</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Data User</h3>
  <hr>
  <div class="tombol" >
    <a href="#" data-toggle="modal" data-target="#ModalUserTambah"><button type="button" class="btn btn-success btn-md " >Tambah Data </button></a>
  </div>
  <br>
  <table id="table" class="table table-striped table-bordered table-responsive" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>

        <th style="text-align: center;" >Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php
        include "./include/koneksi.php";
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT * FROM admin");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
  <tr>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo $hasil['nama']; ?></td>
      <td><?php echo $hasil['email']; ?></td>
      <td><?php echo $hasil['role_id'] == 2 ? "Kasir" : "Administrator"; ?></td>

      <td style="text-align: center;"><a data-toggle="modal" data-target="#ModalUserEdit<?php echo $hasil['id']; ?>" class="btn btn-warning">Edit</a>
      <a href="proses-user.php?hapus=<?php echo $hasil['id']; ?>"  class="btn btn-danger">Hapus</a></td>
  </tr>

  <!-- Modal Edit -->
<div class="modal fade" id="ModalUserEdit<?php echo $hasil['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUserEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="ModalUserEditLabel">Edit User</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="proses-user.php" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama:</label>
            <input type="hidden" class="form-control" name="id" value="<?php echo $hasil['id']; ?>" id="id" disable="true" readonly>
            <input type="text" class="form-control" name="nama" value="<?php echo $hasil['nama']; ?>" id="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo $hasil['email']; ?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Hp:</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?php echo $hasil['no_hp']; ?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="pass" id="pass" value="<?php echo $hasil['pass']; ?>">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Role:</label>
            <input type="text" class="form-control" id="role" value="<?php echo $hasil['role_id'] == 2 ? "Kasir" : "Administrator"; ?>" readonly>
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

<!-- Modal Tambah -->
<div class="modal fade" id="ModalUserTambah" tabindex="-1" role="dialog" aria-labelledby="ModalUserTambahLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="ModalUserTambahLabel">Tambah User</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="proses-user.php" method="post">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nama:</label>
            <input type="text" class="form-control" name="nama"  id="nama">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" class="form-control" name="email" id="email" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Hp:</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Password:</label>
            <input type="password" class="form-control" name="pass" id="pass" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Role:</label>
            <select class="form-control" name="role_id">
                   
                    <option value="1">Administrator</option>
                    <option value="2">Pegawai</option>
                   
            </select>
          </div>
          
          <input type="hidden" class="form-control" name="is_active" id="is_active" value="1" disabled="true">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="simpandata" class="btn btn-primary">Submit</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>
    <!-- end Tambah -->

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
