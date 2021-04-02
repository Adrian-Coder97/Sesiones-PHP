<?php

session_start();//este siempre va en todas las partes donde haiga sesiones 

if(isset($_SESSION["admin"])){//si existe la sesion iniciada podermos dar la bienvenida y todo el contenido que queramos 
    echo "BIENVENIDO! ".$_SESSION["admin"];
    echo '<br><a href="cerrar.php">Cerrar Sesion</a>';
}else{
    header("location:registro.php");//si no existe la sesion regresamos al registro
}