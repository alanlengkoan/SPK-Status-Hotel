<div class="content-wrapper">

    <!-- untuk tampilan alerts -->
    <?php
    if (isset($_GET['ubah'])) {
        echo "
        <div class='alert alert-success alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Berhasil!</strong> Data Kriteria berhasil diubah.
        </div>
        ";
    } else if (isset($_GET['gagal'])) {
        echo "
        <div class='alert alert-danger alert-dismissible'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Gagal!</strong> Data Kriteria gagak diubah.
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
                            <h4 class="card-title">Data Kriteria</h4>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id Kriteria</th>
                                    <th>Kriteria</th>
                                    <th>Weight</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql   = "SELECT * FROM tb_kriteria ORDER BY id_kriteria";
                                $query = mysqli_query($koneksi, $sql);
                                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>".$row['id_kriteria']."</td>";
                                    echo "<td>".$row['kriteria']."</td>";
                                    echo "<td>".$row['weight']."</td>";
                                    echo "<td align='center'> <a href='layout.php?content=data_kriteria_ubah&id_kriteria=".$row['id_kriteria']."' class='btn btn-success btn-sm'>Ubah</a> </td>";
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