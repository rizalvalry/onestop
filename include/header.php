<?php
        include "function.php";
        include "koneksi.php";

        $id_session = $_SESSION['id'];
        $sql = mysqli_query($conn, "SELECT * FROM profil");
        $profil = mysqli_fetch_array($sql);

?>
<!DOCTYPE html>
<html>
  <head>
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

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?= $profil['tag']; ?></title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- custom -->
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- sweet alert -->
  <link rel="stylesheet" type="text/css" href="<?php echo getConfig('base_url');?>asset/sweetalert/dist/sweetalert.css">

</head>

<body class="fixed-nav sticky-footer bg-light" id="page-top">


<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light" id="mainNav">
    <a class="navbar-brand" href="index.html">
      <img src="logo/<?= $profil['gambar']; ?>" width="30" height="30" alt="">
      <?= $profil['nama_profil']; ?>
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="index1.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>index1">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="tambahdatatransaksi.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Transaksi Laundry">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>tambahdatatransaksi">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Transaksi Laundry</span>
          </a>
        </li>
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="transaksi.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Data Transaksi">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>transaksi">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Data Transaksi</span>
          </a>
        </li>
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="pakaian.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Data Pakaian">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>pakaian">
            <i class="fa fa-fw fa-envelope-open"></i>
            <span class="nav-link-text">Data Pakaian</span>
          </a>
        </li>
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="pelanggan.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Data Pelanggan">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>pelanggan">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Data Pelanggan</span>
          </a>
        </li>
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="harga.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Data Harga">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>harga">
            <i class="fa fa-fw fa-money"></i>
            <span class="nav-link-text">Data Harga</span>
          </a>
        </li>
        <?php
      if($_SESSION['role_id'] == 1) {
          ?>

        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="profit.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Data Profit">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>profit">
            <i class="fa fa-fw fa-bar-chart"></i>
            <span class="nav-link-text">Data Profit</span>
          </a>
        </li>
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="user.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Data User">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>user">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Data User</span>
          </a>
        </li>
        <?php } ?>
        <li class="nav-item <?php echo (basename($_SERVER['PHP_SELF'])=="profil.php") ? "active" : "" ?>" data-toggle="tooltip" data-placement="right" title="Data User">
          <a class="nav-link" href="<?php echo getConfig('base_url');?>profil">
            <i class="fa fa-fw fa-globe"></i>
            <span class="nav-link-text">Profil</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-user"></i>
          Halo <?php 
          $id_session = $_SESSION['id'];
          $sql = mysqli_query($conn, "SELECT nama FROM admin where id = '$id_session' ");
          $hasil = mysqli_fetch_array($sql);
          echo $hasil['nama']; ?>
          </a>
          <!-- <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">New Messages:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all messages</a>
          </div> -->
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="badge badge-pill badge-danger" id="noti_number"></span>
          </a>
          <!-- <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">New Alerts:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Status Update</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">This is an automated server response message. All systems are online.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">View all alerts</a>
          </div> -->
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

<script type="text/javascript">
    function loadDoc() {
      setInterval(function(){

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        document.getElementById("noti_number").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "notifikasi.php", true);
      xhttp.send();

      },5000);


    }
    loadDoc();
</script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <!-- sweet alert -->
    <script type="text/javascript" src="<?php echo getConfig('base_url');?>asset/sweetalert/dist/sweetalert.min.js"></script>

