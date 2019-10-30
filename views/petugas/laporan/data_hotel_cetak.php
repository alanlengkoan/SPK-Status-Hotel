<?php
ob_start();
// untuk koneksi ke databases
include_once '../../../database/koneksi.php';
// mengambil data berdasarkan id
$idhotel = $_GET['id_hotel'];
$sql     = "SELECT * FROM tb_hotel WHERE id_hotel = '$idhotel'";
$query   = mysqli_query($koneksi, $sql);
$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>

<!-- CSS -->
<style media="screen">

.judul {
  padding: 4mm;
  text-align: center;
}

.nama {
  text-decoration: underline;
  font-weight: bold;
}

h1, h2, h3, h4, h5, h6 {
  margin-top: 0;
  margin-bottom: 5px;
}

p {
  margin: 0;
}

</style>
<!-- CSS -->

<div class="judul">
  <table align="center">
    <tr>
      <td width="600" align="center">
        <h3>DATA HOTEL</h3>
        <h3>DINAS PARAWISATA</h3>
      </td>
    </tr>
  </table>
  <hr>
</div>

<table>
  <tr>
    <td>Id Hotel</td>
    <td>: <?php echo $data['id_hotel']; ?> </td>
  </tr>
  <tr>
    <td>Nama Hotel</td>
    <td>: <?php echo $data['nama_hotel']; ?> </td>
  </tr>
  <tr>
    <td>Status Hotel</td>
    <td>: <?php echo $data['status']; ?> </td>
  </tr>
  <tr>
    <td>Kontak</td>
    <td>: <?php echo $data['kontak']; ?> </td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>: <?php echo $data['alamat']; ?> </td>
  </tr>
</table>
<br />
<h2>Fasilitas Hotel</h2>
<table border="1" align="center">
  <thead>
    <tr>
      <th>No</th>
      <th>Fasilitas</th>
      <th>Jumlah / Banyak</th>
      <th>Foto</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $tampil = json_decode($data['fasilitas'], true);
    for ($i = 0; $i < count($tampil); $i++) { ?>
      <tr>
        <td><?=$no++?></td>
        <td><?=$tampil[$i]['fasilitas'.$i]?></td>
        <td><?= empty($tampil[$i]['jumlah'.$i]) ? $tampil[$i]['hasil'.$i] : $tampil[$i]['jumlah'.$i] ?></td>
        <td align='center'>
          <?php if ($tampil[$i]['gambar'.$i] == 'none_picture.png') { ?>
            <img style='width: 350px; width: 350px;' src='../../../assets/images/none_picture.png' />
          <?php } else { ?>
            <img style='width: 350px; width: 350px;' src='../../../fotofasilitas/<?=$tampil[$i]['gambar'.$i]?>' />
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<?php

// proses untuk menampilkan file pdf
$content = ob_get_clean();
include_once "../../../vendors/html2pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Laporan Data Penyakit.pdf');

?>
