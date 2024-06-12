<?php
//include database configuration file
$db = require_once ('../../archivosComunes/conexion.php');
;

//get records from database
$query = $db->query("SELECT a.grupo, a.matricula, a.nombre, a.apellidos, i.puntos  AS puntos, i.descripcion AS incidencia, p.descripcion AS descripcion,
p.materia, p.fecha, p.hora, p.fecha_Comunicacion, p.via_Comunicacion, p.caducado, p.cod_parte,
e.cod_expulsion, e.fecha_Inicio, e.fecha_Fin, e.tipo_expulsion, e.fecha_Insercion
 FROM Alumnos a, Partes p, Incidencias i, Expulsiones e, PartesExpulsiones pe
 WHERE a.matricula = p.matricula_alumno AND p.incidencia = i.cod_incidencia AND pe.cod_parte=p.cod_parte AND pe.cod_expulsion = e.cod_expulsion
 ORDER BY a.grupo, a.matricula DESC");

if ($query->rowCount() > 0) {
    $delimiter = ",";
    $filename = "expulsiones_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('Grupo', 'Matricula', 'Nombre', 'Apellidos','Cod_expulsion', 'Fecha_Inicio_Expulsion', 'Fecha_Fin_Expulsion', 'Tipo_expulsion', 'Fecha_Insercion_Expulsion'
    ,'Cod_parte', 'Puntos', 'Incidencia','Descripcion', 'Materia','Fecha_Parte', 'Hora_parte', 'Fecha_Comunicacion', 'Via_Comunicacion', 'Caducado');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array($row['grupo'], $row['matricula'], $row['nombre'], $row['apellidos'],$row['cod_expulsion'],$row['fecha_Inicio'],$row['fecha_Fin'],$row['tipo_expulsion'],$row['fecha_Insercion'], $row['puntos'], $row['cod_parte'], $row['incidencia'], $row['descripcion'], $row['materia'], $row['fecha'], $row['hora'], $row['fecha_Comunicacion'], $row['via_Comunicacion'], $row['caducado']);
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