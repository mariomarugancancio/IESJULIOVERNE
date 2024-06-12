<?php
//include database configuration file
$db = require_once ('../../archivosComunes/conexion.php');
;

//get records from database
$query = $db->query("SELECT a.grupo, a.matricula, a.nombre, a.apellidos, i.puntos  AS puntos, i.descripcion AS incidencia, p.descripcion AS descripcion,
materia, fecha, hora, fecha_Comunicacion, via_Comunicacion, caducado, cod_parte
 FROM Alumnos a, Partes p, Incidencias i 
 WHERE a.matricula = p.matricula_alumno AND p.incidencia = i.cod_incidencia
 ORDER BY a.grupo, a.matricula DESC");

if ($query->rowCount() > 0) {
    $delimiter = ",";
    $filename = "partes_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('Grupo', 'Matricula', 'Nombre', 'Apellidos', 'Cod_parte', 'Puntos', 'Incidencia','Descripcion', 'Materia','Fecha', 'Hora', 'Fecha_Comunicacion', 'Via_Comunicacion', 'Caducado');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array($row['grupo'], $row['matricula'], $row['nombre'], $row['apellidos'], $row['puntos'], $row['cod_parte'], $row['incidencia'], $row['descripcion'], $row['materia'], $row['fecha'], $row['hora'], $row['fecha_Comunicacion'], $row['via_Comunicacion'], $row['caducado']);
        fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);

    //set headers to download file rather than displayed
    header('Content-Encoding: UTF-8');
    header('Content-Type: application/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>