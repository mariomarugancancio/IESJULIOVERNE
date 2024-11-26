<header>

<nav id="navegador" class="navbar navbar-expand-md navbar-light" style="background-color: rgba(0, 0, 0, 0.2)">
    <div class="container-fluid">
      <a class="navbar-brand" href="funciones/rolApp.php">
        <img src="../../images/logoJulioVerneNuevo.png" width="65px" height="65px">
        <span class="text-dark" style="font-size: 18px;">
          Mantenimiento
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse text-center" id="menu">
        <ul class="navbar-nav me-auto">
          <?php
              //Inidicamos que header corresponde
              require_once('../../archivosComunes/conexion.php');
              if($_SESSION['usuario_login']['departamento']!=""){
              $referencia = "SELECT referencia FROM Departamentos WHERE codigo = ".$_SESSION['usuario_login']['departamento'];
              $referencia = $db->query($referencia);
              $columna = "";
              // Mostramos los resultados de la consulta en un select
              foreach ($referencia as $row) {
                $columna = $row["referencia"];
              }
                      // Links para rol 0
        if ($_SESSION['usuario_login']['rol'] == 0) {
          echo '<li class="nav-item"><a class="nav-link ' . (str_contains($_SERVER["SCRIPT_NAME"], "admin.php") ? "active" : "") . '" href="admin.php">Incidencias Pendientes</a></li>';

          echo '<li class="nav-item"><a class="nav-link ' . (str_contains($_SERVER["SCRIPT_NAME"], "adminFinalizadas.php") ? "active" : "") . '" href="adminFinalizadas.php">Incidencias Finalizadas</a></li>';

          echo '<li class="nav-item"><a class="nav-link ' . (str_contains($_SERVER["SCRIPT_NAME"], "incidenciasAdmin.php") ? "active" : "") . '" href="incidenciasAdmin.php">Incidencias Asignadas</a></li>';
      }

      // Links para rol 1 y referencia "inf"
      if ($columna == "inf" && $_SESSION['usuario_login']['rol'] == 1) {
          echo '<li class="nav-item"><a class="nav-link ' . (str_contains($_SERVER["SCRIPT_NAME"], "profesor.php") ? "active" : "") . '" href="profesor.php">Incidencias Asignadas</a></li>';
      }
  }

  // Este enlace está fuera de las condiciones previas
  echo '<li class="nav-item"><a class="nav-link ' . (str_contains($_SERVER["SCRIPT_NAME"], "profesorCreadas.php") ? "active" : "") . '" href="profesorCreadas.php">Incidencias Creadas</a></li>';
 ?>
        </ul>
        <i class="bi bi-person-circle"></i>
        <ul class="nav navbar-nav navbar-right">
        <li class="nav-item">
         <a class="text-dark btn btn-outline-secondary me-2" href="../../archivosComunes/actualizarUsuario.php?idusuario=<?php echo $_SESSION['usuario_login']['cod_usuario'] ?>">
         <span class="d-flex">
             <svg xmlns="http://www.w3.org/2000/svg" style="height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>&nbsp;
              <?php echo $_SESSION['usuario_login']['nombre'].' '.$_SESSION['usuario_login']['apellidos'] ?>
         </span>                 
     </a>
     </li> 
     <li class="nav-item">
        <a class="nav-link"  href="../../archivosComunes/selector.php"><span class="salir">Página Principal</span> <i class="bi bi-back"></i></a>
        </li>

        <li class="nav-item">
            <a class="nav-link"  href="../../archivosComunes/logout.php">Cerrar Sesion</a>
            </li>
        </ul>
        <hr class="text-white-50">
      </div>
    </div>
  </nav>
</header>
<style>
  ul.navbar-nav li.no-decoration {
    margin-right: 10px;
}
ul.navbar-nav li.no-decoration a {
    text-decoration: none ;
}
</style>