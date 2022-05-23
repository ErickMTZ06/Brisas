<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="estilos-admin.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Buscar empleado</title>
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
                            <a class="nav-link link-light" href="admin_home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-light" href="recogidas.php">Recogidas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-light" href="../BD/salir.php">Cerrar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link-light" onclick="HTMLtoPDF()">Descargar PDF</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Contenedor de caja de búsqueda y tabla de datos -->

    <div class="caja-busqueda">
        <input type="text" name="caja_busqueda" id="caja_busqueda" placeholder="Buscar empleado"></input>
    </div>
    <!-- Div con id para descargar PDF de los datos seleccionados al ingresar búsqueda -->
    <div id="HTMLtoPDF">
        <div class="contenedor-img">
            <img src="../source/footer-img.png" class="img-buscar">
        </div>
        <div class="contenedor-tabla">
            <table class="table" id="datos"></table>
        </div>
    </div>

    <div class="boton-depuracion_empleados">
        <aside>
            <!-- Botón para depurar datos -->
            <td><button type="button" class="btn deletedatageneral" style="background-color: #d63384; color: white;" data-bs-toggle="modal" data-bs-target="#delete_datageneral">Eliminar datos</button></td>
        </aside>
    </div>

    <!-- Modal para eliminar datos -->
  <div class="modal fade" id="delete_datageneral" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Depurar datos</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="deletedata_general.php" method="post">
            <h6>¿Seguro(a) de eliminar todos los datos?</h6>
            <input type="submit" class="btn" style="background-color: #d63384; color:white;" value="Eliminar">
          </form>
        </div>
      </div>
    </div>
  </div>

    <!-- Scripts de JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../JS/jquery.min.js"></script>
    <script type="text/javascript" src="../JS/main.js"></script>

    <!-- Archivos js para hacer PDF -->
    <script src="js/jspdf.js"></script>
    <script src="js/jquery-2.1.3.js"></script>
    <script src="js/pdfFromHTML.js"></script>
</body>

</html>