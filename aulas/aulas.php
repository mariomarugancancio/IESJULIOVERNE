
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aulas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>
    <script src="./js/paginacionFiltro.js"></script>
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
        height: 100px;
        border: 1px solid black;
        text-align:center;
        background-color: black;
        color:white ;
        display: none;
      }
      @media (max-width: 600px) {
      .guardaraula{
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
        <p id="mensajeEliminar">¿Está seguro de que desea borrar este aula?</p>
        <button id="confirmBtn" class="btnConfirmar btn-success">Sí, borrar</button>
        <button id="cancelBtn" class="btnConfirmar btn-danger">No, cancelar</button>
    </div>
</div>
  <div style="  position: fixed; bottom: 70px; right: 20px;">
    <a href="#" onclick="aniadir();"><i class="fa-solid fa-address-book fa-2xl"></i></a>
  </div>

  <div class="col-lg-3 col-md-6 my-2">
                    <div class="input-group">
                        <span class="input-group-text">Aula</span>
                        <input type="text" id="filtro" class="form-control" placeholder="Buscador">
                    </div>
                </div>
                <div class="table-responsive">

<table id="tablaAulas" class="table table-bordered table-striped table-hover text-center">
  <thead>
    <tr>
      <th scope="col">Aula</th>
      <th scope="col">Editar</th>
      <th scope="col">Borrar</th>
    </tr>
  </thead>
  <tbody>
<?php
include("mostraraulas.php");
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

function editar(aula){
  // si ya existe uno guardandose no deje guardar otro a la vez
  if(document.querySelector('.fa-solid.fa-floppy-disk') == null){
    var tdaula=document.getElementById("aula"+aula);
    var tdaulaA=document.getElementById("aulaA"+aula);
    var aulaA = tdaulaA.textContent;
    const inputaula = document.createElement('input');
    inputaula.value = tdaula.textContent;
    inputaula.className="guardaraula";
    tdaula.innerHTML = '';
    tdaula.appendChild(inputaula);

  
    
    // agregar un botón "Guardar" al lado del nuevo input
    var tdeditar=document.getElementById("editar"+aula);
  
      tdeditar.className = "fa-solid fa-floppy-disk";
      
      var guardarconf = document.querySelector(".fa-floppy-disk");
      
      guardarconf.addEventListener("click", function() {
        var guardaraula = document.querySelector(".guardaraula").value;
      
        if(guardaraula != "" ){
          var url = "editaraulas.php?aula=" + guardaraula+"&aulaA=" + aulaA;
          window.location.href = url;
        }else{
        // Crear un nuevo div para la alerta
    var alertaDiv = document.createElement('div');

      // Asignar clases de Bootstrap al div
      alertaDiv.className = 'alert alert-danger';
      alertaDiv.setAttribute('role', 'alert');

      // Establecer el mensaje de alerta
      alertaDiv.innerHTML = 'Se debe rellenar el aula';

      // Agregar la alerta al cuerpo del documento o en algún contenedor específico
      document.body.insertBefore(alertaDiv, document.body.firstChild);
    }
      })
    }
}
       
function borrar(aula){
  // Mostrar el modal personalizado
        var mensaje =document.getElementById("mensajeEliminar");
        mensaje.innerHTML= "¿Está seguro de que desea borrar el aula "+ aula+"?"
        var modal = document.getElementById("customConfirm");
        modal.style.display = "block";

        // Manejo del botón confirmar
        document.getElementById("confirmBtn").onclick = function() {
          var url = "borraraulas.php?aula=" + aula;
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
    if (nuevoaula != "") {
      var url = "aniadiraulas.php?aula=" + nuevoaula;
      window.location.href = url;
      }else{
        // Crear un nuevo div para la alerta
    var alertaDiv = document.createElement('div');

      // Asignar clases de Bootstrap al div
      alertaDiv.className = 'alert alert-danger';
      alertaDiv.setAttribute('role', 'alert');

      // Establecer el mensaje de alerta
      alertaDiv.innerHTML = 'Se debe rellenar el aula';

      // Agregar la alerta al cuerpo del documento o en algún contenedor específico
      document.body.insertBefore(alertaDiv, document.body.firstChild);
    }
  }
</script>

<div class="aniadirdiv">
  <label for="">Introducir aula</label>
  <input class="nuevoaula" type="text">
  <input type="button" value="Guardar" onclick="insertar()">
</div>

<?php
  include('../archivosComunes/footer.php');
?>