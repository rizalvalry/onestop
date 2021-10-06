
<?php
        include "include/koneksi.php";
        $sql = mysqli_query($conn, "SELECT * FROM profil");
        $profil = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?= $profil['nama_profil']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="<?= $profil['tag']; ?>" />
    <meta name="keywords" content="<?= $profil['tag']; ?>" />
    <meta name="author" content="<?= $profil['tag']; ?>" />
    <link rel="apple-touch-icon" sizes="57x57" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="icon" type="home/image/png" href="../logo/<?= $profil['gambar']; ?>" sizes="32x32">
    <link rel="icon" type="home/image/png" href="../logo/<?= $profil['gambar']; ?>" sizes="192x192">
    <link rel="icon" type="home/image/png" href="../logo/<?= $profil['gambar']; ?>" sizes="96x96">
    <link rel="icon" type="home/image/png" href="../logo/<?= $profil['gambar']; ?>" sizes="16x16">
    <link rel="manifest" href="../logo/<?= $profil['gambar']; ?>">
    <link rel="shortcut icon" href="../logo/<?= $profil['gambar']; ?>">
  </head>

  <body>

   

<!-- cek login -->
<?php
session_start();
include "include/koneksi.php";
  if(isset($_SESSION['id']))
    {
      echo '<meta http-equiv="refresh" content="0; url=index1">';
    }
    else {
      echo '<meta http-equiv="refresh" content="0; url=login/index">';
    }

?>
<!-- end -->

 </body>
</html>
