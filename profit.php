<?php
session_start();
if(isset($_SESSION['id'])){
?>

    <?php
      include "include/header.php";
    ?>

<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Data Profit</a>
        </li>
        <li class="breadcrumb-item active">Data Profit</li>
      </ol>
      <!-- Icon Cards-->
  <h3>Data Profit</h3>
  <hr>

  <table id="table" class="table table-striped table-bordered table-responsive" >
    <thead>
      <tr>
        <th style="text-align: center;">No</th>
        <th>profit</th>
     
      </tr>
    </thead>

    <tbody>
      <?php
        $i = 0 + 1;
        $sql = mysqli_query($conn, "SELECT sum(Total_Bayar) as total FROM transaksi");
        while ($hasil = mysqli_fetch_array($sql)) {
     ?>
  <tr>
      <td style="text-align: center;"><?php echo $i; ?></td>
      <td><?php echo rupiah($hasil['total']); ?></td>
     
  </tr>
  <?php
      $i++;
      }
    ?>

  </tbody>
  </table>

  <form method="get" action="">
        <label>Filter Berdasarkan</label><br>
        <select name="filter" id="filter">
            <option value="">Pilih</option>
            <option value="1">Per Tanggal</option>
            <option value="2">Per Bulan</option>
            <option value="3">Per Tahun</option>
        </select>
        <br /><br />
        <div id="form-tanggal">
            <label>Tanggal</label><br>
            <input type="text" name="tanggal" class="input-tanggal" />
            <br /><br />
        </div>
        <div id="form-bulan">
            <label>Bulan</label><br>
            <select name="bulan">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            <br /><br />
        </div>
        <div id="form-tahun">
            <label>Tahun</label><br>
            <select name="tahun">
                <option value="">Pilih</option>
                <?php
                $query = "SELECT YEAR(Tgl_Ambil) AS tahun FROM transaksi GROUP BY YEAR(Tgl_Ambil)"; // Tampilkan tahun sesuai di tabel transaksi
                $sql = mysqli_query($conn, $query); // Eksekusi/Jalankan query dari variabel $query
                while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
                    echo '<option value="'.$data['tahun'].'">'.$data['tahun'].'</option>';
                }
                ?>
            </select>
            <br /><br />
        </div>
        <button type="submit">Tampilkan</button>
        <a href="profit">Reset Filter</a>
    </form>
    <hr />
    <?php
    if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
        $filter = $_GET['filter']; // Ambil data filder yang dipilih user
        if($filter == '1'){ // Jika filter nya 1 (per tanggal)
            $Tgl_Ambil = date('d-m-y', strtotime($_GET['tanggal']));
            echo '<b>Data Transaksi Tanggal '.$Tgl_Ambil.'</b><br /><br />';
            echo '<a href="print.php?filter=1&tanggal='.$_GET['tanggal'].'">Cetak PDF</a><br /><br />';
            $query = "SELECT * FROM transaksi WHERE DATE(Tgl_Ambil)='".$_GET['tanggal']."'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
        }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
            $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
            echo '<b>Data Transaksi Bulan '.$nama_bulan[$_GET['bulan']].' '.$_GET['tahun'].'</b><br /><br />';
            echo '<a href="print.php?filter=2&bulan='.$_GET['bulan'].'&tahun='.$_GET['tahun'].'">Cetak PDF</a><br /><br />';
            $query = "SELECT * FROM transaksi WHERE MONTH(Tgl_Ambil)='".$_GET['bulan']."' AND YEAR(Tgl_Ambil)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
        }else{ // Jika filter nya 3 (per tahun)
            echo '<b>Data Transaksi Tahun '.$_GET['tahun'].'</b><br /><br />';
            echo '<a href="print.php?filter=3&tahun='.$_GET['tahun'].'">Cetak PDF</a><br /><br />';
            $query = "SELECT * FROM transaksi WHERE YEAR(Tgl_Ambil)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
        }
    }else{ // Jika user tidak mengklik tombol tampilkan
        echo '<b>Semua Data Transaksi</b><br /><br />';
        echo '<a href="print.php">Cetak PDF</a><br /><br />';
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



    <script>
    $(document).ready(function(){ // Ketika halaman selesai di load
        $('.input-tanggal').datepicker({
            dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
        });
        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else{ // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }
            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })
    </script>
   


<?php
        include "include/footer.php"
?>


<?php
}else{
	header("location:login/index.php");
} ?>
