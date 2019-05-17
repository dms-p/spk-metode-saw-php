<?php
$id=htmlspecialchars(@$_GET['id']);
$query="SELECT * FROM kriteria WHERE id_kriteria='$id'";
$sifat=array("Benefit","Cost");
$execute=$konek->query($query);
if ($execute->num_rows > 0){
    $data=$execute->fetch_array(MYSQLI_ASSOC);
}else{
    header('location:./?page=kriteria');
}
?>
<div class="panel-top panel-top-edit">
    <b><i class="fa fa-pencil-alt"></i> Ubah data</b>
</div>
<form id="form" method="POST" action="./proses/prosesubah.php">
    <input type="hidden" name="op" value="kriteria">
    <input type="hidden" name="id" value="<?php echo $data['id_kriteria']; ?>">
    <div class="panel-middle">
        <div class="group-input">
            <label for="kriteria" >Nama Supplier :</label>
            <input type="text" value="<?php echo $data['namaKriteria']; ?>" class="form-custom" required autocomplete="off" placeholder="Nama Kriteria" id="kriteria" name="kriteria">
        </div>
        <div class="group-input">
            <label for="sifat" >Sifat kriteria :</label>
            <select class="form-custom" required id="sifat" name="sifat">
                <?php
                foreach ($sifat as $datasifat){
                    if ($datasifat == $data['sifat']){
                        $selected="selected";
                    }else{
                        $selected=null;
                    }
                    echo"<option $selected value=\"$datasifat\">$datasifat</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div class="panel-bottom">
        <button type="submit" id="buttonsimpan" class="btn btn-green"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="buttonreset" class="btn btn-second">Reset</button>
    </div>
</form>