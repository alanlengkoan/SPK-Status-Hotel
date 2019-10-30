<!-- untuk memanggil bagian head -->
<?php include_once 'atribut/head.php' ?>

<div class="container-scroller">

	<!-- untuk menu sidebar -->
	<?php include_once 'atribut/navbar.php'; ?>

	<!-- isi content -->
	<div class="container-fluid page-body-wrapper">
		<div class="main-panel">
			<div class="content-wrapper">
				<div class="row">
					<div class="col-sm-12 flex-column d-flex stretch-card">

						<?php if (isset($_GET['masuk'])) { ?>
							<div class="row">
								<div class="col-sm-12 grid-margin d-flex stretch-card">
									<div class="card">
										<div class="card-body">
											<div class="d-flex align-items-center justify-content-between">
												<h4 class="card-title mb-2">Selamat Datang Petugas <i><?= $_SESSION["username"]; ?></i></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>

						<div class="row">
							<div class="col-lg-4 d-flex grid-margin stretch-card">
								<div class="card sale-diffrence-border">
									<div class="card-body text-white">
										<?php
										$sql_h    = mysqli_query($koneksi, "SELECT * FROM tb_hotel");
										$jumdat_h = mysqli_num_rows($sql_h);
										?>
										<h2 class="text-dark mb-2 font-weight-bold"><?= $jumdat_h; ?></h2>
										<h4 class="card-title mb-2">Jumlah Hotel</h4>
									</div>
								</div>
							</div>
							<div class="col-lg-4 d-flex grid-margin stretch-card">
								<div class="card sale-diffrence-border">
									<div class="card-body">
										<?php
										$sql_f    = mysqli_query($koneksi, "SELECT * FROM tb_fasilitas");
										$jumdat_f = mysqli_num_rows($sql_f);
										?>
										<h2 class="text-dark mb-2 font-weight-bold"><?= $jumdat_f; ?></h2>
										<h4 class="card-title mb-2">Jumlah Fasilitas</h4>
									</div>
								</div>
							</div>
							<div class="col-lg-4 d-flex grid-margin stretch-card">
								<div class="card sale-diffrence-border">
									<div class="card-body">
										<?php
										$sql_o    = mysqli_query($koneksi, "SELECT * FROM tb_user_owner");
										$jumdat_o = mysqli_num_rows($sql_o);
										?>
										<h2 class="text-dark mb-2 font-weight-bold"><?= $jumdat_o; ?></h2>
										<h4 class="card-title mb-2">Jumlah User / Owner</h4>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 grid-margin d-flex stretch-card">
								<div class="card">
									<div class="card-body">
										<div class="d-flex align-items-center justify-content-between">
											<h4 class="card-title mb-2">Apa itu Metode <i>Electre</i></h4>
										</div>
										<div>
											<p>Metode <i>Electre</i> merupakan salah satu metode yang efektif untuk <i>MADM</i> dengan
												fitur kualitatif dan kuantitatif, dengan cara konsep perangkingan. Konsep dasar metode
												<i>Electre</i> adalah untuk menangani hubungan outranking dengan menggunakan
												perbandingan berpasangan antara alternatif di bawah masing-masing kriteria secara
												terpisah. Metode <i>Electre</i> digunkan pada kondisi dimana alternatif yang sesuai
												dapat dihasilkan. Jadi, <i>Electre</i> digunkan untuk kasus -kasus dengan banyak
												alternatif namun hanya sedikit kriteria yang dilibatkan.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<!-- isi content -->

			<!-- untuk bagian footer -->
			<?php include_once 'atribut/footer.php'; ?>
		</div>
	</div>
	<!-- isi content -->

</div>

<!-- untuk memanggil bagian foot -->
<?php include_once 'atribut/foot.php' ?>