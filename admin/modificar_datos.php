<?php
session_start();

//Si la variable sesión está vacía
if (!isset($_SESSION['username'])) {
    /* Envía a la siguiente dirección en el caso de no poseer autorización */
    header("location:../home.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos-admin.css">
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Modificación de datos</title>
</head>

<body>
    <header>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d63384;">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active link-light" aria-current="page" href="#">Control de servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-light" href="recogidas.php">Recogidas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-light" href="buscar_empleado.php">Buscar empleado</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cuenta
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="modificar_datos.php">Administrar cuentas</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../BD/salir.php">Cerrar sesión</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Consulta de datos -->
    <?php
    include("../BD/conexion.php");
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conexion, $sql);
    ?>


    <!-- Tabla de registros -->
    <aside>
        <div class="contenedor-img-modificar">
            <img src="../source/footer-img.png" class="img-buscar">
        </div>
        <div class="table-registros-modificar">
            <table class="table table-hover">
                <thead class=" table table-secondary">
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Username</th>
                        <th>Contraseña</th>
                        <th>Editar</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($filas = mysqli_fetch_assoc($resultado)) {
                    ?>

                        <tr>
                            <td><?php echo $filas['id'] ?></td>
                            <td><?php echo $filas['nombre'] ?></td>
                            <td><?php echo $filas['apellidos'] ?></td>
                            <td><?php echo $filas['username'] ?></td>
                            <td><?php echo $filas['password'] ?></td>
                            <td><button type="button" class="btn btn-primary editbtn" data-bs-toggle="modal" data-bs-target="#editar">Editar</button></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </aside>

    <!-- Modal para editar -->
    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Al modificar tendrá que iniciar sesión de nuevo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="actualizar_cuenta_admin.php" method="post">
                        <input type="hidden" name="id" id="update_id">
                        <h6>Nombre</h6>
                        <input type="text" class="form-control mb-3" name="Nombre" id="Nombre">
                        <h6>Apellidos</h6>
                        <input type="text" class="form-control mb-3" name="Apellidos" id="Apellidos">
                        <h6>Username</h6>
                        <input type="text" class="form-control mb-3" name="Username" id="Username">
                        <h6>Ingrese nueva contraseña o contraseña actual para validar</h6>
                        <input type="password" class="form-control mb-3" name="Contraseña" id="Contraseña">

                        <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Actualizar">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de JS -->
    <!-- Script para mostrar datos en modal -->
    <script>
        $('.editbtn').on('click', function() {
            $tr = $(this).closest('tr');
            var datos = $tr.children('td').map(function() {
                return $(this).text();
            });
            $('#update_id').val(datos[0]);
            $('#Nombre').val(datos[1]);
            $('#Apellidos').val(datos[2]);
            $('#Username').val(datos[3]);
            $('#Contraseña').val(datos[4]);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>