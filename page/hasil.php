<!-- Page Title, Breadcrumb -->
<div class="app-title">
    <div>
        <h1>Hasil</h1>
    </div>
    <div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href="./?page=hasil">Hasil</a></li>
        </ul>
    </div>
</div>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <div>
                    <select class="form-control form-control-sm" name="pilih" id="generate-saw">
                        <option value="" disabled selected>--Pilih Barang--</option>
                        <?php
                            $query = "SELECT id_jenisbarang, namaBarang FROM jenis_barang";
                            $execute = $konek->query($query);
                            if($execute->num_rows > 0){
                                while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                    echo '<option value="'.$data['id_jenisbarang'].'">'.$data['namaBarang'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <a href="./cetakpdf.php" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print mr-2"></i>Cetak Laporan</a>
            </div>
            <div class="tile-body">
                <div id="result-saw">
                    <div class="alert alert-warning text-center mb-0">Pilih List Barang, untuk menampilkan hasil.</div>
                </div>
            </div>
        </div>
    </div>
</div>