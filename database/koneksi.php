<?php

$host = '127.0.0.1';
$user = 'my_root';
$pass = 'my_pass';
$dbnm = 'spk_hotel';
$port = '3307';

// untuk koneksi ke database
$koneksi = mysqli_connect($host, $user, $pass, $dbnm, $port);

if (!$koneksi) {
    die('Gagal' . mysqli_connect_errno());
}
