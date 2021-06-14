<!-- Page Title, Breadcrumb -->
<div class="app-title">
    <div>
        <h1>Beranda</h1>
    </div>
    <div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href="./?page=beranda">Beranda</a></li>
        </ul>
    </div>
</div>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="media">
                    <img class="align-self-center mr-3" src="asset/image/illustration/undraw_skateboard_d6or.svg" width="175" alt="Welcome">
                    <div class="media-body">
                        <h5 class="mt-0">Hai, <?= ucfirst($_SESSION['user']) ?>!</h5>
                        <p>Selamat Datang di Sistem Pendukung Keputusan pemilihan supplier berbasis web menggunakan metode <span class="text-dark font-weight-bold">Simple Additive Weighting</span>.</p>
                        <p class="mb-0"><a href="#" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-book mr-2"></i>Unduh Panduan</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>