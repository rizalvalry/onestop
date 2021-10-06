            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th style="text-align: center;">No</th>
                      <th style="text-align: center;">No Order</th>
                      <th>Jenis Pakaian</th>
                      <th>Jenis Laundry</th>
                      <th>Jumlah Pakaian bro</th>
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
                      $detail = mysqli_query($conn, "SELECT pakaian.Jenis_Pakaian, laundry.Jenis_Laundry, detail_transaksi.No_Order, detail_transaksi.Id_Pakaian, detail_transaksi.Jumlah_pakaian, detail_transaksi.Id_Laundry FROM detail_transaksi  
                      join pakaian on detail_transaksi.Id_Pakaian = Pakaian.Id_Pakaian
                      join laundry on detail_transaksi.Id_Laundry = Laundry.Id_Laundry
                      Where No_Order = $no_o AND Jenis_Laundry = 'Cuci' AND admin_id=$admin_id");
                      while ($hasil = mysqli_fetch_array($detail)) {
                       $no_order = $hasil['No_Order'];
                   ?>
                <tr>
                    <td style="text-align: center;"><?php echo $i; ?></td>
                    <td><?php echo $hasil['No_Order']; ?></td>
                    <td><?php echo $hasil['Jenis_Pakaian']; ?></td>
                    <td><?php echo $hasil['Jenis_Laundry']; ?></td>
                    <td><?php echo $hasil['Jumlah_pakaian']; ?></td>
                    <td style="text-align: center;">
                    <button data-id="<?php echo $hasil['No_Order']; ?>" data-ids="<?php echo $hasil['Id_Pakaian']; ?>" data-idl="<?php echo $hasil['Id_Laundry']; ?>"  class="btn btn-danger btn-sm hapus_data_cuci"> <i class="fa fa-trash"></i> Hapus </button>
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
        $('#table').DataTable();
    } );



    $(document).on('click', '.hapus_data_cuci', function(){
        var id = $(this).attr('data-id');
        var ids = $(this).attr('data-ids');
        var idl = $(this).attr('data-idl');
        // var empid = $(this).attr('data-emp-id');
        $.ajax({
            type: 'POST',
            url: "hapus_detail_transaksi.php",
            data: { id: id, ids: ids, idl : idl},
            success: function() {
                $('.data-cuci').load("data-detail-transaksi-cuci.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>