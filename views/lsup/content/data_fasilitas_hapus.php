<?php
include_once "../../database/koneksi.php";
$idfasilitas = $_GET['id_fasilitas'];
// untuk menghapus data pada tbl fasilitas
$sql1         = "DELETE FROM tb_fasilitas WHERE id_fasilitas = '$idfasilitas'";
mysqli_query($koneksi, $sql1);

// untuk menghapus data pada tbl kriteria
$sql2         = "DELETE FROM tb_kriteria WHERE id_kriteria = '$idfasilitas'";
mysqli_query($koneksi, $sql2);
echo "
<script>
    document.location.href='layout.php?content=data_fasilitas&hapus';
</script>
";
?>
