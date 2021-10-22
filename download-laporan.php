<?php
$No_Order 		=  $_GET['cetak'];
use Dompdf\Dompdf;
ob_start(); 

include "./include/koneksi.php";
$sql = mysqli_query($conn, "SELECT * FROM profil");
$profil = mysqli_fetch_array($sql);
session_start();
$id_session = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Struk Transaksi</title>
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!-- custom -->
  <link href="css/bon.css" rel="stylesheet" type="text/css">
  <style media="screen">
  table, th, td, tr {
  border: 1px solid grey;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;
  font-size:10px !important;
}
hr{
  border: 1px solid black;
}
p {
  font-size:10px !important;
}
span {
  font-size:10px !important;
}
  </style>
</head>
<body>
  <?php
$sql = mysqli_query($conn, "SELECT pelanggan.Nama as nama_pelanggan, kelas.nama as kelas, skala.nama as skala, pelanggan.Alamat, transaksi.Tgl_Terima, transaksi.Tgl_Ambil, transaksi.No_Order, pelanggan.No_Hp 
from 
pelanggan join transaksi on pelanggan.No_Identitas = transaksi.No_Identitas 
join kelas on kelas.id_kelas = transaksi.kelas 
join skala on skala.id_skala = transaksi.skala 
WHERE No_Order = '$No_Order'");
$hasil = mysqli_fetch_array($sql);

$pegawai = mysqli_query($conn, "SELECT nama FROM admin where id = $id_session ");
$kasir = mysqli_fetch_array($pegawai);


$tgl1 = $hasil['Tgl_Terima'];// pendefinisian tanggal awal
// $tgl2 = date('Y-m-d', strtotime('+1 days', strtotime($tgl1)));
$tgl2 = $hasil['Tgl_Ambil'];
?>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-8">
            <div class="p-3 bg-white rounded">
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="text-dark mb-0"><?= $profil['nama_profil']; ?></h4>
                    ================================
                        <small><div class="billed"><span class="font-weight-bold">Pekerja:</span><span class="ml-1"> <?= $kasir['nama']; ?></span></div></small>
                        <small><div class="billed"><span class="font-weight-bold">No Order:</span><span class="ml-1"> <?= $hasil['No_Order']; ?></span></div></small>
                        <small><div class="billed"><span class="font-weight-bold">Nama:</span><span class="ml-1"> <?= $hasil['nama_pelanggan']; ?></span></div></small>
                        <small><div class="billed"><span class="font-weight-bold">Tanggal Terima:</span><span class="ml-1"> <?php echo date('d-m-Y H:i:s',strtotime($hasil['Tgl_Terima'])); ?></span></div></small>
                        <small><div class="billed"><span class="font-weight-bold">Date Line:</span><span class="ml-1"> <?= $hasil['skala']; ?></span></div></small>
                    </div>
               
                </div>
  <div class="mt-3">
      <div class="table-responsive">
      <table class="table putus-table" >
  <thead>
    <tr class="putus">
      <th class="putus">No</th>
      <th class="putus">Jenis Barang</th>
      <th class="putus">Treatment</th>
      <th class="putus">Jumlah</th>
      <th class="putus">Harga</th>
    </tr>
  </thead>
  <tbody>
      <?php
        
        $i = 1;
        $sql = mysqli_query($conn, "SELECT Jenis_Pakaian, Jumlah_Pakaian, detail_transaksi.Id_Laundry, laundry.Jenis_Laundry, pakaian.Dry_Clean, pakaian.Reparasi, pakaian.Recolour FROM (detail_transaksi join pakaian ON detail_transaksi.Id_Pakaian = pakaian.Id_Pakaian join laundry ON detail_transaksi.Id_Laundry = laundry.Id_Laundry) WHERE No_Order = '$No_Order'");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
      <tr class="putus">
        <td style="text-align:center" class="putus"><?=$i?></td>
        <td class="putus"><?php echo $hasil['Jenis_Pakaian']; ?></td>
        <td class="putus"><?php echo $hasil['Jenis_Laundry']; ?></td>
        <td class="putus"><?php echo $hasil['Jumlah_Pakaian']; ?></td>
        <td class="putus"><?php 
        if($hasil['Id_Laundry'] == 3) {
          echo $hasil['Dry_Clean']; 
        } elseif($hasil['Id_Laundry'] == 4) {
          echo $hasil['Reparasi'];
        } elseif($hasil['Id_Laundry'] == 5) {
          echo $hasil['Recolour'];
        } else {
          echo "-";
        } 
          ?></td>
        
      </tr>
      <?php
      $i++;
    }
      ?>
  </tbody>
</table>
                    </div>
                </div>



            <?php
            $sql = mysqli_query($conn, "SELECT keterangan, total_berat, diskon, dp, Total_Bayar, sisa_bayar from transaksi WHERE No_Order = '$No_Order'");
            while ($hasil = mysqli_fetch_array($sql))
            {
            ?>
            
              <?php
              if($hasil['dp'] != 0) {
                echo "<small><div class='billed'><span class='font-weight-bold'>DP (Rp):   ".$hasil['dp']."  </span></div></small>";
              } else {
                echo "<small><div class='billed'><span class='font-weight-bold'>LUNAS (Rp):   ".$hasil['Total_Bayar']."  </span></div></small>";
              }
              ?>

              <small><div class="billed"><span class="font-weight-bold">Total Bayar (Rp): <?php echo $hasil['Total_Bayar']; ?></span></div></small>
              <small><div class="billed"><span class="font-weight-bold">Sisa Bayar (Rp): <?php echo $hasil['sisa_bayar']; ?></span></div></small>
              ================================
              <small><div class="billed"><span class="font-weight-bold">Keterangan : <?php echo $hasil['keterangan']; ?></span></div></small>
              <small><div class="billed"><span class="font-weight-bold">Instagram : onestoplaundryandrepair / kicksandbags.spa</span></div></small>
              <small><div class="billed"><span class="font-weight-bold">08118870289</span></div></small>
              <small><div class="billed"><span class="font-weight-bold">081210777721</span></div></small>
              <small><div class="billed"><span class="font-weight-bold">Promo : <?php echo $profil['tag']; ?></span></div></small>
              <span class="text-break"><?= $profil['lokasi']; ?></span>

            

            <?php
            }
            ?>
                
            
        </div>
    </div>
</div>


</body>
</html>
<?php

$html = ob_get_clean();
require_once 'dompdf/autoload.inc.php';
$dompdf = new DOMPDF();
$dompdf->set_paper("A5");
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream(" '".$No_Order."'.pdf");

?>
