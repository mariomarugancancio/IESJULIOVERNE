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

        $nombreApellidosPadre = $_POST['nombre_apellidos_padre'];
        $dniPadre = $_POST['dni_padre'];
        $telefonoPadre = $_POST['telefono_padre'];
        $correoPadre = $_POST['correo_padre'];
        $nombreApellidosMadre = $_POST['nombre_apellidos_madre'];
        $dniMadre = $_POST['dni_madre'];
        $telefonoMadre = $_POST['telefono_madre'];
        $correoMadre = $_POST['correo_madre'];
    


    //Crear el PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    //Título del documento
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->SetTextColor(255, 0, 0); //Rojo
    $pdf->Cell(0, 10, mb_convert_encoding('Formulario de Matrícula 2024-2025 - ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($curso, "ISO-8859-1", "UTF-8"), 0, 1, 'C');
    $pdf->Ln(5);

    //Establecer fuente y tamaño de texto para el contenido
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0); //Restaurar color negro

    //Datos del alumno
    $pdf->SetFont('Arial', 'B', 14);    
    $pdf->Cell(0, 10, mb_convert_encoding('Datos del Alumno o Alumna', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding('Primer Apellido: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($primerApellido, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Segundo Apellido: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($segundoApellido, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Nombre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($nombre, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('DNI: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($dni, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Sexo: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($sexo, "ISO-8859-1", "UTF-8"), 0, 1);

    if ($curso == "SMR1" || $curso == "SMR2" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2") {
        $pdf->Cell(0, 10, mb_convert_encoding('Correo electrónico del alumno: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($miCorreo, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('Teléfono del alumno: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($miTelefono, "ISO-8859-1", "UTF-8"), 0, 1);
    }



    //Datos de Nacimiento
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, mb_convert_encoding('Datos de Nacimiento', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding('Fecha de Nacimiento: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($fechaNacimiento, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Municipio: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($municipioNacimiento, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Provincia: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($provinciaNacimiento, "ISO-8859-1", "UTF-8"), 0, 1);
    if (!empty($paisNacimientoExtranjeros)) {
        $pdf->Cell(0, 10, mb_convert_encoding('País de Nacimiento (Solo Extranjeros): ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($paisNacimientoExtranjeros, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    $pdf->Cell(0, 10, mb_convert_encoding('Familia Numerosa: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($familiaNumerosa, "ISO-8859-1", "UTF-8"), 0, 1);



    //Datos de los Padres o Tutores Legales
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Datos de los Padres o Tutores Legales', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, mb_convert_encoding('Padre o Tutor/a 1', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, mb_convert_encoding('Nombre y Apellidos del padre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($nombreApellidosPadre, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('DNI: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($dniPadre, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('Teléfono del padre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($telefonoPadre, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('Correo electrónico padre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($correoPadre, "ISO-8859-1", "UTF-8"), 0, 1);
    
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, mb_convert_encoding('Madre o Tutor/a 2', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, mb_convert_encoding('Nombre y Apellidos de la madre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($nombreApellidosMadre, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('DNI: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($dniMadre, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('Teléfono de la madre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($telefonoMadre, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('Correo electrónico madre: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($correoMadre, "ISO-8859-1", "UTF-8"), 0, 1);
    
    

    //Datos del Domicilio Familiar
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, mb_convert_encoding('Datos del Domicilio Familiar', "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding('C/Avda. Plaza: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($calle, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Número: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($numero, "ISO-8859-1", "UTF-8"), 0, 1);
    if (!empty($portal)) {
        $pdf->Cell(0, 10, mb_convert_encoding('Portal: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($portal, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    if (!empty($piso)) {
        $pdf->Cell(0, 10, mb_convert_encoding('Piso: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($piso, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    if (!empty($puerta)) {
        $pdf->Cell(0, 10, mb_convert_encoding('Puerta: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($puerta, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    $pdf->Cell(0, 10, mb_convert_encoding('Código Postal: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($codigoPostal, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Municipio: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($municipio, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Provincia: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($provincia, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->Cell(0, 10, mb_convert_encoding('Teléfono en caso de Urgencias: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($telefonoUrgencia, "ISO-8859-1", "UTF-8"), 0, 1);
    $pdf->SetTextColor(255, 0, 0);
    if ($curso == "SMR2" || $curso == "SMR1" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2") {
        $pdf->Cell(0, 10, mb_convert_encoding('TRABAJA: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($trabaja, "ISO-8859-1", "UTF-8"), 0, 1);
    }
    if ($curso == "SMR2" || $curso == "PEFP2" || $curso == "DAM2" || $curso == "DAW2") {
        $pdf->Cell(0, 10, mb_convert_encoding('¿Ha cambiado de domicilio o teléfono respecto al curso pasado?: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($cambio, "ISO-8859-1", "UTF-8"), 0, 1);
    }


    $pdf->SetTextColor(0);
    if (!empty($centro) && !empty($localidadCentro) && !empty($provinciaCentro)){
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Datos Académicos del Curso Anterior', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, mb_convert_encoding('El solicitante, durante el curso 2023-2024, estuvo matriculado en el centro: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($centro, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('de la localidad: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($localidadCentro, "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->Cell(0, 10, mb_convert_encoding('Provincia: ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($provinciaCentro, "ISO-8859-1", "UTF-8"), 0, 1);  
    }

    //Datos de las Materias
    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO") {
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Materias', "ISO-8859-1", "UTF-8"), 0, 1); 
        $pdf->SetFont('Arial', '', 12);
        if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO") {
            $pdf->Cell(0, 10, mb_convert_encoding('Curso Bilingüe; ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($bilingue, "ISO-8859-1", "UTF-8"), 0, 1);
        }
        if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO") {
            $pdf->Cell(0, 10, mb_convert_encoding('Religión (1 hora): ', "ISO-8859-1", "UTF-8") . mb_convert_encoding($religion, "ISO-8859-1", "UTF-8"), 0, 1);
        }
    }

    // Agregar tabla de materias Comunes
    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOCIENCIAS" || $curso == "2BTOHUMCSO" || $curso == "SMR1" || $curso == "SMR2" || $curso == "DAM1" || $curso == "DAM2" || $curso == "DAW1" || $curso == "DAW2"){
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Materias Comunes', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
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
        $pdf->SetFont('Arial', '', 12);
        while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
        if($curso == "4ESO"){
            if(str_contains($asignatura["nombre"],"Matemáticas")){                                                     
                if($asignatura["nombre"] == $mates){
                    $pdf->Cell(95, 10, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1); 
                    $pdf->Cell(95, 10, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
                    $pdf->Ln();                       
                }
            }else{
                $pdf->Cell(95, 10, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
                $pdf->Cell(95, 10, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
                $pdf->Ln();
            }
        }else{
            $pdf->Cell(95, 10, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
            $pdf->Cell(95, 10, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
            $pdf->Ln();
        }
    }
}

    //Agregar materias de Opcion
    if ($curso == "4ESO") {
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Materias de Opción Por Orden', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $arrayMostrar = [];
        for ($i=0; $i < count($opcionArray) ; $i++) { 
            array_push($arrayMostrar,[($i+1). ": ".mb_convert_encoding($opcionArray[$i], "ISO-8859-1", "UTF-8"),mb_convert_encoding("4 horas", "ISO-8859-1", "UTF-8")]);
        }
        addBasicTable($pdf, $arrayMostrar);
    }    
    

    //Agregar materias Obligatorias
    if ($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Materias Obligatorias', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(95, 10, mb_convert_encoding($obligatoria, "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('4 horas', "ISO-8859-1", "UTF-8"), 1);
    }    
    

    //Agregar materias de Modalidad
    if ($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Materias de Modalidad Por Orden', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $arrayMostrar = [];
        for ($i=0; $i < count($modalidadArray) ; $i++) { 
            array_push($arrayMostrar,[($i+1). ": ".mb_convert_encoding($modalidadArray[$i], "ISO-8859-1", "UTF-8"),mb_convert_encoding("4 horas", "ISO-8859-1", "UTF-8")]);
        }
        addBasicTable($pdf, $arrayMostrar);
    }    
    

    //Agregar materias Optativas
    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Materias Optativas Por Orden', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Ln();
        $arrayMostrar = [];
        for ($i=0; $i < count($optativasArray) ; $i++) { 
            array_push($arrayMostrar,[($i+1). ": ".mb_convert_encoding($optativasArray[$i], "ISO-8859-1", "UTF-8"),mb_convert_encoding("4 horas", "ISO-8859-1", "UTF-8")]);
        }
        addBasicTable($pdf, $arrayMostrar);
    }    
    
    //Agregar Modulos Formativos de Caracter General 
    if($curso == "CFGB1" || $curso == "CFGB2" || $curso == "PEFP1" || $curso == "PEFP2"){
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Módulos Formativos de Carácter General', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
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
        $pdf->SetFont('Arial', '', 12);
        while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Cell(120, 10, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
            $pdf->Cell(80, 10, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
            $pdf->Ln();
        }
    }
    

    //Agregar Modulos Profesionales 
    if($curso == "CFGB1" || $curso == "CFGB2" || $curso == "PEFP1" || $curso == "PEFP2"){
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, mb_convert_encoding('Módulos Profesionales ', "ISO-8859-1", "UTF-8"), 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(95, 10, mb_convert_encoding('Nombre', "ISO-8859-1", "UTF-8"), 1);
        $pdf->Cell(95, 10, mb_convert_encoding('Horas Semanales', "ISO-8859-1", "UTF-8"), 1);
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
        $pdf->SetFont('Arial', '', 12);
        while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                $pdf->Cell(95, 10, mb_convert_encoding($asignatura['nombre'], "ISO-8859-1", "UTF-8"), 1);
                $pdf->Cell(95, 10, mb_convert_encoding($asignatura['horas'] . ' horas', "ISO-8859-1", "UTF-8"), 1);
                $pdf->Ln();
        }
    }

    //Mostrar el PDF
    $pdf->Output('I', 'matricula.pdf');
}


//Función para agregar una tabla simple al PDF
function addBasicTable($pdf, $data) {
    $pdf->SetFont('Arial', '', 12);
    foreach ($data as $row) {
        foreach ($row as $col) {
            $pdf->Cell(95, 10, $col, 1);
        }
        $pdf->Ln();
    }    
}

?>