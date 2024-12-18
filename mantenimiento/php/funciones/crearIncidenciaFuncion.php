<?php

error_reporting(0);

$nvl_Tarea = $_POST['nvl_Tarea'];
$localizacion = $_POST['localizacion'];
$imagen = $_FILES["image"]["tmp_name"] ? file_get_contents($_FILES["image"]["tmp_name"]) : file_get_contents('../images/noimage.png'); 
$fechaini = $_POST['fechaini'];
$estado = $_POST['estado'];
$descripcion = $_POST['descripcion'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];

require_once('../../archivosComunes/conexion.php');
// Si se ha pulsado crear una incidencia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["crearInci"])) {
  if ($imagen === NULL) {
     // Mostrar el error en la pantalla
     echo '<div class="alert alert-danger" role="alert">';
     echo 'Para crear una incidencia debes subir una imagen';
     echo '</div>';
  } else {
    // Se insertan los datos en la tabla tareas
    try {
          // Mostrar un mensaje emergente que indica que se está guardando la tarea
    echo '<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // Mostrar el mensaje de guardando
        document.getElementById("mensajeCargando").style.display = "block";
    });
  </script>';
      $insert = 'INSERT INTO Tareas(estado, nivel_tarea, descripcion, imagen, localizacion, fecha_inicio, cod_usuario_crea)
              VALUES (?, ?, ?, ?, ?, ?, ?);';
      $insert2 = $db->prepare($insert);
      $insert2->execute(array($estado, $nvl_Tarea, $descripcion, $imagen, $localizacion, $fechaini, $_SESSION["usuario_login"]["cod_usuario"]));
      // Cuando se ejecute la consulta
        require_once('funciones/correo.php');
        require_once('../../archivosComunes/conexion.php');
        $cuerpo =
        "Se ha creado una nueva incidencia por el siguiente usuario:
        <ul>
            <li>Nombre: {$nombre}</li>
            <li>Apellidos: {$apellidos}</li>
            <li>Email: {$email}</li>
  
        </ul>
        El estado de la tarea es el siguiente
        <ul>
            <li>Estado: {$estado}</li>
            <li>Tipo de incidencia: {$nvl_Tarea}</li>
            <li>Descripción: {$descripcion}</li>
            <li>Localización: {$localizacion}</li>
            <li>Fecha: {$fechaini}</li>


        </ul>
          ";
          
      enviarcorreo($SESSION['usuario_login']['email'], "Nueva tarea de mantenimiento asignada", "$cuerpo");
       // Mostrar el error en la pantalla
       echo '<div class="alert alert-success" role="alert">';
       echo 'Incidencia creada correctamente';
       echo '</div>';
      //require_once("emailCrearTarea.php");
  // Ocultar el mensaje de carga y mostrar éxito
  echo '<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
      // Ocultar el mensaje de guardando
      document.getElementById("mensajeCargando").style.display = "none";
     
  });
</script>';
    } catch (PDOException $e) {
      echo "Error en la base de datos ";
    }
  }
}
?>