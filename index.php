<?php
require_once 'init.php';

$PDO = db_connect();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>GI - Gestão Integrada</title>
    <link rel="stylesheet" type="text/css" href="css/stilo.css">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width" scale="1">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body
style="background-image:  url('./img/Cazal-logotipo.jpeg'); background-repeat: no-repeat; background-attachment: fixed; background-size: 100% 100%; ">

    <div class="container" id="cabecalho" style=" color: whitesmoke; width: 500px; margin-top: 1%; ">
        <div class="border border-primary" style="border-radius: 5mm;">
            <form action="acesso.php" method="post">
                <div class="container" style="margin-left: 15%;">
                    <div class="container">
                        <br>
                        <div class="col-md-8">
                            <label></label>
                            <input class="form-control" type="text" name="user" id="user" placeholder="Usuario"
                                autofocus autocomplete="off" readonly
                                onfocus="this.removeAttribute('readonly');this.select();" required>
                        </div>
                        <div class="col-md-10">
                            <label></label>
                            <input class="form-control" type="password" name="password" id="password"
                                placeholder="Senha" autocomplete="off" readonly
                                onfocus="this.removeAttribute('readonly');this.select();" required>
                        </div>
                        <br>
                        <div class="col-md-5 ">
                            <label for="validationServer02"></label>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </div>

</body>

</html>