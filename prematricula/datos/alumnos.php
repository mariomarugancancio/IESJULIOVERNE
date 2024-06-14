<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ESO</title>
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/d7bc41fc30.js" crossorigin="anonymous"></script>
  <script src="../js/paginacion.js"></script>
</head>
<body >
 <?php
        include('./../nav.php');
    ?>
    
<div class="col-lg-3 col-md-6 my-2">
                    <div class="input-group">
                        <span class="input-group-text">Asignaturas</span>
                        <input type="text" id="filtro" class="form-control" placeholder="Buscador">
                    </div>
                </div>
  
    <table  id="tablaAlumnos" class="table  table-bordered table-striped table-hover text-center" >
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido 1</th>
      <th scope="col">Apellido 2</th>
      <th scope="col">Editar</th>
      <th scope="col">Borrar</th>
    </tr>
  </thead>
  <tbody>
  <?php
// Iniciamos la sesion
require_once("../../archivosComunes/conexion.php");
$curso = $_GET['curso'];

$select = "SELECT am.cod_alumnosMatriculados, am.nombre_alumno, am.primer_apellido_alumno, am.segundo_apellido_alumno
            FROM AlumnosMatriculados am, Matriculas m
            WHERE m.usuario = am.cod_alumnosMatriculados AND m.curso = '".$curso."';";
$resul = $db->query($select);
$i=0;
// Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
    $i = $i+1;
    echo "<tr id='".$i."' class='fila-tabla'>";
    // Recorremos las columnas de la fila actual
    echo '<td>'.$columna['nombre_alumno'].'</td>';
    echo '<td>'.$columna['primer_apellido_alumno'].'</td>';
    echo '<td>'.$columna['segundo_apellido_alumno'].'</td>';
    echo '<td> <a href="#"  class="btn-editar" onclick="editarMatricula('.$columna['cod_alumnosMatriculados'].')"><i class="fa-solid fa-pencil"></i></a> </td>';
    echo '<td> <a href="#"  class="btn-borrar" onclick="eliminarMatricula('.$columna['cod_alumnosMatriculados'].')"><i class="fa-solid fa-trash"></i></a> </td>';
    echo "</tr>";
}
?>

      
  </tbody>
  
</table>
<div class="d-flex justify-content-center mt-5" id="tablaPaginacion">

<nav aria-label="Page navigation example">
    <ul class="pagination" id="paginacion">

    </ul>
</nav>

</div>

    <?php
    include('./../footer.php');
    ?>
</body>
</html>