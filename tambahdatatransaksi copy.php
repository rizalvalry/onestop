<?php
session_start();
if(isset($_SESSION['id'])){
?>

    <?php
      include "include/header.php";
    ?>

    <style type="text/css">
    		.css_pesan { background-color: #F0FFED; border: 1px solid #215800; padding: 10px; width: 180px; margin-bottom: 20px; }
    </style>
  

  <div class="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Transaksi Laundry</a>
        </li>
        <li class="breadcrumb-item active">Transaksi Laundry</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Form Transaksi Laundry</h3>
  <hr>
        <div class="row">
          <div class="col-md-4">
            <form name="form" action="proses-tambah-transaksi.php" method="POST" >
            <?php
            include "./include/koneksi.php";
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

                <input type="hidden" class="form-control" name="admin_id" value="<?= $_SESSION['id']; ?>" readonly="true">
                <input type="hidden" class="form-control" name="Email" value="<?= $_SESSION['email']; ?>" readonly="true">
                
                <div class="form-group">
                  <label>Nama Pelanggan</label>
                  <select class="form-control" name="No_Identitas">
                    <?php
                    $sql = mysqli_query($conn, "SELECT No_Identitas, Nama FROM pelanggan ORDER BY Nama");
                    while ($hasil = mysqli_fetch_array($sql)){
                      ?>
                    <option value="<?php echo $hasil['No_Identitas']; ?>"><?php echo $hasil['Nama']; ?></option>
                    <?php
                        }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Total Berat / Kg</label>
                  <input type="text" id="total_berat" class="form-control" name="total_berat" onkeypress='validate(event)' placeholder="Total Berat" value="1">
                </div>
                <div class="form-group">
                  <label>Diskon</label>
                  <input type="text" id="diskon" class="form-control" name="diskon" placeholder="Diskon" value="0" >
                </div>
                <div class="form-group">
                  <label>Total Bayar</label>
                  <input type="text" id="animal-select" class="form-control" onkeypress='validate(event)' name="total_bayar" readonly="true">     
                </div>
                
                <div class="form-group">
                  <button class="btn btn-warning" id="enableselect">Custom ?</button>
                </div>

                <div style="display:none" class="form-group" id="alasan">
                <label>Alasan</label>
                  <textarea class="form-control" value="Berikan Alasan"></textarea>
                </div>

                <input type="hidden" class="form-control" name="tanggal" value="<?php $tgl=date('Y-m-d'); echo $tgl; ?>">
                <input type="button" value="Tampil Total Bayar" onClick="tambah()" class="btn btn-primary"/>
                
                <input type="submit" name="submit" value="Simpan" class="btn btn-success">
                <a href="transaksi.php"><input type="button" class="btn btn-default" value="Batal" ></a>
                
          </div>


          <div class="col-md-6  col-md-offset-2">
            <div class="group">
            <div class="left">
            <label>Kelas</label>
              <select class="form-control" name="kelas" id="kelas">
                <option value=""> Pilih Kelas</option>
              </select>
            </div>
  
            <div class="right">
              <label>Skala</label>
                <div id="dvskala">
                  <select class="form-control" name="skala" id="skala">
                    <option value=""></option>
                  </select>
                </div>
                </div>
              </div>

              <div class="form-group">
                <label>Down Payment</label>
                  <input pattern="[0-9.]+" type="number" name="dp" id="down-payment" class="form-control" />
              </div>
              
              <div class="form-group" id="kolomsisa" style="display:none;">
                <label>Sisa Bayar</label>
                  <input id="numbers" type="number" name="sisa_bayar" class="form-control" readonly="true"/>
              </div>
              
            </form>
          
            <div class="form-group">
              <!-- <div id="pesan" ></div> -->
              <div class="tombol" >
                <button type="button" class="btn btn-success btn-md " data-toggle="modal" data-target="#ModalTambah" ><span class="glyphicon glyphicon-plus " ></span> Tambah Detail Pakaian</button>
              </div>
              <br>
            <!-- table baru -->
              <div class="data"></div>
              
  
            </div>
          </div>
        </div>

    </div>
</div>





<!-- Modal Tambah Data -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalTambah" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Tambah Transaksi Pakaian</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
          <div class="modal-body">
          <form method="post" class="form-data" id="form-data">  
          <input type="hidden" name="id_ajax" id="id_ajax">
              <?php
                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
                while ($hasil = mysqli_fetch_array($sql)){
                  $na = $hasil['No_Order'];
              }
              ?>
              <input type="text" class="form-control" name="No_Order" id="No_Order" value="<?php echo $na + 1;  ?>" readonly>
              <div class="form-group">
                <label>Jenis Pakaian</label>
                <select class="form-control" name="Id_Pakaian" id="Id_Pakaian">
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
                <select class="form-control" name="Id_Laundry" id="Id_Laundry">
                  <?php
                    $sql = mysqli_query($conn, "SELECT * FROM laundry ORDER BY Jenis_Laundry");
                    while ($hasil = mysqli_fetch_array($sql)){

                  ?>
                  <option value="<?=$hasil['Id_Laundry'];?>"><?=$hasil['Jenis_Laundry'];?></option>
                  <?php
                  }
                   ?>
                </select>
              </div>

							<div class="form-group">
								<label>Jumlah Pakaian</label>
								<input type="text" class="form-control" name="Jumlah_Pakaian" id="Jumlah_Pakaian" onkeypress='validate(event)' placeholder="Jumlah pakaian" >
							</div>
							<div class="modal-footer">
              <button type="button" name="simpan" id="simpan" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
					<i class="fa fa-save"></i> Simpan
				</button>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</form>
					</div>

    </div>
  </div>
</div>



<?php
$sql = mysqli_query($conn, "SELECT Harga FROM harga");
$harga = mysqli_fetch_array($sql);
?>

<script type="text/javascript">
d=eval(form.No_Order.value)
e = d+1
form.No_Order.value=e
    function tambah()
      {
        a=eval(form.total_berat.value)
        // b=eval(form.diskon.value)
        // l=eval(hargalaundry.value)
        c=(a*<?= $harga['Harga']; ?>)
        if (a <= 3) {
          c = <?= $harga['Harga']; ?>;
        } else {
          c =  a * 6500;
        }
        // b=eval(form.b.value)
        // c=a+b
        form.total_bayar.value=c
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
        $("#down-payment, #animal-select").keyup(function() {

          $('#kolomsisa').show();

            var totalakhir  = $("#animal-select").val();
            var uangdp = $("#down-payment").val();

            var total = totalakhir - uangdp;
            $("#numbers").val(total);
        });
    });
      
$('#enableselect').click(function() {
    $('input[name=total_bayar]')
          .attr("readonly", false);

      $('#animal-select')
          .attr('disabled', false)
        .attr('name', 'total_bayar');

        $('#alasan').show();
      
      $('#enableselect').hide();
      return false;
  });

// $('#tambah').submit(function() {
//   $.ajax({
//     type: 'POST',
//     url: 'proses-tambah-detail-transaksi.php',
//     data: $(this).serialize(),
//     success: function(data) {
//       $("#pesan").addClass("css_pesan");
//       $("#ModalTambah").modal('hide');
//       $('#pesan').html(data);
//     }
//   })
//   return false;
// });

// function hapus(order,id){
// 			swal({
// 				title: "Apa anda yakin?",
// 				text: "Anda tidak akan bisa mengembalikan data yang sudah terhapus!",
// 				type: "warning",
// 				showCancelButton: true,
// 				confirmButtonClass: "btn-danger",
// 				confirmButtonText: "Ya, hapus!",
// 				closeOnConfirm: false
// 			},

// 			function(){
// 				var no_id = id;
//         var no_order = order;
// 				$.ajax({
// 					url: "crud/hapus.php",
// 					type: "GET",
// 					data : {Id_Pakaian: no_id, No_Order : no_order},
// 					success: function (data) {
//                     swal("Terhapus!", "Data berhasil dihapus.", "success");

//                 }
// 				});
// 				//document.location = url;
// 				setTimeout("location.href='tambahdatatransaksi';",500);
// 			}

// 			);
// 		};


// JavaScript Kelas
    $(document).ready(function(){
                $.ajax({
                    type: 'POST',
                    url: "get_kelas.php",
                    cache: false, 
                    success: function(msg){
                      $("#kelas").html(msg);
                    }
                });

                $("#kelas").change(function(){
                var kelas = $("#kelas").val();
                  $.ajax({
                    type: 'POST',
                      url: "get_skala.php",
                      data: {kelas: kelas},
                      cache: false,
                      success: function(msg){
                        $("#skala").html(msg);
                      }
                  });
                });
            });
  
//  start here
$(document).ready(function(){
		//Mengirimkan Token Keamanan
	

	    $('.data').load("data-detail-transaksi.php");
	    $("#simpan").click(function(){
	        var data = $('.form-data').serialize();
          var No_Order = $("#No_Order").val();
          var Id_Pakaian = $("#Id_Pakaian").val();
          var Id_Laundry = $("#Id_Laundry").val();
          var Jumlah_Pakaian = $("#Jumlah_Pakaian").val();
            
           

            if (No_Order!="" && Id_Pakaian!=""  && Id_Laundry!=""  && Jumlah_Pakaian!="" ) {
            	$.ajax({
		            type: 'POST',
		            url: "form_detail_transaksi.php",
		            data: data,
		            success: function() {
		                $('.data').load("data-detail-transaksi.php");
		                document.getElementById("id_ajax").value = "";
		                document.getElementById("form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	        
	    });
	});

</script>
</body>
</html>
<?php
}else{
	header("location:login/index.php");
}
