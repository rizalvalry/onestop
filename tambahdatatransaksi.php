<?php
session_start();
if(isset($_SESSION['id'])){
  $admin_id=$_SESSION['id'];
?>

    <?php
      include "include/header.php";
    ?>
    <?php
    if(isset($_SESSION['no_order'])){
      $orderNo = $_SESSION['no_order'];
    } else {
      $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
      while ($hasil = mysqli_fetch_array($sql)){
  		  $_SESSION['no_order'] = $hasil['No_Order'] + 1;
      }
      $orderNo = $_SESSION['no_order'];
    }
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

  <div class="form-group">
    <button type="button" class="btn btn-secondary btn-md " id="lannjutTransaksi" data-id="<?php echo $orderNo; ?>" data-admin-id="<?php echo $admin_id; ?>" ><span class="glyphicon glyphicon-plus " ></span> Lanjutkan Transaksi</button>
    <button type="button" class="btn btn-danger btn-md " id="clearAll" data-id="<?php echo $orderNo; ?>"><span class="glyphicon glyphicon-plus " ></span> Clear</button>
  </div>

  <?php
  include "./include/koneksi.php";
  ?>

<!-- accordion -->
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            CUCI & SETRIKA
              <!-- <span class="badge badge-primary">Primary</span> -->
            </button>
          </h5>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
          <div class="card-body">
          
            <?php include "formcucisetrika.php"; ?>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              CUCI 
            </button>
          </h5>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
          <div class="card-body">
                    
            <?php include "formcuci.php"; ?>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingThree">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
              SETRIKA 
            </button>
          </h5>
        </div>

        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
          <div class="card-body">
                    
            <?php include "formsetrika.php"; ?>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFour">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              DRY CLEAN
            </button>
          </h5>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
          <div class="card-body">
          
          <?php include "formdryclean.php"; ?>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingFive">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
            REPARASI
            </button>
          </h5>
        </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
          <div class="card-body">
          
          <?php include "formreparasi.php"; ?>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header" id="headingSix">
          <h5 class="mb-0">
            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
            RECOLOR
            </button>
          </h5>
        </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
          <div class="card-body">
          
          <?php include "formrecolor.php"; ?>

          </div>
        </div>
      </div>
    </div>
<!-- end accordion -->

        
        
      </div>
    </div>
    
    
    
<!-- Modal Transaksi -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="ModalTransaksi" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Tambah Transaksi Pakaian</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
          <div class="modal-body">

            <?php
              // $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi ORDER BY No_Order Desc LIMIT 1");
              // while ($hasil = mysqli_fetch_array($sql)){
              //   $orderNo = $hasil['No_Order'] + 1;
              // }
            ?>
            

            <form action="proses-tambah-transaksi.php" method="POST">  

              <div class="form-group">
              <label>No Order</label>
                <input type="text" class="form-control" name="No_Order" id="No_Cuci_Order" value="<?php echo $orderNo;  ?>" readonly>
              </div>

              <input type="hidden" class="form-control" name="admin_id" value="<?= $_SESSION['id']; ?>" readonly="true">
                <input type="hidden" class="form-control" name="Email" value="<?= $_SESSION['email']; ?>" readonly="true">
                
                <div class="form-group">
                  <label><span style="color:red">*</span> Nama Pelanggan</label>
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
                  <label>Total Berat Laundry(Kiloan)</label>
                  <?php
                    $sql = mysqli_query($conn, "SELECT SUM(total_berat) as jumlah_berat FROM harga where no_order = $orderNo AND Id_Laundry IN ('1', '2', '6')");
                    $berat = mysqli_fetch_array($sql);
 
                  ?>
                    <input type="text" id="berat" class="form-control" name="berat" placeholder="Total Berat" value="<?= $berat['jumlah_berat']; ?>" readonly="true" />
                </div>

                <div class="form-group">
                  <label>Total Seluruh Item</label>
                  <?php
                  echo $admin_id;
                    $sql = mysqli_query($conn, "select sum(Jumlah_pakaian) as jumlah FROM detail_transaksi 
                    where No_Order = $orderNo AND admin_id = $admin_id GROUP BY admin_id");
                    $total = mysqli_fetch_array($sql);
                  ?>
                    <input type="text" id="total_berat" class="form-control" name="total_berat" placeholder="Total Berat" value="<?= $total['jumlah']; ?>" readonly="true" />
                </div>

              <div class="form-group">
              <label><span style="color:red">*</span> Kelas</label>
                <select class="form-control" name="kelas" id="kelas">
                  <option value=""> Pilih Kelas</option>
                </select>
              </div>

              <div class="form-group">
                <label><span style="color:red">*</span> Skala</label>
                <div id="dvskala">
                  <select class="form-control" name="skala" id="skala">
                    <option value=""></option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                  <label>Diskon</label>
                  <input pattern="[0-9.]+" type="number" id="diskon-item" class="form-control" name="diskon" />
                </div>

              <div class="form-group">
                <label>Down Payment</label>
                <input pattern="[0-9.]+" type="number" name="dp" id="down-payment" class="form-control" />
              </div>
              
              <div class="form-group" id="kolomsisa" style="display:none;">
                <label>Sisa Bayar</label>
                  <input id="numbers" type="number" name="sisa_bayar" class="form-control" readonly="true"/>
              </div>

              <div class="form-group">
                  <label>Total Bayar</label>
                  <?php
                    $sql = mysqli_query($conn, "SELECT sum(total_harga) as total FROM harga where no_order = $na AND admin_id = $admin_id");
                    $bayar = mysqli_fetch_array($sql);
                  ?>
                  <input type="text" id="total_bayar" class="form-control" onkeypress='validate(event)' name="total_bayar" value="<?= $bayar['total'] ?>" readonly="true">     
                </div>

                <div class="form-group">
                  <label><span style="color:red">*</span> Metode Pembayaran</label>
                  <select class="form-control" name="payment" id="payment">
                    <option value="transfer">Transfer</option>
                    <option value="tunai">Tunai</option>
                  </select>
                </div>
              
              <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-primary">
              <i class="fa fa-save"></i> Proses ke Transaksi</button>
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
              </div>
            </form>
					</div>
<!-- Modal End Transaksi -->

</body>

<script>
// $('#validasi').hide();

$('#validasi').click(function() {
  

     
  });

$(document).ready(function() {
  $("#down-payment, #total_bayar").keyup(function() {

    $('#kolomsisa').show();

      var totalakhir  = $("#total_bayar").val();
      var uangdp = $("#down-payment").val();

      var total = totalakhir - uangdp;
      $("#numbers").val(total);
  });

  // $("#diskon-item, #total_bayar").keyup(function() {

  //     $('#kolomsisa').show();

  //       var totalakhir  = $("#total_bayar").val();
  //       var uangdp = $("#down-payment").val();

  //       var total = totalakhir - uangdp;
  //       $("#numbers").val(total);
  //     });
  });

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

$(document).on('click', '#clearAll', function(){
  var id = $(this).attr('data-id');
  var action = 'clearAll';
  $.ajax({
      type: 'POST',
      url: "hapus_detail_transaksi.php",
      data: {id: id, action: action},
      success: function() {
        location.reload();
      }, error: function(response){
          console.log(response.responseText);
      }
  });
});

$(document).on('click', '#lannjutTransaksi', function(){
  var id = $(this).attr('data-id');
  var adminId = $(this).attr('data-admin-id');
  $.ajax({
    type: 'POST',
      url: "cek_lanjut_transaksi.php",
      data: {id: id, adminId: adminId},
      cache: false,
      success: function(msg){
        if(msg=='false') alert("Transaksi belum bisa dilanjutkan. \nPastikan data transaksi sudah lengkap");
        else { 
          // alert(msg);
          const myObj = JSON.parse(msg);
          // alert(myObj.jumlah);
          // alert(myObj.total);
          $('#total_berat').val(myObj.jumlah);
          $('#total_bayar').val(myObj.total);
          $('#ModalTransaksi').modal('toggle');
        }
      }
  });
});

</script>

</html>
<?php
}else{
	header("location:login/index.php");
}
