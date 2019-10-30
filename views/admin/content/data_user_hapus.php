<?php
include_once '../../database/koneksi.php';
$id     = $_GET['id'];
$sql    = "DELETE FROM tb_user WHERE id = '$id'";
mysqli_query($koneksi, $sql);
echo "
<script>
    document.location.href='layout.php?content=data_user&hapus';
</script>
";
