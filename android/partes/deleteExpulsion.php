<?php
include '../conexion.php';

// Obtener los valores de los atributos de la clase Partes a través de la URL
$matricula_del_Alumno = $_GET['matricula_del_Alumno'];

$sql = "SELECT * FROM Expulsiones WHERE matricula_del_Alumno=? AND fecha_Inicio IS NULL;";
$consulta = $db->prepare($sql);
$consulta->execute(array($matricula_del_Alumno));

if ($consulta->rowCount() == 1){

    // Consulta SQL con marcadores de posición (?)
    $sql = "DELETE FROM Expulsiones WHERE matricula_del_Alumno=?;";

    // Preparar la consulta
    $consulta = $db->prepare($sql);

    // Ejecutar la consulta con los valores proporcionados
    $consulta->execute(array($matricula_del_Alumno));

    $sql = "SELECT * FROM Expulsiones WHERE matricula_del_Alumno=?;";
    $consulta = $db->prepare($sql);
    $consulta->execute(array($matricula_del_Alumno));

    if ($consulta->rowCount() == 1){
        $respuesta=2;
    } else {
        $respuesta=1;
    }

} else {
    $respuesta=0;
}
  
header ('Content-Type: application/json');

echo $respuesta;

?>