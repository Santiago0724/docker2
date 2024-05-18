<?php 
    require 'database.php';

    $mess = '';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
    
        if($stmt->execute()){
            $mess = "Ha sido creado el usuario";
            exit;
        }else{
            $mess = "ha ocurrido un error creando su contraseña " . $stmt->errorInfo()[2];;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
   <link href="https://tresplazas.com/web/img/big_punto_de_venta.png" rel="shortcut icon">
   <title>Registro</title>
</head>

<body>



   <div class="container">
      <div class="img">
         <img src="img/login.webp">
      </div>
     
      <div class="login-content">
         <form method="post" action="signup.php">
            <img src="img/avatar.svg">
            <h2 class="title">REGISTRO</h2>
            <div class="input-div one">
               <div class="i">
                  <i class="fas fa-envelope"></i>
               </div>
               <div class="div">
                  <input id="email" type="text" class="input" name="email" required placeholder="Usuario">
               </div>
            </div>
            <div class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <input type="password" id="password" class="input" name="password" required placeholder="Contraseña">
               </div>
            </div>
            <?php 
    if(!empty($mess)) {
        echo '<p>' . $mess . '</p>'; // Mostrar el mensaje dentro de un párrafo HTML
    }
?>

            <div class="text-center">
               <a class="font-italic isai5" href="index.php">Iniciar session</a>
            </div>

            <input name="btnregistro" class="btn" type="submit" value="REGISTRARSE">
         </form>
      </div>
   </div>
   

</body>

</html>
