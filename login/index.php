<?php
        include "../include/koneksi.php";
        $sql = mysqli_query($conn, "SELECT * FROM profil");
        $profil = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $profil['tag']; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<!-- Custom fonts for this template-->
	<link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		<link
			href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
			rel="stylesheet">

		<!-- Custom styles for this template-->
		<link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">

<?php
session_start();
  if(isset($_SESSION['id']))
    {
      header('Location: ../index1');
    }

?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
									<form class="user" action="../login.php" method="post" >
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="pass">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
										<button class="btn btn-primary btn-user btn-block" type="submit" name="submit">
											Login
										</button>
                                     
                                        <hr>
                                    </form>
                                    <!-- <hr> -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



	<!-- Bootstrap core JavaScript-->
	<script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>
</html>
