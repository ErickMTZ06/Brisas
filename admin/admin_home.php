<?php
session_start();

//Si la variable sesión está vacía
if (!isset($_SESSION['username'])) {
  /* Envía a la siguiente dirección en el caso de no poseer autorización */
  header("location:../home.php");
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="estilos-admin.css">
  <script src="jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <title>Panel de administrador</title>
</head>

<body>
  <header>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #d63384;">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active link-light" aria-current="page">Control de servicios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-light" href="recogidas.php">Recogidas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-light" href="buscar_empleado.php">Buscar empleado</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cuenta
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="modificar_datos.php">Administrar cuentas</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="../BD/salir.php">Cerrar sesión</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Consulta de datos -->
  <?php
  include("../BD/conexion.php");
  $sql = "SELECT * FROM datos";
  $resultado = mysqli_query($conexion, $sql);
  ?>


  <!-- Formulario de registro -->
  <div class="form-registro">
    <img src="../source/footer-img.png" class="img" alt="...">
    <h5>Ingresar servicio</h5>
    <form action="registro.php" method="post">
      <input type="number" class="form-control" name="Ticket" placeholder="No. de comanda" required>
      <input type="date" class="form-control" name="Fecha" required>
      <input type="text" class="form-control" name="Nombre(s)" placeholder="Nombre(s)" required>
      <input type="text" class="form-control" name="Apellidos" placeholder="Apellidos" required>
      <input type="number" class="form-control" name="Habitacion" placeholder="No. habitación" required>
      <h6>Ingreso</h6>
      <input type="time" class="form-control mb-3" name="Ingreso" required>
      <h6>Recogida</h6>
      <input type="time" class="form-control mb-3" name="Recogida">
      <h6>Servicio...</h6>
      <select class="form-control" name="select_servicio">
        <option value="Pendiente" selected>Pendiente</option>
        <option value="OK">Ok</option>
      </select>
      <input type="submit" class="btn" style="background-color: #d63384; color:white;">
    </form>
  </div>

  <!-- Tabla de registros -->
  <aside>
    <div class="table-registros">
      <table class="table table-light">
        <thead class=" table table-secondary">
          <tr>
            <th>No. Servicio</th>
            <th>No. de Comanda</th>
            <th>Fecha</th>
            <th>Nombre(s)</th>
            <th>Apellidos</th>
            <th>Habitación</th>
            <th>Ingreso comanda</th1>
            <th>Hora a recoger</th>
            <th>Estado servicio</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
 
        <tbody>
          <?php
          while ($filas = mysqli_fetch_assoc($resultado)) {
          ?>

            <tr>
              <td><?php echo $filas['num_serv'] ?></td>
              <td><?php echo $filas['ticket'] ?></td>
              <td><?php echo $filas['fecha'] ?></td>
              <td><?php echo $filas['nombre'] ?></td>
              <td><?php echo $filas['apellidos'] ?></td>
              <td><?php echo $filas['num_hab'] ?></td>
              <td><?php echo $filas['ingreso'] ?></td>
              <td><?php echo $filas['hora_recogida'] ?></td>
              <td><?php echo $filas['estado_servicio'] ?></td>
              <td><button type="button" class="btn btn-primary editbtn" data-bs-toggle="modal" data-bs-target="#editar">Editar</button></td>
              <td><button type="button" class="btn btn-danger deletebtn" data-bs-toggle="modal" data-bs-target="#eliminar">Borrar</button></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
      <!-- Botón para descargar PDF -->
      <button class="btn btn-danger"><a class="link-light" href="../pdf_general.php">Descargar PDF </a></button>
      <!-- Botón para depurar datos -->
      <td><button type="button" class="btn deletedatamain" style="background-color: #d63384; color: white;" data-bs-toggle="modal" data-bs-target="#delete_datamain">Eliminar datos</button></td>
    </div>
  </aside>

  <!-- Modal para editar -->
  <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modificar datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="actualizar.php" method="post">
            <input type="hidden" name="id" id="update_id">
            <h6>No. de ticket</h6>
            <input type="number" class="form-control" name="Ticket" id="Ticket" placeholder="No. de comanda">
            <input type="date" class="form-control" name="Fecha" id="Fecha" required>
            <h6>Datos del empleado</h6>
            <input type="text" class="form-control" name="Nombre(s)" id="Nombres" placeholder="Nombre(s)">
            <input type="text" class="form-control" name="Apellidos" id="Apellidos" placeholder="Apellidos">
            <h6>No. de habitación</h6>
            <input type="number" class="form-control" name="Habitacion" id="Habitacion" placeholder="No. habitación">
            <h6>Hora de ingreso de ticket</h6>
            <input type="time" class="form-control mb-3" name="Ingreso" id="Ingreso">
            <h6>Hora de recogida</h6>
            <input type="time" class="form-control mb-3" name="Recogida" id="Recogida">
            <h6>Estado servicio</h6>
            <select class="form-control mb-3" name="select_servicio" id="select_servicio">
              <option value="Pendiente" selected>Pendiente</option>
              <option value="OK">Ok</option>
            </select>

            <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Actualizar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para eliminar -->
  <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Seguro de eliminar el registro?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="eliminar.php" method="post">
            <h6>Número de servicio</h6>
            <input type="text" readonly name="id_servicio" id="id_servicio">
            <h6>El sistema guarda una copia del servicio para consultas posteriores.</h6>
            <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Eliminar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para eliminar datos -->
  <div class="modal fade" id="delete_datamain" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"> 
          <h5 class="modal-title" id="exampleModalLabel">Depurar datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="deletedata_admin_home.php" method="post">
            <h6>¿Seguro(a) de eliminar todos los datos?</h6>
            <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Eliminar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts de JS -->
  <!-- Script para mostrar datos en modal -->
  <script>
    $('.editbtn').on('click', function() {
      $tr = $(this).closest('tr');
      var datos = $tr.children('td').map(function() {
        return $(this).text();
      });
      $('#update_id').val(datos[0]);
      $('#Ticket').val(datos[1]);
      $('#Fecha').val(datos[2]);
      $('#Nombres').val(datos[3]);
      $('#Apellidos').val(datos[4]);
      $('#Habitacion').val(datos[5]);
      $('#Ingreso').val(datos[6]);
      $('#Recogida').val(datos[7]);
      $('#select_servicio').val(datos[8]);
    });
  </script>

  <!-- Script para mostrar datos en modal para eliminar -->
  <script>
    $('.deletebtn').on('click', function() {
      $tr = $(this).closest('tr');
      var datos = $tr.children('td').map(function() {
        return $(this).text();
      });
      $('#id_servicio').val(datos[0]);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>