<?php
require '../../archivosComunes/conexion.php';
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//get records from database
$query = $db->query("SELECT a.grupo, a.matricula, a.nombre, a.apellidos, i.puntos AS puntos, i.descripcion AS incidencia, p.descripcion AS descripcion,
p.materia, p.fecha, p.hora, p.fecha_Comunicacion, p.via_Comunicacion, p.caducado, p.cod_parte,
e.cod_expulsion, e.fecha_Inicio, e.fecha_Fin, e.tipo_expulsion, e.fecha_Insercion
 FROM Alumnos a, Partes p, Incidencias i, Expulsiones e, PartesExpulsiones pe
 WHERE a.matricula = p.matricula_alumno AND p.incidencia = i.cod_incidencia AND pe.cod_parte=p.cod_parte AND pe.cod_expulsion = e.cod_expulsion
 ORDER BY a.grupo, a.matricula DESC");

if ($query->rowCount() > 0) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    //set column headers
    $fields = array('Grupo', 'Matricula', 'Nombre', 'Apellidos', 'Cod_expulsion', 'Fecha_Inicio_Expulsion', 'Fecha_Fin_Expulsion', 'Tipo_expulsion', 'Fecha_Insercion_Expulsion', 'Cod_parte', 'Puntos', 'Incidencia', 'Descripcion', 'Materia', 'Fecha_Parte', 'Hora_parte', 'Fecha_Comunicacion', 'Via_Comunicacion', 'Caducado');
    $column = 'A';
    foreach ($fields as $field) {
        $sheet->setCellValue($column . '1', $field);
        $column++;
    }

    //output each row of the data, format line as xlsx and write to file
    $rowNumber = 2;
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $sheet->setCellValue('A' . $rowNumber, $row['grupo']);
        $sheet->setCellValue('B' . $rowNumber, $row['matricula']);
        $sheet->setCellValue('C' . $rowNumber, $row['nombre']);
        $sheet->setCellValue('D' . $rowNumber, $row['apellidos']);
        $sheet->setCellValue('E' . $rowNumber, $row['cod_expulsion']);
        $sheet->setCellValue('F' . $rowNumber, $row['fecha_Inicio']);
        $sheet->setCellValue('G' . $rowNumber, $row['fecha_Fin']);
        $sheet->setCellValue('H' . $rowNumber, $row['tipo_expulsion']);
        $sheet->setCellValue('I' . $rowNumber, $row['fecha_Insercion']);
        $sheet->setCellValue('J' . $rowNumber, $row['cod_parte']);
        $sheet->setCellValue('K' . $rowNumber, $row['puntos']);
        $sheet->setCellValue('L' . $rowNumber, $row['incidencia']);
        $sheet->setCellValue('M' . $rowNumber, $row['descripcion']);
        $sheet->setCellValue('N' . $rowNumber, $row['materia']);
        $sheet->setCellValue('O' . $rowNumber, $row['fecha']);
        $sheet->setCellValue('P' . $rowNumber, $row['hora']);
        $sheet->setCellValue('Q' . $rowNumber, $row['fecha_Comunicacion']);
        $sheet->setCellValue('R' . $rowNumber, $row['via_Comunicacion']);
        $sheet->setCellValue('S' . $rowNumber, $row['caducado']);
        $rowNumber++;
    }

    $filename = 'expulsiones_' . date('Y-m-d') . '.xlsx';

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="' . urlencode($filename) . '"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
}
exit;
?>
