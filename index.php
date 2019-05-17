<?php
session_start();
if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
    include 'login.php';
}else{
    include 'admin.php';
}