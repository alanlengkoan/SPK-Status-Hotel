<?php include_once 'atribut/head.php' ?>
<?php
$sql    = "SELECT id_fasilitas FROM tb_fasilitas";
$query  = mysqli_query($koneksi, $sql);
$data   = mysqli_fetch_array($query, MYSQLI_ASSOC);
$jumlah = mysqli_num_rows($query);

if ($jumlah != 0) {
    $nilkod  = substr($jumlah[0], 1);
    $kode    = (int) $nilkod;
    $kode    = $jumlah + 1;
    $kodeotomatis = str_pad($kode, 1, "0", STR_PAD_LEFT);
} else {
    $kodeotomatis = "1";
}
?>

<div class="content-wrapper">

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Tambah Data Fasilitas</h4>
						</div>
					</div>

					<form class="forms-sample" method="post">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Id Hotel</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpidfasilitas"
									value="<?php echo $kodeotomatis; ?>" readonly="readonly" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Fasilitas</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpfasilitas" placeholder="Nama Fasilitas"
									required="required" />
							</div>
						</div>

						<div class="after-add-more">
							<div class="form-group row">
								<label class="col-sm-3 col-form-label">Jenis Penilaian</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" name="inpnamapenilaian[]"
										placeholder="Nama Penilaian" />
								</div>
								<div class="col-sm-3">
									<input type="number" class="form-control" name="inpnilai[]" placeholder="Nilai" />
								</div>
							</div>
						</div>

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

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" />
						<a href="data_fasilitas.php" class="btn btn-light">Batal</a>
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
if (isset($_POST['simpan'])) {
	// untuk menyimpan data
	$id_fasilitas    = $_POST['inpidfasilitas'];
	$jenis_fasilitas = $_POST['inpfasilitas'];
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
	$hasil   = json_encode($jumlah_penilaian);
	$sql1    = "INSERT INTO tb_fasilitas (id_fasilitas, jenis_fasilitas, penilaian) VALUES ('$id_fasilitas', '$jenis_fasilitas', '$hasil')";
	$tambah1 = mysqli_query($koneksi, $sql1);

	// untuk menambah data kriteria
	$sql2     = "INSERT INTO tb_kriteria (id_kriteria, kriteria, weight) VALUES ('$id_fasilitas', '$nma_kriteria', '0')";
	$tambah2  = mysqli_query($koneksi, $sql2);

	if ($tambah2) {
		echo "
		<script>
			document.location.href='layout.php?content=data_fasilitas&tambah';
		</script>
		";
	} else {
		echo "
		<script>
			alert('Gagal Menyimpan Data!');
			document.location.href='layout.php?content=data_fasilitas&gagal';
		</script>
		";
	}

}
?>