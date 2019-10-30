<div class="content-wrapper">

    <!-- untuk tampilan alerts -->
    <?php
    if (isset($_GET['tambah'])) {
        echo "
        <div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Berhasil!</strong> Data Analisa Kriteria berhasil ditambahkan.
        </div>
        ";
    } else if (isset($_GET['gagal'])) {
        echo "
        <div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Berhasil!</strong> Data Analisa Kriteria berhasil ditambahkan.
        </div>
        ";
    } else if (isset($_GET['ubah'])) {
        echo "
        <div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Berhasil!</strong> Data Analisa Kriteria berhasil ditambahkan.
        </div>
        ";
    } else if (isset($_GET['hapus'])) {
        echo "
        <div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Berhasil!</strong> Data Analisa Kriteria berhasil ditambahkan.
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
                            <h4 class="card-title">Data Alternatif</h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id Alternatif</th>
                                    <th>Nama Hotel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql   = "SELECT * FROM tb_alternatif ORDER BY id_alternatif";
                                $query = mysqli_query($koneksi, $sql);
                                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>".$row['id_alternatif']."</td>";
                                    echo "<td>".$row['nama_hotel']."</td>";
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