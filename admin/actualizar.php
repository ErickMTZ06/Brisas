<?php include("../BD/conexion.php");
    // Archivo perteneciente a "admin_home.php"

    // Variables a recibir del formulario modal
    $id=$_POST['id'];
    $Ticket = $_POST['Ticket'];
    $Fecha = $_POST['Fecha'];
    $Nombres = $_POST['Nombre(s)'];
    $Apellidos = $_POST['Apellidos'];
    $Habitacion = $_POST['Habitacion'];
    $Ingreso = $_POST['Ingreso'];
    $Recogida = $_POST['Recogida'];
    $Servicio = $_POST['select_servicio'];

    // Query para actualizar los datos

    $actualizar=("UPDATE datos SET ticket='$Ticket', fecha='$Fecha', nombre='$Nombres', apellidos='$Apellidos', num_hab='$Habitacion', ingreso='$Ingreso', hora_recogida='$Recogida', estado_servicio='$Servicio' WHERE num_serv='$id'");
    $resultado = mysqli_query($conexion, $actualizar);

    $actualizar_recogidas=("UPDATE recogidas SET nombre='$Nombres', apellidos='$Apellidos', ticket='$Ticket', fecha='$Fecha', num_hab='$Habitacion', hora_recogida='$Recogida', estado_servicio='$Servicio' WHERE id='$id'");
    $resultado_recogidas = mysqli_query($conexion, $actualizar_recogidas);

    $actualizar_respaldo=("UPDATE respaldo_datos SET ingreso='$Ingreso', ticket='$Ticket', fecha='$Fecha', nombre='$Nombres', apellidos='$Apellidos', habitacion='$Habitacion', recogida='$Recogida', estado_servicio='$Servicio' WHERE servicio='$id'");
    $resultado_respaldo = mysqli_query($conexion, $actualizar_respaldo);

    // Condicional por si se realizó Query
   
    if ($resultado) {
        header("Location: admin_home.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("admin_home.php");
    }if ($resultado_respaldo) {
        header("Location: admin_home.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("admin_home.php");
    } if ($resultado_recogidas) {
        header("Location: admin_home.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("admin_home.php");
    }

    // Cerrar conexión

    mysqli_close($conexion);
