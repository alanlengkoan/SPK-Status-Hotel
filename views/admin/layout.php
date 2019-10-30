<!-- untuk memanggil bagian head -->
<?php include_once 'atribut/head.php' ?>

<div class="container-scroller">

	<!-- untuk menu sidebar -->
	<?php include_once 'atribut/navbar.php'; ?>

	<!-- isi content -->
	<div class="container-fluid page-body-wrapper">
		<div class="main-panel">

			<!-- untuk isi content -->
			<?php
			$content = $_GET['content'];
			switch ($content) {
				case 'data_hotel':
					include_once 'content/data_hotel.php';
					break;

				case 'data_fasilitas':
					include_once 'content/data_fasilitas.php';
					break;

				case 'data_user':
					include_once 'content/data_user.php';
					break;

				case 'data_penilaian':
					include_once 'content/data_penilaian.php';
					break;

				case 'data_kriteria':
					include_once 'content/data_kriteria.php';
					break;

				case 'data_alternatif':
					include_once 'content/data_alternatif.php';
					break;

				case 'data_evaluasi':
					include_once 'content/data_evaluasi.php';
					break;

				case 'hasil_metode':
					include_once 'content/hasil_metode.php';
					break;

				case 'data_hotel_tambah':
					include_once 'content/data_hotel_tambah.php';
					break;

				case 'data_hotel_ubah':
					include_once 'content/data_hotel_ubah.php';
					break;

				case 'data_hotel_detail':
					include_once 'content/data_hotel_detail.php';
					break;
				
				case 'data_hotel_hapus':
					include_once 'content/data_hotel_hapus.php';
					break;

				case 'data_fasilitas_tambah':
					include_once 'content/data_fasilitas_tambah.php';
					break;

				case 'data_hotel_tambah_proses':
					include_once 'content/data_hotel_tambah_proses.php';
					break;

				case 'data_hotel_ubah_proses':
					include_once 'content/data_hotel_ubah_proses.php';
					break;

				case 'data_fasilitas_ubah':
					include_once 'content/data_fasilitas_ubah.php';
					break;

				case 'data_fasilitas_hapus':
					include_once 'content/data_fasilitas_hapus.php';
					break;

				case 'data_fasilitas_hapus':
					include_once 'content/data_fasilitas_hapus.php';
					break;

				case 'data_user_tambah':
					include_once 'content/data_user_tambah.php';
					break;

				case 'data_user_ubah':
					include_once 'content/data_user_ubah.php';
					break;

				case 'data_user_hapus':
					include_once 'content/data_user_hapus.php';
					break;

				case 'data_hotel_laporan':
					include_once 'content/data_hotel_laporan.php';
					break;
				
				case 'data_certifikat':
					include_once 'content/data_certifikat.php';
					break;

				case 'data_kriteria_ubah':
					include_once 'content/data_kriteria_ubah.php';
					break;
			}
			?>
			<!-- untuk isi content -->

			<!-- untuk bagian footer -->
			<?php include_once 'atribut/footer.php'; ?>
		</div>
	</div>
	<!-- isi content -->

</div>

<!-- untuk memanggil bagian foot -->
<?php include_once 'atribut/foot.php' ?>