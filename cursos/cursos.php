
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clase</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>
    <script src="./js/paginacion.js"></script>
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">
    <link rel="stylesheet" href="../css/confirmarEliminarr.css">
    <link rel="stylesheet" href="../css/tablasResponsive.css">

    <style>
      .aniadirdiv{
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 200px;
        height: 250px;
        border: 1px solid black;
        text-align:center;
        background-color: black;
        color:white ;
        display: none;
      }
      @media (max-width: 600px) {
      .guardarcurso, .guardaraula{
        width: 90%;
      }
    }
    </style>
</head>
<body >
  <?php
      include('nav.php');
  ?>
  <!-- Modal personalizado -->
<div id="customConfirm" class="modal">
    <div class="modal-content">
        <p id="mensajeEliminar">¿Está seguro de que desea borrar este curso?</p>
        <button id="confirmBtn" class="btnConfirmar btn-success">Sí, borrar</button>
        <button id="cancelBtn" class="btnConfirmar btn-danger">No, cancelar</button>
    </div>
</div>
  <div style="  position: fixed; bottom: 70px; right: 20px;">
    <a href="#" onclick="aniadir();"><i class="fa-solid fa-address-book fa-2xl"></i></a>
  </div>

  <div class="col-lg-3 col-md-6 my-2">
                    <div class="input-group">
                        <span class="input-group-text">Curso</span>
                        <input type="text" id="filtro" class="form-control" placeholder="Buscador">
                    </div>
                </div>
                <div class="table-responsive">

<table id="tablaCursos" class="table table-bordered table-striped table-hover text-center">
  <thead>
    <tr>
      <th scope="col">Grupo</th>
      <th scope="col">Aula</th>
      <th scope="col">Curso</th>
      <th scope="col">Editar</th>
      <th scope="col">Borrar</th>
    </tr>
  </thead>
  <tbody>
<?php
include("mostarcursos.php");
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
function editar(grupo){
  // si ya existe uno guardandose no deje guardar otro a la vez
  if(document.querySelector('.fa-solid.fa-floppy-disk') == null){
    var tdaula=document.getElementById("aula"+grupo);
    var tdgrupo=document.getElementById("grupo"+grupo);
    var tdcurso=document.getElementById("curso"+grupo);
    var tdgrupoA=document.getElementById("grupoA"+grupo);
    var grupoA = tdgrupoA.textContent;
    const inputaula = document.createElement('input');
    inputaula.value = tdaula.textContent;
    inputaula.className="guardaraula";
    tdaula.innerHTML = '';
    tdaula.appendChild(inputaula);

    const inputgrupo = document.createElement('input');
    inputgrupo.value = tdgrupo.textContent;
    inputgrupo.className="guardargrupo";
    tdgrupo.innerHTML = '';
    tdgrupo.appendChild(inputgrupo);

    const inputcurso = document.createElement('input');
    inputcurso.value = tdcurso.textContent;
    inputcurso.className="guardarcurso";
    tdcurso.innerHTML = '';
    tdcurso.appendChild(inputcurso);
    
    // agregar un botón "Guardar" al lado del nuevo input
    var tdeditar=document.getElementById("editar"+grupo);
  
      tdeditar.className = "fa-solid fa-floppy-disk";
      
      var guardarconf = document.querySelector(".fa-floppy-disk");
      
      guardarconf.addEventListener("click", function() {
        var guardaraula = document.querySelector(".guardaraula").value;
        var guardargrupo = document.querySelector(".guardargrupo").value;
        var guardarcurso = document.querySelector(".guardarcurso").value;
        if(guardargrupo != "" && guardarcurso != ""){
          var url = "editarcursos.php?grupo=" + guardargrupo+"&aula=" + guardaraula+"&curso=" + guardarcurso+"&grupoA=" + grupoA;
          window.location.href = url;
        }else{
        // Crear un nuevo div para la alerta
    var alertaDiv = document.createElement('div');

      // Asignar clases de Bootstrap al div
      alertaDiv.className = 'alert alert-danger';
      alertaDiv.setAttribute('role', 'alert');

      // Establecer el mensaje de alerta
      alertaDiv.innerHTML = 'Se debe rellenar el grupo y el curso';

      // Agregar la alerta al cuerpo del documento o en algún contenedor específico
      document.body.insertBefore(alertaDiv, document.body.firstChild);
    }
      })
    }
}

       
function borrar(grupo){
  // Mostrar el modal personalizado
        var mensaje =document.getElementById("mensajeEliminar");
        mensaje.innerHTML= "¿Está seguro de que desea borrar el curso "+ grupo+"?"
        var modal = document.getElementById("customConfirm");
        modal.style.display = "block";

        // Manejo del botón confirmar
        document.getElementById("confirmBtn").onclick = function() {
          var url = "borrarcursos.php?grupo=" + grupo;
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



  function aniadir(){

    var div = document.querySelector(".aniadirdiv");
    if(div.style.display == "none"){
      div.style.display = "block";
    }else if(div.style.display == ""){
      div.style.display = "block";

    }else{
      div.style.display = "none";

    }

  }

  function insertar(){
    var nuevoaula = document.querySelector(".nuevoaula").value;
    var nuevogrupo = document.querySelector(".nuevogrupo").value;
    var nuevocurso = document.querySelector(".nuevocurso").value;
    if (nuevogrupo != "" && nuevocurso != "") {
      var url = "aniadircursos.php?aula=" + nuevoaula+"&grupo=" + nuevogrupo+"&curso=" + nuevocurso;
      window.location.href = url;
      }else{
        // Crear un nuevo div para la alerta
    var alertaDiv = document.createElement('div');

      // Asignar clases de Bootstrap al div
      alertaDiv.className = 'alert alert-danger';
      alertaDiv.setAttribute('role', 'alert');

      // Establecer el mensaje de alerta
      alertaDiv.innerHTML = 'Se debe rellenar el grupo y el curso';

      // Agregar la alerta al cuerpo del documento o en algún contenedor específico
      document.body.insertBefore(alertaDiv, document.body.firstChild);
    }
  }
</script>

<div class="aniadirdiv">
  <label for="">Introducir aula</label>
  <input class="nuevoaula" type="text">
  <label for="">Introducir grupo</label>
  <input class="nuevogrupo" type="text">
  <label for="">Introducir curso</label>
  <input class="nuevocurso" type="text"><br><br>
  <input type="button" value="Guardar" onclick="insertar()">
</div>

<?php
  include('../archivosComunes/footer.php');
?>