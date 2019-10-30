<div class="content-wrapper">

	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-lg-6">
							<h4 class="card-title">Data Fasilitas</h4>
						</div>
						<div class="col-lg-6 text-right">

						</div>
					</div>

					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Id Fasilitas</th>
									<th>Jenis Fasilitas</th>
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