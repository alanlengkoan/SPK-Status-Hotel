<?php
$idhotel = $_GET['id_hotel'];
$sql     = "SELECT * FROM tb_hotel WHERE id_hotel = '$idhotel'";
$query   = mysqli_query($koneksi, $sql);
$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
$hasil1  = json_decode($data['fasilitas'], true);
?>

<div class="content-wrapper">

<!-- untuk validasi gambar -->
<?php if (isset($_GET['validasi_ukuran'])) { ?>
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Gagal!</strong> Ukuran Gambar terlalu besar!
	</div>
<?php } else if (isset($_GET['validasi_ektensi'])) { ?>
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Gagal!</strong> Ektensi gambar tidak sesuai yg diperbolehkan hanya jpeg, jpg dan png!
	</div>
<?php } else if (isset($_GET['validasi_nama'])) { ?>
	<div class="alert alert-danger alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Gagal!</strong> Nama Gambar sudah ada silahkan diganti!
	</div>
<?php } ?>

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Ubah Data Hotel</h4>
						</div>
					</div>

					<form class="forms-sample" action="layout.php?content=data_hotel_ubah_proses" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Id Hotel</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpidhotel" value="<?= $data['id_hotel']; ?>" readonly="readonly" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Hotel</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpnamahotel"
									value="<?= $data['nama_hotel']; ?>" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Status Hotel</label>
							<div class="col-sm-9">
								<select name="inpstatus" class="form-control" required="required">
									<option><?= $data['status'] ?></option>
									<option value="Bintang 1">Bintang 1</option>
									<option value="Bintang 2">Bintang 2</option>
									<option value="Bintang 3">Bintang 3</option>
									<option value="Bintang 4">Bintang 4</option>
									<option value="Bintang 5">Bintang 5</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Kontak</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpkontak" value="<?= $data['kontak']; ?>" required="required" />
							</div>
						</div>

						<?php 
						$sql    = "SELECT * FROM tb_fasilitas ORDER BY id_fasilitas";
						$query  = mysqli_query($koneksi, $sql);
						$jumdat = mysqli_num_rows($query);
						
						for ($i = 0; $i < $jumdat; $i++) {
							// untuk menampilkan file json
							$hasil2 = mysqli_fetch_array($query, MYSQLI_ASSOC);
							$tampil = json_decode($hasil2['penilaian'], true); ?>

							<?php if ($hasil1[$i]['fasilitas'.$i] == 'Pelayanan' || $hasil1[$i]['fasilitas'.$i] == 'pelayanan') { ?>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label"><?= $hasil1[$i]['fasilitas'.$i] ?></label>
								<input type="hidden" name="inpidkriteria[]" value="<?= $hasil2['id_fasilitas']; ?>" readonly="readonly" />
								<input type="hidden" name="inpfasilitas[]" value="<?= $hasil2['jenis_fasilitas']; ?>" readonly="readonly" />
								<div class="col-sm-9">
									<select name="inpnilai[]" class="form-control" required="required" id="inpnilai">
										<option><?php echo $hasil1[$i]['nilai'.$i]; ?></option>
										<?php foreach ($tampil as $key => $value) { ?>
											<option value="<?= $value['nilai'] ?>"><?= $value['fasilitas'] ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<?php } else { ?>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label"><?= $hasil1[$i]['fasilitas'.$i] ?></label>
								<input type="hidden" name="inpidkriteria[]" value="<?= $hasil2['id_fasilitas']; ?>" readonly="readonly" />
								<input type="hidden" name="inpfasilitas[]" value="<?= $hasil2['jenis_fasilitas']; ?>" readonly="readonly" />
								<div class="col-sm-2">
									<select name="inpnilai[]" class="form-control" required="required" id="inpnilai">
										<option><?php echo $hasil1[$i]['nilai'.$i]; ?></option>
										<?php foreach ($tampil as $key => $value) { ?>
											<option value="<?= $value['nilai'] ?>"><?= $value['fasilitas'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-2">
									<input type="number" name="inpjumlah[]" class="form-control form-control-sm" id="inpjumlah" value="<?= $hasil1[$i]['jumlah'.$i]; ?>" required="required" />
								</div>
								<div class="col-sm-2">
									<input type="text" name="inphasil[]" class="form-control form-control-sm" id="inphasil" value="<?= $hasil1[$i]['hasil'.$i]; ?>" required="required" readonly />
								</div>
								<?php if ($hasil1[$i]['fasilitas'.$i] != 'Karyawan' || $hasil1[$i]['fasilitas'.$i] != 'karyawan') { ?>
								<div class="col-sm-2">
									<div class="input-group">
										<div class="custom-file">
											<input type="file" name="inpgambar[]" class="custom-file-input" multiple="multiple" accept="image/*" />
											<input type="hidden" name="inpgambar[]" value="<?= $hasil1[$i]['gambar'.$i]; ?>" />
											<label class="custom-file-label">Choose file</label>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<?php } ?>							
						<?php } ?>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Alamat Hotel</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="inpalamat" rows="8" cols="25" required="required"><?= $data['alamat']; ?></textarea>
							</div>
						</div>

						<input type="submit" name="ubah" value="Ubah" class="btn btn-primary" />
						<a href="layout.php?content=data_hotel" class="btn btn-light">Batal</a>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- untuk memanggil bagian foot -->
<?php include_once 'atribut/foot.php' ?>

<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
// untuk mengambil nilai select
$('body').on('change','#inpnilai', function() {
	// mengambil nilai
	var hasil = $(this).val();
	// untuk megisi nilai pada total
	$(this).parent().parent().find("#inphasil").attr('value', hasil);
});

// proses penjumlahan
$('body').on('input', '#inpjumlah', function() {
	var txt1 = $(this).val();
	var txt2 = $(this).parent().parent().find('#inpnilai option:selected').val();
	// mengkalikan txt1 dan txt2
	var jumlah = parseInt(txt1) * parseInt(txt2);
    // mengecek apa bila value dari #inphasil bernilai 0
	if (txt1 == 0 || isNaN(jumlah)) {
		// akan mengambil nilai dari select
		var tes = $(this).parent().parent().find('#inpnilai option:selected').val();
		$(this).parent().parent().find("#inphasil").attr('value', tes);
	} else {
		// mengambil hasil perkalian
		$(this).parent().parent().find("#inphasil").attr('value', jumlah);
	}

});
</script>