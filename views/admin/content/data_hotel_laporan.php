<div class="content-wrapper">

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Data Hotel</h4>
						</div>
						<div class="col-lg-6 text-right">
							<a href="laporan/cetak_laporan_hotel.php" target="_blank" class="btn btn-success btn-sm">Cetak</a>
						</div>
					</div>

					<div class="table-responsive">

						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Id Hotel</th>
									<th>Nama</th>
									<th>Status Awal</th>
									<th>Status Baru</th>
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
									<td><?= empty($row['status_baru']) ? 'Belum Ada Pembaruan Status' :  $row['status_baru'] ?></td>
									<td><?php echo $row['kontak']; ?></td>
									<td><?php echo $row['alamat']; ?></td>
									<td align="center">
										<a class="btn btn-success btn-sm" target="_blank" href="laporan/cetak_sertifikat_hotel.php?id_hotel=<?php echo $row['id_hotel']; ?>">Cetak Sertifikat</a>
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