
<!DOCTYPE html>
<html>
<head>
    <title>::Login Page::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="asset/css/login.css">
    <link rel="stylesheet" type="text/css" href="asset/plugin/font-icon/css/fontawesome-all.min.css">
</head>
<body id="login">
<img src="asset/image/logo.svg" id="logo-login">
<div class="alert alert-red text-center" style="display:none;" id="alert"><i class="fa fa-info-circle fa-lg"></i><p id="value">sdasdasd</p></div>
<div id="panel-login">
    <form id="formlogin" method="POST" action="ceklogin.php">
        <div class="group-input">
            <label for="username">Username :</label>
            <input type="text" class="form-custom" required autocomplete="off" placeholder="Username" id="username" name="username" >
        </div>
        <div class="group-input">
            <label for="password">Password :</label>
            <input type="password" class="form-custom" required autocomplete="off" placeholder="Password" id="password" name="password" >
        </div>
        <button class="btn btn-green btn-full"><i class="fa fa-arrow-alt-circle-right text-white"></i> Login</button>
    </form>
</div>
<p>&copy dimas aldi</p>
<img src="asset/image/top-image.svg" id="hiasan"><br>
</body>
<script src="asset/js/jquery.js" type="text/javascript"></script>
<script src="asset/js/main.js" type="text/javascript"></script>
</html>