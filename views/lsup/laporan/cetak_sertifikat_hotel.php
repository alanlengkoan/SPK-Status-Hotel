<?php
ob_start();
// untuk koneksi ke databases
include_once '../../../database/koneksi.php';
$idhotel = $_GET['id_hotel'];
$sql     = "SELECT * FROM tb_hotel WHERE id_hotel = '$idhotel'";
$query   = mysqli_query($koneksi, $sql);
$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
$hasil   = json_decode($data['fasilitas'], true);

$sql_d = "SELECT * FROM tb_kpl_dinas WHERE id_kpl_dinas = '1'";
$q_d   = mysqli_query($koneksi, $sql_d);
$d_d   = mysqli_fetch_array($q_d, MYSQLI_ASSOC);
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
  text-align: center;
  text-transform: uppercase;
}

p {
  margin: 0;
}

</style>
<!-- CSS -->

<div class="judul">
    <table align="center">
        <tr>
            <td>
                <img src="../../../assets/images/download.png" alt="Logo Kabupaten Bulukumba" style="width: 120px; height: 150px;">
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td width="600" align="center">
                <h5>Pemerintah Provinsi Sulawesi Selatan</h5>
                <h4>Dinas Parawisata dan Ekonomi Kreatif Kota Makassar</h4>
            </td>
        </tr>
    </table>
</div>

<h3 style="text-align: center; text-decoration: underline;">Sertifikat</h3>

<br /><br />

<table align="center">
    <tr align="center">
        <td colspan="2">Menetapkan :</td>
    </tr>
    <tr>
        <td>Nama Hotel</td>
        <td>: <?= $data['nama_hotel']; ?></td>
    </tr>
    <tr>
        <td>Status Hotel</td>
        <td>: <?= empty($data['status_baru']) ? $data['status'] : $data['status_baru'] ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>: <?= $data['alamat']; ?></td>
    </tr>
</table>

<br /><br />

<table align="center">
    <tr>
        <td>Sebagai :</td>
    </tr>
</table>

<table align="center">
    <tr>
        <td>
            <?php

            if (empty($data['status_baru'])) {
                if ($data['status'] == 'Bintang 1') {
                    echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" />';
                } else if ($data['status'] == 'Bintang 2') {  
                    for ($i = 0; $i < 2; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                } else if ($data['status'] == 'Bintang 3') {  
                    for ($i = 0; $i < 3; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                } else if ($data['status'] == 'Bintang 4') {  
                    for ($i = 0; $i < 4; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                } else if ($data['status'] == 'Bintang 5') {  
                    for ($i = 0; $i < 5; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                }
            } else {
                if ($data['status_baru'] == 'Bintang 1') {
                    echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" />';
                } else if ($data['status_baru'] == 'Bintang 2') {  
                    for ($i = 0; $i < 2; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                } else if ($data['status_baru'] == 'Bintang 3') {  
                    for ($i = 0; $i < 3; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                } else if ($data['status_baru'] == 'Bintang 4') {  
                    for ($i = 0; $i < 4; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                } else if ($data['status_baru'] == 'Bintang 5') {  
                    for ($i = 0; $i < 5; $i++) {
                        echo '<img style="width: 50px;" src="../../../assets/images/bintang.png" /> &nbsp;';
                    }
                }
            }
            ?>
        </td>
    </tr>
</table>

<br /><br />

<h3 align="center">Hotel <?= empty($data['status_baru']) ? $data['status'] : $data['status_baru'] ?></h3>

<br /><br />

<h5>telah diuji kelayakan persyaratan dasarnya</h5>

<br /><br />

<table align="center">
  <tr>
    <td width="500"></td>
    <td align="center">
      <p>Kepala Dinas</p>
      <p>Parawisata dan Ekonomi</p>
      <br />
      <br />
      <br />
      <br />
      <p class="nama"><?=$d_d['nama']?></p>
      <p><?=$d_d['nrp']?></p>
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
