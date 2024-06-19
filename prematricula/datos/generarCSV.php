<?php
// Iniciamos la sesion
if (isset($_GET['curso'])) {
  $curso = $_GET['curso'];

  if ($curso !== 'PEFP1' && $curso !== 'PEFP2' && $curso !== 'SMR1' && $curso !== 'SMR2' && $curso !== 'CFGB1' && $curso !== 'CFGB2' && $curso !== 'DAM1' && $curso !== 'DAM2' && $curso !== 'DAW1' && $curso !== 'DAM2') {
    //include database configuration file
    $db = require_once ('../../archivosComunes/conexion.php');

    //get records from database
    $query = $db->query("SELECT am.cod_alumnosMatriculados, CONCAT(primer_apellido_alumno,' ', segundo_apellido_alumno,', ', nombre_alumno) AS alumno,
curso_antiguo, religion
FROM AlumnosMatriculados am, Matriculas m
WHERE am.cod_alumnosMatriculados = m.cod_matricula AND m.curso = '" . $curso . "' ;");

    if ($query->rowCount() > 0) {
      $delimiter = ",";
      $filename = $curso . "_" . date('Y') . "-" . date('Y') + 1 . ".csv";
      
      //create a file pointer
      $f = fopen('php://memory', 'w');

      //set column headers
      if($curso == '4ESO'){
      $fields = array('Alumno/a', 'Curso que viene', 'Curso anterior', 'Opcion 1', 'Opcion 2', 'Opcion 3', 'Opcion 4', 'Opcion 5', 'Optativa 1', 'Optativa 2', 'Optativa 3', 'Optativa 4', 'Optativa 5', 'Religión');
      }
      if($curso == '1BTOCIENCIAS' || $curso == '1BTOHUMCSO'){
        $fields = array('Alumno/a', 'Curso que viene', 'Curso anterior', 'Obligatoria', 'Modalidad 1','Modalidad 2','Modalidad 3','Modalidad 4', 'Optativa 1', 'Optativa 2', 'Optativa 3',  'Optativa 4', 'Religión');
        }else if( $curso == '2BTOHUMCSO'){
          $fields = array('Alumno/a', 'Curso que viene', 'Curso anterior', 'Obligatoria', 'Modalidad 1','Modalidad 2','Modalidad 3','Modalidad 4', 'Optativa 1', 'Optativa 2', 'Optativa 3');
          }else if($curso == '2BTOCIENCIAS' ){
          $fields = array('Alumno/a', 'Curso que viene', 'Curso anterior', 'Obligatoria', 'Modalidad 1','Modalidad 2','Modalidad 3','Modalidad 4','Modalidad 5',  'Optativa 1', 'Optativa 2', 'Optativa 3');
          }else{
        $fields = array('Alumno/a', 'Curso que viene', 'Curso anterior', 'Optativa 1', 'Optativa 2', 'Optativa 3', 'Religión');

      }
      fputcsv($f, $fields, $delimiter);
      $optativa1 = "";
      $optativa2 = "";
      $optativa3 = "";
      $optativa4 = "";
      $optativa5 = "";
      $opcion1 = "";
      $opcion2 = "";
      $opcion3 = "";
      $opcion4 = "";
      $opcion5 = "";
      $modalidad1 = "";
      $modalidad2 = "";
      $modalidad3 = "";
      $modalidad4 = "";
      $modalidad5 = "";
      $obligatoria1 = "";
      //output each row of the data, format line as csv and write to file pointer
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        //get records from database
        $queryOptativas = $db->query("SELECT a.nombre, o.preferencia
        FROM AlumnosMatriculados am, Matriculas m, Optativas o, Asignaturas a
        WHERE am.cod_alumnosMatriculados = m.cod_matricula AND am.cod_alumnosMatriculados = o.matricula AND o.asignatura = a.cod_asignatura AND am.cod_alumnosMatriculados = '" . $row['cod_alumnosMatriculados'] . "';");

        if ($queryOptativas->rowCount() > 0) {


          while ($rowOptativas = $queryOptativas->fetch(PDO::FETCH_ASSOC)) {
            if ($rowOptativas['preferencia'] == 1) {
              $optativa1 = $rowOptativas['nombre'];
            }
            if ($rowOptativas['preferencia'] == 2) {
              $optativa2 = $rowOptativas['nombre'];
            }
            if ($rowOptativas['preferencia'] == 3) {
              $optativa3 = $rowOptativas['nombre'];
            }
            if($curso == '4ESO' || $curso == '1BTOCIENCIAS' || $curso == '1BTOHUMCSO')
              if ($rowOptativas['preferencia'] == 4) {
                $optativa4 = $rowOptativas['nombre'];
              }
            }
            if($curso == '4ESO'){
              if ($rowOptativas['preferencia'] == 5) {
                $optativa5 = $rowOptativas['nombre'];
              }
            }
          }
          if($curso == '4ESO'){
          $queryOpciones = $db->query("SELECT a.nombre, o.preferencia
          FROM AlumnosMatriculados am, Matriculas m, Opciones o, Asignaturas a
          WHERE am.cod_alumnosMatriculados = m.cod_matricula AND am.cod_alumnosMatriculados = o.matricula AND o.asignatura = a.cod_asignatura AND am.cod_alumnosMatriculados = '" . $row['cod_alumnosMatriculados'] . "';");
  
          if ($queryOpciones->rowCount() > 0) {
  
            while ($rowOpciones = $queryOpciones->fetch(PDO::FETCH_ASSOC)) {
              if ($rowOpciones['preferencia'] == 1) {
                $opcion1 = $rowOpciones['nombre'];
              }
              if ($rowOpciones['preferencia'] == 2) {
                $opcion2 = $rowOpciones['nombre'];
              }
              if ($rowOpciones['preferencia'] == 3) {
                $opcion3 = $rowOpciones['nombre'];
              }
                if ($rowOpciones['preferencia'] == 4) {
                  $opcion4 = $rowOpciones['nombre'];
                }
                if ($rowOpciones['preferencia'] == 5) {
                  $opcion5 = $rowOpciones['nombre'];
                }
              
            }
          }
        }
        if($curso == '1BTOCIENCIAS' || $curso == '1BTOHUMCSO' || $curso == '2BTOCIENCIAS' || $curso == '2BTOHUMCSO'){
          $queryOpciones = $db->query("SELECT a.nombre, mo.preferencia
          FROM AlumnosMatriculados am, Matriculas m, Modalidad mo, Asignaturas a
          WHERE am.cod_alumnosMatriculados = m.cod_matricula AND am.cod_alumnosMatriculados = mo.matricula AND mo.asignatura = a.cod_asignatura AND am.cod_alumnosMatriculados = '" . $row['cod_alumnosMatriculados'] . "';");
  
          if ($queryOpciones->rowCount() > 0) {

  
            while ($rowModalidad = $queryOpciones->fetch(PDO::FETCH_ASSOC)) {
              if ($rowModalidad['preferencia'] == 1) {
                $modalidad1 = $rowModalidad['nombre'];
              }
              if ($rowModalidad['preferencia'] == 2) {
                $modalidad2 = $rowModalidad['nombre'];
              }
              if ($rowModalidad['preferencia'] == 3) {
                $modalidad3 = $rowModalidad['nombre'];
              }
                if ($rowModalidad['preferencia'] == 4) {
                  $modalidad4 = $rowModalidad['nombre'];
                }
                if($curso == '2BTOCIENCIAS'){
                if ($rowModalidad['preferencia'] == 5) {
                  $modalidad5 = $rowModalidad['nombre'];
                }
              }
              
            }
          }
        }
        if($curso == '1BTOCIENCIAS' || $curso == '1BTOHUMCSO' || $curso == '2BTOCIENCIAS' || $curso == '2BTOHUMCSO'){
          $queryOpciones = $db->query("SELECT a.nombre
          FROM AlumnosMatriculados am, Matriculas m, Obligatorias o, Asignaturas a
          WHERE am.cod_alumnosMatriculados = m.cod_matricula AND am.cod_alumnosMatriculados = o.matricula AND o.asignatura = a.cod_asignatura AND am.cod_alumnosMatriculados = '" . $row['cod_alumnosMatriculados'] . "';");
  
          if ($queryOpciones->rowCount() > 0) {

  
            while ($rowObligatoria = $queryOpciones->fetch(PDO::FETCH_ASSOC)) {
                $obligatoria1 = $rowObligatoria['nombre'];
              }
              
          }
        }
          if($curso == '4ESO'){
            $lineData = array($row['alumno'], $curso, $row['curso_antiguo'], $opcion1, $opcion2, $opcion3, $opcion4, $opcion5, $optativa1, $optativa2, $optativa3, $optativa4, $optativa5, $row['religion']);
          }else if($curso == '1BTOCIENCIAS' || $curso == '1BTOHUMCSO'){
            $lineData = array($row['alumno'], $curso, $row['curso_antiguo'], $obligatoria1, $modalidad1, $modalidad2, $modalidad3, $modalidad4, $optativa1, $optativa2, $optativa3, $optativa4);
            }else  if($curso == '2BTOHUMCSO'){
              $lineData = array($row['alumno'], $curso, $row['curso_antiguo'], $obligatoria1, $modalidad1, $modalidad2, $modalidad3, $modalidad4, $optativa1, $optativa2, $optativa3);
              }else  if($curso == '2BTOCIENCIAS'){
                $lineData = array($row['alumno'], $curso, $row['curso_antiguo'], $obligatoria1, $modalidad1, $modalidad2, $modalidad3, $modalidad4, $modalidad5, $optativa1, $optativa2, $optativa3);
                }else{
            $lineData = array($row['alumno'], $curso, $row['curso_antiguo'], $optativa1, $optativa2, $optativa3, $row['religion']);

          }
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
  }
}
?>