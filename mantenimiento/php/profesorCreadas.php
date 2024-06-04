<?php
// Iniciamos la sesion
session_start();
// Para acceder a esta pagina hay que iniciar sesion previamente.
require_once('funciones/loginRequerido.php');
require 'funciones/controlroles.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <title>Profesor</title>
</head>
<body>
 <?php

      require_once("funciones/header.php");
    
  ?>
  <article>
    <section>
      <div class="container px-4 py-5" id="Incidencias">
        <h2 class="pb-2 mb-5 border-bottom">Incidencias</h2>
        <div class="p-4 rounded-3" style="background: #F5F4F4">
          <!-- <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5"> -->
          <div>
            <?php
            require_once("funciones/leyenda.php");
            ?>
            <div class="input-container mb-4 d-flex justify-content-between">
              <input type="search" placeholder="Buscar incidencia" id="filtro" />
              <a id="botonincidencia" href="crearInci.php" class="btn float" type="button" style="background-color: rgba(0, 0, 0, 0.2);">Crear Incidencia</a>

            </div>
            <?php
            // Fichero para mostrar las Tareas del Operario
            require_once('funciones/mostrarTareasProfesorCreadas.php');
            ?>
          </div>
          <div class="d-flex justify-content-center mt-5" id="tablaPaginacion">
            <nav>
              <ul class="pagination mr-2 " id="paginacion"></ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
  </article>
  <?php
  require_once('funciones/footer.php');
  ?>