<?php include("../BD/conexion.php");
    // Archivo perteneciente a "recogidas.php"
    
    // Query para eliminar los datos
    $eliminar = "DELETE FROM recogidas";
    $resultado = mysqli_query($conexion, $eliminar);

    // Condicional por si se efectúa o no el Query

    if (!$resultado) {
        echo "<script>alert('Error al eliminar');</script>";
        require ("recogidas.php");
    }else {
        header("Location: recogidas.php");
    }
    //Cerrar conexión

    mysqli_close($conexion);
?>