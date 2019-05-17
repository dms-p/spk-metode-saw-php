
<!-- judul -->
<div class="panel-top">
    <b class="text-green"><i class="fa fa-plus-circle text-green"></i> Tambah data</b>
</div>
<form id="form" action="./proses/prosestambah.php" method="POST">
    <input type="hidden" value="bobot" name="op">
    <div class="panel-middle">
        <div class="group-input">
            <label for="barang">Jenis Barang</label>
            <select class="form-custom" required name="barang" id="barang">
                <option selected disabled>--Pilih Jenis Barang--</option>
                <?php
                $query="SELECT * FROM jenis_barang";
                $execute=$konek->query($query);
                if ($execute->num_rows > 0){
                    while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                        echo "<option value=\"$data[id_jenisbarang]\">$data[namaBarang]</option>";
                    }
                }else {
                    echo "<option value=\"\">Belum ada Jenis Barang</option>";
                }
                ?>
            </select>
        </div>
        <?php
        $query="SELECT * FROM kriteria";
        $execute=$konek->query($query);
        if ($execute->num_rows > 0){
            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                echo "<div class=\"group-input\">
                        <label for=\"$data[namaKriteria]\">$data[namaKriteria]</label>
                        <input type='hidden' value=$data[id_kriteria] name='kriteria[]'>
                            <input class=\"form-custom\" type=\"text\" autocomplete=\"off\" required name=\"bobot[]\" id=\"$data[namaKriteria]\" placeholder=\"Nilai $data[namaKriteria]\">
                      </div>
                ";
            }
        }
        ?>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>