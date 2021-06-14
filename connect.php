<?php
$konek=new mysqli('localhost','root','','spksaw');
if ($konek->connect_error){
    "Database Error".$konek->connect_error;
}
?>