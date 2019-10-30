<!-- untuk koneksi ke database -->
<?php include_once '../../database/koneksi.php'; ?>
<?php
session_start();
if (!isset($_SESSION["username"])) {
	header("Location: ../../login.php?&masuk");
	exit;
} else if ($_SESSION['level'] != 'admin') {
  header("Location: ../../login.php?&masuk");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
 
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Pendukung Keputusan Status Hotel</title>

  <link rel="stylesheet" href="../../assets/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../assets/css/style.css">

</head>
 <body>
