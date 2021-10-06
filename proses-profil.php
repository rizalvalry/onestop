<?php
// memanggil file koneksi.php untuk melakukan koneksi database
include "include/koneksi.php"; 

	// membuat variabel untuk menampung data dari form
  $id = $_POST['id'];
  $nama_profil = $_POST['nama_profil'];
  $email = $_POST['email'];
  $tag = $_POST['tag'];
  $no_telp = $_POST['no_telp'];
  $no_telp2 = $_POST['no_telp2'];
  $lokasi = $_POST['lokasi'];
  $no_rekening = $_POST['no_rekening'];
  $gambar_profil = $_FILES['gambar_profil']['name'];

  //cek dulu jika merubah gambar produk jalankan coding ini
  if($gambar_profil != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); //ekstensi file gambar yang bisa diupload 
    $x = explode('.', $gambar_profil); //memisahkan nama file dengan ekstensi yang diupload
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar_profil']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar_profil; //menggabungkan angka acak dengan nama file sebenarnya
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'logo/'.$nama_gambar_baru); //memindah file gambar ke folder gambar
                      
                    // jalankan query UPDATE berdasarkan ID yang produknya kita edit
                   $query  = "UPDATE profil SET nama_profil = '$nama_profil', email = '$email', tag = '$tag', no_telp = '$no_telp', no_telp2 = '$no_telp2',  lokasi = '$lokasi', no_rekening = '$no_rekening', gambar = '$nama_gambar_baru'";
                    $query .= "WHERE id = '$id'";
                    $result = mysqli_query($conn, $query);
                    // periska query apakah ada error
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
                    } else {
                      //tampil alert dan akan redirect ke halaman profil
                      //silahkan ganti profil sesuai halaman yang akan dituju
                      echo "<script>alert('Data berhasil diubah.');window.location='profil';</script>";
                    }
              } else {     
               //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
              }
    } else {
      // jalankan query UPDATE berdasarkan ID yang produknya kita edit
      $query  = "UPDATE profil SET nama_profil = '$nama_profil', email = '$email', tag = '$tag', no_telp = '$no_telp', no_telp2 = '$no_telp2',  lokasi = '$lokasi', no_rekening = '$no_rekening'";
      $query .= "WHERE id = '$id'";
      $result = mysqli_query($conn, $query);
      // periska query apakah ada error
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($conn).
                             " - ".mysqli_error($conn));
      } else {
        //tampil alert dan akan redirect ke halaman profil
        //silahkan ganti profil sesuai halaman yang akan dituju
          echo "<script>alert('Data berhasil diubah.');window.location='profil';</script>";
      }
    }

