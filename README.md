# Sesiones-PHP

1. En registro PHP

```
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>REGISTRO USUARIOS</h3>
    <form action="agregar_usuario.php" method="POST">
        <input type="text" name="nombre_usuario" placeholder="Ingresa usuario">
        <input type="text" name="contrasena" placeholder="Ingresa contraseña">
        <input type="text" name="contrasena2" placeholder="Ingresa contraseña nuevamente">
        <button type="submit">Guardar</button>
    </form>

    <h3>LOGIN</h3>
    <form action="login.php" method="POST">
        <input type="text" name="nombre_usuario" placeholder="Ingresa usuario">
        <input type="text" name="contrasena" placeholder="Ingresa contraseña">
        <button type="submit">Guardar</button>
    </form>
</body>

</html>
```

2. En agregar usuario.php 
```
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
```
3. En login.php 

```
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
```

4. En restringido.php

```

<?php

session_start();//este siempre va en todas las partes donde haiga sesiones 

if(isset($_SESSION["admin"])){//si existe la sesion iniciada podermos dar la bienvenida y todo el contenido que queramos 
    echo "BIENVENIDO! ".$_SESSION["admin"];
    echo '<br><a href="cerrar.php">Cerrar Sesion</a>';
}else{
    header("location:registro.php");//si no existe la sesion regresamos al registro
}

```

5.En cerrar.php 

```

<?php
//ESTO ES PARA DESTRUIR TODO LO QUE HEMOS CREADO DE LA SESION 
// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

// Unset all of the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
header("location:registro.php")//REGRESAR AL REGISTRO
?>

```
