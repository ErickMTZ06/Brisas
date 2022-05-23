<?php 
require("conexion.php");
session_start();

$usuario = $_POST['usuario'];
$pass_crypt = ($_POST['password']);

$consulta = ("SELECT * FROM usuarios WHERE username = '$usuario' AND password = '$pass_crypt'");
$consulta = mysqli_query($conexion, $consulta);

$array = mysqli_fetch_array($consulta);

if($array['id'] == 1) {
    $_SESSION['username'] = $usuario;
    header("location: ../admin/admin_home.php");
}else if($array['id']==2) {
    $_SESSION['username'] = $usuario;
    header("location: ../cliente/consulta.php");
} else {
    header("location: ../home.php");
}


?>