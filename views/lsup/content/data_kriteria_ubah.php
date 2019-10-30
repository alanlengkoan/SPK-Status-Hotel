<?php include_once 'atribut/head.php' ?>
<?php
$idkriteria = $_GET['id_kriteria'];
$sql        = "SELECT * FROM tb_kriteria WHERE id_kriteria = '$idkriteria' ";
$query      = mysqli_query($koneksi, $sql);
$data       = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>

<div class="content-wrapper">

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Ubah Data Kriteria</h4>
						</div>
					</div>

					<form class="forms-sample" method="post">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Id Kriteria</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpidkriteria" value="<?= $idkriteria; ?>"
									readonly="readonly" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Kriteria</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpkriteria"
									value="<?= $data['kriteria'] ?>" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Weight</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpweight" value="<?= $data['weight'] ?>"
									required="required" />
							</div>
						</div>

						<input type="submit" name="ubah" value="Ubah" class="btn btn-primary" />
						<a href="data_kriteria.php" class="btn btn-light">Batal</a>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<?php
if (isset($_POST['ubah'])) {
	// untuk menyimpan data
	$id_kriteria = $_POST['inpidkriteria'];
	$kriteria    = $_POST['inpkriteria'];
	$weight      = $_POST['inpweight'];

	// untuk menambah data kriteria
	$sql1   = "UPDATE tb_kriteria SET kriteria = '$kriteria', weight = '$weight' WHERE id_kriteria = '$id_kriteria'";
	$tambah = mysqli_query($koneksi, $sql1);

	if ($tambah) {
		echo "
		<script>
			document.location.href='layout.php?content=data_kriteria&ubah';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Gagal Menyimpan Data!');
			document.location.href='layout.php?content=data_kriteria&gagal';
		</script>
		";
	}
}
?>