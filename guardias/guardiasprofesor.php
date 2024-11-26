<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardias</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>
    <script src="js/paginacion.js"></script>
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">
    <link rel="shortcut icon" href="../css/confirmarEliminarr.css">
    <link rel="stylesheet" href="../css/tablasResponsive.css">

</head>
<body>

    <?php
        include('navguardias.php');
    ?>
      <!-- Modal personalizado -->
<div id="customConfirm" class="modal">
    <div class="modal-content">
        <p>¿Está seguro de que desea borrar esta guardia?</p>
        <button id="confirmBtn" class="btnConfirmar btn-success">Sí, borrar</button>
        <button id="cancelBtn" class="btnConfirmar btn-danger">No, cancelar</button>
    </div>
</div>
     <div class="row m-2">
                <div class="col-lg-2 col-md-2 py-1 my-2">
                <label>Filtrar por fecha</label>
                </div>
                 <div class="col-lg-2 col-md-2  my-2">
                 <input type="date" id="filtroFecha" class="form-control" placeholder="Filtrar por fecha">
                </div>
                <div class="col-lg-4 col-md-4 my-2">
                    <input type="text" id="filtroClase" class="form-control"
                        placeholder="Filtrar por clase">
                </div>
                </div>
                <div class="table-responsive">

    <table  id="tablaGuardias" class="table  table-bordered table-striped text-center ">
  <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Periodo</th>
      <th scope="col">Clase</th>
      <th scope="col">Profesor</th>
      <th scope="col">Observaciones</th>
      <th scope="col">Editar</th>
      <?php if ($_SESSION['usuario_login']['rol'] == "0") {
      echo '<th scope="col">Borrar</th>';
      }
      ?>
    </tr>
  </thead>
  <tbody>
    <?php
        include("../guardias/listaguardiasprofesores.php");
      
    
      ?>
  </tbody>
</table>
</div>
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
  
  function eliminarGuardia(codguardia) {
        // Mostrar el modal personalizado
        var modal = document.getElementById("customConfirm");
        modal.style.display = "block";

        // Manejo del botón confirmar
        document.getElementById("confirmBtn").onclick = function() {
            var url = "borrarguardias.php?cod_guardias=" + codguardia;
            window.location.href = url;
        };

        // Manejo del botón cancelar
        document.getElementById("cancelBtn").onclick = function() {
            modal.style.display = "none"; // Cerrar el modal si cancela
        };
    }

    // Opción para cerrar el modal si se hace clic fuera de él
    window.onclick = function(event) {
        var modal = document.getElementById("customConfirm");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };


</script>
<?php
        include('../archivosComunes/footer.php');
        ?>