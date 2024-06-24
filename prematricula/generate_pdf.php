<?php
require('libs/fpdf.php');
require('./../archivosComunes/conexion.php');

include("enviarABD.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Recoger los datos del formulario
    $curso = $_POST['curso'];
    $primerApellido = $_POST['primer-apellido'];
    $segundoApellido = $_POST['segundo-apellido'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $sexo = $_POST['sexo'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $municipioNacimiento = $_POST['municipio_nacimiento'];
    $provinciaNacimiento = $_POST['provincia_nacimiento'];
    $paisNacimientoExtranjeros = $_POST['pais_nacimiento_extranjeros'];
    $familiaNumerosa = $_POST['familia_numerosa'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $portal = $_POST['portal'];
    $piso = $_POST['piso'];
    $puerta = $_POST['puerta'];
    $codigoPostal = $_POST['codigo_postal'];
    $municipio = $_POST['municipio'];
    $provincia = $_POST['provincia'];
    $telefonoUrgencia = $_POST['telefono_urgencia'];

    $centro = $_POST['centro'];
    $localidadCentro = $_POST['localidad_centro'];
    $provinciaCentro = $_POST['provincia_centro'];
    $curso_antiguo = $_POST['curso_antiguo'];
    
    if($curso == "4ESO"){
        $mates = $_POST['comunes_mates'];
        $opcion = $_POST['preferenciaClasesOpcion'];
        $opcionArray = explode("/",$opcion);
    }

    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $optativas = $_POST['preferenciaClasesOptativas'];
        $optativasArray = explode("/",$optativas);
    }

    if($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $obligatoria = $_POST['preferenciaClasesObligatoria'];
        $modalidad = $_POST['preferenciaClasesModalidad'];
        $modalidadArray = explode("/",$modalidad);
    }

    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO") {
        $bilingue = $_POST['bilingue'];
    }

    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO") {
        $religion = $_POST['religion'];
    }

    if($curso == "SMR1" || $curso == "SMR2" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2"){
        $miTelefono = $_POST['telefonoAlumno'];
        $miCorreo = $_POST['correoAlumno'];

    }

    if($curso == "SMR2" || $curso == "PEFP2" || $curso == "DAM2" || $curso == "DAW2"){
        $cambio = $_POST['cambioDT'];
    }

    if( $curso == "SMR1" ||  $curso == "SMR2" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2"){
        $trabaja = $_POST['trabaja'];
    }

        $nombreApellidosProgenitor1 = $_POST['nombre_apellidos_progenitor1'];
        $dniProgenitor1 = $_POST['dni_progenitor1'];
        $telefonoProgenitor1 = $_POST['telefono_progenitor1'];
        $correoProgenitor1 = $_POST['correo_progenitor1'];
        $nombreApellidosProgenitor2 = $_POST['nombre_apellidos_progenitor2'];
        $dniProgenitor2 = $_POST['dni_progenitor2'];
        $telefonoProgenitor2 = $_POST['telefono_progenitor2'];
        $correoProgenitor2 = $_POST['correo_progenitor2'];
    


    //Crear el PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    //Título del documento
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0, 0, 0); //Negro
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 10); // Configurar la fuente antes de agregar cualquier texto
    //Logo y datos del centro
    $image_path = '../images/logoJulioVerneNuevo.png';
    $image_path_firma = '../images/firmaAlicia.jpg';
    $image_path_sello = '../images/selloIES.png';
    // Obtener el año actual
    $year_current = date('Y');

    // Obtener el año siguiente
    $year_next = date('Y') + 1;
    $text = "IMPRESO DE MATRÍCULA EN CENTROS\nEDUCATIVOS SOSTENIDOS CON FONDOS\nPÚBLICOS\n".$curso."\nCURSO ".$year_current." / ".$year_next."\nIES JULIO VERNE (BARGAS)";
    
    // Añadir la imagen (primera columna)
    $pdf->Image($image_path, 10, 5, 40); // (ruta, x, y, ancho)

    // Mover la posición de la celda para la segunda columna
    $pdf->SetXY(110, 12); // Ajustar x e y según sea necesario
    $pdf->MultiCell(0, 5, mb_convert_encoding($text, "ISO-8859-1", "UTF-8"), 0, 'C');
 
    //Establecer fuente y tamaño de texto para el contenido
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0); //Restaurar color negro
    $pdf->Ln(5);
    //Datos del alumno
    $pdf->SetFont('Arial', 'B', 10);    
    $pdf->Cell(0, 5, mb_convert_encoding('Datos del Alumno o Alumna', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, mb_convert_encoding('Primer Apellido: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($primerApellido, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 5, mb_convert_encoding('Segundo Apellido: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($segundoApellido, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 5, mb_convert_encoding('Nombre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($nombre, "ISO-8859-1", "UTF-8"), 0, 1);
    if(!empty($dni)){
    $pdf->Cell(0, 5, mb_convert_encoding('DNI: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($dni, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    $pdf->Cell(0, 5, mb_convert_encoding('Sexo: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($sexo, "ISO-8859-1", "UTF-8"), 0, 1);

    if ($curso == "SMR1" || $curso == "SMR2" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2") {
        $pdf->Cell(0, 5, mb_convert_encoding('Correo electrónico del alumno: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($miCorreo, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 5, mb_convert_encoding('Teléfono del alumno: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($miTelefono, "ISO-8859-1", "UTF-8"), 0, 1);
    }



    //Datos de Nacimiento
    $pdf->Ln();
    // Mover la posición de la celda para la segunda columna
    $pdf->SetXY(110, 46); // Ajustar x e y según sea necesario
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, mb_convert_encoding('Datos de Nacimiento', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->SetXY(110, $pdf->GetY()); // Ajustar x e y según sea necesario
    $pdf->Cell(0, 5, mb_convert_encoding('Fecha de Nacimiento: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($fechaNacimiento, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetXY(110, $pdf->GetY()); // Ajustar x e y según sea necesario
    $pdf->Cell(0, 5, mb_convert_encoding('Municipio: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($municipioNacimiento, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetXY(110, $pdf->GetY()); // Ajustar x e y según sea necesario
    $pdf->Cell(0, 5, mb_convert_encoding('Provincia: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($provinciaNacimiento, "ISO-8859-1", "UTF-8"), 0, 1);
    if (!empty($paisNacimientoExtranjeros)) {
        $pdf->SetXY(110, $pdf->GetY()); // Ajustar x e y según sea necesario
        $pdf->Cell(0, 5, mb_convert_encoding('País de Nacimiento (Solo Extranjeros): ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($paisNacimientoExtranjeros, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    $pdf->SetXY(110, $pdf->GetY()); // Ajustar x e y según sea necesario
    $pdf->Cell(0, 5, mb_convert_encoding('Familia Numerosa: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($familiaNumerosa, "ISO-8859-1", "UTF-8"), 0, 1);



    //Datos de los Progenitores o Tutores Legales
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 5, mb_convert_encoding('Datos de los Progenitores o Tutores Legales', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 5, mb_convert_encoding('Progenitor 1 o Tutor/a 1', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 5, mb_convert_encoding('Nombre y Apellidos del progenitor 1: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($nombreApellidosProgenitor1, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 5, mb_convert_encoding('DNI: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($dniProgenitor1, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 5, mb_convert_encoding('Teléfono del progenitor 1: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($telefonoProgenitor1, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 5, mb_convert_encoding('Correo electrónico progenitor 1: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($correoProgenitor1, "ISO-8859-1", "UTF-8"), 0, 1);
        if(!empty($dniProgenitor2)){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 5, mb_convert_encoding('Progenitor 2 o Tutor/a 2', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 5, mb_convert_encoding('Nombre y Apellidos de la progenitor 2: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($nombreApellidosProgenitor2, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 5, mb_convert_encoding('DNI: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($dniProgenitor2, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 5, mb_convert_encoding('Teléfono de la progenitor 2: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($telefonoProgenitor2, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 5, mb_convert_encoding('Correo electrónico progenitor 2: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($correoProgenitor2, "ISO-8859-1", "UTF-8"), 0, 1);
        }
    

    //Datos del Domicilio Familiar
    $pdf->Ln();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 5, mb_convert_encoding('Datos del Domicilio Familiar', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, mb_convert_encoding('C/Avda. Plaza: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($calle, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 5, mb_convert_encoding('Número: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($numero, "ISO-8859-1", "UTF-8"), 0, 1);
    if (!empty($portal)) {
        $pdf->Cell(0, 5, mb_convert_encoding('Portal: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($portal, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    if (!empty($piso)) {
        $pdf->Cell(0, 5, mb_convert_encoding('Piso: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($piso, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    if (!empty($puerta)) {
        $pdf->Cell(0, 5, mb_convert_encoding('Puerta: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($puerta, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    $pdf->Cell(0, 5, mb_convert_encoding('Código Postal: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($codigoPostal, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 5, mb_convert_encoding('Municipio: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($municipio, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 5, mb_convert_encoding('Provincia: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($provincia, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 5, mb_convert_encoding('Teléfono en caso de Urgencias: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($telefonoUrgencia, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetTextColor(255, 0, 0);
    if ($curso == "SMR2" || $curso == "SMR1" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2") {
        $pdf->Cell(0, 5, mb_convert_encoding('TRABAJA: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($trabaja, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    if ($curso == "SMR2" || $curso == "PEFP2" || $curso == "DAM2" || $curso == "DAW2") {
        $pdf->Cell(0, 5, mb_convert_encoding('¿Ha cambiado de domicilio o teléfono respecto al curso pasado?: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($cambio, "ISO-8859-1", "UTF-8"), 0, 1);
    }


    $pdf->SetTextColor(0);
    if (!empty($centro) && !empty($localidadCentro) && !empty($provinciaCentro) && !empty($curso_antiguo)){
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, mb_convert_encoding('Datos Académicos del Curso Anterior', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->MultiCell(0, 5, mb_convert_encoding('El solicitante, durante el curso 2023-2024, estuvo matriculado en el centro: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($centro, "ISO-8859-1", "UTF-8").  mb_convert_encoding(' de la localidad: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($localidadCentro, "ISO-8859-1", "UTF-8"). mb_convert_encoding(' ,provincia: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($provinciaCentro, "ISO-8859-1", "UTF-8") . mb_convert_encoding(' en el curso: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($curso_antiguo, "ISO-8859-1", "UTF-8"), 0, 1);  

    }
    $pdf->Cell(0, 5, mb_convert_encoding('Ampa: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($ampa, "ISO-8859-1", "UTF-8"), 0, 1);

    //Datos de las Materias
    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO") {
        $pdf->SetFont('Arial', '', 10);
        if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO") {
            $pdf->Cell(0, 5, mb_convert_encoding('Curso Bilingüe; ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($bilingue, "ISO-8859-1", "UTF-8"), 0, 1);
        }
        if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO") {
            $pdf->Cell(0, 5, mb_convert_encoding('Religión (1 hora): ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($religion, "ISO-8859-1", "UTF-8"), 0, 1);
        }
    }
    $pueblo=false;
    if (!empty($pueblo_transporte)){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 5, mb_convert_encoding('Transporte', "ISO-8859-1", "UTF-8"), 0, 1); 
        $pdf->SetFont('Arial', '', 10);
        $pueblo=true;
      $pdf->Cell(0, 5, mb_convert_encoding('Pueblo transporte: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($pueblo_transporte, "ISO-8859-1", "UTF-8"), 0, 1);  

    }
    if (!empty($urbanizacion_transporte)){
        if($pueblo==false){
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(0, 5, mb_convert_encoding('Transporte', "ISO-8859-1", "UTF-8"), 0, 1); 
            $pdf->SetFont('Arial', '', 10);
        }
        $pdf->Cell(0, 5, mb_convert_encoding('Urbanización transporte: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($urbanizacion_transporte, "ISO-8859-1", "UTF-8"), 0, 1);  
  
      }
     
    // Agregar tabla de materias Comunes
    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOCIENCIAS" || $curso == "2BTOHUMCSO" || $curso == "SMR1" || $curso == "SMR2" || $curso == "DAM1" || $curso == "DAM2" || $curso == "DAW1" || $curso == "DAW2"){
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, mb_convert_encoding('Materias Comunes', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
    
        if($curso == "1ESO"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '1ESO' AND tipo LIKE '%comunes'";  
        }
        if($curso == "2ESO"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '2ESO' AND tipo LIKE '%comunes'";  
        }
        if($curso == "3ESO"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '3ESO' AND tipo LIKE '%comunes'";  
        }
        if($curso == "4ESO"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '4ESO' AND tipo LIKE '%comunes'";  
        }
        if($curso == "1BTOCIENCIAS"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '1BTOCIENCIAS' AND tipo LIKE '%comunes'";  
        }
        if($curso == "1BTOHUMCSO"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '1BTOHUMCSO' AND tipo LIKE '%comunes'";  
        }
        if($curso == "2BTOCIENCIAS"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '2BTOCIENCIAS' AND tipo LIKE '%comunes'";  
        }
        if($curso == "2BTOHUMCSO"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '2BTOHUMCSO' AND tipo LIKE '%comunes'";  
        }
        if($curso == "SMR1"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'SMR1' AND tipo LIKE '%comunes'";  
        }
        if($curso == "SMR2"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'SMR2' AND tipo LIKE '%comunes'";  
        }
        if($curso == "DAW1"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'DAW1' AND tipo LIKE '%comunes'";  
        }
        if($curso == "DAW2"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'DAW2' AND tipo LIKE '%comunes'";  
        }
        if($curso == "DAM1"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'DAM1' AND tipo LIKE '%comunes'";  
        }
        if($curso == "DAM2"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'DAM2' AND tipo LIKE '%comunes'";  
        }

        $resul = $db->query($select);
        $pdf->SetFont('Arial', '', 10);
        while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
        if($curso == "4ESO"){
            if(str_contains($asignatura["nombre"],"Matemáticas")){                                                     
                if($asignatura["nombre"] == $mates){
                    $pdf->Cell(95, 5, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1); 
                    $pdf->Cell(95, 5, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
                    $pdf->Ln();                       
                }
            }else{
                $pdf->Cell(95, 5, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
                $pdf->Cell(95, 5, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
                $pdf->Ln();
            }
        }else{
            $pdf->Cell(95, 5, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
            $pdf->Cell(95, 5, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
            $pdf->Ln();
        }
    }
}

    //Agregar materias de Opcion
    if ($curso == "4ESO") {
        $pdf->ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, mb_convert_encoding('Materias de Opción Por Orden', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $arrayMostrar = [];
        for ($i=0; $i < count($opcionArray) ; $i++) { 
            array_push($arrayMostrar,[($i+1). ": ".mb_convert_encoding($opcionArray[$i], "ISO-8859-1", "UTF-8"),mb_convert_encoding("4 horas", "ISO-8859-1", "UTF-8")]);
        }
        addBasicTable($pdf, $arrayMostrar);
    }    
    

    //Agregar materias Obligatorias
    if ($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, mb_convert_encoding('Materias Obligatorias', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 5, mb_convert_encoding($obligatoria, "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('4 horas', "ISO-8859-1", "UTF-8"), 1);
    }    
    

    //Agregar materias de Modalidad
    if ($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, mb_convert_encoding('Materias de Modalidad Por Orden', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $arrayMostrar = [];
        for ($i=0; $i < count($modalidadArray) ; $i++) { 
            array_push($arrayMostrar,[($i+1). ": ".mb_convert_encoding($modalidadArray[$i], "ISO-8859-1", "UTF-8"),mb_convert_encoding("4 horas", "ISO-8859-1", "UTF-8")]);
        }
        addBasicTable($pdf, $arrayMostrar);
    }    
    

    //Agregar materias Optativas
    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $pdf->ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, mb_convert_encoding('Materias Optativas Por Orden', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $arrayMostrar = [];
        for ($i=0; $i < count($optativasArray) ; $i++) { 
            array_push($arrayMostrar,[($i+1). ": ".mb_convert_encoding($optativasArray[$i], "ISO-8859-1", "UTF-8"),mb_convert_encoding("4 horas", "ISO-8859-1", "UTF-8")]);
        }
        addBasicTable($pdf, $arrayMostrar);
    }    
    
    //Agregar Modulos Formativos de Caracter General 
    if($curso == "CFGB1" || $curso == "CFGB2" || $curso == "PEFP1" || $curso == "PEFP2"){
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, mb_convert_encoding('Módulos Formativos de Carácter General', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();

        if($curso == "CFGB1"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'CFGB1' AND tipo LIKE '%general'";  
        }
        if($curso == "CFGB2"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'CFGB2' AND tipo LIKE '%general'";  
        }
        if($curso == "PEFP1"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'PEFP1' AND tipo LIKE '%general'";  
        }
        if($curso == "PEFP2"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'PEFP2' AND tipo LIKE '%general'";  
        }
    
        $resul = $db->query($select);
        $pdf->SetFont('Arial', '', 10);
        while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Cell(120, 5, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
            $pdf->Cell(80, 5, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
            $pdf->Ln();
        }
    }
    

    //Agregar Modulos Profesionales 
    if($curso == "CFGB1" || $curso == "CFGB2" || $curso == "PEFP1" || $curso == "PEFP2"){
        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, mb_convert_encoding('Módulos Profesionales ', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(95, 5, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 5, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();

        if($curso == "CFGB1"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'CFGB1' AND tipo LIKE '%profesionales'";  
        }
        if($curso == "CFGB2"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'CFGB2' AND tipo LIKE '%profesionales'";  
        }
        if($curso == "PEFP1"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'PEFP1' AND tipo LIKE '%profesionales'";  
        }
        if($curso == "PEFP2"){
            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'PEFP2' AND tipo LIKE '%profesionales'";  
        }
    
        $resul = $db->query($select);
        $pdf->SetFont('Arial', '', 10);
        while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                $pdf->Cell(95, 5, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
                $pdf->Cell(95, 5, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
                $pdf->Ln();
        }
    }
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 8);
    $pdf->SetTextColor(255, 0, 0); //Negro
    $pdf->MultiCell(0, 5, mb_convert_encoding('Autorizo a mi hijo/a a realizar actividades dentro de Bargas sin petición de permiso previo.', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->MultiCell(0, 5, mb_convert_encoding('Autorizo al IES Julio Verne al uso de las imágenes en las cuales aparezca individualmente o en grupo relativo a las actividades lectivas, complementarias y extraescolares para su publicación en la web del centro y/o en las redes sociales del mismo.', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetTextColor(0, 0, 0); //Negro
    $pdf->Ln();
    $pdf->SetFont('Arial', '', 10);

    $pdf->SetXY(20, $pdf->GetY()); // Ajustar x e y según sea necesario

    $pdf->cell(0, 5, mb_convert_encoding('Firma del progenitor 1', "ISO-8859-1", "UTF-8"));
    $pdf->SetXY(60, $pdf->GetY()); // Ajustar x e y según sea necesario
    $pdf->cell(0, 5,mb_convert_encoding('Firma de la progenitor 2', "ISO-8859-1", "UTF-8"));
    $pdf->SetXY(100, $pdf->GetY()); // Ajustar x e y según sea necesario
    $pdf->SetFont('Arial', 'U', 10);
    $pdf->cell(0, 5,mb_convert_encoding('En caso de 1 sola firma, aportar Declaración Responsable', "ISO-8859-1", "UTF-8"));
    $pdf->SetFont('Arial', '', 10);

    $pdf->SetXY(10, $pdf->GetY()+30); // Ajustar x e y según sea necesario
    $pdf->MultiCell(0, 5, mb_convert_encoding('Resguardo de matrícula que ha presentado el alumno/a '.$nombre.' '.$primerApellido.' '.$segundoApellido.' para 1º ESO para el curso académico 2024-2025 en el IES "Julio Verne" el día '.date('d-m-Y'), "ISO-8859-1", "UTF-8"));
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY($pdf->GetX(), $pdf->GetY()); // Ajustar x e y según sea necesario
    $pdf->ln(); 

    $pdf->cell(0, 5, mb_convert_encoding('Documentos a presentar', "ISO-8859-1", "UTF-8"), 0, 1 ,'C');
    $pdf->ln(); 
    $pdf->SetFont('Arial', '', 10);
    $pdf->cell(0, 5, mb_convert_encoding('1.- Impreso de matrícula.', "ISO-8859-1", "UTF-8"));
    $pdf->ln(); 
    $pdf->cell(0, 5, mb_convert_encoding('2.- 1 foto con nombre y apellidos al dorso', "ISO-8859-1", "UTF-8"));
    $pdf->ln(); 
    $pdf->cell(0, 5, mb_convert_encoding('3.- Fotocopia del DNI', "ISO-8859-1", "UTF-8"));
    $pdf->SetXY(10, $pdf->GetY()+10); // Ajustar x e y según sea necesario
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->MultiCell(0, 5, mb_convert_encoding('* Si el alumno/a ha estado matriculado en el curso 2023/2024 en un centro fuera de Castilla-La Mancha, deberá aportar en el momento de matricularse un certificado oficial académico de dicho curso, expedido por el centro.', "ISO-8859-1", "UTF-8"));
    $pdf->SetFont('Arial', '', 10);
    $pdf->ln(); 
    $pdf->MultiCell(0, 5, mb_convert_encoding('La matrícula debe presentarse firmada por el progenitor 1 y el progenitor 2 (ambos) o por los tutores legales del alumno/a. Si por algún motivo, la matrícula fuese firmada por un solo progenitor, se rellenará también el impreso de DECLARACIÓN RESPONSABLE, que deberán pedir en el colegio y entregarlo en el instituto junto con la matrícula.', "ISO-8859-1", "UTF-8"));
    $pdf->MultiCell(0, 5, mb_convert_encoding('En caso afirmativo cederemos sus teléfonos de contacto a los responsables del AMPA.', "ISO-8859-1", "UTF-8"));
    $pdf->ln(); 

    // Tabla
    $pdf->SetFillColor(0, 0, 0); // Fondo negro
    $pdf->SetTextColor(255, 255, 255); // Texto blanco
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(0, 10, mb_convert_encoding('INFORMACIÓN BÁSICA DE PROTECCIÓN DE DATOS', "ISO-8859-1", "UTF-8"), 0, 1, 'C', true);

    // Reset de colores para el resto de filas
    $pdf->SetFillColor(255, 255, 255); // Fondo blanco
    $pdf->SetTextColor(0, 0, 0); // Texto negro
    $pdf->SetFont('Arial', '', 8);

    // Siguientes filas
    $pdf->Cell(95, 5, mb_convert_encoding('Responsable', "ISO-8859-1", "UTF-8"), 1, 0, 'C', true);
    $pdf->MultiCell(95, 5, mb_convert_encoding('Viceconsejería de Educación', "ISO-8859-1", "UTF-8"), 1, 1, 'C', true);
    $pdf->Cell(95, 10, mb_convert_encoding('Finalidad', "ISO-8859-1", "UTF-8"), 1, 0, 'C', true);
    $pdf->MultiCell(95, 5, mb_convert_encoding('Gestión administrativa y educativa del alumnado de centros docentes de Castilla-La Mancha', "ISO-8859-1", "UTF-8"), 1, 1, 'C', true);
    $pdf->Cell(95, 20, mb_convert_encoding('Legitimación', "ISO-8859-1", "UTF-8"), 1, 0, 'C', true);
    $pdf->MultiCell(95, 5, mb_convert_encoding('Cumplimiento de una obligación legal/Ejercicio de poderes públicos-Ley Orgánica 2/2006, de 3 de mayo, de Educación / Ley 7/2010, de 20 de julio, de Educación de Castilla-La Mancha.', "ISO-8859-1", "UTF-8"), 1, 1, 'C', true);
    $pdf->Cell(95, 5, mb_convert_encoding('Destinatarios', "ISO-8859-1", "UTF-8"), 1, 0, 'C', true);
    $pdf->MultiCell(95, 5, mb_convert_encoding('Existe cesión de datos', "ISO-8859-1", "UTF-8"), 1, 1, 'C', true);
    $pdf->Cell(95, 15, mb_convert_encoding('Derechos', "ISO-8859-1", "UTF-8"), 1, 0, 'C', true);
    $pdf->MultiCell(95, 5, mb_convert_encoding('Puede ejercer los derechos de acceso, rectificación o supresión de sus datos, así como de otros derechos, tal y como se explica en la información adicional', "ISO-8859-1", "UTF-8"), 1, 1, 'C', true);
    $pdf->Cell(95, 10, mb_convert_encoding('Información adicional', "ISO-8859-1", "UTF-8"), 1, 0, 'C', true);
    $pdf->MultiCell(95, 5, mb_convert_encoding('Disponible en la dirección electrónica Electrónica: https://www.castillalamancha.es/protecciondedatos', "ISO-8859-1", "UTF-8"), 1, 1, 'C', true);
    //Mostrar el PDF
    $nombrePDF = mb_convert_encoding('matricula_'.$primerApellido.'_'.$nombre, "ISO-8859-1", "UTF-8");
    $pdf->Output('I', $nombrePDF.'.pdf');
}


//Función para agregar una tabla simple al PDF
function addBasicTable($pdf, $data) {
    $pdf->SetFont('Arial', '', 10);
    foreach ($data as $row) {
        foreach ($row as $col) {
            $pdf->Cell(95, 5, $col, 1);
        }
        $pdf->Ln();
    }    
}

?>