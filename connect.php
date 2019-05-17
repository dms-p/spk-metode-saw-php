<?php
$konek=new mysqli('localhost','root','','spksaw');
if ($konek->connect_errno){
    "Database Error".$konek->connect_error;
}
?>