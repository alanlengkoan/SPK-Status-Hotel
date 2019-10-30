<div class="content-wrapper">

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Tambah Data User</h4>
            </div>
          </div>

          <form class="forms-sample" method="post">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="inpusername" placeholder="Username" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control" name="inppassname" id="inppassname" placeholder="Password" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Ulangi Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control form-password" name="inppassword" id="inppassword" placeholder="Ulangi Password" oninput="cekPass()" />
                <label class="pesan"></label>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input form-checkbox" /> Lihat Password!
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Level</label>
              <div class="col-sm-9">
                <select name="inplevel" class="form-control">
                  <option>- Pilih Level -</option>
                  <option value="admin">Admin</option>
                  <option value="lsup">LSUP</option>
                  <option value="petugas">Petugas</option>
                </select>
              </div>
            </div>

            <input type="submit" name="simpan" value="Simpan" id="simpan" class="btn btn-primary" />
            <a href="layout.php?content=data_user" class="btn btn-light">Batal</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
  document.getElementById("simpan").disabled = false;
  function cekPass() {
    var passnm = $('#inppassname').val();
    var passwd = $('#inppassword').val();

    if (passnm != passwd) {
      document.getElementById("simpan").disabled = false;
      $('.pesan').html('Password tidak sesuai!');
      return true;
    } else {
      document.getElementById("simpan").disabled = false;
      $('.pesan').html('Password sesuai!');
      return true;
    }
  }

  $('.form-checkbox').click(function(){
    if ($(this).is(':checked')) {
      $('.form-password').attr('type', 'text');
    } else {
      $('.form-password').attr('type', 'password');
    }
  });
</script>

<?php
if (isset($_POST['simpan'])) {
  $usernm = $_POST['inpusername'];
  $passnm = $_POST['inppassname'];
  $passwd = $_POST['inppassword'];
  $level  = $_POST['inplevel'];

  $passhash = password_hash($passwd, PASSWORD_DEFAULT);
  $sql      = "INSERT INTO tb_user (username, passname, password, level) VALUES ('$usernm', '$passnm', '$passhash', '$level')";
  $result   = mysqli_query($koneksi, $sql);

  if ($result) {
    echo "
		<script>
			document.location.href='layout.php?content=data_user&tambah';
		</script>
		";
  } else {
    echo "
		<script>
			document.location.href='layout.php?content=data_user&gagal';
		</script>
		";
  }
}
?>
