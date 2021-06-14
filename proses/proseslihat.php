<?php
require '../connect.php';
require '../class/crud.php';
if ($_SERVER['REQUEST_METHOD']=='GET') {
    $id=@$_GET['id'];
    $op=@$_GET['op'];
}else if ($_SERVER['REQUEST_METHOD']=='POST'){
    $id=@$_POST['id'];
    $op=@$_POST['op'];
}
$crud=new crud();
switch ($op){
    case 'subkriteria':
        if(!empty($id)){
            $where = "WHERE nilai_kriteria.id_kriteria='$id'";
        }
        else{
            $where = null;
        }
        $query="SELECT id_nilaikriteria, nilai, keterangan, namaKriteria, id_kriteria FROM nilai_kriteria INNER JOIN kriteria USING (id_kriteria) $where ORDER BY id_kriteria,nilai ASC";
        $execute=$konek->query($query);
        if($execute->num_rows > 0){
            $no=1;
            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
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
        else{
            echo '
            <tr>
                <td colspan="4" align="center"><em>Tidak ada data.</em></td>
            </tr>
            ';
        }
    break;
    case 'nilai':
        if(!empty($id)){
            $where = "WHERE nilai_supplier.id_jenisbarang='$id'";
        } else{
            $where = null;
        }
        $query = "SELECT id_nilaisupplier, id_supplier, supplier.namaSupplier AS namaSupplier, jenis_barang.id_jenisbarang AS id_jenisbarang, jenis_barang.namaBarang AS namaBarang FROM nilai_supplier INNER JOIN supplier USING(id_supplier) INNER JOIN jenis_barang USING (id_jenisbarang) $where GROUP BY id_supplier ORDER BY id_jenisbarang, id_supplier ASC";
        $execute=$konek->query($query);
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
        else{
            echo '
            <tr>
                <td colspan="4" align="center"><em>Tidak ada data.</em></td>
            </tr>
            ';
        }
    break;
}