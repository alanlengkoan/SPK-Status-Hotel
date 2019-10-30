<div class="content-wrapper">

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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql   = "SELECT * FROM tb_kriteria ORDER BY id_kriteria";
                                $query = mysqli_query($koneksi, $sql);
                                while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { ?>
                                    <tr>
                                        <td><?=$row['id_kriteria']?></td>
                                        <td><?=$row['kriteria']?></td>
                                        <td><?=$row['weight']?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>