<?php include_once 'atribut/head.php' ?>
<?php
// manampilkan nama hotel
$sql2    = "SELECT * FROM tb_user_owner WHERE username = '$_SESSION[username]'";
$result2 = mysqli_query($koneksi, $sql2);
$data2   = mysqli_fetch_array($result2, MYSQLI_ASSOC);

// untuk mengecek data hotel apa bila sudah ada
$sql3    = "SELECT * FROM tb_hotel WHERE nama_hotel = '$data2[nama_hotel]'";
$result3 = mysqli_query($koneksi, $sql3);
$data3   = mysqli_num_rows($result3);
$row     = mysqli_fetch_array($result3, MYSQLI_ASSOC);
?>

<div class="container-scroller">

	<!-- untuk menu sidebar -->
	<?php include_once 'atribut/menu.php'; ?>

	<!-- isi content -->
	<div class="container-fluid page-body-wrapper">
		<div class="main-panel">

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
			<?php } else if (isset($_GET['tambah'])) { ?>
				<div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Berhasil!</strong> Data Hotel berhasil disimpan!
				</div>
			<?php } else if (isset($_GET['gagal'])) { ?>
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<strong>Gagal!</strong> Data Hotel gagal disimpan!
				</div>
			<?php } ?>

				<?php if ($data3 > 0) { ?>
					<div class="row">
						<div class="col-lg-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">

									<div class="row">
										<div class="col-lg-6">
											<h4 class="card-title">Data Detail Hotel</h4>
										</div>
									</div>

									<form class="forms-sample">
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Id Hotel</label>
											<div class="col-sm-9">
												<?= $row['id_hotel']; ?>											
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Nama Hotel</label>
											<div class="col-sm-9">
												<?= $row['nama_hotel']; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Status Hotel</label>
											<div class="col-sm-9">
												<?= $row['status']; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Kontak</label>
											<div class="col-sm-9">
												<?= $row['kontak']; ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 col-form-label">Alamat</label>
											<div class="col-sm-9">
												<?= $row['alamat']; ?>
											</div>
										</div>
									</form>

								</div>
							</div>
						</div>
						<div class="col-lg-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">

									<div class="row">
										<div class="col-lg-6">
											<h4 class="card-title">Fasilitas Hotel</h4>
										</div>
									</div>

									<div class="table-responsive">
										<table class="table table-bordered table-striped">
											<thead>
												<tr>
													<th>No</th>
													<th>Fasilitas</th>
													<th>Jumlah / Banyak</th>
													<th>Gambar</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$no = 1;
												$tampil = json_decode($row['fasilitas'], true);
												for ($i = 0; $i < count($tampil); $i++) { ?>
													<tr>
														<td><?=$no++?></td>
														<td><?=$tampil[$i]['fasilitas'.$i]?></td>
														<td><?= empty($tampil[$i]['jumlah'.$i]) ? $tampil[$i]['hasil'.$i] : $tampil[$i]['jumlah'.$i] ?></td>
														<td align='center'>
															<?php if ($tampil[$i]['gambar'.$i] == 'none_picture.png') { ?>
																<img style='width: 550px; width: 550px;' src='../../assets/images/none_picture.png' />
															<?php } else { ?>
																<img style='width: 550px; width: 550px;' src='../../fotofasilitas/<?=$tampil[$i]['gambar'.$i]?>' />
															<?php } ?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>

								</div>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="row">
					<div class="col-lg-12 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">

								<div class="row">
									<div class="col-lg-6">
										<h4 class="card-title">Tambah Data Hotel</h4>
										<p class="card-description">
											Silahkan isi data hotel dengan baik dan benar!
										</p>
									</div>
								</div>

								<form class="forms-sample" method="post" action="data_hotel_proses.php" enctype="multipart/form-data">
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Id Hotel</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="inpidhotel" value="<?= $data2['id_hotel']; ?>" readonly="readonly" required="required" />
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-3 col-form-label">Nama Hotel</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="inpnamahotel" value="<?= $data2['nama_hotel'] ?>" required="required" />
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
									<a href="data_hotel.php" class="btn btn-light">Batal</a>
								</form>

							</div>
						</div>
					</div>
				</div>
				<?php } ?>

			</div>

			<!-- untuk footer -->
			<footer class="footer">
				<div class="footer-wrap">
					<div class="w-100 clearfix">
						<span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a
								href="https://www.templatewatch.com/" target="_blank">templatewatch</a>. All rights
							reserved.</span>
						<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
							with <i class="mdi mdi-heart-outline"></i></span>
					</div>
				</div>
			</footer>
			<!-- untuk footer -->

		</div>
	</div>
	<!-- isi content -->

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
	if (isNaN(jumlah)) {
		// akan mengambil nilai dari select
		var nilai = $(this).parent().parent().find('#inpnilai option:selected').val();
		$(this).parent().parent().find("#inphasil").attr('value', nilai);
	} else {
		// mengambil hasil perkalian
		$(this).parent().parent().find("#inphasil").attr('value', jumlah);
	}

});
</script>