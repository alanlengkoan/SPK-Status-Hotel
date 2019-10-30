<div class="content-wrapper">

        <div class="row">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

                <?php if (isset($_GET['id'])) { ?>
                
                <?php
                $id     = $_GET['id'];
                $sql    = "SELECT * FROM tb_user WHERE id = '$id'";
                $result = mysqli_query($koneksi, $sql);
                $data   = mysqli_fetch_array($result, MYSQLI_ASSOC);
                ?>

                <div class="row">
                  <div class="col-lg-6">
                    <h4 class="card-title">Ubah Data User</h4>
                  </div>
                </div>

                <form class="forms-sample" method="post">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Username</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="inpusername" value="<?= $data['username']; ?>" required="required" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="inppassname" id="inppassname" value="<?= $data['passname'] ?>" required="required" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ulangi Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control form-password" name="inppassword" id="inppassword" value="<?php echo $data['passname']; ?>" oninput="cekPass()" />
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
                        <?php
                        if ($data['level'] == 'admin') {
                          echo "<option value='".$data['level']."'>Admin</option>";
                        } else if ($data['level'] == 'lsup') {
                          echo "<option value='".$data['level']."'>LSUP</option>";
                        } else if ($data['level'] == 'petugas') {
                          echo "<option value='".$data['level']."'>Petugas</option>";
                        }
                        ?>
                        <option value="admin">Admin</option>
                        <option value="lsup">LSUP</option>
                        <option value="petugas">Petugas</option>
                      </select>
                    </div>
                  </div>

                  <input type="submit" name="ubah_user" value="Ubah" id="ubah" class="btn btn-primary" />
                  <a href="layout.php?content=data_user" class="btn btn-light">Batal</a>
                </form>
                <?php } else if (isset($_GET['id_hotel'])) { ?>
                  <?php
                  $idhotel = $_GET['id_hotel'];
                  $sql     = "SELECT * FROM tb_user_owner WHERE id_hotel = '$idhotel'";
                  $result  = mysqli_query($koneksi, $sql);
                  $data    = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  ?>
                  <div class="row">
                    <div class="col-lg-6">
                      <h4 class="card-title">Ubah Data User / Owner</h4>
                    </div>
                  </div>

                  <form class="forms-sample" method="post">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" name="inpusername" value="<?= $data['username']; ?>" required="required" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" name="inppassname" id="inppassname" value="<?= $data['passname'] ?>" required="required" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Ulangi Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control form-password" name="inppassword" id="inppassword" value="<?php echo $data['passname']; ?>" oninput="cekPass()" />
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
                          <?php
                          if ($data['level'] == 'owner') {
                            echo "<option value='".$data['level']."'>Owner</option>";
                          } else if ($data['level'] == 'konfirmasi') {
                            echo "<option value='".$data['level']."'>Konfirmasi Akun</option>";
                          }
                          ?>
                          <option value="owner">Owner</option>
                        </select>
                      </div>
                    </div>

                    <input type="submit" name="ubah_user_owner" value="Ubah" id="ubah" class="btn btn-primary" />
                    <a href="layout.php?content=data_user" class="btn btn-light">Batal</a>
                  </form>
                <?php } ?>

              </div>
            </div>
          </div>
        </div>
      </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  document.getElementById("ubah").disabled = false;
  function cekPass() {
    var passnm = $('#inppassname').val();
    var passwd = $('#inppassword').val();

    if (passnm != passwd) {
      document.getElementById("ubah").disabled = false;
      $('.pesan').html('Password tidak sesuai!');
      return true;
    } else {
      document.getElementById("ubah").disabled = false;
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
if (isset($_POST['ubah_user'])) {
  $usernm = $_POST['inpusername'];
  $passnm = $_POST['inppassname'];
  $passwd = $_POST['inppassword'];
  $level  = $_POST['inplevel'];

  $passhash = password_hash($passwd, PASSWORD_DEFAULT);
  $sql      = "UPDATE tb_user SET username = '$usernm', passname = '$passnm', password = '$passhash', level = '$level' WHERE id = '$id'";
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
			document.location.href='layout.php?content=data_user&tambah';
		</script>
		";
  }
} else if (isset($_POST['ubah_user_owner'])) {
  $usernm = $_POST['inpusername'];
  $passnm = $_POST['inppassname'];
  $passwd = $_POST['inppassword'];
  $level  = $_POST['inplevel'];

  $passhash = password_hash($passwd, PASSWORD_DEFAULT);
  $sql      = "UPDATE tb_user_owner SET username = '$usernm', passname = '$passnm', password = '$passhash', level = '$level' WHERE id_hotel = '$idhotel'";
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
			document.location.href='layout.php?content=data_user&tambah';
		</script>
		";
  }
}
?>
