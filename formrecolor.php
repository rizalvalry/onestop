<?php
$sql = mysqli_query($conn, "SELECT * FROM laundry where Id_Laundry = 5");
$laundry = mysqli_fetch_array($sql);
?>

<!-- isi -->
<div class="row">
          <div class="col-md-12">
            <form name="formrecolororder">
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
                <button type="button" class="btn btn-success btn-md " data-toggle="modal" data-target="#ModalTambahRecolor" ><span class="glyphicon glyphicon-plus " ></span> Tambah Detail Pakaian</button>
              </div>
              <br>

              <!-- pindah kesini -->
              <!-- <form name="formrecolor" action="proses-detail.php" method="post">
                <input type="hidden" class="form-control" name="Id_Laundry" value="<?= $laundry['Id_Laundry']; ?>">
              <div class="form-group">
                  <label>Total Berat / Item</label>

                  <?php
                  // $sql = mysqli_query($conn, "SELECT No_Order FROM detail_transaksi  ORDER BY No_Order Desc LIMIT 1");
                  // $hasil = mysqli_fetch_array($sql);
                  // $order = $hasil['No_Order'];
                  ?>
                  <input type="hidden" class="form-control" name="no_order" value="<?= $hasil['No_Order']; ?>">
                  <?php
                  // $admin_id = $_SESSION['id'];
                  // $sql = mysqli_query($conn, "SELECT * FROM harga  where no_order = '$order' AND Id_Laundry = 5 AND admin_id=$admin_id");
                  // $hasil = mysqli_fetch_array($sql);
                  ?>
                  <input type="text" id="recolor_total_berat" class="form-control" name="total_berat" onkeypress='validate(event)' placeholder="Total Berat" value="<?= $hasil['total_berat']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Total Bayar</label>
                  <input type="text" id="recolor-select" class="form-control" onkeypress='validate(event)' name="total_harga" value="<?= $hasil['total_harga']; ?>" readonly="true">     
                </div>
                
                <div class="form-group">
                  <button class="btn btn-warning" id="recolorenableselect">Custom ?</button>
                  <div style="display:none" class="form-group" id="recoloralasan">
                  <label>Alasan</label>
                    <textarea class="form-control" value="Berikan Alasan"></textarea>
                  </div>
                  <input type="button" value="Tampil Total Bayar" onClick="tambahRecolor()" class="btn btn-primary"/>
                  <button type="submit" name="updaterecolor" class="btn btn-info">Simpan Perubahan</button>
                </div>
                  
              </form> -->
              <!-- akhir pindah -->

            <!-- table baru -->
              <div class="data-recolor"></div>
              
  
            </div>
          </div>
        </div>

    </div>
</div>



<!-- Modal Tambah Data -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalTambahRecolor" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Tambah Transaksi <?= $laundry['Jenis_Laundry'] ?></h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
          <div class="modal-body">
          <form method="post" class="recolor-form-data" id="recolor-form-data">  
          <input type="hidden" name="id_ajax_recolor" id="recolor_cuci">
              <?php
                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
                while ($hasil = mysqli_fetch_array($sql)){
                  $na = $hasil['No_Order'];
              }
              ?>
              <input type="text" class="form-control" name="No_Order" id="Recolor_No_Order" value="<?php echo $na + 1;  ?>" readonly>
              <div class="form-group">
                <label>Jenis Pakaian</label>
                <select class="form-control" name="Id_Pakaian" id="Id_Recolor_Pakaian">
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
                <select class="form-control" name="Id_Laundry" id="Id_Recolor_Laundry">
                  <option value="5">Recolor</option>
                </select>
              </div>

							<div class="form-group">
								<label>Jumlah Pakaian</label>
								<input type="text" class="form-control" name="Jumlah_Pakaian" id="Jumlah_Recolor_Pakaian" onkeypress='validate(event)' placeholder="Jumlah pakaian" >
							</div>
							<div class="modal-footer">
              <button type="button" name="simpan-cuci" id="recolor-simpan" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-save"></i> Simpan
				</button>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</form>
					</div>
        <!-- selesai isi -->


        <?php
$sql = mysqli_query($conn, "SELECT Harga FROM laundry where Id_Laundry = 5");
$cuci = mysqli_fetch_array($sql);
?>

<script type="text/javascript">
// setrika
d=eval(formrecolororder.No_Order.value)
e = d+1
formrecolororder.No_Order.value=e
    function tambahRecolor()
      {
        a=eval(formrecolor.recolor_total_berat.value)
        // b=eval(formrecolor.diskon.value)
        l=eval(hargarecolor.value)
        formrecolor.total_berat.value=l
        c=(l*<?= $cuci['Harga']; ?>)
        // b=eval(formrecolor.b.value)
        // c=a+b
        formrecolor.total_harga.value=c
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
        $("#down-payment, #recolor-select").keyup(function() {

          $('#kolomsisa').show();

            var totalakhir  = $("#recolor-select").val();
            var uangdp = $("#down-payment").val();

            var total = totalakhir - uangdp;
            $("#numbers").val(total);
        });
    });
      
$('#recolorenableselect').click(function() {
    $('#recolor-select')
          .attr("readonly", false);

      $('#recolor-select')
          .attr('disabled', false)
        .attr('id', 'recolor-select');

        $('#recoloralasan').show();
      
      $('#recolorenableselect').hide();
      return false;
  });

  
//  start here
$(document).ready(function(){
		//Mengirimkan Token Keamanan
	

	    $('.data-recolor').load("data-detail-transaksi-recolor.php");
	    $("#recolor-simpan").click(function(){
	        var data = $('.recolor-form-data').serialize();
          var No_Order = $("#Recolor_No_Order").val();
          var Id_Pakaian = $("#Id_Recolor_Pakaian").val();
          var Id_Laundry = $("#Id_Recolor_Laundry").val();
          var Jumlah_Pakaian = $("#Jumlah_Recolor_Pakaian").val();
            
           

            if (No_Order!="" && Id_Pakaian!=""  && Id_Laundry!=""  && Jumlah_Pakaian!="" ) {
            	$.ajax({
		            type: 'POST',
		            url: "form_detail_transaksi.php",
		            data: data,
		            success: function() {
		                $('.data-recolor').load("data-detail-transaksi-recolor.php");
		                document.getElementById("recolor_cuci").value = "";
		                document.getElementById("recolor-form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	        
	    });
	});

</script>