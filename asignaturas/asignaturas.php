<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignaturas</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d7bc41fc30.js" crossorigin="anonymous"></script>
    <script src="./js/paginacion.js"></script>

    <style>
      .aniadirdiv{
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        width: 200px;
        height: 300px;
        border: 1px solid black;
        text-align:center;
        background-color: black;
        color:white ;
        display: none;
      }
      @media (max-width: 600px) {
      .guardarnombre, .guardarhoras, .guardarcurso, .guardartipo{
        width: 90%;
      }
    }
    </style>
</head>
<body >
  <?php
      include('nav.php');
  ?>
  <div style="  position: fixed; bottom: 20px; right: 20px;">
    <a href="#" onclick="aniadir();"><i class="fa-solid fa-address-book fa-2xl"></i></a>
  </div>
    <div class="col-lg-3 col-md-6 my-2">
                    <div class="input-group">
                        <span class="input-group-text">Asignaturas</span>
                        <input type="text" id="filtro" class="form-control" placeholder="Buscador">
                    </div>
                </div>
  
<table id="tablaAsignaturas" class="table table-bordered table-striped table-hover text-center">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Horas</th>
      <th scope="col">Curso</th>
      <th scope="col">Tipo</th>
      <th scope="col">Editar</th>
      <th scope="col">Borrar</th>
    </tr>
  </thead>
  <tbody>
<?php
include("mostrarAsignaturas.php");
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
function editar(cod_asignatura){
  // si ya existe uno guardandose no deje guardar otro a la vez
  if(document.querySelector('.fa-solid.fa-floppy-disk') == null){
    var tdnombre=document.getElementById("nombre"+cod_asignatura);
    var tdhoras=document.getElementById("horas"+cod_asignatura);
    var tdcurso=document.getElementById("curso"+cod_asignatura);
    var tdtipo=document.getElementById("tipo"+cod_asignatura);
    var tdAsignatura=document.getElementById("Asignatura"+cod_asignatura);

    var Asignatura = tdAsignatura.textContent;

    const inputnombre = document.createElement('input');
    inputnombre.value = tdnombre.textContent;
    inputnombre.className="guardarnombre";
    tdnombre.innerHTML = '';
    tdnombre.appendChild(inputnombre);

    const inputhoras = document.createElement('input');
    inputhoras.value = tdhoras.textContent;
    inputhoras.className="guardarhoras";
    tdhoras.innerHTML = '';
    tdhoras.appendChild(inputhoras);

    const inputcurso = document.createElement('input');
    inputcurso.value = tdcurso.textContent;
    inputcurso.className="guardarcurso";
    tdcurso.innerHTML = '';
    tdcurso.appendChild(inputcurso);

    const inputtipo = document.createElement('input');
    inputtipo.value = tdtipo.textContent;
    inputtipo.className="guardartipo";
    tdtipo.innerHTML = '';
    tdtipo.appendChild(inputtipo);


    // agregar un botón "Guardar" al lado del nuevo input
    var tdeditar=document.getElementById("editar"+cod_asignatura);
  
      tdeditar.className = "fa-solid fa-floppy-disk";
      
      var guardarconf = document.querySelector(".fa-floppy-disk");
      guardarconf.addEventListener("click", function() {
        var guardarnombre = document.querySelector(".guardarnombre").value;
        var guardarhoras = document.querySelector(".guardarhoras").value;
        var guardarcurso = document.querySelector(".guardarcurso").value;
        var guardartipo = document.querySelector(".guardartipo").value;
        if(guardarnombre != "" && guardarhoras != "" && guardarcurso != ""){
          var url = "editarAsignaturas.php?nombre=" + guardarnombre + "&horas=" + guardarhoras + "&curso=" + guardarcurso + "&tipo=" + guardartipo + "&Asignatura=" + Asignatura;
          window.location.href = url;
        }
      })
    }
}

    
    function borrar(cod_asignatura, nombre, curso){
    if (confirm("¿Está seguro de que desea borrar la asignatura "+nombre+" de "+curso+ "?")) {
      var url = "borrarAsignaturas.php?cod_asignatura=" + cod_asignatura;
      window.location.href = url;
    }
  }

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
    var nuevonombre = document.querySelector(".nuevonombre").value;
    var nuevohoras = document.querySelector(".nuevohoras").value;
    var nuevocurso = document.querySelector(".nuevocurso").value;
    var nuevotipo = document.querySelector(".nuevotipo").value;
    if (nuevonombre != "" && nuevohoras != "" && nuevocurso != "") {
      var url = "aniadirAsignaturas.php?nombre=" + nuevonombre+"&horas=" + nuevohoras+"&curso=" + nuevocurso+"&tipo=" + nuevotipo;
      window.location.href = url;
      }
  }
</script>

<div class="aniadirdiv">
  <label for="">Introducir nombre</label>
  <input class="nuevonombre" type="text">
  <label for="">Introducir horas</label>
  <input class="nuevohoras" type="number">
  <label for="">Introducir curso</label>
  <input class="nuevocurso" type="text">
  <label for="">Introducir tipo</label>
  <input class="nuevotipo" type="text"><br><br>
  <input type="button" value="Guardar" onclick="insertar()">
</div>


<footer class="bg-dark text-center  text-white mt-4">
    <p class="col-12 text-center"><a class="text-white" href="http://ies-julioverne.centros.castillalamancha.es/" target="_blank" class="text-decoration-none p-2">IES Julio Verne (Bargas, Toledo)</a></p>
        <a href="#" class="col-12 text-white">Volver arriba</a>

    <div id="footerCredits" class="text-center my-2 p-2">
            <h6 class="fw-bold">Desarrollado por:</h6>
            <div class="row container mx-auto justify-content-center">
                <div class="col-12 col-md-6">Nerea Espigares Nieto</div>
            </div>
        </div>
      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
      Copyright &copy; 2023
      </div>
      <!-- Copyright -->
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>