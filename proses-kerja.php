<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "include/koneksi.php"; 

	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $keterangan = $_POST['keterangan'];
  $gambar_kerja = $_FILES['gambar_kerja']['name'];

  //cek dulu jika merubah gambar produk jalankan coding ini
  if($gambar_kerja != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_kerja); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_kerja']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_kerja; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'item/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE transaksi SET status = 'proses', keterangan = '$keterangan', gambar = '$nama_gambar_baru'";
                    $query .= "WHERE No_Order = '$id'";
                    $result = mysqli_query($conn, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
                    } else {
                      //tampil alert dan akan redirect ke halaman transaksi
                      //silahkan ganti transaksi sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='transaksi';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE transaksi SET status = 'proses', keterangan = '$keterangan'";
      $query .= "WHERE No_Order = '$id'";
      $result = mysqli_query($conn, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
      } else {
        //tampil alert dan akan redirect ke halaman transaksi
        //silahkan ganti transaksi sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='transaksi';</script>";
      }
    }

