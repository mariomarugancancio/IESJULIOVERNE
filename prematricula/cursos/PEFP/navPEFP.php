<?php
$cod_alumnosMatriculados ="";
$nombre_alumno="";
$primer_apellido_alumno=""; 
$segundo_apellido_alumno="";
$dni_alumno="";
$sexo_alumno="";
$email_alumno="";
$telefono_alumno="";
$fechaNacimiento="";
$municipioNacimiento="";
$provinciaNacimiento="";
$paisNacimiento="";
$familiaNumerosa="";
$nombre_apellidos_progenitor1="";
$dni_progenitor1="";
$telefono_progenitor1="";
$email_progenitor1=""; 
$nombre_apellidos_progenitor2="";
$dni_progenitor2="";
$telefono_progenitor2="";
$email_progenitor2="";
$calle="";
$numero="";
$portal="";
$piso="";
$puerta="";
$codigoPostal="";
$municipio="";
$provincia="";
$telefonoUrgencia="";
$centro="";
$localidad_centro="";
$provincia_centro="";
$curso_antiguo="";
$religion="";
$bilingue="";
$asignaturasOptativas = [];
$asignaturasOptativasPreferencias = [];
$ampa = "";
if (isset($_GET['cod_matricula'])) {
$cod_matricula = $_GET['cod_matricula'];
$select = "SELECT cod_alumnosMatriculados, nombre_alumno, primer_apellido_alumno, segundo_apellido_alumno,
            dni_alumno, sexo_alumno, email_alumno, telefono_alumno, 
            fecha_nacimiento, municipio_nacimiento, provincia_nacimiento, pais_nacimiento, familia_numerosa, nombre_apellidos_progenitor1, dni_progenitor1, telefono_progenitor1,
            email_progenitor1, nombre_apellidos_progenitor2, dni_progenitor2, telefono_progenitor2, email_progenitor2,
            calle, numero, portal, piso, puerta, codigoPostal, municipio, provincia, telefonoUrgencia,
            centro, localidad_centro, provincia_centro, curso_antiguo, bilingue, religion, cambio, ampa
            FROM AlumnosMatriculados
            WHERE cod_alumnosMatriculados = '".$cod_matricula."';";

$resul = $db->query($select);

if ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
$cod_alumnosMatriculados = $columna['cod_alumnosMatriculados'];
$nombre_alumno = $columna['nombre_alumno'];
$primer_apellido_alumno = $columna['primer_apellido_alumno']; 
$segundo_apellido_alumno = $columna['segundo_apellido_alumno'];
$dni_alumno = $columna['dni_alumno'];
$sexo_alumno = $columna['sexo_alumno'];
$email_alumno = $columna['email_alumno'];
$telefono_alumno = $columna['telefono_alumno'];
$fechaNacimiento = $columna['fecha_nacimiento'];
$municipioNacimiento = $columna['municipio_nacimiento'];
$provinciaNacimiento = $columna['provincia_nacimiento'];
$paisNacimiento = $columna['pais_nacimiento'];
$familiaNumerosa = $columna['familia_numerosa'];
$nombre_apellidos_progenitor1 = $columna['nombre_apellidos_progenitor1'];
$dni_progenitor1 = $columna['dni_progenitor1'];
$telefono_progenitor1 = $columna['telefono_progenitor1'];
$email_progenitor1 = $columna['email_progenitor1']; 
$nombre_apellidos_progenitor2 = $columna['nombre_apellidos_progenitor2'];
$dni_progenitor2 = $columna['dni_progenitor2'];
$telefono_progenitor2 = $columna['telefono_progenitor2'];
$email_progenitor2 = $columna['email_progenitor2'];
$calle = $columna['calle'];
$numero = $columna['numero'];
$portal = $columna['portal'];
$piso = $columna['piso'];
$puerta = $columna['puerta'];
$codigoPostal = $columna['codigoPostal'];
$municipio = $columna['municipio'];
$provincia = $columna['provincia'];
$telefonoUrgencia = $columna['telefonoUrgencia'];
$centro = $columna['centro'];
$localidad_centro = $columna['localidad_centro'];
$provincia_centro = $columna['provincia_centro'];
$curso_antiguo = $columna['curso_antiguo'];
$religion = $columna['religion'];
$bilingue = $columna['bilingue'];
$cambio="";
$ampa = $columna['ampa'];

if($curso == 'PEFP2'){
  $cambio = $columna['cambio'];

}
}


}
  session_start();
  if(isset($_SESSION['usuario_login']['cod_usuario'])){

    echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand ms-xl-5" href="../../../prematricula/prematricula.php">Prematrícula 2024/2025</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse  text-center" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          </ul>       
         <ul class="navbar-nav me-right mb-2 mb-lg-0">
         <li class="nav-item">
         <a class="text-light btn btn-outline-secondary me-2" href="../../../archivosComunes/actualizarUsuario.php?idusuario='.$_SESSION['usuario_login']['cod_usuario'].'">
         <span class="d-flex">
             <svg xmlns="http://www.w3.org/2000/svg" style="height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>&nbsp;
             '.$_SESSION['usuario_login']['nombre'].' '.$_SESSION['usuario_login']['apellidos'].'
         </span>                 
     </a>
     </li> 
         <li class="nav-item">
        <a class="nav-link"  href="../../../archivosComunes/selector.php">Página Principal <i class="bi bi-back"></i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link"  href="../../../archivosComunes/logout.php">Cerrar Sesion</a>
            </li>
            </div>
            </div>
            </ul> 
          </nav>';
  }else{
    echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    <a class="navbar-brand ms-xl-5" href="/prematricula/prematricula.php">Prematrícula 2024/2025</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      </div>
      </nav>';
  }
?>