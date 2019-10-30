<?php
// untuk koneksi ke database
include_once 'database/koneksi.php';
session_start();

if(isset($_POST["masuk"])) {
	$username  = $_POST['username'];
	$password  = $_POST['password'];

	$sql1    = "SELECT * FROM tb_user WHERE username = '$username'";
	$result1 = mysqli_query($koneksi, $sql1);
	$data1   = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	$sql2    = "SELECT * FROM tb_user_owner WHERE username = '$username'";
	$result2 = mysqli_query($koneksi, $sql2);
	$data2   = mysqli_fetch_array($result2, MYSQLI_ASSOC);

	if (mysqli_num_rows($result1) > 0 || mysqli_num_rows($result2) > 0) {
		if ($data1['level'] == 'admin' || $data1['level'] == 'lsup' || $data1['level'] == 'petugas') {
			if (password_verify($password, $data1["password"])) {

	      // untuk mengecek level user
	      if ($data1['level'] == 'admin') {

	        // set session
	        $_SESSION["username"] = $username;
	        $_SESSION["level"]    = 'admin';
	        header("location: views/admin/index.php?masuk");
	        exit;

	      } else if ($data1['level'] == 'lsup') {

	        // set session
	        $_SESSION["username"] = $username;
	        $_SESSION["level"]    = 'lsup';
	        header("location: views/lsup/index.php?masuk");
	        exit;

	      } else if ($data1['level'] == 'petugas') {

	        // set session
	        $_SESSION["username"] = $username;
	        $_SESSION["level"]    = 'petugas';
	        header("location: views/petugas/index.php?masuk");
	        exit;

	      }

	    } else {

			$valid_password = true;
		  
	    }
		} else if ($data2['level'] == 'owner') {

			if (password_verify($password, $data2["password"])) {

				// set session
				$_SESSION["username"] = $username;
				$_SESSION["level"]    = 'owner';
				header("location: views/owner/index.php");
				exit;

			} else {
			$valid_password = true;
			}

		} else if ($data2['level'] == 'konfirmasi') {
			$valid_konfirmasi = true;
		}
	} else {
		$valid_username = true;
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Pendukung Keputusan Status Hotel</title>

  <link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

  <div class="container-scroller">
  	<div class="container-fluid page-body-wrapper full-page-wrapper">
  		<div class="main-panel">
  			<div class="content-wrapper d-flex align-items-center auth px-0">
  				<div class="row w-100 mx-0">
  					<div class="col-lg-4 mx-auto">
  						<div class="auth-form-light text-left py-5 px-4 px-sm-5">
  							<div class="brand-logo">
  								<h3 style="color: #0ddbb9; text-transform: uppercase; font-weight: bold;">Sistem Pendukung Keputusan Status Hotel</h3>
  							</div>
							  
							<?php
							if (isset($_GET['masuk'])) {
								echo "
								<div class='alert alert-info alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Gagal!</strong> Anda harus Login terlebih dahulu untuk mengakses!
								</div>
								";
							} else if (isset($valid_username)) {
								echo "
								<div class='alert alert-danger alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Gagal!</strong> Username yang Anda masukkan tidak terdaftar!
								</div>
								";
							} else if (isset($valid_konfirmasi)) {
								echo "
								<div class='alert alert-info alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Info!</strong> Akun Anda dalam proses konfirmasi, mohon ditunggu!
								</div>
								";
							} else if (isset($valid_password)) {
								echo "
								<div class='alert alert-danger alert-dismissible'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<strong>Gagal!</strong> Password Anda Salah!
								</div>
								";
							}
							?>
  							<form class="pt-1" method="post">
  								<div class="form-group">
  									<input type="text" name="username" class="form-control" placeholder="Username" />
  								</div>
  								<div class="form-group">
  									<input type="password" name="password" class="form-control" placeholder="Password" />
  								</div>
  								<div class="mt-3">
  									<input type="submit" name="masuk" value="Masuk" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
  								</div>
  								<div class="text-center mt-4 font-weight-light">
  									Belum punya akun? <a href="registrasi.php" class="text-primary">Daftar</a>
  								</div>
  							</form>
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  </div>

  <script src="assets/base/vendor.bundle.base.js"></script>
  <script src="assets/js/template.js"></script>
  
</body>

</html>