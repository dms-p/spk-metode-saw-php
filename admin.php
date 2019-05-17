<?php
require './connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Dimas Aldi Pratama">
	<title>Sistem Pendukung keputusan pemilihan Supplier</title>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="asset/plugin/font-icon/css/fontawesome-all.min.css">
</head>
<body>
<header>
    <img src="asset/image/logo.svg" id="logo-header">
</header>
<nav>
    <?php include "nav.php"; ?>
</nav>
<main>
    <div id="bg-green"></div>
    <div id="main-body">
        <?php include "page.php"; ?>
    </div>
</main>
<script src="asset/js/jquery.js" type="text/javascript"></script>
<script src="asset/js/main.js" type="text/javascript"></script>
</body>
</html>