<?php 
    include("../BD/conexion.php"); 
    // Archivo perteneciente a "modificar_datos.php"

    // Variables a recibir del formulario
     $usuario = utf8_encode($_POST['Username']);
     $pass_crypt = utf8_encode($_POST['Contraseña']);
     $name = utf8_encode($_POST['Nombre']);
     $apellidos = utf8_encode($_POST['Apellidos']);
     $id = $_POST['id'];

    // Query para actualizar los datos

     $actualizar=("UPDATE usuarios SET username='$usuario', nombre='$name', apellidos='$apellidos', password='$pass_crypt' WHERE id ='$id'");
     $resultado = mysqli_query($conexion, $actualizar);
     

     if ($resultado) {
        echo "<script>alert('Datos actualizados, volver a inciar sesión');</script>";
        header("Location: ../home.php");
        session_destroy();
        exit();
    }else {
        echo "<script>alert('Datos no actualizados');</script>";
        require ("modificar_datos.php");
    }


    // Cerrar conexión
     mysqli_close($conexion);
?>