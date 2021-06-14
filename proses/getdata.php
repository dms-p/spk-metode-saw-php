<?php
require '../connect.php';
$id = htmlspecialchars(@$_GET['id']);
$op = htmlspecialchars(@$_GET['op']);
$a = htmlspecialchars(@$_GET['a']);
$b = htmlspecialchars(@$_GET['b']);

switch($op){
	case 'barang':
		$query = "SELECT id_jenisbarang, namaBarang FROM jenis_barang WHERE id_jenisbarang = '$id'";
		$execute = $konek->query($query);
		if($execute->num_rows > 0){
		    $data = $execute->fetch_array(MYSQLI_ASSOC);
		    echo json_encode($data);
		}
	break;
	case 'supplier':
		$query = "SELECT id_supplier, namaSupplier FROM supplier WHERE id_supplier = '$id'";
		$execute = $konek->query($query);
		if($execute->num_rows > 0){
		    $data = $execute->fetch_array(MYSQLI_ASSOC);
		    echo json_encode($data);
		}
	break;
	case 'kriteria':
		$query = "SELECT id_kriteria, namaKriteria, sifat FROM kriteria WHERE id_kriteria = '$id'";
		$execute = $konek->query($query);
		if($execute->num_rows > 0){
		    $data = $execute->fetch_array(MYSQLI_ASSOC);
		    echo json_encode($data);
		}
	break;
	case 'subkriteria':
		$query = "SELECT id_nilaikriteria, id_kriteria, nilai, keterangan FROM nilai_kriteria WHERE id_nilaikriteria = '$id'";
		$execute = $konek->query($query);
		if($execute->num_rows > 0){
		    $data = $execute->fetch_array(MYSQLI_ASSOC);
		    echo json_encode($data);
		}
	break;
	case 'bobot':
		$query = "SELECT id_jenisbarang, bobot, id_bobotkriteria, kriteria.namaKriteria AS namaKriteria FROM bobot_kriteria INNER JOIN kriteria USING (id_kriteria) WHERE id_jenisbarang = '$id'";
		$execute = $konek->query($query);
		$detail = [];
		if($execute->num_rows > 0){
		    while($data = $execute->fetch_array(MYSQLI_ASSOC)){
		    	array_push($detail, $data);
		    }
		    echo json_encode([
		    	'disabled' => [
		    		'id_jenisbarang' => $id
		    	],
		    	'enabled' => $detail
		    ]);
		}
	break;
	case 'nilai':
		$query = "SELECT id_nilaisupplier, id_nilaikriteria, kriteria.namaKriteria AS namaKriteria, nilai_kriteria.keterangan AS keterangan FROM nilai_supplier INNER JOIN kriteria USING (id_kriteria) INNER JOIN nilai_kriteria USING (id_nilaikriteria) WHERE nilai_supplier.id_supplier='$a' AND nilai_supplier.id_jenisbarang='$b'";
		$execute = $konek->query($query);
		$detail = [];
		if($execute->num_rows > 0){
		    while($data = $execute->fetch_array(MYSQLI_ASSOC)){
		    	array_push($detail, $data);
		    }
		    echo json_encode([
		    	'disabled' => [
		    		'id_supplier' => $a,
		    		'id_jenisbarang' => $b
		    	],
		    	'enabled' => $detail
		    ]);
		}
	break;
}
?>