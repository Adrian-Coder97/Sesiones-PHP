<?php
session_start();//este siempre va en todas las partes donde haiga sesiones 

include_once '../yt_colores/conexion.php'; //llamar a conexion.php de yt_colores

$usuario_login = $_POST["nombre_usuario"];
$contrasena_login = $_POST["contrasena"];

echo "<pre>"; //el pre solo es para que se imprima ordenadamente 
var_dump($usuario_login);
var_dump($contrasena_login);
echo "<pre>";

$sql = 'SELECT * FROM usuario WHERE nombre = ?'; //verificar que el usuario existe en la base de datos 
$sentencia = $pdo->prepare($sql);
$sentencia->execute(array($usuario_login));
$resultado = $sentencia->fetch(); //fetch regresa un true o false de acuerdo a si encontro al usuario en la BD

echo "<pre>";
var_dump($resultado);
echo "<pre>";

if (!$resultado) {
    //matar la operacion 
    echo "NO EXISTE USUARIO";
    die();
}

//SI EL USUARIO SI EXISTE CONTINUA: 
//echo "USUARIO VERIFICADO";

echo "<pre>";
var_dump($resultado["contrasena"]); //recuperar la contraseña del usuasrio 
echo "<pre>";

if (password_verify($contrasena_login, $resultado["contrasena"])) {
    //LAS CONTRASEÑAS SON IGUALES 
    $_SESSION["admin"] = $usuario_login; 
    header("Location: restringido.php"); 
} else {
    echo "NO SON IGUALES LAS CONTRASEÑAS";
    die();
}
