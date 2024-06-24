<?php
// Iniciamos la sesion
session_start();
// Para acceder a esta pagina hay que iniciar sesion previamente.
require_once('loginRequerido.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aplicaciones</title>
  <link rel="stylesheet" type="text/css" href="../css/app.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">

</head>
<body>
    <header>
      
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

      <div class="container-fluid">
      <div class="contenedor">
      <a href="selector.php"><img src="../images/logoJulioVerneNuevo.png" alt="" class="logo me-2">
      </a>
      <h1 class="titulo"><a href="selector.php">IES JULIO VERNE</a></h1>
      </div>
      
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
      data-bs-toggle="dropdown">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <div class="collapse navbar-collapse  text-center" id="navbarSupportedContent">
  <ul class="navbar-nav me-auto">
    </ul>
        <ul class="navbar-nav navbar-right">
    <li class="nav-item">
      <?php 
     echo'
      <a class="text-light btn btn-outline-secondary me-2" href="../archivosComunes/actualizarUsuario.php?idusuario='.$_SESSION['usuario_login']['cod_usuario'].'">'?>
      <span class="d-flex">
          <svg xmlns="http://www.w3.org/2000/svg" style="height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>&nbsp;
         <?php echo $_SESSION['usuario_login']['nombre'].' '.$_SESSION['usuario_login']['apellidos'];?>
      </span>                 
  </a>
  </li> 
      <li class="nav-item">
       <a class="nav-link active" href="../archivosComunes/selector.php">Página Principal <i class="bi bi-back"></i></a>
     </li>

     <li class="nav-item">
         <a class="nav-link"  href="../archivosComunes/logout.php">Cerrar Sesion</a>
         </li>
    </ul>

  </div>
</div>
</nav>
    </header> 
  
    <section style="font-size: 16px;">

    <a href="../mantenimiento/php/funciones/rolApp.php" id="mantenimiento">
        Mantenimiento
        <img src="../images/Mantenimiento1.webp" alt="Partes1">
        <img src="../images/mantenimiento2.webp" alt="Partes2">
      </a>
      
      <a href="../partes/partes.php" id="partes">
        Partes de Incidencia
        <img src="../images/parte1.png" alt="Partes1">
        <img src="../images/clase2.png" alt="Partes2">
      </a>

      <a href="../inventario/index.php" id="inventario">
        Inventario
        <img src="../images/inventario1.webp" alt="imagen Inventario1">
        <img src="../images/inventario2.webp" alt="imagen Inventario2">
      </a>

      <a href="../reservas/misreservas.php" id="clases">
        Gestión de Reservas
        <img src="../images/clases1.png" alt="Imagen GestionClases1">
        <img src="../images/clase2.png" alt="Imagen GestionClases2">
      </a>

      <a href="../guardias/guardias.php" id="guardias">
        Gestión de Guardias
        <img src="../images/guardias3.png" alt="Imagen Guardias">
        <img src="../images/guardias2.png" alt="Imagen Guardias">
      </a>
      <a href="../prematricula/prematricula.php" id="prematricula">
        Prematrícula
        <img src="../images/prematricula1.webp" alt="Imagen Prematricula1">
        <img src="../images/prematricula2.webp" alt="Imagen Prematricula2">
      </a>
      <a href="../asignaturas/asignaturas.php" id="asignaturas">
        Gestión de Asignaturas
        <img src="../images/asignaturas1.webp" alt="Imagen GestionAsignaturas1">
        <img src="../images/asignaturas2.webp" alt="Imagen GestionAsignaturas2">
      </a>
      <a href="../cursos/cursos.php" id="cursos">
        Gestión de Cursos
        <img src="../images/cursos1.jpg" alt="Imagen GestionCursos1">
        <img src="../images/clase2.png" alt="Imagen GestionCursos2">
      </a>
      <a href="../alumnos/gestionarAlumnos.php" id="alumnos">
        Gestión de Alumnos
        <img src="../images/alumnos1.jpg" alt="Imagen GestionAlumnos1">
        <img src="../images/usuario2.webp" alt="Imagen GestionAlumnos2">
      </a>
      <a href="../fotocopias/gestionarFotocopias.php" id="fotocopias">
        Gestión de Fotocopias
        <img src="../images/fotocopias1.jpg" alt="Imagen GestionFotocopias1">
        <img src="../images/fotocopias2.png" alt="Imagen GestionFotocopias2">
      </a>
      <?php
        if ($_SESSION['usuario_login']['rol'] == "0") {
      ?>
      <a href="adminUsuario.php" id="usuarios">
      <?php
        } else {
      ?>
      <a href="../archivosComunes/actualizarUsuario.php?idusuario='<?php echo $_SESSION['usuario_login']['cod_usuario']?>'" id="usuarios">
       <?php
        }
      ?>
        Gestión de Usuarios
        <img src="../images/usuario1.webp" alt="Imagen GestionUsuarios1">
        <img src="../images/usuario2.webp" alt="Imagen GestionUsuarios2">
      </a>


    </section>
    <?php
        include("footer.php");
 
         if($_SESSION["usuario_login"]["rol"] == 3){
          print '<script>
          document.getElementById("mantenimiento").style.display="block";
          document.getElementById("inventario").style.display="none";
          document.getElementById("guardias").style.display="none";
          document.getElementById("clases").style.display="none";
          document.getElementById("usuarios").style.display="block";
          document.getElementById("partes").style.display="none";
          document.getElementById("cursos").style.display="none";
          document.getElementById("asignaturas").style.display="none";
          document.getElementById("prematricula").style.display="block";
          document.getElementById("alumnos").style.display="none";
          document.getElementById("fotocopias").style.display="block";

          </script>';
        }
        if($_SESSION["usuario_login"]["rol"] == 2 ){
          print '<script>
          document.getElementById("mantenimiento").style.display="block";
          document.getElementById("inventario").style.display="none";
          document.getElementById("guardias").style.display="none";
          document.getElementById("clases").style.display="none";
          document.getElementById("usuarios").style.display="block";
          document.getElementById("partes").style.display="none";
          document.getElementById("cursos").style.display="none";
          document.getElementById("asignaturas").style.display="none";
          document.getElementById("prematricula").style.display="none";
          document.getElementById("alumnos").style.display="none";
          document.getElementById("fotocopias").style.display="none";

          </script>';
        }
        if($_SESSION["usuario_login"]["rol"] == 1){
          print '<script>
          document.getElementById("mantenimiento").style.display="block";
          document.getElementById("inventario").style.display="block";
          document.getElementById("guardias").style.display="block";
          document.getElementById("clases").style.display="block";
          document.getElementById("usuarios").style.display="block";
          document.getElementById("partes").style.display="block";
          document.getElementById("cursos").style.display="none";
          document.getElementById("asignaturas").style.display="none";
          document.getElementById("prematricula").style.display="block";
          document.getElementById("alumnos").style.display="none";
          document.getElementById("fotocopias").style.display="none";

          </script>';
        }
        if($_SESSION["usuario_login"]["rol"] == 0){
          print '<script>
          document.getElementById("mantenimiento").style.display="block";
          document.getElementById("inventario").style.display="block";
          document.getElementById("guardias").style.display="block";
          document.getElementById("clases").style.display="block";
          document.getElementById("usuarios").style.display="block";
          document.getElementById("partes").style.display="block";
          document.getElementById("cursos").style.display="block";
          document.getElementById("asignaturas").style.display="block";
          document.getElementById("prematricula").style.display="block";
          document.getElementById("alumnos").style.display="block";
          document.getElementById("fotocopias").style.display="block";

          </script>';
        }
      ?>


</body>
</html>