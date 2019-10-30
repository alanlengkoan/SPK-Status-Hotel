<?php include_once 'database/koneksi.php'; ?>
<?php
$sql          = "SELECT id_hotel FROM tb_user_owner";
$query        = mysqli_query($koneksi, $sql);
$data         = mysqli_fetch_array($query, MYSQLI_ASSOC);
$jumlah       = mysqli_num_rows($query);

if ($jumlah != 0) {
    $nilkod  = substr($jumlah[0], 1);
    $kode    = (int) $nilkod;
    $kode    = $jumlah + 1;
    $kodeotomatis = str_pad($kode, 1, "0", STR_PAD_LEFT);
} else {
    $kodeotomatis = "1";
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Pendukung Keputusan Status Hotel</title>

  <link rel="stylesheet" href="assets/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/base/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <h3 style="color: #0ddbb9; text-transform: uppercase; font-weight: bold;">Sistem Pendukung Keputusan Status Hotel</h3>
                </div>
                
                <form class="pt-3" method="post">
                  <div class="form-group">
                    <input type="hidden" class="form-control form-control-lg" name="inpidhotel" value="<?= $kodeotomatis; ?>">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="inpnamahotel" placeholder="Nama Hotel">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="inpusername" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="inppassname" id="inppassname" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg form-password" name="inppassword" id="inppassword" placeholder="Ulangi Password" oninput="cekPass()" />
                    <label class="pesan"></label>
                  </div>
                  <div class="form-check form-check-flat form-check-primary">
										<label class="form-check-label">
                      <input type="checkbox" class="form-check-input form-checkbox" /> Lihat Password!
										</label>
									</div>

                  <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="daftar" id="daftar" value="Daftar" />
                    <a href="index.php" class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn">Batal</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
  									Sudah punya akun? <a href="login.php" class="text-primary">Masuk</a>
  								</div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="assets/base/vendor.bundle.base.js"></script>
  <script src="assets/js/template.js"></script>

  <script type="text/javascript">
    document.getElementById("daftar").disabled = true;

    function cekPass() {
      var passnm = $('#inppassname').val();
      var passwd = $('#inppassword').val();

      if (passnm != passwd) {
        document.getElementById("daftar").disabled = true;
        $('.pesan').html('Password tidak sesuai!');
        return false;
      } else {
        document.getElementById("daftar").disabled = false;
        $('.pesan').html('Password sesuai!');
        return true;
      }
    }

    $('.form-checkbox').click(function () {
      if ($(this).is(':checked')) {
        $('.form-password').attr('type', 'text');
      } else {
        $('.form-password').attr('type', 'password');
      }
    });
  </script>

</body>

</html>

<?php
include_once 'database/koneksi.php';
if (isset($_POST['daftar'])) {
  $idhtel = $_POST['inpidhotel'];
  $namaht = $_POST['inpnamahotel'];
  $usernm = $_POST['inpusername'];
  $passnm = $_POST['inppassname'];
  $passwd = $_POST['inppassword'];
  $level  = 'konfirmasi';

  if ($passnm != $passwd) {
    echo "Password tidak sama!";
  } else {
    $passhash = password_hash($passwd, PASSWORD_DEFAULT);
    $sql      = "INSERT INTO tb_user_owner (id_hotel, nama_hotel, username, passname, password, level) VALUES ('$idhtel', '$namaht', '$usernm', '$passnm', '$passhash', '$level')";
    $query    = mysqli_query($koneksi, $sql);

    if ($query) {
      echo "Berhasil";
    } else {
      echo "Gagal";
    }
  }
}
 ?>