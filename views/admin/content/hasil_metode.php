<?php
error_reporting(0);

$sql1    = "SELECT * FROM tb_hotel";
$result1 = $koneksi->query($sql1);

$sql2    = "SELECT * FROM tb_alternatif";
$result2 = $koneksi->query($sql2);

$hotel = array();
while($row = $result2->fetch_row()){
  $hotel[$row[0]] = $row[1]; 
}

$penilaian = array();
while ($row2 = $result1->fetch_array(MYSQLI_ASSOC)) {
  // mengambil hasil dari tabel hotel
  $tampil = json_decode($row2['fasilitas'], true);
  // mengambil penilaian
  for ($i = 0; $i < count($tampil); $i++) { 
    $penilaian[$row2['id_hotel']][] = $tampil[$i]['hasil'.$i];
  }
  
}

$sql3    = "SELECT id_kriteria, kriteria FROM tb_kriteria";
$result3 = $koneksi->query($sql3);

?>

<div class="content-wrapper">

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Membentuk Perbandingan Berpasangan (X)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <?php 
                  foreach ($result3 as $key) {
                    echo "<th>".$key['kriteria']."</th>";
                  }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                //-- query untuk mengambil data jumlah kriteria 'n'
                $sql    = "SELECT COUNT(*) FROM tb_kriteria";
                $result = $koneksi->query($sql);
                $row    = $result->fetch_row();
                //--- inisialisasi jumlah kriteria 'n'
                $n = $row[0];
                //-- query untuk mengambil data Perbandingan Berpasangan X
                $sql    = "SELECT * FROM tb_evaluasi ORDER BY id_alternatif, id_kriteria";
                $result = $koneksi->query($sql);
                
                $X = array();
                $alternative='';
                //--- inisialisasi jumlah alternative 'm'
                $m=0;
                while($row = $result->fetch_row()){
                  if($row[0]!=$alternative){
                    $X[$row[0]]=array();
                    $alternative=$row[0];
                    ++$m;
                  }
                  $X[$row[0]][$row[1]]=$row[2];
                }

                foreach ($X as $key => $value) {
                  echo "<tr>";
                  for ($i = 1; $i <= count($value); $i++) {
                    echo "<td>".$value[$i]."</td>";
                  }
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Perbandingan Berpasangan Ternormalisasi (R)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                        foreach ($result3 as $key) {
                          echo "<th>".$key['kriteria']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php

                      //-- menentukan nilai rata-rata kuadrat per-kriteria
                      $x_rata=array();
                      foreach($X as $i=>$x){
                        foreach($x as $j=>$value){
                          $x_rata[$j]=(isset($x_rata[$j])?$x_rata[$j]:0)+pow($value,2);
                        }
                      }
                      for($j=1;$j<=$n;$j++){
                        $x_rata[$j]=sqrt($x_rata[$j]);
                      }
                      //-- menormalisasi matriks X menjadi matriks R
                      $R=array();
                      $alternative='';
                      foreach($X as $i=>$x){
                        if($alternative!=$i){
                          $alternative=$i;
                          $R[$i]=array();
                        }
                        foreach($x as $j=>$value){
                          $R[$i][$j]=$value/$x_rata[$j];
                        }
                      }

                      foreach ($R as $key => $value) {
                        echo "<tr>";                        
                        echo "<td>".$hotel[$key]."</td>";
                        for ($i = 1; $i <= count($value); $i++) {
                          echo "<td>".$value[$i]."</td>";
                        }
                        echo "</tr>";
                      }

                      ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Menentukan Bobot tiap-tiap Kriteria (W)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <?php 
                        foreach ($result3 as $key) {
                          echo "<th>".$key['kriteria']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php
                      // query untuk mengambil data nilai bobot criteria
                      $sql    = "SELECT id_kriteria, weight FROM tb_kriteria ORDER BY id_kriteria";
                      $result = $koneksi->query($sql);

                      $criteria = array();
                      while($row = $result->fetch_row()) {
                        $criteria[$row[0]]=$row[1];
                      }

                      echo "<tr>";
                      for ($i = 1; $i <= count($criteria); $i++) {
                        echo "<td>".$criteria[$i]."</td>";
                      }
                      echo "</tr>";

                      ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Membentuk Matrik Preferensi (V)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Alternatif</th>
                  <?php 
                        foreach ($result3 as $key) {
                          echo "<th>".$key['kriteria']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php
                      //-- inisialisasi matrik preferensi V dan himpunan bobot kriteria w
                      $V=$w=array();
                      //-- memasukkan data bobot ke dalam $w
                      foreach($criteria as $j=>$weight)
                        $w[$j]=$weight;
                      $alternative='';
                      //-- menghitung nilai Preferensi V
                      foreach($R as $i=>$r){
                        if($alternative!=$i){
                          $alternative=$i;
                          $V[$i]=array();
                        }
                        foreach($r as $j=>$value){
                          $V[$i][$j]=$w[$j]*$value;
                        }
                      }

                      foreach ($V as $key => $value) {
                        echo "<tr>";                        
                        echo "<td>".$hotel[$key]."</td>";
                        for ($i = 1; $i <= count($value); $i++) {
                        echo "<td>".$value[$i]."</td>";
                      }
                      echo "</tr>";
                    }

                    ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Menentukan Concordance Index (Ckl)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                          foreach ($result2 as $key => $value) {
                            echo "<th>".$value['nama_hotel']."</th>";
                          }
                          ?>
                </tr>
              </thead>
              <tbody>
                <?php

                        $c=array();
                        $c_index='';
                        for($k=1;$k<=$m;$k++){
                          if($c_index!=$k){
                            $c_index=$k;
                            $c[$k]=array();
                          }
                          for($l=1;$l<=$m;$l++){
                            if($k!=$l){
                              for($j=1;$j<=$n;$j++){
                                if(!isset($c[$k][$l]))$c[$k][$l]=array();
                                if($V[$k][$j]>=$V[$l][$j]){
                                  array_push($c[$k][$l],$j);
                                }
                              }
                            } else if (isset($c[$k][$l]) == NULL) {
                              $c[$k][$l]=$c[$k][$l] = "-";
                            }
                          }
                        }

                        foreach ($c as $key => $value) {
                         echo "<tr>";                        
                         echo "<td>".$hotel[$key]."</td>";
                         for ($i = 1; $i <= count($c); $i++) {
                          echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                        }
                        echo "</tr>";
                      }

                      ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Menentukan Discordance Index (Dkl)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                        foreach ($result2 as $key => $value) {
                          echo "<th>".$value['nama_hotel']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php

                      $d=array();
                      $d_index='';
                      for($k=1;$k<=$m;$k++){
                        if($d_index!=$k){
                          $d_index=$k;
                          $d[$k]=array();
                        }
                        for($l=1;$l<=$m;$l++){
                          if($k!=$l){
                            for($j=1;$j<=$n;$j++){
                              if(!isset($d[$k][$l]))$d[$k][$l]=array();
                              if($V[$k][$j]<$V[$l][$j]){
                                array_push($d[$k][$l],$j);
                              }
                            }
                          } else if (isset($d[$k][$l]) == NULL) {
                            $d[$k][$l]=$d[$k][$l] = "-";
                          }
                        }
                      }

                      foreach ($d as $key => $value) {
                       echo "<tr>";                        
                       echo "<td>".$hotel[$key]."</td>";
                       for ($i = 1; $i <= count($c); $i++) {
                        echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                      }
                      echo "</tr>";
                    }

                    ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Membentuk Matriks Concordance (C)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                        foreach ($result2 as $key => $value) {
                          echo "<th>".$value['nama_hotel']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php

                    $C=array();
                    $c_index='';
                    for($k=1;$k<=$m;$k++){
                      if($c_index!=$k){
                        $c_index=$k;
                        $C[$k]=array();
                      }
                      for($l=1;$l<=$m;$l++){
                        if($k!=$l && count($c[$k][$l])){
                          $f=0;
                          foreach($c[$k][$l] as $j){
                            $C[$k][$l]=(isset($C[$k][$l])?$C[$k][$l]:0)+$w[$j];
                          }
                        } else if (isset($C[$k][$l]) == NULL) {
                          $C[$k][$l]=$C[$k][$l] = "-";
                        }
                      }
                    }

                    foreach ($C as $key => $value) {
                      echo "<tr>";
                      echo "<tr>";                        
                      echo "<td>".$hotel[$key]."</td>";
                      for ($i = 1; $i <= count($c); $i++) {
                        echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                      }
                      echo "</tr>";
                    }

                    ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Threshold c</h4>
            </div>
          </div>

          <?php
                $sigma_c=0;
                foreach($C as $k=>$cl){
                  foreach($cl as $l=>$value){
                    $sigma_c+=$value;
                  }
                }
                $threshold_c=$sigma_c/($m*($m-1));
                echo "<b>".$threshold_c."</b>";
                ?>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Membentuk Matriks Discordance (D)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                        foreach ($result2 as $key => $value) {
                          echo "<th>".$value['nama_hotel']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php

                      $D=array();
                      $d_index='';
                      for($k=1;$k<=$m;$k++){
                        if($d_index!=$k){
                          $d_index=$k;
                          $D[$k]=array();
                        }
                        for($l=1;$l<=$m;$l++){
                          if($k!=$l){
                            $max_d=0;
                            $max_j=0;
                            if(count($d[$k][$l])){
                              $mx=array();
                              foreach($d[$k][$l] as $j){
                                if($max_d < abs($V[$k][$j]-$V[$l][$j]))
                                  $max_d=abs($V[$k][$j]-$V[$l][$j]);
                              }
                            }
                            $mx=array();
                            for($j=1;$j<=$n;$j++){
                              if($max_j < abs($V[$k][$j]-$V[$l][$j]))
                                $max_j=abs($V[$k][$j]-$V[$l][$j]);
                            }
                            $D[$k][$l]=$max_d/$max_j;
                          } else if (isset($D[$k][$l]) == NULL) {
                            $D[$k][$l]=$D[$k][$l] = "-";
                          }
                        }
                      }

                      foreach ($D as $key => $value) {
                      echo "<tr>";                        
                      echo "<td>".$hotel[$key]."</td>";
                      for ($i = 1; $i <= count($c); $i++) {
                        echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                      }
                      echo "</tr>";
                    }

                    ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Threshold d</h4>
            </div>
          </div>

          <?php
                $sigma_d=0;
                foreach($D as $k=>$dl){
                  foreach($dl as $l=>$value){
                    $sigma_d+=$value;
                  }
                }
                $threshold_d=$sigma_d/($m*($m-1));
                echo $threshold_d;
                ?>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Membentuk Matrik Concordance Dominan(F)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                        foreach ($result2 as $key => $value) {
                          echo "<th>".$value['nama_hotel']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php
                      $F=array();
                      foreach($C as $k=>$cl){
                        $F[$k]=array();
                        foreach($cl as $l=>$value){
                          $F[$k][$l]=($value >= $threshold_c?1:0);
                        }
                      }

                      foreach ($F as $key => $value) {
                      echo "<tr>";                        
                      echo "<td>".$hotel[$key]."</td>";
                      for ($i = 1; $i <= count($c); $i++) {
                        echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                      }
                      echo "</tr>";
                    }
                    ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Membentuk Matrik Discordance Dominan(G)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                        foreach ($result2 as $key => $value) {
                          echo "<th>".$value['nama_hotel']."</th>";
                        }
                        ?>
                </tr>
              </thead>
              <tbody>
                <?php
                      $G=array();
                      foreach($D as $k=>$dl){
                        $G[$k]=array();
                        foreach($dl as $l=>$value){
                          $G[$k][$l]=($value >= $threshold_d?1:0);
                        }
                      }

                      foreach ($G as $key => $value) {
                      echo "<tr>";                        
                      echo "<td>".$hotel[$key]."</td>";
                      for ($i = 1; $i <= count($c); $i++) {
                        echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                      }
                      echo "</tr>";
                    }

                    ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Membentuk Matrik Agregasi Dominan(E)</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th></th>
                  <?php 
                        foreach ($result2 as $key => $value) {
                          echo "<th>".$value['nama_hotel']."</th>";
                        }
                        ?>
                  <th>Poin</th>
                </tr>
              </thead>
              <tbody>
                <?php
                      $hasil = array();
                      $E=array();
                      foreach($F as $k=>$sl){
                        $E[$k]=array();
                        foreach($sl as $l=>$value){
                          $E[$k][$l]=$F[$k][$l]*$G[$k][$l];
                        }
                      }

                      foreach ($E as $key => $value) {
                        $hasil[$key] = array_sum($value);

                        echo "<tr>";                        
                        echo "<td>".$hotel[$key]."</td>";
                        for ($i = 1; $i <= count($c); $i++) {
                          echo is_array($value[$i]) ? "<td>".implode(", ", $value[$i])."</td>" : "<td>".$value[$i]."</td>";
                        }
                        echo "<td>".array_sum($value)."</td>";
                        echo "</tr>";
                      }
                      ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-lg-6">
              <h4 class="card-title">Ranking Hotel</h4>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Ranking</th>
                  <th>Nama hotel</th>
                  <th>Poin</th>
                  <th>Penilaian</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                arsort($hasil);
                $ranking = 1;
                foreach ($hasil as $key => $value) { ?>
                  <tr>
                    <td><?= $ranking++ ?></td>
                    <td><?= $hotel[$key] ?></td>
                    <td><?= $value ?></td>
                    <td><?= array_sum($penilaian[$key]) ?></td>
                    <td>
                      <?php 
                      if (array_sum($penilaian[$key]) > 936) {
                        echo "Bintang 5";
                      } else if (array_sum($penilaian[$key]) > 728) {
                        echo "Bintang 4";
                      } else if (array_sum($penilaian[$key]) > 520) {
                        echo "Bintang 3";
                      } else if (array_sum($penilaian[$key]) > 312) {
                        echo "Bintang 2";
                      } else if (array_sum($penilaian[$key]) > 208) {
                        echo "Bintang 1";
                      }
                      ?>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <!-- form untuk menyimpan hasil rangking -->
          <form method="post">
            <input type="submit" name="update" value="Update Status" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
          </form>
          <?php 
            if (isset($_POST['update'])) {               
              foreach ($hasil as $key => $value) {
                if (array_sum($penilaian[$key]) > 936) {
                  $penilaian_b = "Bintang 5";
                } else if (array_sum($penilaian[$key]) > 728) {
                  $penilaian_b = "Bintang 4";
                } else if (array_sum($penilaian[$key]) > 520) {
                  $penilaian_b = "Bintang 3";
                } else if (array_sum($penilaian[$key]) > 312) {
                  $penilaian_b = "Bintang 2";
                } else if (array_sum($penilaian[$key]) > 208) {
                  $penilaian_b = "Bintang 1";
                }

                $sql = "UPDATE tb_hotel SET status_baru = '$penilaian_b' WHERE id_hotel = '$key'";
                $query = $koneksi->query($sql);

                if ($query) {
                  echo "<script>alert('Update Status Berhasil!')</script>";
                  echo "<script>window.location=(href='layout.php?content=data_hotel_laporan')</script>";
                }
                
              }
            }
          ?>

        </div>
      </div>
    </div>

  </div>
</div>