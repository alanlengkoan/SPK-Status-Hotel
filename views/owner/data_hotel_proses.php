<?php
// untuk koneksi
include_once '../../database/koneksi.php';

if (isset($_POST ['simpan'])) {

	$idhotel     = $_POST['inpidhotel'];
	$nama_hotel  = $_POST['inpnamahotel'];
	$status      = $_POST['inpstatus'];
	$status_baru = 'Belum Ada !';
	$kontak      = $_POST['inpkontak'];
	$alamat      = $_POST['inpalamat'];
	$fasilitas   = $_POST['inpfasilitas'];
	$jumlah      = $_POST['inpjumlah'];

	// untuk mengambil data kriteria
	$kriteria = $_POST['inpidkriteria'];
	$nilai    = $_POST['inpnilai'];
	$hasil    = $_POST['inphasil'];
	$hasil[] = $_POST['inpnilai'][count($hasil)];

	// untuk nama gambar
	$nmagambar = $_FILES['inpgambar']['name'];
	// untuk format foto
	$frmgambar = array('jpeg', 'jpg', 'png');
	// untuk ukuran foto
	$ukrgambar = 10 * 1024 * 1024;
	// untuk mengecek gambar ada berapa
	for ($i = 0; $i < count($nmagambar); $i++) {
		// mengambil data file berdasarkan jumlah
		$nmagmbr = basename($_FILES['inpgambar']['name'][$i]);
		$tmpgmbr = $_FILES['inpgambar']['tmp_name'][$i];
		$szegmbr = $_FILES['inpgambar']['size'][$i];
		$errgmbr = $_FILES['inpgambar']['error'][$i];

		if ($errgmbr == 0) {
			if ($szegmbr > $ukrgambar) {
				header('location: data_hotel.php?validasi_ukuran');
				exit();
			} else if (!in_array(pathinfo($nmagmbr, PATHINFO_EXTENSION), $frmgambar)) {
				header('location: data_hotel.php?validasi_ektensi');
				exit();
			} else if (file_exists("../../fotofasilitas/".$nmagmbr)) {
				header('location: data_hotel.php?validasi_nama');
				exit();
			} else {
				// upload gambar atau menyimpan gambar
				move_uploaded_file($tmpgmbr, "../../fotofasilitas/".$nmagmbr);
			}
		}
	}
	
	// membuat var array
	$jumlahkriteria = array();
	// untuk menghitung jumlah data
	for ($i = 0; $i < count($kriteria); $i++) { 
		$fasarray = array(
			'fasilitas'.$i => $fasilitas[$i],
			'nilai'.$i     => $nilai[$i],
			'hasil'.$i     => empty($hasil[$i]) ? $nilai[$i] : $hasil[$i],
			'jumlah'.$i    => isset($jumlah[$i]) ? $jumlah[$i] : 0,
			'gambar'.$i    => isset($nmagambar[$i]) ? $nmagambar[$i] : 'none_picture.png'
		);
		// menggabung data menjadi array
		array_push($jumlahkriteria, $fasarray);
	}

	// mengparsing data menjadi json
	$hasil_akhir = json_encode($jumlahkriteria);
	// untuk menyimpan data kedalam tabel hotel
	$sql1 = "INSERT INTO tb_hotel (id_hotel, nama_hotel, status, status_baru, alamat, kontak, fasilitas) VALUES ('$idhotel', '$nama_hotel', '$status', '$status_baru', '$alamat', '$kontak', '$hasil_akhir')";
	mysqli_query($koneksi, $sql1);

	// untuk menyimpan data kedalam tabel alternatif
	$sql2 = "INSERT INTO tb_alternatif (id_alternatif, nama_hotel) VALUES ('$idhotel', '$nama_hotel')";
	$tambah2 = mysqli_query($koneksi, $sql2);

	// untuk menyimpan data kedalam tabel evaluasi
	for ($i=0; $i < count($kriteria); $i++) {
		$sql3 = "INSERT INTO tb_evaluasi (id_alternatif, id_kriteria, value) VALUES ('$idhotel', '$kriteria[$i]', '$hasil[$i]')";
		mysqli_query($koneksi, $sql3);
	}

	if ($tambah2) {
		echo "<script>document.location.href='data_hotel.php?tambah';</script>";
	} else {
		echo "<script>document.location.href='data_hotel.php?gagal';</script>";
	}

}