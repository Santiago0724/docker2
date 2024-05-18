<?php 
    require 'database.php';

    session_start(); 

    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if(count($results) > 0 ){
            $user = $results;
        }
    }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    <div class="custom-container">
        <h1>Bienvenido</h1>
        <p> Hola <?= $user['email']?> </p>
        <p>Has iniciado sesión correctamente.</p>
       
        <a href="logout.php">Cerrar sesión</a> 
    </div>
</body>
</html>

