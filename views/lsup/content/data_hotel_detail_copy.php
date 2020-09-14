<?php
$idhotel = $_GET['id_hotel'];
$sql     = "SELECT * FROM tb_hotel WHERE id_hotel = '$idhotel'";
$query   = mysqli_query($koneksi, $sql);
$data    = mysqli_fetch_array($query, MYSQLI_ASSOC);
?>

<div class="content-wrapper">

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
								<?= $data['id_hotel']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Nama Hotel</label>
							<div class="col-sm-9">
								<?= $data['nama_hotel']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Status Hotel</label>
							<div class="col-sm-9">
								<?= $data['status']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Kontak</label>
							<div class="col-sm-9">
								<?= $data['kontak']; ?>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3 col-form-label">Alamat</label>
							<div class="col-sm-9">
								<?= $data['alamat']; ?>
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
								$tampil = json_decode($data['fasilitas'], true);
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
								<?php }?>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<a href="layout.php?content=data_hotel" class="btn btn-primary btn-block">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>