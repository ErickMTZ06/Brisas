<?php include("../BD/conexion.php");
    // Archivo perteneciente a "admin_home.php" y "recogidas.php"

    // Variable que obtiene la ID

    $num_serv=$_POST['id_servicio'];
    
    // Query para eliminar el dato donde el número de servicio sea igual a la variable obtenida
    $eliminar = "DELETE FROM datos WHERE num_serv = '$num_serv'";
    $resultado = mysqli_query($conexion, $eliminar);

    // Condicional por si se efectúa o no el Query

    if (!$resultado) {
        echo "<script>alert('Error al eliminar');</script>";
        require ("admin_home.php");
    }else {
        header("Location:admin_home.php");
    }

    //Cerrar conexión

    mysqli_close($conexion);
