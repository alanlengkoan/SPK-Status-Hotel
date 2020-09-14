<?php
if (isset($_POST ['ubah'])) {
	
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
	
	// membuat var array
	$jumlahkriteria = array();
	for ($i = 0; $i < count($kriteria); $i++) {
		$fasarray = array(
			'fasilitas' . $i => $fasilitas[$i],
			'nilai' . $i     => $nilai[$i],
			'hasil' . $i     => empty($hasil[$i]) ? $nilai[$i] : $hasil[$i],
			'jumlah' . $i    => isset($jumlah[$i]) ? $jumlah[$i] : 0,
			'gambar' . $i    => empty($nmagambar2[$i]) ? 'none_picture.png' : $nmagambar2[$i]
		);
		// menggabung data menjadi array
		array_push($jumlahkriteria, $fasarray);
	}

	// mengparsing data menjadi json
	$hasil_akhir = json_encode($jumlahkriteria);
	$sql1 = "UPDATE tb_hotel SET nama_hotel = '$nama_hotel', status = '$status', alamat = '$alamat', kontak = '$kontak', fasilitas = '$hasil_akhir' WHERE id_hotel = '$idhotel'";
	mysqli_query($koneksi, $sql1);

	// untuk menyimpan data kedalam tabel alternatif
	$sql2 = "UPDATE tb_alternatif SET nama_hotel = '$nama_hotel' WHERE id_alternatif = '$idhotel'";
	$ubah = mysqli_query($koneksi, $sql2);

	// untuk menyimpan data kedalam tabel evaluasi
	$jumdat = count($kriteria);
	for ($i=0; $i < $jumdat; $i++) {
		$sql3 = "UPDATE tb_evaluasi SET value = '$hasil[$i]' WHERE id_alternatif = '$idhotel' AND id_kriteria = $kriteria[$i]";
		mysqli_query($koneksi, $sql3);
	}

	if ($ubah) {
		echo "<script>document.location.href='layout.php?content=data_hotel&ubah';</script>";
	} else {
		echo "<script>alert('Gagal Mengubah Data!');document.location.href='layout.php?content=data_hotel&gagal';</script>";
	}

}