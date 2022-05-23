<?php include("../BD/conexion.php");
    // Archivo perteneciente a "recogidas.php"
    
    // Variables obtenidas a partir del formulario

    $name = $_POST["Nombre(s)"];
    $apellidos = $_POST["Apellidos"];
    $num_habitacion = $_POST["Habitacion"];
    $comentario = $_POST["Comentario"];

    // Query para insertar las recogidas

    $insertar = "INSERT INTO recogidas (nombre, apellidos, num_hab, comentario) VALUES ('$name', '$apellidos', '$num_habitacion', '$comentario')";
    $resultado = mysqli_query($conexion, $insertar);

    // Condicional por si se efectúa o no el Query

    if ($resultado) {
        header("Location: recogidas.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("recogidas.php");
    }

    // Cerrar conexión
    mysqli_close($conexion);

?>