
    <!-- Sidebar Menu -->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user justify-content-center d-none">
            <img class="app-sidebar__user-avatar img-fluid" src="asset/image/YNTKTS.png" width="120">
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item <?= !isset($_GET['page']) || $_GET['page'] == 'beranda' ? 'active' : '' ?>" href="./?page=beranda"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Beranda</span></a></li>
            <li><a class="app-menu__item <?= isset($_GET['page']) && $_GET['page'] == 'barang' ? 'active' : '' ?>" href="./?page=barang"><i class="app-menu__icon fa fa-archive"></i><span class="app-menu__label">Barang</span></a></li>
            <li><a class="app-menu__item <?= isset($_GET['page']) && $_GET['page'] == 'supplier' ? 'active' : '' ?>" href="./?page=supplier"><i class="app-menu__icon fa fa-truck"></i><span class="app-menu__label">Supplier</span></a></li>
            <li><a class="app-menu__item <?= isset($_GET['page']) && $_GET['page'] == 'kriteria' ? 'active' : '' ?>" href="./?page=kriteria"><i class="app-menu__icon fa fa-check-square"></i><span class="app-menu__label">Kriteria</span></a></li>
            <li><a class="app-menu__item <?= isset($_GET['page']) && $_GET['page'] == 'subkriteria' ? 'active' : '' ?>" href="./?page=subkriteria"><i class="app-menu__icon fa fa-check-square-o"></i><span class="app-menu__label">Sub Kriteria</span></a></li>
            <li><a class="app-menu__item <?= isset($_GET['page']) && $_GET['page'] == 'bobot' ? 'active' : '' ?>" href="./?page=bobot"><i class="app-menu__icon fa fa-balance-scale"></i><span class="app-menu__label">Bobot</span></a></li>
            <li><a class="app-menu__item <?= isset($_GET['page']) && $_GET['page'] == 'penilaian' ? 'active' : '' ?>" href="./?page=penilaian"><i class="app-menu__icon fa fa-star"></i><span class="app-menu__label">Penilaian</span></a></li>
            <li><a class="app-menu__item <?= isset($_GET['page']) && $_GET['page'] == 'hasil' ? 'active' : '' ?>" href="./?page=hasil"><i class="app-menu__icon fa fa-bar-chart"></i><span class="app-menu__label">Hasil</span></a></li>
            <li><a class="app-menu__item" href="#"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Panduan</span></a></li>
            <li><a class="app-menu__item" href="./logout.php" id="out"><i class="app-menu__icon fa fa-power-off"></i><span class="app-menu__label">Keluar</span></a></li>
        </ul>
    </aside>