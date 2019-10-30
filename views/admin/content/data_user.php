<div class="content-wrapper">

  <!-- untuk tampilan alerts -->
  <?php
  if (isset($_GET['tambah'])) {
    echo "
    <div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Berhasil!</strong> Data User berhasil ditambahkan.
    </div>
    ";
  } else if (isset($_GET['gagal'])) {
    echo "
    <div class='alert alert-danger alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Gagal!</strong> Data User gagal ditambahkan.
    </div>
    ";
  } else if (isset($_GET['ubah'])) {
    echo "
    <div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Berhasil!</strong> Data User berhasil diubah.
    </div>
    ";
  } else if (isset($_GET['hapus'])) {
    echo "
    <div class='alert alert-success alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    <strong>Berhasil!</strong> Data Fasilitas berhasil dihapus.
    </div>
    ";
  }
  ?>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Data User</h4>
            </div>
            <div class="col-lg-6 text-right">
              <a href="layout.php?content=data_user_tambah" class="btn btn-success btn-sm">Tambah Data User</a>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no    = 1;
                $sql   = "SELECT * FROM tb_user";
                $query = mysqli_query($koneksi, $sql);
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                  echo "<tr>";
                  echo "<td>".$no++."</td>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['username']."</td>";
                  echo "<td>".substr($row['password'], 0, 10)."...</td>";
                  if ($row['level'] == 'admin') {
                    echo "<td>Admin</td>";
                  } else if ($row['level'] == 'lsup') {
                    echo "<td>LSUP</td>";
                  } else if ($row['level'] == 'petugas') {
                    echo "<td>Petugas</td>";
                  }
                  echo "<td align='center'>
                        <a href='layout.php?content=data_user_ubah&id=".$row['id']."' class='btn btn-success btn-sm'>Ubah</a>
                        <a href='layout.php?content=data_user_hapus&id=".$row['id']."' class='btn btn-danger btn-sm'>Hapus</a>
                        </td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Data Owner / Member</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Id Hotel</th>
                  <th>Nama Hotel</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no    = 1;
                $sql   = "SELECT * FROM tb_user_owner";
                $query = mysqli_query($koneksi, $sql);
                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                  echo "<tr>";
                  echo "<td>".$no++."</td>";
                  echo "<td>".$row['id_hotel']."</td>";
                  echo "<td>".$row['nama_hotel']."</td>";
                  echo "<td>".$row['username']."</td>";
                  echo "<td>".substr($row['password'], 0, 10)."...</td>";
                  if ($row['level'] == 'owner') {
                    echo "<td>Owner</td>";
                  } else if ($row['level'] == 'konfirmasi') {
                    echo "<td>Konfirmasi Akun</td>";
                  }
                  echo "<td align='center'>
                        <a href='layout.php?content=data_user_ubah&id_hotel=".$row['id_hotel']."' class='btn btn-success btn-sm'>Ubah</a>
                        </td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>