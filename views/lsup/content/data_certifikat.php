<?php 
$sql   = "SELECT * FROM tb_kpl_dinas WHERE id_kpl_dinas = '1'";
$query = mysqli_query($koneksi, $sql);
$data  = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>

<div class="content-wrapper">

<!-- untuk validasi gambar -->
<?php if (isset($_GET['ubah'])) { ?>
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Berhasil!</strong> Ubah data berhasil!
	</div>
<?php } ?>

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Detail Kepala Dinas Parawisata dan Ekonomi</h4>
						</div>
					</div>

					<form class="forms-sample" action="<?=$_SERVER['REQUEST_URI']?>" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpnamakpldinas" value="<?=$data['nama']?>" required="required" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-3 col-form-label">Jabatan</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpjabatan" value="<?=$data['jabatan']?>" required="required" />
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-3 col-form-label">NRP</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpnrp" value="<?=$data['nrp']?>" required="required" />
							</div>
						</div>

						<input type="submit" name="ubah" value="Ubah" class="btn btn-primary" />
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<?php 
if (isset($_POST ['ubah'])) {
	// untuk mengubah data
	$inpnamakpl = $_POST['inpnamakpldinas'];
	$inpjabatan = $_POST['inpjabatan'];
	$inpnrp     = $_POST['inpnrp'];

	$sql   = "UPDATE tb_kpl_dinas SET nama = '$inpnamakpl', jabatan = '$inpjabatan', nrp = '$inpnrp' WHERE id_kpl_dinas = '1'";
	$ubah  = mysqli_query($koneksi, $sql);

	if ($ubah) {
        echo "<script>document.location.href='".$_SERVER['REQUEST_URI']."&ubah';</script>";
	} else {
        echo "<script>alert('Gagal Mengubah Data!');</script>";
        echo "<script>document.location.href='".$_SERVER['REQUEST_URI']."';</script>";
	}

}
?>