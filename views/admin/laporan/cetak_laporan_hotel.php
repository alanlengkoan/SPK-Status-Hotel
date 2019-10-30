<?php
ob_start();
// untuk koneksi ke databases
include_once '../../../database/koneksi.php';
?>

<!-- CSS -->
<style media="screen">

body {
  font-family: times;
}

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
  text-align: center;
  text-transform: uppercase;
  font-family: times;
}

a {
  text-decoration: none;
}

p {
  margin: 0;
  font-family: times;
}

</style>
<!-- CSS -->

<div class="judul">
  <table align="center">
    <tr>
      <td>
        <img src="../../../assets/images/download.png" alt="Logo Kabupaten Bulukumba" style="width: 70p; height: 70px;">
      </td>
      <td width="600" align="center">
        <h2>Pemerintah Kota Makassar</h2>
        <h3>Dinas Parawisata</h3>
        <p><b>Jl. Urip Sumoharjo No. 58, Makassar 90144. Phone/Fax: 0411 - 424 832</b></p>
        <p>Email: mkassombere@gmail.com - Twitter: @mks_sombere - Website: <a href="http://www.tourism-makassar.id/">www.tourism-makassar.id</a></p>
      </td>
    </tr>
  </table>
  <hr>
</div>

<h4 style="text-align: center;">Laporan Status Data Hotel</h4>

<table border="1" align="center">
  <thead>
      <tr>
          <th>No</th>
          <th>Id Hotel</th>
          <th>Nama</th>
          <th>Status Awal</th>
          <th>Status Baru</th>
          <th>No. Hp</th>
          <th>Alamat</th>
      </tr>
  </thead>
  <tbody>
        <?php
        $no    = 1;
        $sql   = "SELECT * FROM  tb_hotel";
        $query = mysqli_query($koneksi, $sql);
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['id_hotel']; ?></td>
            <td><?php echo $row['nama_hotel']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?= empty($row['status_baru']) ? 'Belum Ada Pembaruan Status' :  $row['status_baru'] ?></td>
            <td><?php echo $row['kontak']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
        </tr>
        <?php } ?>
  </tbody>
</table>

<br />
<br />

<table align="center">
  <tr>
    <td width="500"></td>
    <td>
      <p>Yang bertanda tangan dibawah ini :</p>
      <br />
      <br />
      <br />
      <br />
      <p class="nama">Desy Simon</p>
    </td>
  </tr>
</table>

<?php

// proses untuk menampilkan file pdf
$content = ob_get_clean();
include_once "../../../vendors/html2pdf/html2pdf.class.php";
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Laporan Data Penyakit.pdf');

?>
