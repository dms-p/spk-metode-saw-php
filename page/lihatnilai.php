<?php
$a=htmlspecialchars(@$_GET['a']);
$b=htmlspecialchars(@$_GET['b']);
$querylihat="SELECT id_nilaisupplier,kriteria.namaKriteria AS namaKriteria,nilai_kriteria.keterangan AS keterangan FROM nilai_supplier
INNER JOIN kriteria USING (id_kriteria)
INNER JOIN nilai_kriteria USING (id_nilaikriteria)
WHERE nilai_supplier.id_supplier='$a' AND nilai_supplier.id_jenisbarang='$b'";
$execute2=$konek->query($querylihat);
if ($execute2->num_rows == 0){
    header('location:./?page=penilaian');
}
?>
<!-- judul -->
<div class="panel-top">
    <b class="text-green">Detail data</b>
</div>
<form>
    <div class="panel-middle">
        <div class="group-input">
            <?php
            $query="SELECT namaSupplier FROM supplier WHERE id_supplier='$a'";
            $execute=$konek->query($query);
            $data=$execute->fetch_array(MYSQLI_ASSOC);
            ?>
            <div class="group-input">
                <label for="jenisbarang">Nama Supplier</label>
                <input class="form-custom" value="<?php echo $data['namaSupplier'];?>" disabled type="text" autocomplete="off" required name="jenisbarang" id="jenisbarang">
            </div>
        </div>
        <div class="group-input">
            <?php
            $query="SELECT namaBarang FROM jenis_barang WHERE id_jenisbarang='$b'";
            $execute=$konek->query($query);
            $data=$execute->fetch_array(MYSQLI_ASSOC);
            ?>
            <div class="group-input">
                <label for="jenisbarang">Jenis Barang</label>
                <input class="form-custom" value="<?php echo $data['namaBarang'];?>" disabled type="text" autocomplete="off" required name="jenisbarang" id="jenisbarang" placeholder="jenisbarang">
            </div>
        </div>
        <?php
        $execute2=$konek->query($querylihat);
        while($data2=$execute2->fetch_array(MYSQLI_ASSOC)){
            echo "<div class=\"group-input\">
                        <label for=\"\">$data2[namaKriteria]</label>
                        <input class=\"form-custom\" value=\"$data2[keterangan]\" disabled type=\"text\" autocomplete=\"off\" required name=\"bobot[]\">
                      </div>
                ";
        }
        ?>
    </div>
    <div class="panel-bottom">
        <button type="submit" class="btn btn-green">Simpan</button>
        <button type="reset" class="btn btn-second">Reset</button>
    </div>
</form>