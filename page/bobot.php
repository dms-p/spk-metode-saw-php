<?php
require './connect.php';
?>
<!-- judul -->
<div class="panel">
    <div class="panel-middle" id="judul">
        <img src="asset/image/bobot.svg">
        <div id="judul-text">
            <h2 class="text-green">BOBOT</h2>
            Halamanan Administrator Bobot Kriteria
        </div>
    </div>
</div>
<!-- judul -->
<div class="row">
    <div class="col-4">
        <div class="panel">
            <?php
            if (@htmlspecialchars($_GET['aksi'])=='ubah'){
                include 'ubahbobot2.php';
            }elseif (@htmlspecialchars($_GET['aksi'])=='lihat'){
                include 'lihatbobot.php';
            }else{
                include 'tambahbobot2.php';
            }
            ?>
        </div>
    </div>
    <div class="col-8">
        <div class="panel">
            <div class="panel-top">
                <b class="text-green">Daftar Bobot</b>
            </div>
            <div class="panel-middle">
                <div class="table-responsive">
                    <table>
                        <thead><tr><th>No</th><th>Nama Barang</th><th>Aksi</th></tr></thead>
                        <tbody>
                        <?php
                        $query="SELECT bobot_kriteria.id_jenisbarang AS idbarangbobot,jenis_barang.namaBarang AS namaBarang FROM bobot_kriteria INNER JOIN jenis_barang WHERE bobot_kriteria.id_jenisbarang=jenis_barang.id_jenisbarang GROUP BY idbarangbobot ORDER BY idbarangbobot ASC";
                        $execute=$konek->query($query);
                        if ($execute->num_rows > 0){
                            $no=1;
                            while($data=$execute->fetch_array(MYSQLI_ASSOC)){
                                echo"
                                <tr id='data'>
                                    <td>$no</td>
                                    <td>$data[namaBarang]</td>
                                    <td>
                                    <div class='norebuttom'>
                                    <a class=\"btn btn-green\" href='./?page=bobot&aksi=lihat&id=".$data['idbarangbobot']."'><i class='fa fa-eye'></i></a>
                                    <a class=\"btn btn-light-green\" href='./?page=bobot&aksi=ubah&id=".$data['idbarangbobot']."'><i class='fa fa-pencil-alt'></i></a>
                                    <a class=\"btn btn-yellow\" data-a=".$data['namaBarang']." id='hapus' href='./proses/proseshapus.php/?op=bobot&id=".$data['idbarangbobot']."'><i class='fa fa-trash-alt'></i></a></td>
                                </div></tr>";
                                $no++;
                            }
                        }else{
                            echo "<tr><td  class='text-center text-green' colspan='4'><b>Kosong</b></td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-bottom"></div>
        </div>
    </div>
</div>