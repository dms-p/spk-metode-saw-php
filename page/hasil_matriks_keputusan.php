<?php
require '../connect.php';
require '../function.php';
$cookiePilih=@$_COOKIE['pilih'];
//$cookiePilih=null;
if (isset($cookiePilih) && !empty($cookiePilih)){
/***************awal set variabel************/
    $valueMinMax=array(); $kriteriaArray=array(); $supplierArray=array(); $forminmax=array(); $simpanNormalisasi=array(); $bobotArray=array();
    $querykriteria="SELECT namaKriteria FROM kriteria";//query tabel kriteria
    //query get data alternative
    $queryAlternative="SELECT supplier.namaSupplier AS namaSupplier,id_supplier FROM nilai_supplier INNER JOIN supplier USING(id_supplier) WHERE id_jenisbarang='$cookiePilih' GROUP BY id_supplier ";
    //query get data bobot
    $queryBobot="SELECT id_kriteria,bobot FROM bobot_kriteria WHERE id_jenisbarang='$cookiePilih'";
    //query get data nilai
    $indexArray=0;//variabel index array
/***************akhir set variabel************/
    $executeBobot=$konek->query($queryBobot);
    if ($executeBobot->num_rows>0) {
        while ($dataBobot=$executeBobot->fetch_array(MYSQLI_ASSOC)) {
            $bobotArray[$dataBobot['id_kriteria']]=@$dataBobot['bobot'];
        }
    }
/////////////////////////////////////////////////////////////////awal set header table matriks keputusan
$executeQueryTabel=$konek->query( $querykriteria);
echo "<div class='panel-middle'>";
echo "<p><h3>Matriks Keputusan</h3></p><table><tr><th rowspan='2'>Alternative</th><th colspan='$executeQueryTabel->num_rows'>Kriteria</th></tr><tr>";
while ($data=$executeQueryTabel->fetch_array(MYSQLI_ASSOC)){
    echo "<th>$data[namaKriteria]</th>";
    array_push($kriteriaArray,$data['namaKriteria']);//simpan nama nama kriteria ke array
}
echo "</tr>";
/////////////////////////////////////////////////////////////////akhir set header table matriks keputusan
/******awal isi table matriks keputusan****/
$executeGetAlternative=$konek->query($queryAlternative);
$colspan=$executeQueryTabel->num_rows+1;
if ($executeGetAlternative->num_rows > 0){
    while ($dataAlternative=$executeGetAlternative->fetch_array(MYSQLI_ASSOC)){
        echo"<tr id='data'><td>$dataAlternative[namaSupplier]</td>";
        $queryGetNilai="SELECT nilai_kriteria.nilai AS nilai,kriteria.sifat AS sifat,nilai_supplier.id_kriteria AS id_kriteria FROM nilai_supplier JOIN kriteria ON kriteria.id_kriteria=nilai_supplier.id_kriteria JOIN nilai_kriteria ON nilai_kriteria.id_nilaikriteria=nilai_supplier.id_nilaikriteria WHERE (id_jenisbarang='$cookiePilih' AND id_supplier='$dataAlternative[id_supplier]')";
        $executeNilai=$konek->query($queryGetNilai);
        $i=0;
        while ($dataNilai=$executeNilai->fetch_array(MYSQLI_ASSOC)){
            echo "<td>$dataNilai[nilai]</td>";
            $nilaiSupplier[$indexArray][$i]=array("sifat"=>$dataNilai['sifat'],"id_kriteria"=>$dataNilai['id_kriteria']);
            $forminmax[$dataNilai['id_kriteria']][$indexArray]=$dataNilai['nilai'];
            $i++;
        }
            echo "</tr>";
            $supplierArray[$indexArray]=["namaSupplier"=>$dataAlternative['namaSupplier'],"id_supplier"=>$dataAlternative['id_supplier']];
            $indexArray++;
    }
}else{
    echo "<tr class='text-center'><td colspan=\"$colspan\">Data Kosong</td></tr>";
}
echo "</table>";
/******akhir isi table matriks keputusan****/
/////////////////////////////////////////////////////////////////awal set header table normalisasi
echo "<p><h3>Normalisasi Matriks Keputusan</h3></p><table><tr><th rowspan='2'>Alternative</th><th colspan='$executeQueryTabel->num_rows'>Kriteria</th></tr><tr>";
foreach ($kriteriaArray as $namaKriteria) {
    echo "<th>$namaKriteria</th>";
}
echo "</tr>";
/////////////////////////////////////////////////////////////////akhir set header table normalisasi
/******awal isi table normalisasi****/
if (!empty($supplierArray)){
    $simpanrangking=array();
    if (!empty($bobotArray)) {
        for ($j=0; $j< count($supplierArray); $j++) { 
            echo "<tr id='data'><td>".$supplierArray[$j]['namaSupplier']."</td>";
                for ($k=0; $k<count($nilaiSupplier[$j]) ; $k++) {
                    $idKriteria=$nilaiSupplier[$j][$k]['id_kriteria'];
                    echo "<td>".$hasil=normalisasi($forminmax[$idKriteria][$j],$forminmax[$idKriteria],$nilaiSupplier[$j][$k]["sifat"])."</td>";
                    $simpanrangking[$j][$k]=floatval($hasil)*$bobotArray[$idKriteria];
                }
            echo"</tr>";
        }
    }else{
        echo "<tr class='text-center'><td colspan=\"$colspan\"><b>Bobot Kriteria tidak boleh kosong</b></td></tr>";
    }
}else{
    echo "<tr class='text-center'><td colspan=\"$colspan\">Data Kosong</td></tr>";
}
echo "</table>";
/******akhir isi table normalisasi****/
/////////////////////////////////////////////////////////////////awal set header table perangkingan
echo "<p><h3>Normalisasi Matriks Keputusan</h3></p> <table> <tr><th rowspan='2'>Alternative</th><th colspan='$executeQueryTabel->num_rows'>Kriteria</th><th rowspan='2'>Hasil</th></tr><tr>";
foreach ($kriteriaArray as $namaKriteria) {
    echo "<th>$namaKriteria</th>";
}
/////////////////////////////////////////////////////////////////akhir set header table perangkingan
/******awal isi table perangkingan****/
if (!empty($supplierArray)){
    if (!empty($bobotArray)) {
        for ($j=0; $j< count($supplierArray); $j++) {
            $hasilakhir=0;
            echo "<tr id='data'><td>".$supplierArray[$j]['namaSupplier']."</td>";
                for ($k=0; $k<count($simpanrangking[$j]) ; $k++) {
                    echo "<td>".$hasil=$simpanrangking[$j][$k]."</td>";
                    $hasilakhir+=floatval($hasil);
                }
                    echo "<td>".round($hasilakhir,3)."</td>";
            echo"</tr>";
        }
    }else{
        echo "<tr class='text-center'><td colspan=\"$colspan\"><b>Bobot Kriteria tidak boleh kosong</b></td></tr>";
    }
}else{
    echo "<tr class='text-center'><td colspan=\"$colspan\">Data Kosong</td></tr>";
}
echo "</table>";
/******akhir isi table perangkingan****/
    $queryHasil="SELECT hasil.hasil AS hasil,jenis_barang.namaBarang,supplier.namaSupplier AS namaSupplier FROM hasil JOIN jenis_barang ON jenis_barang.id_jenisbarang=hasil.id_jenisbarang JOIN supplier ON supplier.id_supplier=hasil.id_supplier WHERE hasil.hasil=(SELECT MAX(hasil) FROM hasil WHERE id_jenisbarang='$cookiePilih')";
    $execute=$konek->query($queryHasil)->fetch_array(MYSQLI_ASSOC);
    echo "<p>Jadi rekomendasi pemilihan supplier <i>$execute[namaBarang]</i> jatuh pada <i>$execute[namaSupplier]</i> dengan Nilai <b>".round($execute['hasil'],3)."</b></p>";
echo "</div>";
}else{
    echo "<p class='text-center'><b>Pilih List Barang, untuk menampilkan hasil</b></p>";
}