<div class="content-wrapper">

	<!-- untuk tampilan alerts -->
	<?php
	if (isset($_GET['tambah'])) {
		echo "
		<div class='alert alert-success alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Berhasil!</strong> Data Hotel berhasil ditambahkan.
		</div>
		";
	} else if (isset($_GET['gagal'])) {
		echo "
		<div class='alert alert-danger alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Gagal!</strong> Data Hotel gagal ditambahkan.
		</div>
		";
	} else if (isset($_GET['ubah'])) {
		echo "
		<div class='alert alert-success alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Berhasil!</strong> Data Hotel berhasil diubah.
		</div>
		";
	} else if (isset($_GET['hapus'])) {
		echo "
		<div class='alert alert-success alert-dismissible'>
		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
		<strong>Berhasil!</strong> Data Hotel berhasil dihapus.
		</div>
		";
	}
	?>

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Data Hotel</h4>
						</div>
					</div>

					<div class="table-responsive">

						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Id Hotel</th>
									<th>Nama</th>
									<th>Status</th>
									<th>No. Hp</th>
									<th>Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no    = 1;
								$sql   = "SELECT * FROM  tb_hotel";
								$query = mysqli_query($koneksi, $sql);
								while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
								?>
								<tr>
									<td><?php echo $no++; ?></td>
									<td><?php echo $row['id_hotel']; ?></td>
									<td><?php echo $row['nama_hotel']; ?></td>
									<td><?php echo $row['status']; ?></td>
									<td><?php echo $row['kontak']; ?></td>
									<td><?php echo $row['alamat']; ?></td>
									<td align="center">
										<a class="btn btn-success btn-sm" href="layout.php?content=data_hotel_detail&id_hotel=<?php echo $row['id_hotel']; ?>">Detail</a>
										<a class="btn btn-primary btn-sm" href="layout.php?content=data_hotel_ubah&id_hotel=<?php echo $row['id_hotel']; ?>">Ubah</a>
										<a class="btn btn-info btn-sm" href="laporan/data_hotel_cetak.php?id_hotel=<?php echo $row['id_hotel']; ?>"
											target="_blank">Cetak</a>
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