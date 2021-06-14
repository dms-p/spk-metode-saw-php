<!-- Page Title, Breadcrumb -->
<div class="app-title">
    <div>
        <h1>Bobot</h1>
    </div>
    <div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href="./?page=bobot">Bobot</a></li>
        </ul>
    </div>
</div>

<?php
    $listWeight = array(
        array("nama" => "0 - Sangat Rendah", "nilai" => 0),
        array("nama" => "0.25 - Rendah", "nilai" => 0.25),
        array("nama" => "0.5 - Tengah", "nilai" => 0.5),
        array("nama" => "0.75 - Tinggi", "nilai" => 0.75),
        array("nama" => "1 - Sangat Tinggi", "nilai" => 1),
    );
?>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <a href="#" class="btn btn-sm btn-primary btn-add"><i class="fa fa-plus mr-2"></i>Tambah Data</a>
            </div>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th width="30">No.</th>
                                <th>Nama Barang</th>
                                <th width="70">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT bobot_kriteria.id_jenisbarang AS idbarangbobot, jenis_barang.namaBarang AS namaBarang FROM bobot_kriteria INNER JOIN jenis_barang WHERE bobot_kriteria.id_jenisbarang = jenis_barang.id_jenisbarang GROUP BY idbarangbobot ORDER BY idbarangbobot ASC";
                            $execute = $konek->query($query);
                            if($execute->num_rows > 0){
                                $no = 1;
                                while($data = $execute->fetch_array(MYSQLI_ASSOC)){
                                    echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td>'.$data['namaBarang'].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-info btn-detail" data-id="'.$data['idbarangbobot'].'" data-op="bobot" data-toggle="tooltip" title="Detail"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-sm btn-warning btn-edit" data-id="'.$data['idbarangbobot'].'" data-op="bobot" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="'.$data['idbarangbobot'].'" data-op="bobot" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>';
                                    $no++;
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal" id="modal-add">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form class="form" method="post" action="./proses/prosestambah.php">
                <input type="hidden" name="op" value="bobot">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Barang <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select name="barang" class="form-control" required>
                                <option value="" disabled selected>-- Pilih--</option>
                                <?php
                                    $query = "SELECT * FROM jenis_barang";
                                    $execute = $konek->query($query);
                                    if($execute->num_rows > 0){
                                        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                            echo '<option value="'.$data['id_jenisbarang'].'">'.$data['namaBarang'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                        $query = "SELECT id_kriteria, namaKriteria FROM kriteria";
                        $execute = $konek->query($query);
                        if($execute->num_rows > 0){
                            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                echo '
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">'.$data['namaKriteria'].' <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="kriteria[]" value="'.$data['id_kriteria'].'">
                                        <select name="bobot[]" class="form-control" required>
                                            <option value="" disabled selected>-- Pilih--</option>';
                                foreach($listWeight as $w){
                                    echo '<option value="'.$w['nilai'].'">'.$w['nama'].'</option>';
                                }
                                echo '
                                        </select>
                                    </div>
                                </div>';
                            }
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal" id="modal-detail">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-form-label col-md-3">Barang <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select name="barang" class="form-control" id="id_jenisbarang" disabled>
                            <option value="" disabled selected>-- Pilih--</option>
                            <?php
                                $query = "SELECT * FROM jenis_barang";
                                $execute = $konek->query($query);
                                if($execute->num_rows > 0){
                                    while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                        echo '<option value="'.$data['id_jenisbarang'].'">'.$data['namaBarang'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <?php
                    $query = "SELECT id_kriteria, namaKriteria FROM kriteria";
                    $execute = $konek->query($query);
                    if($execute->num_rows > 0){
                        $i = 0;
                        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                            echo '
                            <div class="form-group row">
                                <label class="col-form-label col-md-3">'.$data['namaKriteria'].' <span class="text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input type="hidden" name="id[]" id="id_bobotkriteria-'.$i.'">
                                    <select name="bobot[]" class="form-control" id="bobot-'.$i.'" disabled>
                                        <option value="" disabled selected>-- Pilih--</option>';
                            foreach($listWeight as $w){
                                echo '<option value="'.$w['nilai'].'">'.$w['nama'].'</option>';
                            }
                            echo '
                                    </select>
                                </div>
                            </div>';
                            $i++;
                        }
                    }
                ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal" id="modal-edit">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form class="form" method="post" action="./proses/prosesubah.php">
                <input type="hidden" name="op" value="bobot">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Barang <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select name="barang" class="form-control" id="id_jenisbarang" disabled>
                                <option value="" disabled selected>-- Pilih--</option>
                                <?php
                                    $query = "SELECT * FROM jenis_barang";
                                    $execute = $konek->query($query);
                                    if($execute->num_rows > 0){
                                        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                            echo '<option value="'.$data['id_jenisbarang'].'">'.$data['namaBarang'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <?php
                        $query = "SELECT id_kriteria, namaKriteria FROM kriteria";
                        $execute = $konek->query($query);
                        if($execute->num_rows > 0){
                            $i = 0;
                            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                echo '
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">'.$data['namaKriteria'].' <span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="hidden" name="id[]" id="id_bobotkriteria-'.$i.'">
                                        <select name="bobot[]" class="form-control" id="bobot-'.$i.'" required>
                                            <option value="" disabled selected>-- Pilih--</option>';
                                foreach($listWeight as $w){
                                    echo '<option value="'.$w['nilai'].'">'.$w['nama'].'</option>';
                                }
                                echo '
                                        </select>
                                    </div>
                                </div>';
                                $i++;
                            }
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>