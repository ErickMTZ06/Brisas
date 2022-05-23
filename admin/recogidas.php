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
  <link rel="stylesheet" href="slider.css">
  <script src="jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <title>Registro de recogidas</title>
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
              <a class="nav-link active" aria-current="page" >Control de servicios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin_home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link link-light" href="buscar_empleado.php">Buscar empleado</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../BD/salir.php">Cerrar sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Consulta de datos -->
  <?php
  include("../BD/conexion.php");
  $sql = "SELECT * FROM recogidas";
  $resultado = mysqli_query($conexion, $sql);
  ?>

  <!-- contenedor general -->
  <div class="container mt-5">
  <img src="../source/footer-img.png" class="img" alt="...">
    <div class="row">
      <h4>Inserte las observaciones al finalizar un servicio</h4>
      <!-- Tabla de registros -->
      <div class="col-md-12">
        <table class="table table-light">
          <thead class=" table table-secondary">
            <tr>
              <th>No. Servicio</th>
              <th>Nombre(s)</th>
              <th>Apellidos</th>
              <th>Comanda</th>
              <th>Habitación</th>
              <th>Hora a recoger</th>
              <th>Comentario</th>
              <th></th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php
            while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>

              <tr>
                <td><?php echo $filas['id'] ?></td>
                <td><?php echo $filas['nombre'] ?></td>
                <td><?php echo $filas['apellidos'] ?></td>
                <td><?php echo $filas['ticket'] ?></td>
                <td><?php echo $filas['num_hab'] ?></td>
                <td><?php echo $filas['hora_recogida'] ?></td>
                <td><?php echo $filas['comentario'] ?></td>

                <td><button type="button" class="btn btn-primary editbtnrecogida" data-bs-toggle="modal" data-bs-target="#editar_recogida">Editar</button></td>
                <td><button type="button" class="btn btn-danger deletebtnrecogida" data-bs-toggle="modal" data-bs-target="#deletebtnrecogida">Borrar</button></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <!-- Botón para descargar PDF -->
        <button class="btn btn-danger"><a class="link-light" href="../pdf_recogidas.php">Descargar PDF </a></button>
        <!-- Botón para depurar -->
        <td><button type="button" class="btn deletedata" style="background-color: #d63384; color: white;" data-bs-toggle="modal" data-bs-target="#delete_data">Eliminar datos</button></td>
        <br><br>
      </div>
    </div>
  </div>

  <div class="slider">
        <ul>
            <li><img src="img/1.jpg" alt=""></li>
            <li><img src="img/2.jpg" alt=""></li>
            <li><img src="img/3.jpg" alt=""></li>
            <li><img src="img/4.jpg" alt=""></li>
        </ul>
    </div>

  <!-- Modal para editar comentario-->
  <div class="modal fade" id="editar_recogida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar comentario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="actualizar_recogida.php" method="post">
            <input type="hidden" class="form-control mb-3" name="num_serv" id="update_id_recogida" placeholder="Número de servicio ">
            <h6>Comentario</h6>
            <input type="text" class="form-control mb-3" name="Comentario" id="Comentario">

            <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Actualizar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para eliminar -->
  <div class="modal fade" id="deletebtnrecogida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar recolección</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="eliminar_recogida.php" method="post">
            <h6>Id de reocgida</h6>
            <input type="text" readonly name="id_recogida" id="id_recogida">
            <h6>Realizado por</h6>
            <input type="text" readonly name="nombre_recogida" id="nombre_recogida"><input type="text" readonly name="apellido_recogida" id="apellido_recogida">
            <h6>Comentario...</h6>
            <input type="text" readonly name="comentario_recogida" id="comentario_recogida">

            <h6>Este dato al ser eliminado no afecta a la pantalla cliente y se guarda una copia para consultas posteriores.</h6>
            <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Eliminar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para eliminar datos de recogidas -->
  <div class="modal fade" id="delete_data" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Depurar datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="deletedata_recogidas.php" method="post">
            <h6>¿Seguro(a) de eliminar todos los datos?</h6>
            <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Eliminar">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts de JS -->

  <script>
    $('.editbtnrecogida').on('click', function() {
      $tr=$(this).closest('tr');
      var datos=$tr.children('td').map(function() {
        return $(this).text();
      });
      $('#update_id_recogida').val(datos[0]);
      $('#Comentario').val(datos[7]);
    });
  </script>

<script>
    $('.deletebtnrecogida').on('click', function() {
      $tr=$(this).closest('tr');
      var datos=$tr.children('td').map(function() {
        return $(this).text();
      });
      $('#id_recogida').val(datos[0]);
      $('#nombre_recogida').val(datos[1]);
      $('#apellido_recogida').val(datos[2]);
      $('#comentario_recogida').val(datos[7]);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>