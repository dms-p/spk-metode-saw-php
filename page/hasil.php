<!-- judul -->
<div class="panel">
    <div class="panel-middle" id="judul">
        <img src="asset/image/rank.svg">
        <div id="judul-text">
            <h2 class="text-green">HASIL</h2>
            Halamanan Utama Hasil Penilaian
        </div>
    </div>
</div>
<!-- judul -->
<div class="panel">
    <div class="panel-top">
        <div style="float:left;width: 300px;">
            <select class="form-custom" name="pilih"  id="pilihHasil">
                <option disabled selected value="">-- Pilih Jenis Barang --</option>;
                <?php
                $query="SELECT*FROM jenis_barang";
                $execute=$konek->query($query);
                if ($execute->num_rows > 0){
                    while ($data=$execute->fetch_array(MYSQLI_ASSOC)){
                        echo "<option value=$data[id_jenisbarang]>$data[namaBarang]</option>";
                    }
                }else{
                    echo '<option disabled value="">Tidak ada data</option>';
                }
                ?>
            </select>
        </div>
        <div style="float: right;" class="input-dropdown">
            <a  class="btn btn-green" id="btn-dropdown" target="_blank" href="./cetakpdf.php"><i class="fa fa-print"></i> Cetak Pdf</a>
            <!--ul class="dropdown" id="panel-dropdown">
               <li><a href="./cetakexcel.php"><i class="fa fa-file-excel"></i> Cetak Excel</a></li>
                <li><a target="_blank" href="./cetakpdf.php"><i class="fa fa-file-pdf"></i> Cetak Pdf</a></li>
            </ul-->
        </div>
        <div style="clear: both"></div>
    </div>
    <div class="panel-middle">
        <div id="valueHasil">
            <p class='text-center'><b>Pilih List Barang, untuk menampilkan hasil</b></p>
        </div>
    </div>
    <div class="panel-bottom"></div>
</div>