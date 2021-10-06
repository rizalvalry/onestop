<?php
$sql = mysqli_query($conn, "SELECT * FROM laundry where Id_Laundry = 2");
$laundry = mysqli_fetch_array($sql);
?>

<!-- isi -->
<div class="row">
          <div class="col-md-12">
            <form name="formcucisetrikaorder">
            <?php
            $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
            while ($hasil = mysqli_fetch_array($sql)){
              $order = $hasil['No_Order'];
              ?>
                <div class="form-group">
                  <label>No. Order</label>
                  <input type="text" class="form-control" name="No_Order" value="<?php echo $order; ?>" readonly>
                </div>
                <?php
                    }
                    ?>

              
            </form>
          
            <div class="form-group">
              <!-- <div id="pesan" ></div> -->
              <div class="tombol" >
                <button type="button" class="btn btn-success btn-md " data-toggle="modal" data-target="#ModalTambahcucisetrika" ><span class="glyphicon glyphicon-plus " ></span> Tambah Detail Pakaian</button>
              </div>
              <br>

              <!-- pindah kesini -->
              <form name="formcucisetrika" action="proses-detail.php" method="post">
                <input type="hidden" class="form-control" name="Id_Laundry" value="<?= $laundry['Id_Laundry']; ?>">
              <div class="form-group">
                  <label>Total Berat / Item</label>

                  <?php
                  // $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
                  // $hasil = mysqli_fetch_array($sql);
                  // $order = $hasil['No_Order'];
                  ?>
                  <input type="hidden" class="form-control" name="no_order" value="<?= $order+1; ?>">
                  <?php
                  $admin_id = $_SESSION['id'];
                  $sql = mysqli_query($conn, "SELECT * FROM harga  where no_order = $order+1 AND Id_Laundry = 2 AND admin_id=$admin_id");
                  $hasil = mysqli_fetch_array($sql);
                  ?>
                  <input type="text" id="cucisetrika_total_berat" class="form-control" name="total_berat" onkeypress='validate(event)' placeholder="Total Berat" value="<?= $hasil['total_berat']; ?>">
                </div>
                <div class="form-group">
                  <label>Total Bayar</label>
                  <input type="text" id="cucisetrika-select" class="form-control" onkeypress='validate(event)' name="total_harga" value="<?= $hasil['total_harga']; ?>" readonly="true">     
                </div>
                
                <div class="form-group">
                  <button class="btn btn-warning" id="cucisetrikaenableselect">Custom ?</button>
                  <div style="display:none" class="form-group" id="cucisetrikaalasan">
                  <label>Alasan</label>
                    <textarea class="form-control" value="Berikan Alasan"></textarea>
                  </div>
                  <input type="button" value="Tampil Total Bayar" onClick="tambahcucisetrika()" class="btn btn-primary"/>
                  <button type="submit" name="updatecucisetrika" class="btn btn-info">Simpan Perubahan</button>
                </div>
                  
              </form>
              <!-- akhir pindah -->

            <!-- table baru -->
              <div class="data-cucisetrika"></div>
              
  
            </div>
          </div>
        </div>

    </div>
</div>



