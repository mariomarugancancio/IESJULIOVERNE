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
  <link rel="shortcut icon" href="../../images/logoJulioVerneNuevo.png">

</head>
<body >
 <?php
        include('./../nav.php');
    ?>
 <div class="row justify-content-between">
   
<div class="col-lg-3 col-md-6 my-2">
                    <div class="input-group">
                        <span class="input-group-text">Buscador</span>
                        <input type="text" id="filtro" class="form-control" placeholder="Buscador">
                    </div>
                </div>
                <?php if (isset($_GET['curso'])) {
                  $curso = $_GET['curso'];
                  ?>
                <div class="col-lg-3 col-md-6 my-2">
                <form action="generarCSV.php?curso=<?php echo $curso; ?>" method="post">
                <button type="submit" class="btn btn-success p-2">Generar CSV</button>
                </form>
                </div>
                </div>
                <?php } ?>


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
if (isset($_GET['curso'])) {
  $curso = $_GET['curso'];

$select = "SELECT am.cod_alumnosMatriculados, am.nombre_alumno, am.primer_apellido_alumno, am.segundo_apellido_alumno
            FROM AlumnosMatriculados am, Matriculas m
            WHERE m.cod_matricula = am.cod_alumnosMatriculados AND m.curso = '".$curso."'
            ORDER BY am.nombre_alumno, am.primer_apellido_alumno, am.segundo_apellido_alumno;";

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
    echo '<td> <a href="#"  class="btn-editar" onclick="editarMatricula(' . htmlspecialchars(json_encode($columna['cod_alumnosMatriculados']), ENT_QUOTES, 'UTF-8') . ', ' . htmlspecialchars(json_encode($curso), ENT_QUOTES, 'UTF-8') . ')"><i class="fa-solid fa-pencil"></i></a> </td>';
    echo '<td> <a href="#" class="btn-borrar" onclick="eliminarMatricula(' . htmlspecialchars(json_encode($columna['cod_alumnosMatriculados']), ENT_QUOTES, 'UTF-8') . ', ' . htmlspecialchars(json_encode($curso), ENT_QUOTES, 'UTF-8') . ')"><i class="fa-solid fa-trash"></i></a> </td>';
    echo "</tr>";
}
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
    <script>
  function editarMatricula(cod_matricula, curso) {
    var url;

    if(curso == "1ESO"){
      url = "../cursos/ESO/1ESO.php?cod_matricula=" + cod_matricula;
}else if(curso == "2ESO"){
  url = "../cursos/ESO/2ESO.php?cod_matricula=" + cod_matricula;
}else if(curso == "3ESO"){
  url = "../cursos/ESO/3ESO.php?cod_matricula=" + cod_matricula;
}else if(curso == "4ESO"){
  url = "../cursos/ESO/4ESO.php?cod_matricula=" + cod_matricula;
}else if(curso == "1BTOCIENCIAS"){
  url = "../cursos/Bachillerato/Ciencias y Tecnologia/1BTOCiencias.php?cod_matricula=" + cod_matricula;
}else if(curso == "2BTOCIENCIAS"){
  url = "../cursos/Bachillerato/Ciencias y Tecnologia/2BTOCiencias.php?cod_matricula=" + cod_matricula;
}else if(curso == "1BTOHUMCSO"){
  url = "../cursos/Bachillerato/Humanidades-Ciencias Sociales/1BTOHumanidades.php?cod_matricula=" + cod_matricula;
}else if(curso == "2BTOHUMCSO"){
  url = "../cursos/Bachillerato/Humanidades-Ciencias Sociales/2BTOHumanidades.php?cod_matricula=" + cod_matricula;
}else if(curso == "PEFP1"){
  url = "../cursos/PEFP/PEFP1.php?cod_matricula=" + cod_matricula;
}else if(curso == "PEFP2"){
  url = "../cursos/PEFP/PEFP2.php?cod_matricula=" + cod_matricula;
}else if(curso == "CFGB1"){
  url = "../cursos/Ciclo-Formativo/Basico/CFGB1.php?cod_matricula=" + cod_matricula;
}else if(curso == "CFGB2"){
  url = "../cursos/Ciclo-Formativo/Basico/CFGB2.php?cod_matricula=" + cod_matricula;
}else if(curso == "SMR1"){
  url = "../cursos/Ciclo-Formativo/Medio/CFGM1.php?cod_matricula=" + cod_matricula;
}else if(curso == "SMR2"){
  url = "../cursos/Ciclo-Formativo/Medio/CFGM1.php?cod_matricula=" + cod_matricula;
}else if(curso == "DAW1"){
  url = "../cursos/Ciclo-Formativo/Superior/DAW/1CFGS-DAW1.php?cod_matricula=" + cod_matricula;
}else if(curso == "DAW2"){
  url = "../cursos/Ciclo-Formativo/Superior/DAW/2CFGS-DAW2.php?cod_matricula=" + cod_matricula;
}else if(curso == "DAM1"){
  url = "../cursos/Ciclo-Formativo/Superior/DAM/1CFGS-DAM1.php?cod_matricula=" + cod_matricula;
}else if(curso == "DAM2"){
  url = "../cursos/Ciclo-Formativo/Superior/DAM/2CFGS-DAM2.php?cod_matricula=" + cod_matricula;
}  
      window.location.href = url;
  }
  
  function eliminarMatricula(cod_matricula, curso){
    if (confirm("¿Está seguro de que desea borrar esta matricula?")) {
      var url = "borrarMatriculas.php?cod_matricula=" + cod_matricula+ "&curso="+curso;
      window.location.href = url;
    }
  }

</script>
</body>
</html>