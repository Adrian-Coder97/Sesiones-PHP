<?php

session_start(); //este siempre va en todas las partes donde haiga sesiones 

/*if (isset($_SESSION["admin"])) { //si existe la sesion iniciada podermos dar la bienvenida y todo el contenido que queramos 

    echo "BIENVENIDO! " . $_SESSION["admin"];
    echo '<br><a href="cerrar.php">Cerrar Sesion</a>';
} else {
    header("location:registro.php"); //si no existe la sesion regresamos al registro
}*/


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body>
    <div class="container p-3">
        <?php
        if (isset($_SESSION["admin"])) { //si existe la sesion iniciada podermos dar la bienvenida y todo el contenido que queramos           
            echo "BIENVENIDO! " . $_SESSION["admin"];
            echo '<br><a href="cerrar.php">Cerrar Sesion</a>';
        } else {
            header("location:registro.php"); //si no existe la sesion regresamos al registro
        }
        ?>
        <img src="https://picsum.photos/1920/1080" alt="" class="rounded-circle" height="100px" width="130px">
    </div>

</body>

</html>