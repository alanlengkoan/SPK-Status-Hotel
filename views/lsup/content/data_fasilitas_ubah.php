<?php
$idfasilitas = $_GET['id_fasilitas'];
$sql   = "SELECT * FROM tb_fasilitas WHERE id_fasilitas = '$idfasilitas'";
$query = mysqli_query($koneksi, $sql);
$data  = mysqli_fetch_array($query, MYSQLI_ASSOC);
$hasil = json_decode($data['penilaian'], true);
?>

<div class="content-wrapper">

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Ubah Data Fasilitas</h4>
						</div>
					</div>

					<form class="forms-sample" method="post">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Id Fasilitas</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpidfasilitas"
									value="<?= $data['id_fasilitas']; ?>" readonly="readonly" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Fasilitas</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpfasilitas"
									value="<?= $data['jenis_fasilitas'] ?>" required="required" />
							</div>
						</div>

						<?php 
						for ($i=0; $i < count($hasil); $i++) { 
						?>
						<div class="control-group">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Jenis Penilaian</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="inpnamapenilaian[]"
										value="<?= $hasil[$i]['fasilitas'] ?>" />
								</div>
								<div class="col-sm-3">
									<input type="number" class="form-control" name="inpnilai[]"
										value="<?= $hasil[$i]['nilai'] ?>" />
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-danger btn-md hapus">Hapus</button>
								</div>
							</div>
						</div>
						<?php } ?>

						<div class="after-add-more"></div>

						<div class="copy">
							<div class="control-group">
								<div class="form-group row">
									<label class="col-sm-3 col-form-label">Jenis Penilaian</label>
									<div class="col-sm-3">
										<input type="text" class="form-control" name="inpnamapenilaian[]"
											placeholder="Nama Penilaian" />
									</div>
									<div class="col-sm-3">
										<input type="number" class="form-control" name="inpnilai[]"
											placeholder="Nilai" />
									</div>
									<div class="col-sm-3">
										<!-- button untuk hapus -->
										<button type="button" class="btn btn-danger btn-md hapus">Hapus</button>
										<!-- button untuk hapus -->
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-3"></div>
							<div class="col-lg-3">
								<!-- button tambah -->
								<button class="btn btn-success tambah" type="button">Tambah</button>
								<!-- button tambah -->
							</div>
						</div>

						<input type="submit" name="ubah" value="Ubah" class="btn btn-primary" />
						<a href="layout.php?content=data_fasilitas" class="btn btn-light">Batal</a>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

		// untuk menambahkan field
		$(".tambah").click(function () {
			var html = $(".copy").html();
			$(".after-add-more").after(html);
		});

		// untuk menghapus field
		$("body").on("click", ".hapus", function () {
			$(this).parents(".control-group").remove();
		});

	});
</script>

<?php 
if (isset($_POST ['ubah'])) {
	// untuk mengubah data
	$id_fasilitas    = $_POST['inpidfasilitas'];
	$nma_kriteria    = $_POST['inpfasilitas'];
	$nma_penilaian   = $_POST['inpnamapenilaian'];
	$nilai           = $_POST['inpnilai'];

	$jumlah_penilaian = array();

	for ($i = 0; $i < count($nma_penilaian); $i++) {
		// untuk menghitung jumlah data
		$dataarray = array(
			'fasilitas' => $nma_penilaian[$i],
			'nilai'    => $nilai[$i]
		);
		// menggabung data menjadi array
		array_push($jumlah_penilaian, $dataarray);
	}

	// mengparsing data menjadi json
	$hasil = json_encode($jumlah_penilaian);
	$sql   = "UPDATE tb_fasilitas SET jenis_fasilitas = '$nma_kriteria', penilaian = '$hasil' WHERE id_fasilitas = '$id_fasilitas'";
	$ubah  = mysqli_query($koneksi, $sql);

	if ($ubah) {
		echo "
		<script>
			document.location.href='layout.php?content=data_fasilitas&ubah';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Gagal Mengubah Data!');
			document.location.href='layout.php?content=data_fasilitas;
		</script>
		";
	}

}
?>