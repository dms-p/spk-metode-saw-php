<!-- Page Title, Breadcrumb -->
<div class="app-title">
    <div>
        <h1>Supplier</h1>
    </div>
    <div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home"></i></li>
            <li class="breadcrumb-item"><a href="./?page=supplier">Supplier</a></li>
        </ul>
    </div>
</div>

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
                                <th>Nama Supplier</th>
                                <th width="50">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $query = "SELECT * FROM supplier ORDER BY namaSupplier ASC";
                            $execute = $konek->query($query);
                            if($execute->num_rows > 0){
                                $no = 1;
                                while($data = $execute->fetch_array(MYSQLI_ASSOC)){
                                    echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td>'.$data['namaSupplier'].'</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-warning btn-edit" data-id="'.$data['id_supplier'].'" data-op="supplier" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="'.$data['id_supplier'].'" data-op="supplier" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash"></i></a>
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
                <input type="hidden" name="op" value="supplier">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Nama Supplier <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="supplier" type="text" class="form-control" required>
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
                <input type="hidden" name="id" id="id_supplier">
                <input type="hidden" name="op" value="supplier">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Nama Supplier <span class="text-danger">*</span></label>
                        <div class="col-md-10">
                            <input name="supplier" type="text" class="form-control" id="namaSupplier" required>
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