<!-- Modal Tambah Data -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalTambahcucisetrika" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Tambah Transaksi <?= $laundry['Jenis_Laundry'] ?></h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
          <div class="modal-body">
          <form method="post" class="cucisetrika-form-data" id="cucisetrika-form-data">  
          <input type="hidden" name="id_ajax_cucisetrika" id="cucisetrika_cuci">
              <?php
                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
                while ($hasil = mysqli_fetch_array($sql)){
                  $na = $hasil['No_Order'];
              }
              ?>
              <input type="text" class="form-control" name="No_Order" id="cucisetrika_No_Order" value="<?php echo $na + 1;  ?>" readonly>
              <div class="form-group">
                <label>Jenis Pakaian</label>
                <select class="form-control" name="Id_Pakaian" id="Id_cucisetrika_Pakaian">
                  <?php
                    $sql = mysqli_query($conn, "SELECT * FROM pakaian ORDER BY Jenis_Pakaian");
                    while ($hasil = mysqli_fetch_array($sql)){

                  ?>
                  <option value="<?=$hasil['Id_Pakaian'];?>"><?=$hasil['Jenis_Pakaian'];?></option>
                  <?php
                  }
                   ?>
                </select>
              </div>

              <div class="form-group">
                <label>Jenis Laundry</label>
                <select class="form-control" name="Id_Laundry" id="Id_cucisetrika_Laundry">
                  <option value="2">Cuci & Setrika</option>
                </select>
              </div>

							<div class="form-group">
								<label>Jumlah Pakaian</label>
								<input type="text" class="form-control" name="Jumlah_Pakaian" id="Jumlah_cucisetrika_Pakaian" onkeypress='validate(event)' placeholder="Jumlah pakaian" >
							</div>
							<div class="modal-footer">
              <button type="button" name="simpan-cuci" id="cucisetrika-simpan" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-save"></i> Simpan
				</button>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</form>
					</div>
        <!-- selesai isi -->


        <?php
$sql = mysqli_query($conn, "SELECT Harga FROM laundry where Id_Laundry = 2");
$cuci = mysqli_fetch_array($sql);
?>

<script type="text/javascript">
// setrika
d=eval(formcucisetrikaorder.No_Order.value)
e = d+1
formcucisetrikaorder.No_Order.value=e
    function tambahcucisetrika()
      {
        a=eval(formcucisetrika.cucisetrika_total_berat.value)
        // b=eval(formcucisetrika.diskon.value)
        c=(a*<?= $cuci['Harga']; ?>)
        if (a <= 3) {
          c = <?= $cuci['Harga'] * 3 ?>;
        } else {
          c =  a * <?= $cuci['Harga'] ?>;
        }
        // b=eval(formcucisetrika.b.value)
        // c=a+b
        formcucisetrika.total_harga.value=c
      }


      function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
          theEvent.returnValue = false;
          if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }


    $(document).ready(function() {
      $("#kolomsisa").hide();
    });


    $(document).ready(function() {
        $("#down-payment, #cucisetrika-select").keyup(function() {

          $('#kolomsisa').show();

            var totalakhir  = $("#cucisetrika-select").val();
            var uangdp = $("#down-payment").val();

            var total = totalakhir - uangdp;
            $("#numbers").val(total);
        });
    });
      
$('#cucisetrikaenableselect').click(function() {
    $('#cucisetrika-select')
          .attr("readonly", false);

      $('#cucisetrika-select')
          .attr('disabled', false)
        .attr('id', 'cucisetrika-select');

        $('#cucisetrikaalasan').show();
      
      $('#cucisetrikaenableselect').hide();
      return false;
  });

  
//  start here
$(document).ready(function(){
		//Mengirimkan Token Keamanan
	

	    $('.data-cucisetrika').load("data-detail-transaksi-cucisetrika.php");
	    $("#cucisetrika-simpan").click(function(){
	        var data = $('.cucisetrika-form-data').serialize();
          var No_Order = $("#cucisetrika_No_Order").val();
          var Id_Pakaian = $("#Id_cucisetrika_Pakaian").val();
          var Id_Laundry = $("#Id_cucisetrika_Laundry").val();
          var Jumlah_Pakaian = $("#Jumlah_cucisetrika_Pakaian").val();
            
           

            if (No_Order!="" && Id_Pakaian!=""  && Id_Laundry!=""  && Jumlah_Pakaian!="" ) {
            	$.ajax({
		            type: 'POST',
		            url: "form_detail_transaksi.php",
		            data: data,
		            success: function() {
		                $('.data-cucisetrika').load("data-detail-transaksi-cucisetrika.php");
		                document.getElementById("cucisetrika_cuci").value = "";
		                document.getElementById("cucisetrika-form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	        
	    });
	});

</script>