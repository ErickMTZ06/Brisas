<?php include("../BD/conexion.php");
    // Archivo perteneciente a "recogidas.php"
    
    // Variables obtenidas a partir del formulario
    $num_serv=$_POST['num_serv'];
    $Comentario=$_POST['Comentario'];

    // Query para actualizar los datos de las recogidas
    $actualizar_recogida=("UPDATE recogidas SET comentario='$Comentario' WHERE id='$num_serv'");

    $actualizar_comentario=("UPDATE datos SET observaciones='$Comentario' WHERE num_serv='$num_serv'");

    $actualizar_respaldo=("UPDATE respaldo_datos SET observaciones='$Comentario' WHERE servicio='$num_serv'");

    $resultado_recogida = mysqli_query($conexion, $actualizar_recogida);
    $resultado_comentario = mysqli_query($conexion, $actualizar_comentario);
    $resultado_respaldo = mysqli_query($conexion, $actualizar_respaldo);

    // Condicional por si se efectúa o no el Query
    if ($resultado_recogida) {
        header("Location: recogidas.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("recogidas.php");
    } if ($resultado_comentario) {
        header("Location: recogidas.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("recogidas.php");
    }  if ($resultado_respaldo) {
        header("Location: recogidas.php");
    }else {
        echo "<script>alert('Datos no insertados');</script>";
        require ("recogidas.php");
    }

    // Cerrar conexión
    mysqli_close($conexion);
?>