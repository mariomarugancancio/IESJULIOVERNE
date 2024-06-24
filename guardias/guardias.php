<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardias</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d7bc41fc30.js" crossorigin="anonymous"></script>
    <script src="js/paginacion.js"></script>
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">

    <!-- <style>
      @media (min-width: 768px) {
        body{width: 90%;
        }
      }
    </style> -->
</head>
<body class="m-auto">

  <?php
    include('navguardias.php');

  if ($_SESSION['usuario_login']['rol'] == "1") {
    header('Location: guardiasprofesor.php');
  } 
?>

<div class="row m-2">
                <div class="col-lg-2 col-md-2 py-1 my-2">
                <label>Filtrar por fecha</label>
                </div>
                 <div class="col-lg-2 col-md-2 my-2">
                 <input type="date" id="filtroFecha" class="form-control" placeholder="Filtrar por fecha">
                </div>
                <div class="col-lg-4 col-md-4 my-2">
                    <input type="text" id="filtroNombreProfesor" class="form-control"
                        placeholder="Filtrar por nombre del profesor">
                </div>
                <div class="col-lg-4 col-md-4 my-2">
                    <input type="text" id="filtroClase" class="form-control"
                        placeholder="Filtrar por clase">
                </div>
                </div>
    <table  id="tablaGuardias" class="table  table-bordered table-striped table-hover text-center" >
  <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Periodo</th>
      <th scope="col">Clase</th>
      <th scope="col">Profesor</th>
      <th scope="col">Observaciones</th>
      <th scope="col">Editar</th>
      <th scope="col">Borrar</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(isset($_POST['ventana'])){
      if($_POST['ventana'] == "hora"){
        include("../guardias/hora.php");
      }else if($_POST['ventana'] == "dia"){
        include("../guardias/dia.php");
      }else if($_POST['ventana'] == "semana"){
        include("../guardias/semana.php");
      }else{
        include("../guardias/listaguardias.php");
      }
    }else{    
      include("../guardias/listaguardiasprofesores.php");
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
<script>
  function editarGuardia(cod_guardias) {
    var url = "editandoguardia.php?cod_guardias=" + cod_guardias;
      window.location.href = url;
  }
  
  function eliminarGuardia(codguardia){
    if (confirm("¿Está seguro de que desea borrar esta guardia?")) {
      var url = "borrarguardias.php?cod_guardias=" + codguardia;
      window.location.href = url;
    }
  }

</script>
<?php
        include('../archivosComunes/footer.php');
        ?>