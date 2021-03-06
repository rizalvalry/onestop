<div class="form-group">
  <label>Total Berat / Item</label>

  <?php
  include "./include/koneksi.php";
  session_start();
  
  $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
  while ($hasil = mysqli_fetch_array($sql)){
    $order = $hasil['No_Order']+1;
  }
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

        $admin_id = $_SESSION['id'];
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT * FROM
        (SELECT p.Jenis_Pakaian, l.Jenis_Laundry, d.No_Order, d.Id_Pakaian, d.Jumlah_pakaian, d.Id_Laundry from detail_transaksi d
        join pakaian p on d.Id_Pakaian = p.Id_Pakaian
        join laundry l on d.Id_Laundry = l.Id_Laundry
        where No_Order = $order AND d.Id_Laundry = 4 AND admin_id=$admin_id)
        as t1
        join (SELECT total_harga, Id_Pakaian as idpakaian FROM harga where no_order = $order AND Id_Laundry = 4) as t2 on t1.Id_Pakaian = t2.idpakaian");
        while ($hasil = mysqli_fetch_array($sql)) {
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

    </tbody>
  </table>
</div>

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