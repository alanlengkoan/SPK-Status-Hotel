<div class="content-wrapper">

    <div class="row">
        <?php 
        $sql   = "SELECT * FROM tb_fasilitas ORDER BY id_fasilitas";
        $query = mysqli_query($koneksi, $sql);

        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $judul  = $row['jenis_fasilitas'];
            $tampil = json_decode($row['penilaian'], true);
        ?>

        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"><?= $judul; ?></h4>
                    <p class="card-description">
                        Penilaian untuk <b><?= $judul; ?></b>.
                    </p>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fasilitas</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                for ($i = 0; $i < count($tampil); $i++) { 
                                    echo "<tr>";
                                    echo "<td>".$tampil[$i]['fasilitas']."</td>";
                                    echo "<td>".$tampil[$i]['nilai']."</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>


</div>