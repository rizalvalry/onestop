<?php
include "include/koneksi.php";

$sql = mysqli_query($conn, "SELECT skala.nama as skala, transaksi.Tgl_Terima, transaksi.Tgl_Ambil, transaksi.No_Order 
from 
transaksi 
join kelas on kelas.id_kelas = transaksi.kelas 
join skala on skala.id_skala = transaksi.skala 
WHERE No_Order = '1164'");
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
    $bulan = date('Y-m-d', strtotime($Date. ' + ' .$kalenderbulan. 'days'));

}

echo $harian;
?>

<p id="demo"></p>
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
  document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam "
  + minutes + " Menit " + seconds + " Detik ";
    
  // Jika hitungan mundur selesai, tulis beberapa teks 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
    var mySound = soundManager.createSound({
            id: 'mySound',
            url: '/sound/alert.mp3'
            });

            mySound.play();
  }
}, 1000);
</script>