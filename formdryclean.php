<?php
$sql = mysqli_query($conn, "SELECT * FROM laundry where Id_Laundry = 3");
$laundry = mysqli_fetch_array($sql);
?>

<!-- isi -->
<div class="row">
          <div class="col-md-12">
            <form name="formdrycleanorder">
            <?php
            $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi  ORDER BY No_Order Desc LIMIT 1");
            while ($hasil = mysqli_fetch_array($sql)){
              ?>
                <div class="form-group">
                  <label>No. Order</label>
                  <input type="text" class="form-control" name="No_Order" value="<?php echo $hasil['No_Order']; ?>" readonly>
                </div>
                <?php
                    }
                    ?>

              
            </form>
          
            <div class="form-group">
              <!-- <div id="pesan" ></div> -->
              <div class="tombol" >
                <button type="button" class="btn btn-success btn-md " data-toggle="modal" data-target="#ModalTambahDryclean" ><span class="glyphicon glyphicon-plus " ></span> Tambah Detail Pakaian</button>
              </div>
              <br>

              <!-- pindah kesini -->
              <!-- <form name="formdryclean" action="proses-detail.php" method="post">
                <input type="hidden" class="form-control" name="Id_Laundry" value="<?= $laundry['Id_Laundry']; ?>">
              <div class="form-group">
                  <label>Total Berat / Item</label>

                  <?php
                  $sql = mysqli_query($conn, "SELECT No_Order FROM detail_transaksi  ORDER BY No_Order Desc LIMIT 1");
                  $hasil = mysqli_fetch_array($sql);
                  $order = $hasil['No_Order'];
                  ?>
                  <input type="hidden" class="form-control" name="no_order" value="<?= $hasil['No_Order']; ?>">
                  <?php
                  $admin_id = $_SESSION['id'];
                  $sql = mysqli_query($conn, "SELECT sum(total_berat) as total_berat, sum(total_harga) as total_harga FROM harga  where no_order = '$order' AND Id_Laundry = 3 AND admin_id=$admin_id");
                  $hasil = mysqli_fetch_array($sql);
                  ?>
                  <input type="text" id="dryclean_total_berat" class="form-control" name="total_berat" onkeypress='validate(event)' placeholder="Total Berat" value="<?= $hasil['total_berat']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Total Bayar</label>
                  <input type="text" id="dryclean-select" class="form-control" onkeypress='validate(event)' name="total_harga" value="<?= $hasil['total_harga']; ?>" readonly="true">     
                </div> -->
                
                <!-- <div class="form-group"> -->
                  <!-- <button class="btn btn-warning" id="drycleanenableselect">Custom ?</button>
                  <div style="display:none" class="form-group" id="drycleanalasan">
                  <label>Alasan</label>
                    <textarea class="form-control" value="Berikan Alasan"></textarea>
                  </div> -->
                  <!-- <input type="button" value="Tampil Total Bayar" onClick="tambahDryclean()" class="btn btn-primary"/> -->
                  <!-- <button type="submit" name="updatedryclean" class="btn btn-info">Simpan Perubahan</button> -->
                <!-- </div> -->
                  
              <!-- </form> -->
              <!-- akhir pindah -->

            <!-- table baru -->
              <div class="data-dryclean"></div>
              
  
            </div>
          </div>
        </div>

    </div>
</div>



<!-- Modal Tambah Data -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalTambahDryclean" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Tambah Transaksi <?= $laundry['Jenis_Laundry'] ?></h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
          <div class="modal-body">
          <form method="post" class="dryclean-form-data" id="dryclean-form-data">  
          <input type="hidden" name="id_ajax_dryclean" id="dryclean_cuci">
              <?php
                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
                while ($hasil = mysqli_fetch_array($sql)){
                  $na = $hasil['No_Order'];
              }
              ?>
              <input type="text" class="form-control" name="No_Order" id="Dryclean_No_Order" value="<?php echo $na + 1;  ?>" readonly>
              <div class="form-group">
                <label>Jenis Pakaian</label>
                <select class="form-control" name="Id_Pakaian" id="Id_Dryclean_Pakaian">
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
                <select class="form-control" name="Id_Laundry" id="Id_Dryclean_Laundry">
                  <option value="3">Dry Clean</option>
                </select>
              </div>

							<div class="form-group">
								<label>Jumlah Pakaian</label>
								<input type="text" class="form-control" name="Jumlah_Pakaian" id="Jumlah_Dryclean_Pakaian" onkeypress='validate(event)' placeholder="Jumlah pakaian" >
							</div>
							<div class="modal-footer">
              <button type="button" name="simpan-cuci" id="dryclean-simpan" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-save"></i> Simpan
				</button>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</form>
					</div>
        <!-- selesai isi -->


        <?php
$sql = mysqli_query($conn, "SELECT Harga FROM laundry where Id_Laundry = 3");
$cuci = mysqli_fetch_array($sql);
?>

<script type="text/javascript">
// setrika
d=eval(formdrycleanorder.No_Order.value)
e = d+1
formdrycleanorder.No_Order.value=e
    function tambahDryclean()
      {
        a=eval(formdryclean.dryclean_total_berat.value)
        // b=eval(formdryclean.diskon.value)
        l=eval(hargalaundry.value)
        formdryclean.total_berat.value=l
        c=(l*<?= $cuci['Harga']; ?>)
        // b=eval(formdryclean.b.value)
        // c=a+b
        formdryclean.total_harga.value=c
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
        $("#down-payment, #dryclean-select").keyup(function() {

          $('#kolomsisa').show();

            var totalakhir  = $("#dryclean-select").val();
            var uangdp = $("#down-payment").val();

            var total = totalakhir - uangdp;
            $("#numbers").val(total);
        });
    });
      
$('#drycleanenableselect').click(function() {
    $('#dryclean-select')
          .attr("readonly", false);

      $('#dryclean-select')
          .attr('disabled', false)
        .attr('id', 'dryclean-select');

        $('#drycleanalasan').show();
      
      $('#drycleanenableselect').hide();
      return false;
  });

  
//  start here
$(document).ready(function(){
		//Mengirimkan Token Keamanan
	

	    $('.data-dryclean').load("data-detail-transaksi-dryclean.php");
	    $("#dryclean-simpan").click(function(){
	        var data = $('.dryclean-form-data').serialize();
          var No_Order = $("#Dryclean_No_Order").val();
          var Id_Pakaian = $("#Id_Dryclean_Pakaian").val();
          var Id_Laundry = $("#Id_Dryclean_Laundry").val();
          var Jumlah_Pakaian = $("#Jumlah_Dryclean_Pakaian").val();
            
           

            if (No_Order!="" && Id_Pakaian!=""  && Id_Laundry!=""  && Jumlah_Pakaian!="" ) {
            	$.ajax({
		            type: 'POST',
		            url: "form_detail_transaksi.php",
		            data: data,
		            success: function() {
		                $('.data-dryclean').load("data-detail-transaksi-dryclean.php");
		                document.getElementById("dryclean_cuci").value = "";
		                document.getElementById("dryclean-form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	        
	    });
	});

</script>