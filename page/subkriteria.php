<!-- Page Title, Breadcrumb -->
<div class="app-title">
    <div>
        <h1>Sub Kriteria</h1>
    </div>
    <div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href="./?page=subkriteria">Sub Kriteria</a></li>
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
                    <select class="form-control form-control-sm" id="categorize" data-op="subkriteria">
                        <option value="">Semua Kriteria</option>
                        <?php
                            $query = "SELECT id_kriteria, namaKriteria FROM kriteria";
                            $execute = $konek->query($query);
                            if($execute->num_rows > 0){
                                while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                    echo '<option value="'.$data['id_kriteria'].'">'.$data['namaKriteria'].'</option>';
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
                                <th>Kriteria</th>
                                <th>Nilai</th>
                                <th>Keterangan</th>
                                <th width="50">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT id_nilaikriteria, nilai, keterangan, namaKriteria, id_kriteria FROM nilai_kriteria INNER JOIN kriteria USING (id_kriteria) ORDER BY id_kriteria,nilai ASC";
                            $execute = $konek->query($query);
                            if($execute->num_rows > 0){
                                $no = 1;
                                while($data = $execute->fetch_array(MYSQLI_ASSOC)){
                                    echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td>'.$data['namaKriteria'].'</td>
                                        <td>'.$data['nilai'].'</td>
                                        <td>'.$data['keterangan'].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-warning btn-edit" data-id="'.$data['id_nilaikriteria'].'" data-op="subkriteria" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="'.$data['id_nilaikriteria'].'" data-op="subkriteria" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
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
                <input type="hidden" name="op" value="subkriteria">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Kriteria <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="kriteria" class="form-control" required>
                                <option value="" disabled selected>-- Pilih--</option>
                                <?php
                                    $query = "SELECT id_kriteria, namaKriteria FROM kriteria";
                                    $execute = $konek->query($query);
                                    if($execute->num_rows > 0){
                                        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                            echo '<option value="'.$data['id_kriteria'].'">'.$data['namaKriteria'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Nilai <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="nilai" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="keterangan" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
                </div>
            </form>
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
                <input type="hidden" name="id" id="id_nilaikriteria">
                <input type="hidden" name="op" value="subkriteria">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Kriteria <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <select name="kriteria" class="form-control" id="id_kriteria" required>
                                <option value="" disabled selected>-- Pilih--</option>
                                <?php
                                    $query = "SELECT id_kriteria, namaKriteria FROM kriteria";
                                    $execute = $konek->query($query);
                                    if($execute->num_rows > 0){
                                        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                            echo '<option value="'.$data['id_kriteria'].'">'.$data['namaKriteria'].'</option>';
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Nilai <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="nilai" type="text" class="form-control" id="nilai" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Keterangan <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="keterangan" type="text" class="form-control" id="keterangan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save mr-2"></i>Simpan</button>
                    <button class="btn btn-sm btn-danger" type="button" data-dismiss="modal"><i class="fa fa-close mr-2"></i>Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>