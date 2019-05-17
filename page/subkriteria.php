<div class="panel">
    <div class="panel-middle" id="judul">
        <img src="asset/image/sub-kriteria.svg">
        <div id="judul-text">
            <h2 class="text-green">SUB KRITERIA</h2>
            Halamanan Administrator Sub Kriteria
        </div>
    </div>
</div>
<!-- judul -->
<div class="row">
    <div class="col-4">
        <div class="panel">
            <?php
            if (@htmlspecialchars($_GET['aksi'])=='ubah'){
                include 'ubahsubkriteria.php';
            }else{
                include 'tambahsubkriteria.php';
            }
            ?>
        </div>
    </div>
    <div class="col-8">
        <div class="panel">
            <div class="panel-top">
                <b style="float: left" class="text-green">Daftar Sub Kriteria</b>
                <div style="float:right;width: 250px;">
                    <select class="form-custom" name="pilih" id="pilih">
                        <option value="">Semua Kriteria</option>;
                        <?php
                        $query="SELECT id_kriteria,namaKriteria FROM kriteria";
                        $execute=$konek->query($query);
                        if ($execute->num_rows > 0){
                            while ($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                if ($pilih==$data[id_kriteria]) {
                                    $selected="selected";
                                }else{
                                    $selected=null;
                                }
                                echo "<option $selected value=$data[id_kriteria]>$data[namaKriteria]</option>";
                            }
                        }else{
                            echo '<option disabled value="">Tidak ada data</option>';
                        }
                        ?>
                    </select>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="panel-middle">
                <div class="table-responsive">
                    <table>
                        <thead><tr><th>No</th><th>Nama</th><th>Sifat</th><th>Sifat</th><th>Aksi</th></tr></thead>
                        <tbody id="isiSubkriteria"></tbody>
                    </table>
                </div>
            </div>
            <div class="panel-bottom"></div>
        </div>
    </div>
</div>