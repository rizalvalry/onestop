<?php ob_start(); ?>
<html>
<head>
  <title>Cetak PDF</title>
  <style>
    table {
      border-collapse:collapse;
      table-layout:fixed;width: 630px;
    }
    table td {
      word-wrap:break-word;
      width: 20%;
    }
  </style>
</head>
<body>
  <?php
  // Load file koneksi.php
  
  include "./include/koneksi.php";
  
  if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter
    $filter = $_GET['filter']; // Ambil data filder yang dipilih user
    if($filter == '1'){ // Jika filter nya 1 (per tanggal)
      $Tgl_Ambil = date('d-m-y', strtotime($_GET['tanggal']));
      echo '<b>Data Transaksi Tanggal '.$Tgl_Ambil.'</b><br /><br />';
      $query = "SELECT * FROM transaksi WHERE DATE(Tgl_Ambil)='".$_GET['tanggal']."'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
      $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
      echo '<b>Data Transaksi Bulan '.$nama_bulan[$_GET['bulan']].' '.$_GET['tahun'].'</b><br /><br />';
      $query = "SELECT * FROM transaksi WHERE MONTH(Tgl_Ambil)='".$_GET['bulan']."' AND YEAR(Tgl_Ambil)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
    }else{ // Jika filter nya 3 (per tahun)
      echo '<b>Data Transaksi Tahun '.$_GET['tahun'].'</b><br /><br />';
      $query = "SELECT * FROM transaksi WHERE YEAR(Tgl_Ambil)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
    }
  }else{ // Jika user tidak memilih filter
    echo '<b>Semua Data Transaksi</b><br /><br />';
    $query = "SELECT * FROM transaksi where Tgl_Ambil > 1 ORDER BY Tgl_Ambil"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
  }
  ?>
  <table border="1" cellpadding="8">
  <tr>
        <th>Tanggal</th>
        <th>No Order</th>
        <th>KTP Cust</th>
        <th>Admin ID</th>
        <th>Total Bayar</th>
  </tr>
  <?php
  $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
  $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
  if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
      $Tgl_Ambil = date('d-m-Y', strtotime($data['Tgl_Ambil'])); // Ubah format tanggal jadi dd-mm-yyyy
      echo "<tr>";
      echo "<td>".$Tgl_Ambil."</td>";
      echo "<td>".$data['No_Order']."</td>";
      echo "<td>".$data['No_Identitas']."</td>";
      echo "<td>".$data['admin_id']."</td>";
      echo "<td>".$data['Total_Bayar']."</td>";
      echo "</tr>";
    }
  }else{ // Jika data tidak ada
    echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
  }
  ?>
  </table>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
require 'html2pdf/autoload.php';
$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Data Transaksi.pdf', 'D');
?>