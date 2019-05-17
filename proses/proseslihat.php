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
    if (!empty($id)) {
        $where="WHERE nilai_kriteria.id_kriteria='$id'";
    }else{
        $where=null;
    }
    $query="SELECT id_nilaikriteria,nilai,keterangan,namaKriteria,id_kriteria FROM nilai_kriteria INNER JOIN kriteria USING (id_kriteria) $where ORDER BY id_kriteria,nilai ASC";
    $execute=$konek ->query($query);
    if ($execute->num_rows > 0){
        $no=1;
        while($data=$execute->fetch_array(MYSQLI_ASSOC)){
            echo"
            <tr id='data'>
                <td>$no</td>
                <td>".$data['namaKriteria']."</td>
                <td>".$data['nilai']."</td>
                <td>".$data['keterangan']."</td>
                <td><div class='norebuttom'>
                <a class=\"btn btn-light-green\" href='./?page=subkriteria&aksi=ubah&id=".$data['id_nilaikriteria']."'><i class='fa fa-pencil-alt'></i></a>
                <a class=\"btn btn-yellow\" data-a=\"nilai $data[nilai] dalam $data[namaKriteria]\" id='hapus' href='./proses/proseshapus.php/?op=subkriteria&id=".$data['id_nilaikriteria']."'><i class='fa fa-trash-alt'</a></td></div>
            </tr>";
            $no++;
        }
    }else{
        echo "<tr><td  class='text-center text-green' colspan='4'><b>Kosong</b></td></tr>";
    }
        break;
    case 'nilai':
        if (!empty($id)) {
            $where="WHERE nilai_supplier.id_jenisbarang='$id'";
        }else{
            $where=null;
        }
        $query="SELECT id_nilaisupplier,id_supplier,supplier.namaSupplier AS namaSupplier,jenis_barang.id_jenisbarang AS id_jenisbarang,jenis_barang.namaBarang AS namaBarang FROM nilai_supplier INNER JOIN supplier USING(id_supplier) INNER JOIN jenis_barang USING (id_jenisbarang) $where GROUP BY id_supplier ORDER BY id_jenisbarang,id_supplier ASC";
        $execute=$konek->query($query);
        if ($execute->num_rows > 0){
            $no=1;
            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
               echo"
                <tr id='data'>
                    <td>$no</td>
                    <td>$data[namaBarang]</td>
                    <td>$data[namaSupplier]</td>
                    <td>
                    <div class='norebuttom'>
                    <a class=\"btn btn-green\" href=\"./?page=penilaian&aksi=lihat&a=$data[id_supplier]&b=$data[id_jenisbarang]\"><i class='fa fa-eye'></i></a>
                    <a class=\"btn btn-light-green\" href=\"./?page=penilaian&aksi=ubah&a=$data[id_supplier]&b=$data[id_jenisbarang]\"><i class='fa fa-pencil-alt'></i></a>
                    <a class=\"btn btn-yellow\" data-a=\".$data[namaBarang] - $data[namaSupplier]\" id='hapus' href='./proses/proseshapus.php/?op=nilai&id=".$data['id_supplier']."'><i class='fa fa-trash-alt'></i></a></td>
                </div></tr>";
                $no++;
            }
        }else{
            echo "<tr><td  class='text-center text-green' colspan='4'><b>Kosong</b></td></tr>";
        }
        break;
}