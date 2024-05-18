<?php

    require 'database.php';

    session_start();

    $mess = '';
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        

        if ($results !== false && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: inicio.php');
            exit;
        }else{
            $mess = "Lo siento esas credenciales no coiciden";
        }

       
    }        
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
    <title>Inicio de sesión</title>
</head>

<body>

    <div class="container">
        <div class="img">
            <img src="img/login.webp">
        </div>
        
        <div class="login-content">
        <form method="post" action="index.php">
    <img src="img/avatar.svg">
    <h2 class="title">BIENVENIDO</h2>

    <div class="input-div one">
        <div class="i">
            <i class="fas fa-user"></i>
        </div>
        <div class="div">
            <input id="email" type="text" class="input" name="email" placeholder="Usuario">
        </div>
    </div>
    <div class="input-div pass">
        <div class="i">
            <i class="fas fa-lock"></i>
        </div>
        <div class="div">
            <input type="password" id="password" class="input" name="password" placeholder="Contraseña">
        </div>
    </div>
    <div class="view">
        <div class="fas fa-eye verPassword" onclick="vista()" id="verPassword"></div>
    </div>
    <?php if(!empty($mess)) { ?>
        <p> <?= $mess ?> </p>
        <?php } ?>


    <div class="text-center">
        <a class="font-italic isai5" href="signup.php">Registrarse</a>
    </div>
    <input name="btningresar" class="btn" type="submit" value="INICIAR SESION">
</form>

        </div>
    </div>

</body>

</html>
