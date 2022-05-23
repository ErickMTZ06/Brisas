<?php
session_start();
$usuario = $_SESSION['username'];

if (!isset($usuario)) {
    header("location: ../home.php");

    include("../BD/conexion.php");
    $empleados = "SELECT * FROM datos";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="reloj.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <title>Panel de consulta</title>
</head>

<body>

    <!-- Consulta de datos -->
    <?php
    include("../BD/conexion.php");
    $sql = "SELECT * FROM datos";
    $resultado = mysqli_query($conexion, $sql);
    ?>

        <!-- Reloj digital y código preterminado por si el script no funciona y poder modificarlo -->
        <div id="reloj" class="wrap">
            <div class="widget">
                <div class="fecha">
                    <p id="diaSemana" class="diaSemana">Martes</p>
                    <p id="dia" class="dia">27</p>
                    <p>de </p>
                    <p id="mes" class="mes">Octubre</p>
                    <p>del </p>
                    <p id="year" class="year">2015</p>
                </div>

                <div class="reloj">
                    <p id="horas" class="horas">11</p>
                    <p>:</p>
                    <p id="minutos" class="minutos">48</p>
                    <p>:</p>
                    <div class="caja-segundos">
                        <p id="ampm" class="ampm">AM</p>
                        <p id="segundos" class="segundos">12</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de registros -->
        <div class="contenedor-tabla_consulta">
            <table class="table table-light">
                <thead class=" table table-secondary">
                    <tr>
                        <th>Ticket</th>
                        <th>Nombre(s)</th>
                        <th>Apellidos</th>
                        <th>Habitación</th>
                        <th>Recogida</th>
                        <th>Servicio</th>
                        <th>Comentario</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($filas = mysqli_fetch_assoc($resultado)) {
                    ?>

                        <tr>
                            <td><?php echo $filas['ticket'] ?></td>
                            <td><?php echo $filas['nombre'] ?></td>
                            <td><?php echo $filas['apellidos'] ?></td>
                            <td><?php echo $filas['num_hab'] ?></td>
                            <td><?php echo $filas['hora_recogida'] ?></td>
                            <td><?php echo $filas['estado_servicio'] ?></td>
                            <td><?php echo $filas['observaciones'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <a href="../BD/salir.php" class=" btn btn-danger">Salir</a>
            <button class="btn btn-primary" id="boton" onclick="ocultar();">Ocultar reloj</button>
            <button class="btn btn-primary" id="boton" onclick="mostrar();">Mostrar reloj</button>

            <br><br><br><br><br><br><b><br><br><br><br><br><br><br>
            
        </div>
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Script de reloj -->
    <script src="funcion_reloj.js"></script>

    <!-- Script para mostrar/ocultar reloj -->
    <script src="ocultarmostrar.js"></script>

</body>

</html>