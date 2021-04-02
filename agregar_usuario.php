<?php
include_once '../yt_colores/conexion.php';//llamar a conexion.php de yt_colores
//echo password_hash("bluuweb", PASSWORD_DEFAULT)."\n";

$usuario_nuevo = $_POST["nombre_usuario"];//las variables deben tener un nombre diferente a las variables en el archivo conexion.php de yt_colores
$contrasena = $_POST["contrasena"];
$contrasena2 = $_POST["contrasena2"];

$sql = 'SELECT * FROM usuario WHERE nombre = ?';//verificar que el usuario exista en la base de datos 
$sentencia = $pdo->prepare($sql);
$sentencia->execute(array($usuario_nuevo));
$resultado = $sentencia->fetch();//fetch regresa un true o false de acuerdo a si encontro al usuario en la BD
var_dump($resultado);

if($resultado){//SI EL USUARIO YA EXISTE SE EJECUTA ESTE IF
    echo "<br> EL USUARIO YA EXISTE"; 
    die();//die hace que el codigo muera en ese punto y ya no se ejecute lo de abajo
}
//SI EL USUARIO NO EXISTE CONTINUA: 



$contrasena = password_hash($contrasena, PASSWORD_DEFAULT);//cifrar contraseña

echo "<pre>";
var_dump($usuario_nuevo);
var_dump($contrasena);
var_dump($contrasena2);
echo "<pre>";

if (password_verify($contrasena2, $contrasena)) {//comparar si las contraseñas son iguales 
    echo 'Password is valid!<br>';
    

     /*enviarlos a la base de datos*/
     $sql_agregar = "INSERT INTO usuario (nombre, contrasena) VALUES (?,?)"; //signos de interrogacion por seguridad
     $sentencia_agregar = $pdo->prepare($sql_agregar);
     if($sentencia_agregar->execute(array($usuario_nuevo, $contrasena))){ //en el array van el el mismo orden que irian en los signos de interrogracion 
        echo "datos guardados <br>";
     }else{
        echo "ERROR al guardar el usuario <br>";
     }
     
 
     /*cerrar la conexion de agregar:*/
     $sentencia_agregar = null;
     $pdo = null;
     //header("location:index.php"); //recargar la pagina cuando se envien los datos 
} else {
    echo 'Invalid password.';
}
