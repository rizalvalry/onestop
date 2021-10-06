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
$sql = mysqli_query($conn, "SELECT pelanggan.Nama, kelas.nama as kelas, skala.nama as skala, pelanggan.Alamat, transaksi.Tgl_Terima, transaksi.Tgl_Ambil, transaksi.No_Order, pelanggan.No_Hp 
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
                        <h1 class="text-uppercase"><?= $hasil['No_Order']; ?></h1>
                        <small><div class="billed"><span class="font-weight-bold text-uppercase">Billed:</span><span class="ml-1"><?= $kasir['nama']; ?></span></div></small>
                        <small><div class="billed"><span class="font-weight-bold text-uppercase">Date:</span><span class="ml-1"><?php echo $hasil['Tgl_Terima']; ?></span></div></small>
                        <small><div class="billed"><span class="font-weight-bold text-uppercase">Order ID:</span><span class="ml-1">#<?= $hasil['No_Order']; ?></span></div></small>
                        <span class="text-break"><?= $profil['lokasi']; ?></span>
                    </div>
                    <div class="col-md-6 text-right mt-3">
                        <h4 class="text-danger mb-0"><?= $profil['nama_profil']; ?></h4>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="table-responsive">
                    <table class="table" >
  <thead>
    <tr>
      <th>No</th>
      <th>Jenis Barang</th>
      <th>Treatment</th>
      <th>Jumlah Pakaian/Barang</th>
      <th>Harga Barang</th>
    </tr>
  </thead>
  <tbody>
      <?php
        
        $i = 1;
        $sql = mysqli_query($conn, "SELECT Jenis_Pakaian, Jumlah_Pakaian, detail_transaksi.Id_Laundry, laundry.Jenis_Laundry, laundry.Harga FROM (detail_transaksi join pakaian ON detail_transaksi.Id_Pakaian = pakaian.Id_Pakaian join laundry ON detail_transaksi.Id_Laundry = laundry.Id_Laundry) WHERE No_Order = '$No_Order'");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
      <tr>
        <td style="text-align:center"><?=$i?></td>
        <td><?php echo $hasil['Jenis_Pakaian']; ?></td>
        <td><?php echo $hasil['Jenis_Laundry']; ?></td>
        <td><?php echo $hasil['Jumlah_Pakaian']; ?></td>
        <td><?php echo $hasil['Harga']; ?></td>
      </tr>
      <?php
      $i++;
    }
      ?>
  </tbody>
</table>
                    </div>
                </div>
                
                <div class="container">
<?php
$sql = mysqli_query($conn, "SELECT total_berat, diskon, dp, Total_Bayar, sisa_bayar from transaksi WHERE No_Order = '$No_Order'");
while ($hasil = mysqli_fetch_array($sql))
{
 ?>
<div>
  <p class="float-right">Promo : <?php echo $profil['tag']; ?></p>
</div>
<div class="">
  <?php
  if($hasil['dp'] != 0) {
    echo "<p>LUNAS (Rp):   ".$hasil['Total_Bayar']."  </p>";
  } else {
    echo "<p>DP :   ".$hasil['dp']."  </p>";
  }
  ?>
  <p>Total Bayar (Rp): <?php echo $hasil['Total_Bayar']; ?></p>
  <p>Total Bayar (Rp): <?php echo $hasil['sisa_bayar']; ?></p>
</div>

<?php
}
?>
                
            </div>
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
$dompdf->stream('struk.pdf');

?>
