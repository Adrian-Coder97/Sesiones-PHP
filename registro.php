<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container border p-3 mt-3 bg-white">
        <h3>Registrarse</h3>
            <form action="agregar_usuario.php" method="POST" class="d-flex flex-column justify-content-center align-items-center">
                <input type="text" name="nombre_usuario" placeholder="Ingresa usuario" class="form-control p-3 mt-2">
                <input type="text" name="contrasena" placeholder="Ingresa contraseña" class="form-control p-3 mt-2">
                <input type="text" name="contrasena2" placeholder="Ingresa contraseña nuevamente" class="form-control p-3 mt-2">
                <button type="submit" class="btn btn-success mt-2 w-75">Registrarse</button>
            </form>
    </div>


    <div class="container border p-3 mt-3 bg-white">
        <h3>Iniciar Sesion</h3>
        <form action="login.php" method="POST" class="d-flex flex-column justify-content-center align-items-center">
            <input type="text" name="nombre_usuario" placeholder="Ingresa usuario" class="form-control p-3 mt-2">
            <input type="text" name="contrasena" placeholder="Ingresa contraseña" class="form-control p-3 mt-2">
            <button type="submit" class="btn btn-primary mt-2 w-75">Ingresar</button>
        </form>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>