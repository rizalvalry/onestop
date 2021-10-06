<?php
$sql = mysqli_query($conn, "SELECT * FROM laundry where Id_Laundry = 6");
$laundry = mysqli_fetch_array($sql);
?>

<!-- isi -->
<div class="row">
          <div class="col-md-12">
            <form name="formcuciorder">
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
                <button type="button" class="btn btn-success btn-md " data-toggle="modal" data-target="#ModalTambahcuci" ><span class="glyphicon glyphicon-plus " ></span> Tambah Detail Pakaian</button>
              </div>
              <br>

              <!-- pindah kesini -->
              <form name="formcuci" action="proses-detail.php" method="post">
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
                  $sql = mysqli_query($conn, "SELECT * FROM harga  where no_order = '$order' AND Id_Laundry = 6 AND admin_id=$admin_id");
                  $hasil = mysqli_fetch_array($sql);
                  ?>
                  <input type="text" id="cuci_total_berat" class="form-control" name="total_berat" onkeypress='validate(event)' placeholder="Total Berat" value="<?= $hasil['total_berat']; ?>">
                </div>
                <div class="form-group">
                  <label>Total Bayar</label>
                  <input type="text" id="cuci-select" class="form-control" onkeypress='validate(event)' name="total_harga" value="<?= $hasil['total_harga']; ?>" readonly="true">     
                </div>
                
                <div class="form-group">
                  <button class="btn btn-warning" id="cucienableselect">Custom ?</button>
                  <div style="display:none" class="form-group" id="cucialasan">
                  <label>Alasan</label>
                    <textarea class="form-control" value="Berikan Alasan"></textarea>
                  </div>
                  <input type="button" value="Tampil Total Bayar" onClick="tambahcuci()" class="btn btn-primary"/>
                  <button type="submit" name="updatecuci" class="btn btn-info">Simpan Perubahan</button>
                </div>
                  
              </form>
              <!-- akhir pindah -->

            <!-- table baru -->
              <div class="data-cuci"></div>
              
  
            </div>
          </div>
        </div>

    </div>
</div>



<!-- Modal Tambah Data -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalTambahcuci" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Tambah Transaksi <?= $laundry['Jenis_Laundry'] ?></h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
          <div class="modal-body">
          <form method="post" class="cuci-form-data" id="cuci-form-data">  
          <input type="hidden" name="id_ajax_cuci" id="cuci_cuci">
              <?php
                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
                while ($hasil = mysqli_fetch_array($sql)){
                  $na = $hasil['No_Order'];
              }
              ?>
              <input type="text" class="form-control" name="No_Order" id="cuci_No_Order" value="<?php echo $na + 1;  ?>" readonly>
              <div class="form-group">
                <label>Jenis Pakaian</label>
                <select class="form-control" name="Id_Pakaian" id="Id_cuci_Pakaian">
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
                <select class="form-control" name="Id_Laundry" id="Id_cuci_Laundry">
                  <option value="6">Cuci</option>
                </select>
              </div>

							<div class="form-group">
								<label>Jumlah Pakaian</label>
								<input type="text" class="form-control" name="Jumlah_Pakaian" id="Jumlah_cuci_Pakaian" onkeypress='validate(event)' placeholder="Jumlah pakaian" >
							</div>
							<div class="modal-footer">
              <button type="button" name="simpan-cuci" id="cuci-simpan" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-save"></i> Simpan
				</button>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</form>
					</div>
        <!-- selesai isi -->


        <?php
$sql = mysqli_query($conn, "SELECT Harga FROM laundry where Id_Laundry = 6");
$cuci = mysqli_fetch_array($sql);
?>

<script type="text/javascript">
// setrika
d=eval(formcuciorder.No_Order.value)
e = d+1
formcuciorder.No_Order.value=e
    function tambahcuci()
      {
        a=eval(formcuci.cuci_total_berat.value)
        // b=eval(formcuci.diskon.value)
        c=(a*<?= $cuci['Harga']; ?>)
        if (a <= 3) {
          c = <?= $cuci['Harga'] * 3 ?>;
        } else {
          c =  a * <?= $cuci['Harga'] ?>;
        }
        // b=eval(formcuci.b.value)
        // c=a+b
        formcuci.total_harga.value=c
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
        $("#down-payment, #cuci-select").keyup(function() {

          $('#kolomsisa').show();

            var totalakhir  = $("#cuci-select").val();
            var uangdp = $("#down-payment").val();

            var total = totalakhir - uangdp;
            $("#numbers").val(total);
        });
    });
      
$('#cucienableselect').click(function() {
    $('#cuci-select')
          .attr("readonly", false);

      $('#cuci-select')
          .attr('disabled', false)
        .attr('id', 'cuci-select');

        $('#cucialasan').show();
      
      $('#cucienableselect').hide();
      return false;
  });

  
//  start here
$(document).ready(function(){
		//Mengirimkan Token Keamanan
	

	    $('.data-cuci').load("data-detail-transaksi-cuci.php");
	    $("#cuci-simpan").click(function(){
	        var data = $('.cuci-form-data').serialize();
          var No_Order = $("#cuci_No_Order").val();
          var Id_Pakaian = $("#Id_cuci_Pakaian").val();
          var Id_Laundry = $("#Id_cuci_Laundry").val();
          var Jumlah_Pakaian = $("#Jumlah_cuci_Pakaian").val();
            
           

            if (No_Order!="" && Id_Pakaian!=""  && Id_Laundry!=""  && Jumlah_Pakaian!="" ) {
            	$.ajax({
		            type: 'POST',
		            url: "form_detail_transaksi.php",
		            data: data,
		            success: function() {
		                $('.data-cuci').load("data-detail-transaksi-cuci.php");
		                document.getElementById("cuci_cuci").value = "";
		                document.getElementById("cuci-form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	        
	    });
	});

</script>