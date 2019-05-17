<div class="panel-top">
    <b class="text-green"><i class="fa fa-plus-circle text-green"></i> Tambah data</b>
</div>
<form id="form" method="POST" action="./proses/prosestambah.php">
    <input type="hidden" name="op" value="subkriteria">
    <div class="panel-middle">
        <div class="group-input">
            <label for="kriteria" >Kriteria :</label>
            <select class="form-custom" required id="kriteria" name="kriteria">
                <option selected disabled>-- Pilih Sifat Kriteria --</option>
                <?php
                $query="SELECT * FROM kriteria";
                $execute=$konek->query($query);
                if ($execute->num_rows > 0){
                    while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                        echo "<option value=\"$data[id_kriteria]\">$data[namaKriteria]</option>";
                    }
                }else {
                    echo "<option value=\"\">Belum ada kriteria</option>";
                }
                ?>
            </select>
        </div>
        <div class="group-input">
            <label for="Nilai" >Nilai :</label>
            <input type="text" class="form-custom" required autocomplete="off" placeholder="Nilai" id="Nilai" name="nilai">
        </div>
        <div class="group-input">
            <label for="keterangan" >Keterangan :</label>
            <input type="text" class="form-custom" required autocomplete="off" placeholder="Nama keterangan" id="keterangan" name="keterangan">
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>