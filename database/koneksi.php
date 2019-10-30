<?php

$host = 'localhost';
$user = 'root';
$pass = '0sampai1';
$dbnm = 'spk_hotel';

// untuk koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $dbnm);

if (!$koneksi) {
    die('Gagal' . mysqli_connect_errno());
}

?>