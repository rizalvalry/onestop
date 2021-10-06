<div class="form-group">
  <label>Total Berat / Item</label>

  <?php
  include "./include/koneksi.php";
  session_start();
  
  $sql = mysqli_query($conn, "SELECT No_Order FROM detail_transaksi  ORDER BY No_Order Desc LIMIT 1");
  $hasil = mysqli_fetch_array($sql);
  $order = $hasil['No_Order'];
  ?>
  <input type="hidden" class="form-control" name="no_order" value="<?= $hasil['No_Order']; ?>">
  <?php
  $admin_id = $_SESSION['id'];
  $sql = mysqli_query($conn, "SELECT sum(total_berat) as total_berat, sum(total_harga) as total_harga FROM harga  where no_order = '$order' AND Id_Laundry = 4 AND admin_id=$admin_id");
  $hasil = mysqli_fetch_array($sql);
  ?>
  <input type="text" id="dryclean_total_berat" class="form-control" name="total_berat" onkeypress='validate(event)' placeholder="Total Berat" value="<?= $hasil['total_berat']; ?>" readonly>
</div>
<div class="form-group">
  <label>Total Bayar</label>
  <input type="text" id="dryclean-select" class="form-control" onkeypress='validate(event)' name="total_harga" value="<?= $hasil['total_harga']; ?>" readonly="true">     
</div>

<div class="table-responsive">
  <table id="table-reparasi" class="table table-striped table-bordered" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th style="text-align: center;">No Order</th>
        <th>Jenis Pakaian</th>
        <th>Jenis Laundry</th>
        <th>Jumlah Pakaian</th>
        <th>Total Harga</th>
        <th style="text-align: center;" >Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      include "./include/koneksi.php";
        $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
        while ($hasil = mysqli_fetch_array($sql)){
          $no = $hasil['No_Order'];
        }

        session_start();
        $admin_id = $_SESSION['id'];
        $no_o = $no + 1;
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT p.Jenis_Pakaian, l.Jenis_Laundry, dt.No_Order, dt.Id_Pakaian, dt.Jumlah_pakaian, dt.Id_Laundry, h.total_harga FROM detail_transaksi dt
                                      join pakaian p on dt.Id_Pakaian = p.Id_Pakaian
                                      join laundry l on dt.Id_Laundry = l.Id_Laundry
                                      join harga h on dt.Id_Pakaian = h.Id_Pakaian
                                      Where dt.No_Order = $no_o AND h.Id_Laundry = 4 AND l.Jenis_Laundry = 'Reparasi' AND dt.admin_id=$admin_id");
        while ($hasil = mysqli_fetch_array($sql)) {
          $no_order = $hasil['No_Order'];
      ?>
      <tr>
          <td style="text-align: center;"><?php echo $i; ?></td>
          <td><?php echo $hasil['No_Order']; ?></td>
          <td><?php echo $hasil['Jenis_Pakaian']; ?></td>
          <td><?php echo $hasil['Jenis_Laundry']; ?></td>
          <td><?php echo $hasil['Jumlah_pakaian']; ?></td>
          <td><?php echo $hasil['total_harga']; ?></td>
          <td style="text-align: center;">
          <button data-id="<?php echo $hasil['No_Order']; ?>" data-ids="<?php echo $hasil['Id_Pakaian']; ?>" data-idl="<?php echo $hasil['Id_Laundry']; ?>" class="btn btn-danger btn-sm hapus_data_rep"> <i class="fa fa-trash"></i> Hapus </button>
          </td>
      </tr>

      <?php
        $i++;
        }
      ?>

      <?php  
        $sql = mysqli_query($conn, "SELECT sum(Jumlah_pakaian) as jumlah FROM detail_transaksi where Id_Laundry = 4 AND No_Order = $no_order");
        $hargareparasi = mysqli_fetch_array($sql);
      ?>
    </tbody>
  </table>
</div>

  <!-- <div class="form-group row" style="display:none;">
<div class="col-xs-2">
  <label for="ex1">Sub Total Laundry</label>
  <input type="text" name="hargareparasi" id="hargareparasi" value="<?= $hargareparasi['jumlah']; ?>" class="form-control" readonly="true">
</div> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#table-reparasi').DataTable();
    } );
    
    function reset(){
        document.getElementById("err_nama_mahasiswa").innerHTML = "";
        document.getElementById("err_alamat").innerHTML = "";
        document.getElementById("err_jurusan").innerHTML = "";
        document.getElementById("err_tanggal_masuk").innerHTML = "";
        document.getElementById("err_jenkel").innerHTML = "";
    }


    $(document).on('click', '.hapus_data_rep', function(){
        var id = $(this).attr('data-id');
        var ids = $(this).attr('data-ids');
        var idl = $(this).attr('data-idl');
        // var empid = $(this).attr('data-emp-id');
        $.ajax({
            type: 'POST',
            url: "hapus_detail_transaksi.php",
            data: { id: id, ids: ids, idl : idl},
            success: function() {
                $('.data-reparasi').load("data-detail-transaksi-reparasi.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>