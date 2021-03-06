<div class="content-wrapper">

	<!-- untuk tampilan alerts -->
	<?php if (isset($_GET['tambah'])) { ?>
	<div class='alert alert-success alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Berhasil!</strong> Data Fasilitas berhasil ditambahkan.
	</div>
	<?php } else if (isset($_GET['gagal'])) { ?>
	<div class='alert alert-danger alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Gagal!</strong> Data Fasilitas gagal ditambahkan.
	</div>
	<?php } else if (isset($_GET['ubah'])) { ?>
	<div class='alert alert-success alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Berhasil!</strong> Data Fasilitas berhasil diubah.
	</div>
	<?php } else if (isset($_GET['hapus'])) { ?>
	<div class='alert alert-success alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Berhasil!</strong> Data Fasilitas berhasil dihapus.
	</div>
	<?php } ?>

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Data Fasilitas</h4>
						</div>
						<div class="col-lg-6 text-right">
							<a href="layout.php?content=data_fasilitas_tambah" class="btn btn-success btn-sm">Tambah Data Fasilitas</a>
						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Id Fasilitas</th>
									<th>Jenis Fasilitas</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no    = 1;
								$sql   = "SELECT * FROM tb_fasilitas";
								$query = mysqli_query($koneksi, $sql);
								while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo "ID_FASILITAS-".$row['id_fasilitas']; ?></td>
									<td><?php echo $row['jenis_fasilitas']; ?></td>
									<td align="center">
										<a class="btn btn-primary btn-sm" href="layout.php?content=data_fasilitas_ubah&id_fasilitas=<?php echo $row['id_fasilitas']; ?>">Ubah</a>
										<a class="btn btn-danger btn-sm" href="layout.php?content=data_fasilitas_hapus&id_fasilitas=<?php echo $row['id_fasilitas']; ?>" onclick="return confirm('Anda yakin ingin menghapus ini?')">Hapus</a>
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
</div>