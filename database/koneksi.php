<?php

$host = 'localhost';
$user = 'my_root';
$pass = 'my_pass';
$dbnm = 'spk_hotel';

// untuk koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $dbnm);

if (!$koneksi) {
    die('Gagal' . mysqli_connect_errno());
}

?>