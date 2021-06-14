<!-- Page Title, Breadcrumb -->
<div class="app-title">
    <div>
        <h1>Penilaian</h1>
    </div>
    <div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href="./?page=penilaian">Penilaian</a></li>
        </ul>
    </div>
</div>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-title-w-btn">
                <a href="#" class="btn btn-sm btn-primary btn-add"><i class="fa fa-plus mr-2"></i>Tambah Data</a>
                <div>
                    <select class="form-control form-control-sm" id="categorize" data-op="nilai">
                        <option value="">Semua Barang</option>
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
            </div>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th width="30">No.</th>
                                <th>Nama Barang</th>
                                <th>Nama Supplier</th>
                                <th width="70">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT id_nilaisupplier, id_supplier, supplier.namaSupplier AS namaSupplier, jenis_barang.id_jenisbarang AS id_jenisbarang, jenis_barang.namaBarang AS namaBarang FROM nilai_supplier INNER JOIN supplier USING (id_supplier) INNER JOIN jenis_barang USING (id_jenisbarang) GROUP BY id_supplier, id_jenisbarang ORDER BY id_jenisbarang, id_supplier ASC";
                            $execute = $konek->query($query);
                            if($execute->num_rows > 0){
                                $no = 1;
                                while($data = $execute->fetch_array(MYSQLI_ASSOC)){
                                    echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td>'.$data['namaBarang'].'</td>
                                        <td>'.$data['namaSupplier'].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-info btn-detail" data-a="'.$data['id_supplier'].'" data-b="'.$data['id_jenisbarang'].'" data-op="nilai" data-toggle="tooltip" title="Detail"><i class="fa fa-eye"></i></a>
                                                <a href="#" class="btn btn-sm btn-warning btn-edit" data-a="'.$data['id_supplier'].'" data-b="'.$data['id_jenisbarang'].'" data-op="nilai" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-a="'.$data['id_supplier'].'" data-b="'.$data['id_jenisbarang'].'" data-op="nilai" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
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
                <input type="hidden" name="op" value="nilai">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Supplier <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select name="supplier" class="form-control" required>
                                <option value="" disabled selected>-- Pilih--</option>
                                <?php
                                    $query = "SELECT * FROM supplier";
                                    $execute = $konek->query($query);
                                    if($execute->num_rows > 0){
                                        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                            echo '<option value="'.$data['id_supplier'].'">'.$data['namaSupplier'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
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
                                        <select name="nilai[]" class="form-control" required>
                                            <option value="" disabled selected>-- Pilih--</option>';
                                $query2 = "SELECT id_nilaikriteria, keterangan FROM nilai_kriteria WHERE id_kriteria = '$data[id_kriteria]'";
                                $execute2 = $konek->query($query2);
                                if($execute2->num_rows > 0){
                                    while($data2 = $execute2->fetch_array(MYSQLI_ASSOC)){
                                        echo '<option value="'.$data2['id_nilaikriteria'].'">'.$data2['keterangan'].'</option>';
                                    }
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
                    <label class="col-form-label col-md-3">Supplier <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select name="supplier" class="form-control" id="id_supplier" disabled>
                            <option value="" disabled selected>-- Pilih--</option>
                            <?php
                                $query = "SELECT * FROM supplier";
                                $execute = $konek->query($query);
                                if($execute->num_rows > 0){
                                    while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                        echo '<option value="'.$data['id_supplier'].'">'.$data['namaSupplier'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
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
                                    <input type="hidden" name="id[]" id="id_nilaisupplier-'.$i.'">
                                    <select name="nilai[]" class="form-control" id="id_nilaikriteria-'.$i.'" disabled>
                                        <option value="" disabled selected>-- Pilih--</option>';
                            $query2 = "SELECT id_nilaikriteria, keterangan FROM nilai_kriteria WHERE id_kriteria = '$data[id_kriteria]'";
                            $execute2 = $konek->query($query2);
                            if($execute2->num_rows > 0){
                                while($data2 = $execute2->fetch_array(MYSQLI_ASSOC)){
                                    echo '<option value="'.$data2['id_nilaikriteria'].'">'.$data2['keterangan'].'</option>';
                                }
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
                <input type="hidden" name="op" value="nilai">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3">Supplier <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <select name="supplier" class="form-control" id="id_supplier" disabled>
                                <option value="" disabled selected>-- Pilih--</option>
                                <?php
                                    $query = "SELECT * FROM supplier";
                                    $execute = $konek->query($query);
                                    if($execute->num_rows > 0){
                                        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                            echo '<option value="'.$data['id_supplier'].'">'.$data['namaSupplier'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
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
                                        <input type="hidden" name="id[]" id="id_nilaisupplier-'.$i.'">
                                        <select name="nilai[]" class="form-control" id="id_nilaikriteria-'.$i.'" required>
                                            <option value="" disabled selected>-- Pilih--</option>';
                                $query2 = "SELECT id_nilaikriteria, keterangan FROM nilai_kriteria WHERE id_kriteria = '$data[id_kriteria]'";
                                $execute2 = $konek->query($query2);
                                if($execute2->num_rows > 0){
                                    while($data2 = $execute2->fetch_array(MYSQLI_ASSOC)){
                                        echo '<option value="'.$data2['id_nilaikriteria'].'">'.$data2['keterangan'].'</option>';
                                    }
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