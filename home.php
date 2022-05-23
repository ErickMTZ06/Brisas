<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-css.css">
    <title>Iniciar sesión</title>
</head>

<body class="fondo_login">
    <form action="./BD/loguear.php" class="form-register" method="post">
        <div class="container-img">
            <img src="./source/footer-img.png" alt="">
        </div>
        <p class="titulo-form">Hola!, Por favor identifícate</p>
        <input type="text" class="controls" name="usuario" placeholder="Ingrese usuario" required>
        <input type="password" class="controls" name="password" placeholder="Introduzca contraseña" requireds>
        <input type="submit" class="botons" value="Iniciar sesión">
    </form>
</body>

</html>