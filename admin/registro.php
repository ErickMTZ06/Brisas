<?php include("../BD/conexion.php");
    // Archivo perteneciente a "admin_home.php"
    // Variables obtenidas a partir del formulario

    $ticket= $_POST["Ticket"];
    $fecha= $_POST["Fecha"];
    $name = $_POST["Nombre(s)"];
    $apellidos= $_POST["Apellidos"];
    $num_habitacion = $_POST["Habitacion"];
    $ingreso = $_POST["Ingreso"];
    $hora_recogida = $_POST["Recogida"];
    $select_servicio= $_POST["select_servicio"];

    // Query para insertar los datos

    $insertar = "INSERT INTO datos (ticket, fecha, nombre, apellidos, num_hab, ingreso,hora_recogida, estado_servicio) 
    VALUES ('$ticket', '$fecha', '$name', '$apellidos', '$num_habitacion', '$ingreso', '$hora_recogida', '$select_servicio')";

    $insertar_respaldo = "INSERT INTO respaldo_datos (ingreso, ticket, fecha, nombre, apellidos, habitacion, recogida, estado_servicio) VALUES 
    ('$ingreso','$ticket', '$fecha', '$name', '$apellidos', '$num_habitacion', '$hora_recogida', '$select_servicio') ";

    $insertar_recogida = "INSERT INTO recogidas (nombre, apellidos, ticket, fecha, num_hab, hora_recogida, estado_servicio) VALUES 
    ('$name', '$apellidos', '$ticket', '$fecha', '$num_habitacion', '$hora_recogida', '$select_servicio') ";


    $resultado = mysqli_query($conexion, $insertar);
    $resultado_respaldo = mysqli_query($conexion, $insertar_respaldo);
    $resultado_recogida = mysqli_query($conexion, $insertar_recogida);

    // Condicional por si se efectúa o no el Query
    if ($resultado) {
        header("Location: admin_home.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("admin_home.php");
    } if ($resultado_respaldo) {
        header("Location: admin_home.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("admin_home.php");
    } if ($resultado_recogida) {
        header("Location: admin_home.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("admin_home.php");
    }

    // Cerrar conexión 
    mysqli_close($conexion);

?>