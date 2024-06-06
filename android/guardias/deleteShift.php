<?php
include '../conexion.php';

// Obtener los valores de los atributos de la clase Partes a través de la URL
$cod_guardias = $_GET['cod_guardias'];
// Consulta SQL con marcadores de posición (?)
$sql = "DELETE FROM guardias WHERE cod_guardias = ?";
// Preparar la consulta
$stmt = $db->prepare($sql);
// Ejecutar la consulta con los valores proporcionados
$stmt->execute(array($cod_guardias));

   
  
header ('Content-Type: application/json');

echo "Guardia eliminada correctamente";

?>


