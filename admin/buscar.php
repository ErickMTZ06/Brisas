<?php

	// Archivo perteneciente a "buscar_empleado.php"
	
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "control_brisas";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

	// Query de mostrar datos y ordenar por ID

    $query = "SELECT * FROM respaldo_datos WHERE nombre NOT LIKE '' ORDER By servicio LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
		// Query para mostrar datos de respaldo donde se busquen por nombre y apellidos
    	$query = "SELECT * FROM respaldo_datos WHERE servicio LIKE '%$q%' OR nombre LIKE '%$q%' OR apellidos LIKE '%$q%'";
    }

    $resultado = $conn->query($query);

	// Condicional para mostrar tabla de datos si la query fue realizada
    if ($resultado->num_rows>0) {
    	$salida.="<table  class='tabla_datos'>
    			<thead>
    				<tr id='titulo'>
						<td>Command</td>
						<td>Date</td>
    					<td>Name</td>
    					<td>Surname</td>
    					<td>Room</td>
						<td>Pickup</td>
						<td>Service</td>
						<td>Comment</td>
    				</tr>

    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
						<td>".$fila['ticket']."</td>
						<td>".$fila['fecha']."</td>
    					<td>".$fila['nombre']."</td>
    					<td>".$fila['apellidos']."</td>
    					<td>".$fila['habitacion']."</td>
						<td>".$fila['recogida']."</td>
						<td>".$fila['estado_servicio']."</td>
						<td>".$fila['observaciones']."</td>
    				</tr>";

    	}
    	$salida.="</tbody></table>";
		// Mensaje al no encontrar registros
    }else{
    	$salida.="No hay registros que coincidan con la búsqueda realizada";
    }


    echo $salida;

	// Cerrar conexión

    $conn->close();



?>