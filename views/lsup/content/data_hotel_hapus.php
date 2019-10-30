<?php
// untuk mengambik file koneksi
include_once "../../database/koneksi.php";
// untuk menghilangkan error
error_reporting(0);
$idhotel = $_GET['id_hotel'];
$sql_t   = "SELECT * FROM tb_hotel WHERE id_hotel = '$idhotel'";
$query_t = mysqli_query($koneksi, $sql_t);
$data    = mysqli_fetch_array($query_t, MYSQLI_ASSOC);
$tampil  = json_decode($data['fasilitas'], true);
for ($i = 0; $i < count($tampil); $i++) {
  $foto = $tampil[$i]['gambar'.$i];
  // untuk meghapus foto dalam file foto fasilitas
  unlink("../../fotofasilitas/".$foto);
}

// untuk menghapus data hotel
$sql1 = "DELETE FROM tb_hotel WHERE id_hotel = '$idhotel'";
mysqli_query($koneksi, $sql1);

// untuk menghapus akun user owner atau member
$sql2 = "DELETE FROM tb_user_owner WHERE id_hotel = '$idhotel'";
mysqli_query($koneksi, $sql2);

// untuk meghapus data alternatif
$sql3 = "DELETE FROM tb_alternatif WHERE id_alternatif = '$idhotel'";
mysqli_query($koneksi, $sql3);

// untuk mengahapus data hasil evaluasi
$sql4 = "DELETE FROM tb_evaluasi WHERE id_alternatif = '$idhotel'";
mysqli_query($koneksi, $sql4);

echo "<script>document.location.href='layout.php?content=data_hotel&hapus';</script>";
?>
