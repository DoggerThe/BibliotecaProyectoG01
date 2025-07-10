<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ecua Librería - Bibliotecario</title>
  <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/InicioGeneral.css">
  <link rel="stylesheet" href="/BibliotecaProyectoG01/assets/css/ListadoLibroBiblio.css">
</head>

<body>
  <div class="bibliotecario-container">

    <?php include __DIR__.'/../layout/layoutBibliotecario.php';?>
    <!-- Tabla que mostrará la lista de libros recuperados desde la base de datos -->
    <div class="container-General">
      <div class="Container-barra">
        <form class="barra-busqueda" id="form-busqueda">
          <input type="text" id="busqueda" name="busqueda" placeholder="Buscar...">
          <button type="submit">🔍</button>
        </form>
      </div>
      <div class="Container-Tabla">
        <h1>Lista de Libros</h1>
        <table id="tablaLibros">
          <thead>
            <tr>
              <th>Titulo</th>
              <th>Autor</th>
              <th>Cantidad Disponible</th>
            </tr>
          </thead>
          <tbody>
            <!-- Aquí se insertarán dinámicamente los registros de libros con JS -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script> 
    const rolUsuario = <?php echo isset($_SESSION['rolUsuario']) ? $_SESSION['rolUsuario'] : '0'?>;
    const idUsuario = <?php echo isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : '0'?>; 
  </script>
  <script src="/BibliotecaProyectoG01/assets/js/busquedaLibros.js"></script>
</body>

</html>