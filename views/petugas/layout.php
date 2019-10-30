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

				case 'data_hotel_ubah':
					include_once 'content/data_hotel_ubah.php';
					break;
				
				case 'data_hotel_ubah_proses':
					include_once 'content/data_hotel_ubah_proses.php';
					break;

				case 'data_hotel_detail':
					include_once 'content/data_hotel_detail.php';
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