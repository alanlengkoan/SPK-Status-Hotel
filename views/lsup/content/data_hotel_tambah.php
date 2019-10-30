<?php
$sql          = "SELECT id_hotel FROM tb_hotel";
$query        = mysqli_query($koneksi, $sql);
$data         = mysqli_fetch_array($query, MYSQLI_ASSOC);
$jumlah       = mysqli_num_rows($query);

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
							<h4 class="card-title">Tambah Data Hotel</h4>
						</div>
					</div>

					<form class="forms-sample" action="layout.php?content=data_hotel_tambah_proses" method="post" enctype="multipart/form-data">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Id Hotel</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpidhotel" value="<?= $kodeotomatis; ?>" readonly="readonly" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Hotel</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="inpnamahotel" placeholder="Nama Hotel" required="required" />
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Status Hotel</label>
							<div class="col-sm-9">
								<select name="inpstatus" class="form-control" required="required">
									<option>- Pilih Status -</option>
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
								<input type="text" class="form-control" name="inpkontak" placeholder="Kontak" required="required" />
							</div>
						</div>

						<?php 
						$sql    = "SELECT * FROM tb_fasilitas ORDER BY id_fasilitas";
						$query  = mysqli_query($koneksi, $sql);

						while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
							// untuk menampilkan file json
							$tampil = json_decode($row['penilaian'], true); ?>

							<?php if ($row['jenis_fasilitas'] == 'Pelayanan' || $row['jenis_fasilitas'] == 'pelayanan') { ?>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label"><?= $row['jenis_fasilitas'] ?></label>
								<input type="hidden" name="inpidkriteria[]" value="<?= $row['id_fasilitas'] ?>" readonly="readonly" />
								<input type="hidden" name="inpfasilitas[]" value="<?= $row['jenis_fasilitas'] ?>" readonly="readonly" />
								<div class="col-sm-9">
									<?php if ($row['jenis'] == "fasilitas") { ?>
									<select name="inpnilai[]" class="form-control" required="required" id="inpnilai">
										<option>- Pilih <?php echo $row['jenis_fasilitas']; ?> -</option>
										<?php foreach ($tampil as $key => $value) { ?>
											<option value="<?=$value['nilai']?>"><?=$value['fasilitas']?></option>    
										<?php } ?>
									</select>
								</div>
							</div>
							<?php } ?>
							<?php } else { ?>
							<div class="form-group row">
								<label class="col-sm-3 col-form-label"><?= $row['jenis_fasilitas'] ?></label>
								<input type="hidden" name="inpidkriteria[]" value="<?= $row['id_fasilitas'] ?>" readonly="readonly" />
								<input type="hidden" name="inpfasilitas[]" value="<?= $row['jenis_fasilitas'] ?>" readonly="readonly" />
								<div class="col-sm-2">
									<?php if ($row['jenis'] == "fasilitas") { ?>
									<select name="inpnilai[]" class="form-control" required="required" id="inpnilai">
										<option>- Pilih <?php echo $row['jenis_fasilitas']; ?> -</option>
										<?php foreach ($tampil as $key => $value) { ?>
											<option value="<?=$value['nilai']?>"><?=$value['fasilitas']?></option>    
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-2">
									<input type="number" name="inpjumlah[]" class="form-control form-control-sm" id="inpjumlah" placeholder="Masukkan Jumlah" required="required" />
								</div>
								<div class="col-sm-2">
									<input type="text" name="inphasil[]" class="form-control form-control-sm" id="inphasil" value="0" required="required" readonly />
								</div>
								<?php if ($row['jenis_fasilitas'] != 'Karyawan') { ?>
								<div class="col-sm-2">
									<div class="input-group">
										<div class="custom-file">
											<input type="file" name="inpgambar[]" class="custom-file-input" multiple="multiple" accept="image/*" required="required" />
											<label class="custom-file-label">Choose file</label>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							<?php } ?>
						<?php   
							}
						}
						?>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Alamat Hotel</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="inpalamat" rows="8" cols="25" placeholder="Alamat Hotel" required="required"></textarea>
							</div>
						</div>

						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary" />
						<a href="layout.php?content=data_hotel" class="btn btn-light">Batal</a>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

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