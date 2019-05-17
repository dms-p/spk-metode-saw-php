<?php
$id=htmlspecialchars(@$_GET['id']);
$query="SELECT * FROM nilai_kriteria WHERE id_nilaikriteria='$id'";
$execute=$konek->query($query);
if ($execute->num_rows > 0){
    $data=$execute->fetch_array(MYSQLI_ASSOC);
}else{
    header('location:./?page=subkriteria');
}
?>
<div class="panel-top panel-top-edit">
    <b><i class="fa fa-pencil-alt"></i> Ubah data</b>
</div>
<form id="form" method="POST" action="./proses/prosesubah.php">
    <input type="hidden" name="op" value="subkriteria">
    <input type="hidden" name="id" value="<?php echo $data['id_nilaikriteria']; ?>">
    <div class="panel-middle">
        <div class="group-input">
            <label for="kriteria" >Kriteria :</label>
            <select class="form-custom" required id="kriteria" name="kriteria">
                <?php
                $query="SELECT * FROM kriteria";
                $execute=$konek->query($query);
                if ($execute->num_rows > 0){
                    while($data2=$execute->fetch_array(MYSQLI_ASSOC)){
                        if ($data2['id_kriteria']==$data['id_kriteria']){
                            $selected="selected";
                        }else{
                            $selected=null;
                        }
                        echo "<option $selected value=\"$data2[id_kriteria]\">$data2[namaKriteria]</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="group-input">
            <label for="Nilai" >Nilai :</label>
            <input type="text" value="<?php echo $data['nilai']; ?>" class="form-custom" required autocomplete="off" placeholder="Nilai" id="Nilai" name="nilai">
        </div>
        <div class="group-input">
            <label for="keterangan" >Keterangan :</label>
            <input type="text" value="<?php echo $data['keterangan'] ?>" class="form-custom" required autocomplete="off" placeholder="Nama keterangan" id="keterangan" name="keterangan">
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>