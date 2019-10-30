<div class="horizontal-menu">
  <nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container-fluid">
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
        <ul class="navbar-nav navbar-nav-left">
          <li class="nav-item ml-0 mr-5 d-lg-flex d-none">
            <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
          </li>
        </ul>

        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <h3 style="color: #0ddbb9; text-transform: uppercase; font-weight: bold;">Sistem Pendukung Keputusan Status Hotel</h3>
        </div>
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <span class="nav-profile-name"><?= $_SESSION["username"] ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a href="../logout.php" class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="horizontal-menu-toggle">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </div>
  </nav>
  <nav class="bottom-navbar">
    <div class="container">
      <ul class="nav page-navigation">

        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="mdi mdi-view-dashboard menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item <?php if ($_GET['content'] == "data_hotel") {echo "active";} ?> ">
          <a href="layout.php?content=data_hotel" class="nav-link">
            <i class="mdi mdi-city-variant menu-icon"></i>
            <span class="menu-title">Data Hotel</span>
            <i class="menu-arrow"></i>
          </a>
        </li>
        <li class="nav-item <?php if ($_GET['content'] == "data_fasilitas") {echo "active";} ?> ">
          <a href="layout.php?content=data_fasilitas" class="nav-link">
            <i class="mdi mdi-bed-empty menu-icon"></i>
            <span class="menu-title">Data Fasilitas</span>
            <i class="menu-arrow"></i>
          </a>
        </li>
        <li class="nav-item <?php if ($_GET['content'] == "data_user") {echo "active";} ?>">
          <a href="layout.php?content=data_user" class="nav-link">
            <i class="mdi mdi-account-group menu-icon"></i>
            <span class="menu-title">Data User</span>
            <i class="menu-arrow"></i>
          </a>
        </li>
        <li class="nav-item <?php if ($_GET['content'] == "data_penilaian") {echo "active";} ?>">
          <a href="layout.php?content=data_penilaian" class="nav-link">
            <i class="mdi mdi-ballot menu-icon"></i>
            <span class="menu-title">Data Penilaian</span>
            <i class="menu-arrow"></i>
          </a>
        </li>
        <li class="nav-item <?php if ($_GET['content'] == "data_hotel_laporan") {echo "active";} ?>">
          <a href="#" class="nav-link">
            <i class="mdi mdi-file-document-box-multiple menu-icon"></i>
            <span class="menu-title">Laporan</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
              <li class="nav-item"><a class="nav-link" href="layout.php?content=data_certifikat">Ubah Certifikat</a></li>
              <li class="nav-item"><a class="nav-link" href="layout.php?content=data_hotel_laporan">Laporan Hotel</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item <?php if ($_GET['content'] == "data_kriteria" || $_GET['content'] == "data_alternatif" || $_GET['content'] == "data_evaluasi" || $_GET['content'] == "hasil_metode") {echo "active";} ?>">
          <a href="#" class="nav-link">
            <i class="mdi mdi-metronome-tick menu-icon"></i>
            <span class="menu-title">Proses Metode</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
              <li class="nav-item"><a class="nav-link" href="layout.php?content=data_kriteria">Data Kriteria</a></li>
              <li class="nav-item"><a class="nav-link" href="layout.php?content=data_alternatif">Data Alternatif</a></li>
              <li class="nav-item"><a class="nav-link" href="layout.php?content=hasil_metode">Hasil Metode</a></li>
            </ul>
          </div>
        </li>
        
      </ul>
    </div>
  </nav>
</div>