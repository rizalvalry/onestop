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

  <h3>Form Edit Transaksi Laundry</h3>
  <hr>
        <div class="row">
          <div class="col-md-6">
            <form name="form" action="proses-edit-transaksi.php" method="POST" >
            <?php
            include "./include/koneksi.php";

            $No_Order = $_GET['edit'];
            
            $petugas = mysqli_query($conn, "SELECT nama, admin_id FROM transaksi t join admin a where t.admin_id = a.id AND t.No_Order = '".$No_Order."' ");
            $result = mysqli_fetch_array($petugas);
            
            $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi WHERE No_Order='".$No_Order."' ");
            while ($hasil = mysqli_fetch_array($sql)){
              ?>
                <div class="form-group">
                  <label>No. Order</label>
                  <input type="text" class="form-control" name="No_Order" value="<?php echo $hasil['No_Order']; ?>" readonly>
                </div>
                <?php
                    }
                ?>
            <div class="form-group">
              <label>Petugas</label>
              <input type="text" class="form-control" name="No_Order" value="<?php echo $result['nama']; ?>" readonly>
            </div>    

                <div class="form-group">
                  <label>Nama Pelanggan</label>
                  <select class="form-control" name="No_Identitas" readonly>
                    <?php
                    $sql = mysqli_query($conn, "select p.Nama FROM transaksi t
                    join pelanggan p ON t.No_Identitas = p.No_Identitas
                    where No_Order = '".$No_Order."'");
                    while ($hasil = mysqli_fetch_array($sql)){
                      ?>
                    <option value="<?php echo $hasil['No_Identitas']; ?>"><?php echo $hasil['Nama']; ?></option>
                    <?php
                        }
                    ?>
                  </select>
                </div>
                <?php
                $sql = mysqli_query($conn, "SELECT Tgl_Terima, total_berat, diskon, Total_Bayar, dp, sisa_bayar FROM transaksi WHERE No_Order='".$No_Order."' ");
                while ($hasil = mysqli_fetch_array($sql)){
                  ?>
                <div class="form-group">
                  <label>Total Berat</label>
                  <input type="text" id="total_berat" class="form-control" name="total_berat" placeholder="Total Berat" value="<?php echo $hasil['total_berat']; ?>">
                </div>
                <div class="form-group">
                  <label>Diskon</label>
                  <input type="text" id="diskon" class="form-control" name="diskon" placeholder="Diskon" value="<?php echo $hasil['diskon']; ?>" >
                </div>
                <div class="form-group">
                  <label>DP</label>
                  <input type="text"  class="form-control" name="dp" value="<?php echo $hasil['dp']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Sisa yang harus dibayar</label>
                  <input type="text"  class="form-control" name="sisa_bayar" value="<?php echo $hasil['sisa_bayar']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Total Bayar</label>
                  <input type="text"  class="form-control" name="total_bayar" value="<?php echo $hasil['Total_Bayar']; ?>" readonly>
                </div>
                <input type="hidden" class="form-control" name="tanggal" value="<?php $tgl=date('Y-m-d'); echo $tgl; ?>">
                <?php
                    }
                ?>
                <input type="button" value="Tampil Total Bayar" onClick="tambah()" class="btn btn-primary"/>
                <input type="submit" name="submit" value="Simpan Perubahan" class="btn btn-success">
                <a href="transaksi.php"><input type="button" class="btn btn-default" value="Batal" ></a>

              </form>
          </div>

          <div class="col-md-6  col-md-offset-2">

          <?php
            $sql = mysqli_query($conn, "SELECT skala.nama as skala, transaksi.Tgl_Terima, transaksi.Tgl_Ambil, transaksi.No_Order 
            from 
            transaksi 
            join kelas on kelas.id_kelas = transaksi.kelas 
            join skala on skala.id_skala = transaksi.skala 
            WHERE No_Order = '".$No_Order."' ");
            $hasil = mysqli_fetch_array($sql);
            $satuan = substr($hasil['skala'],2);
            $waktu = substr($hasil['skala'],0,1);
            $int = (int)$waktu;
            $kalenderbulan = 30;
            
            $Date = $hasil['Tgl_Terima'];
            // echo $satuan;
            if($satuan == "Hari") {
                $harian = date('Y-m-d H:i:s', strtotime($Date. ' + ' .$int. 'days'));
            
            } elseif($satuan == "Minggu") {
                $mingguan = date('Y-m-d H:i:s', strtotime($Date. ' + ' .$int. 'weeks'));
            
            } elseif($satuan == "Jam") {
                $jam = date('Y-m-d H:i:s', strtotime($Date. ' + ' .$int. 'hours'));
            
            } elseif($satuan == "Bulan") {
                $bulan = date('Y-m-d H:i:s', strtotime($Date. ' + ' .$kalenderbulan. 'days'));
            
            }
          ?>

          <div class="form-group">
            <label>Dateline</label>
            <input type="text" class="form-control" id="demo" readonly>
          </div>

          <script>
          // Mengatur waktu akhir perhitungan mundur
          var countDownDate = new Date("<?php if($harian) {
              echo $harian;
          } elseif($mingguan) {
              echo $mingguan;
          } elseif($jam) {
              echo $jam;
          } elseif($bulan) {
              echo $bulan;
          } ?>").getTime();

          // Memperbarui hitungan mundur setiap 1 detik
          var x = setInterval(function() {

            // Untuk mendapatkan tanggal dan waktu hari ini
            var now = new Date().getTime();
              
            // Temukan jarak antara sekarang dan tanggal hitung mundur
            var distance = countDownDate - now;
              
            // Perhitungan waktu untuk hari, jam, menit dan detik
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              
            // Keluarkan hasil dalam elemen dengan id = "demo"
            document.getElementById("demo").value = days + " Hari " + hours + " Jam "
            + minutes + " Menit " + seconds + " Detik ";
              
            // Jika hitungan mundur selesai, tulis beberapa teks 
            if (distance < 0) {
              clearInterval(x);
              document.getElementById("demo").value = "EXPIRED";
            }
          }, 1000);
          </script>

          
          <?php
                $sql = mysqli_query($conn, "SELECT kelas.nama as kelas, skala.nama as skala, transaksi.No_Order 
                from 
                transaksi 
                join kelas on kelas.id_kelas = transaksi.kelas 
                join skala on skala.id_skala = transaksi.skala 
                WHERE No_Order = '".$No_Order."' ");
                while ($hasil = mysqli_fetch_array($sql)){
                  ?>
          <div class="form-group">
            <label>Kelas</label>
            <input type="text"  class="form-control" value="<?php echo $hasil['kelas']; ?>" readonly>
            </div>
  
            <div class="form-group">
              <label>Skala</label>
              <input type="text"  class="form-control" value="<?php echo $hasil['skala']; ?>" readonly>
                </div>
                <?php } ?>

            <div id="pesan" ></div>
            <div class="tombol" >
      				<button type="button" class="btn btn-success btn-md " data-toggle="modal" data-target="#ModalTambah" ><span class="glyphicon glyphicon-plus " ></span> Tambah Detail Pakaian</button>
      			</div>
            <br>
            <div class="table-responsive">
              <table id="table" class="table table-striped table-bordered" >
                <thead>
                  <tr>
                    <th style="text-align: center;">No</th>
                    <th>Jenis Pakaian</th>
                    <th>Jenis Laundry</th>
                    <th>Jumlah Pakaian</th>
                    <th style="text-align: center;" >Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 0 + 1;
                    $sql = mysqli_query($conn, "SELECT pakaian.Jenis_Pakaian, laundry.Jenis_Laundry, detail_transaksi.No_Order, detail_transaksi.Id_Pakaian, detail_transaksi.Jumlah_pakaian FROM detail_transaksi 
                    join pakaian on detail_transaksi.Id_Pakaian = Pakaian.Id_Pakaian
                    join laundry on detail_transaksi.Id_Laundry = Laundry.Id_Laundry
                    Where No_Order = $No_Order");
                    while ($hasil = mysqli_fetch_array($sql)) {
                 ?>
              <tr>
                  <td style="text-align: center;"><?php echo $i; ?></td>
                  <td><?php echo $hasil['Jenis_Pakaian']; ?></td>
                  <td><?php echo $hasil['Jenis_Laundry']; ?></td>
                  <td><?php echo $hasil['Jumlah_pakaian']; ?></td>
                  <td style="text-align: center;">
                  <a href="proses-hapus-detail-transaksi-edit.php?order=<?php echo $hasil['No_Order']; ?>&pakaian=<?php echo $hasil['Id_Pakaian']; ?>" class="btn btn-danger">Hapus</a></td>
              </tr>
              <?php
                  $i++;
                  }
                ?>

              </tbody>
              </table>
              </div>
          </div>
        </div>
    </div>
</div>


<!-- Modal Tambah Data -->
		<div class="modal fade" id="ModalTambah" role="dialog">
			<div class="modal-dialog modal-sm">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tambah Transaksi Pakaian</h4>
					</div>

					<div class="modal-body">
						<form id="tambah" method="POST" >
              <?php
                $sql = mysqli_query($conn, "SELECT No_Order FROM transaksi WHERE No_Order = $No_Order");
                while ($hasil = mysqli_fetch_array($sql)){
                  $na = $hasil['No_Order'];
              }
              ?>
              <input type="text" class="form-control" name="No_Order" value="<?php echo $na;  ?>" >
              <div class="form-group">
                <label>Jenis Pakaian</label>
                <select class="form-control" name="Id_Pakaian">
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
								<label>Jumlah Pakaian</label>
								<input type="text" class="form-control" name="Jumlah_Pakaian" placeholder="Jumlah pakaian" >
							</div>
							<div class="modal-footer">
								<button class="btn btn-success" type="submit" >Simpan</button>
								<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Batal</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>



<script type="text/javascript">
function tambah()
    {
    a=eval(form.total_berat.value)
    b=eval(form.diskon.value)
    c=(a*7000)-b
    // b=eval(form.b.value)
    // c=a+b
    form.total_bayar.value=c
    }


$('#tambah').submit(function() {
  $.ajax({
    type: 'POST',
    url: 'proses-tambah-detail-transaksi-edit.php',
    data: $(this).serialize(),
    success: function(data) {
      $("#pesan").addClass("css_pesan");
      $("#ModalTambah").modal('hide');
      $('#pesan').html(data);
    }
  })
  return false;
});

function hapus(order,id){
			swal({
				title: "Apa anda yakin?",
				text: "Anda tidak akan bisa mengembalikan data yang sudah terhapus!",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Ya, hapus!",
				closeOnConfirm: false
			},

			function(){
				var no_id = id;
        var no_order = order;
				$.ajax({
					url: "crud/hapus.php",
					type: "GET",
					data : {Id_Pakaian: no_id, No_Order : no_order},
					success: function (data) {
                    swal("Terhapus!", "Data berhasil dihapus.", "success");

                }
				});
				//document.location = url;
				setTimeout("location.href='tambahdatatransaksi.php';",1000);
			}

			);
		};
</script>

<?php
        include "include/footer.php"
?>

<?php
}else{
	header("location:login/index.php");
}
