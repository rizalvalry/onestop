<?php
$sql = mysqli_query($conn, "SELECT * FROM laundry where Id_Laundry = 1");
$laundry = mysqli_fetch_array($sql);
?>

<!-- isi -->
<div class="row">
          <div class="col-md-12">
            <form name="formsetrikaorder">
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
                <button type="button" class="btn btn-success btn-md " data-toggle="modal" data-target="#ModalTambahsetrika" ><span class="glyphicon glyphicon-plus " ></span> Tambah Detail Pakaian</button>
              </div>
              <br>

              <!-- pindah kesini -->
              <form name="formsetrika" action="proses-detail.php" method="post">
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
                  $sql = mysqli_query($conn, "SELECT * FROM harga  where no_order = '$order' AND Id_Laundry = 1 AND admin_id=$admin_id");
                  $hasil = mysqli_fetch_array($sql);
                  ?>
                  <input type="text" id="setrika_total_berat" class="form-control" name="total_berat" onkeypress='validate(event)' placeholder="Total Berat" value="<?= $hasil['total_berat']; ?>">
                </div>
                <div class="form-group">
                  <label>Total Bayar</label>
                  <input type="text" id="setrika-select" class="form-control" onkeypress='validate(event)' name="total_harga" value="<?= $hasil['total_harga']; ?>" readonly="true">     
                </div>
                
                <div class="form-group">
                  <button class="btn btn-warning" id="setrikaenableselect">Custom ?</button>
                  <div style="display:none" class="form-group" id="setrikaalasan">
                  <label>Alasan</label>
                    <textarea class="form-control" value="Berikan Alasan"></textarea>
                  </div>
                  <input type="button" value="Tampil Total Bayar" onClick="tambahsetrika()" class="btn btn-primary"/>
                  <button type="submit" name="updatedatasetrika" class="btn btn-info">Simpan Perubahan</button>
                </div>
                  
              </form>
              <!-- akhir pindah -->

            <!-- table baru -->
              <div class="data-setrika"></div>
              
  
            </div>
          </div>
        </div>

    </div>
</div>



<!-- Modal Tambah Data -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalTambahsetrika" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Tambah Transaksi <?= $laundry['Jenis_Laundry'] ?></h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
          <div class="modal-body">
          <form method="post" class="setrika-form-data" id="setrika-form-data">  
          <input type="hidden" name="id_ajax_setrika" id="id_ajax_setrika">
              <?php
                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
                while ($hasil = mysqli_fetch_array($sql)){
                  $na = $hasil['No_Order'];
              }
              ?>
              <input type="text" class="form-control" name="No_Order" id="setrika_No_Order" value="<?php echo $na + 1;  ?>" readonly>
              <div class="form-group">
                <label>Jenis Pakaian</label>
                <select class="form-control" name="Id_Pakaian" id="Id_setrika_Pakaian">
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
                <select class="form-control" name="Id_Laundry" id="Id_setrika_Laundry">
                  <option value="1">Setrika</option>
                </select>
              </div>

							<div class="form-group">
								<label>Jumlah Pakaian</label>
								<input type="text" class="form-control" name="Jumlah_Pakaian" id="Jumlah_setrika_Pakaian" onkeypress='validate(event)' placeholder="Jumlah pakaian" >
							</div>
							<div class="modal-footer">
              <button type="button" name="simpan-setrika" id="setrika-simpan" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-save"></i> Simpan
				</button>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</form>
					</div>
        <!-- selesai isi -->


        <?php
$sql = mysqli_query($conn, "SELECT Harga FROM laundry where Id_Laundry = 1");
$setrika = mysqli_fetch_array($sql);
?>

<script type="text/javascript">
// setrika
d=eval(formsetrikaorder.No_Order.value)
e = d+1
formsetrikaorder.No_Order.value=e
    function tambahsetrika()
      {
        a=eval(formsetrika.setrika_total_berat.value)
        // b=eval(formsetrika.diskon.value)
        c=(a*<?= $setrika['Harga']; ?>)
        if (a <= 3) {
          c = <?= $setrika['Harga'] * 3 ?>;
        } else {
          c =  a * <?= $setrika['Harga'] ?>;
        }
        // b=eval(formsetrika.b.value)
        // c=a+b
        formsetrika.total_harga.value=c
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
        $("#down-payment, #setrika-select").keyup(function() {

          $('#kolomsisa').show();

            var totalakhir  = $("#setrika-select").val();
            var uangdp = $("#down-payment").val();

            var total = totalakhir - uangdp;
            $("#numbers").val(total);
        });
    });
      
$('#setrikaenableselect').click(function() {
    $('#setrika-select')
          .attr("readonly", false);

      $('#setrika-select')
          .attr('disabled', false)
        .attr('id', 'setrika-select');

        $('#setrikaalasan').show();
      
      $('#setrikaenableselect').hide();
      return false;
  });

  
//  start here
$(document).ready(function(){
		//Mengirimkan Token Keamanan
	

	    $('.data-setrika').load("data-detail-transaksi-setrika.php");
	    $("#setrika-simpan").click(function(){
	        var data = $('.setrika-form-data').serialize();
          var No_Order = $("#setrika_No_Order").val();
          var Id_Pakaian = $("#Id_setrika_Pakaian").val();
          var Id_Laundry = $("#Id_setrika_Laundry").val();
          var Jumlah_Pakaian = $("#Jumlah_setrika_Pakaian").val();
            
           

            if (No_Order!="" && Id_Pakaian!=""  && Id_Laundry!=""  && Jumlah_Pakaian!="" ) {
            	$.ajax({
		            type: 'POST',
		            url: "form_detail_transaksi.php",
		            data: data,
		            success: function() {
		                $('.data-setrika').load("data-detail-transaksi-setrika.php");
		                document.getElementById("id_ajax_setrika").value = "";
		                document.getElementById("setrika-form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	        
	    });
	});

</script>