<?php
session_start();
require('./../archivosComunes/conexion.php');
$usuario=1;
if(isset($_SESSION['usuario_login']['cod_usuario'])){
    $usuario = $_SESSION['usuario_login']['cod_usuario'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $curso = $_POST['curso'];
    $primerApellido = $_POST['primer-apellido'];
    $segundoApellido = $_POST['segundo-apellido'];
    $nombre = $_POST['nombre'];
    if(isset($_POST['dni'])){
        $dni = $_POST['dni'];
    }
    $sexo = $_POST['sexo'];

    $miCorreo = null;
    $miTelefono = null;

    $fecha_nacimiento =  $_POST['fecha_nacimiento'];
    $municipio_nacimiento =  $_POST['municipio_nacimiento'];
    $provincia_nacimiento =  $_POST['provincia_nacimiento'];
    $pais_nacimiento_extranjeros =  $_POST['pais_nacimiento_extranjeros'];
    $familia_numerosa =  $_POST['familia_numerosa'];
    $nombreApellidosPadre = $_POST['nombre_apellidos_padre'];
    $dniPadre = $_POST['dni_padre'];
    $telefonoPadre = $_POST['telefono_padre'];
    $correoPadre = $_POST['correo_padre'];
    $nombreApellidosMadre = $_POST['nombre_apellidos_madre'];
    $dniMadre = $_POST['dni_madre'];
    $telefonoMadre = $_POST['telefono_madre'];
    $correoMadre = $_POST['correo_madre'];

    $anioActual = date('Y');
    $anioSiguiente = date('Y')+1;
    $anioCurso = $anioActual . "-" . $anioSiguiente;
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


    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $optativas = $_POST['preferenciaClasesOptativas'];
        $optativasArray = explode("/",$optativas);
    }

    if($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        $obligatoria = $_POST['preferenciaClasesObligatoria'];
        $modalidad = $_POST['preferenciaClasesModalidad'];
        $modalidadArray = explode("/",$modalidad);
    }

 

    if($curso == "SMR1" || $curso == "SMR2" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2"){
        $miTelefono = $_POST['telefonoAlumno'];
        $miCorreo = $_POST['correoAlumno'];

    }
    $cambio = "";
    if($curso == "SMR2" || $curso == "PEFP2" || $curso == "DAM2" || $curso == "DAW2"){
        $cambio = $_POST['cambioDT'];
    }
    $trabaja = "";

    if( $curso == "SMR1" ||  $curso == "SMR2" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2"){
        $trabaja = $_POST['trabaja'];
    }
    $bilingue="";
    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO") {
        $bilingue = $_POST['bilingue'];
    }
    $religion="";
    if ($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO") {
        $religion = $_POST['religion'];
    }

    

        // alumnosMatriculados
        $insert = "INSERT INTO alumnosmatriculados (primer_apellido_alumno, segundo_apellido_alumno, nombre_alumno, dni_alumno, sexo_alumno, email_alumno, telefono_alumno, fecha_nacimiento, municipio_nacimiento, provincia_nacimiento, pais_nacimiento, familia_numerosa, nombre_apellidos_padre, dni_padre, telefono_padre, email_padre, nombre_apellidos_madre, dni_madre, telefono_madre, email_madre, calle, numero, portal, piso, puerta, codigoPostal, municipio, provincia, telefonoUrgencia, centro, localidad_centro, provincia_centro, curso_antiguo, cambio, trabaja, religion, bilingue)
         VALUES (:primer_apellido_alumno, :segundo_apellido_alumno, :nombre_alumno, :dni_alumno, :sexo_alumno, :email_alumno, :telefono_alumno, :fecha_nacimiento, :municipio_nacimiento, :provincia_nacimiento, :pais_nacimiento_extranjeros, :familia_numerosa, :nombre_apellidos_padre, :dni_padre, :telefono_padre, :email_padre, :nombre_apellidos_madre, :dni_madre, :telefono_madre, :email_madre, :calle, :numero, :portal, :piso, :puerta, :codigo_postal, :municipio, :provincia, :telefono_urgencia, :centro, :localidad_centro, :provincia_centro, :curso_antiguo, :cambio, :trabaja, :religion, :bilingue)";
        $stmt = $db->prepare($insert);
        $stmt->bindParam(':primer_apellido_alumno', $primerApellido);
        $stmt->bindParam(':segundo_apellido_alumno', $segundoApellido);
        $stmt->bindParam(':nombre_alumno', $nombre);
        $stmt->bindParam(':dni_alumno', $dni);
        $stmt->bindParam(':sexo_alumno', $sexo);
        $stmt->bindParam(':email_alumno', $miCorreo);
        $stmt->bindParam(':telefono_alumno', $miTelefono);
        $stmt->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt->bindParam(':municipio_nacimiento', $municipio_nacimiento);
        $stmt->bindParam(':provincia_nacimiento', $provincia_nacimiento);
        $stmt->bindParam(':pais_nacimiento_extranjeros', $pais_nacimiento_extranjeros);
        $stmt->bindParam(':familia_numerosa', $familia_numerosa);
        $stmt->bindParam(':nombre_apellidos_padre', $nombreApellidosPadre);
        $stmt->bindParam(':dni_padre', $dniPadre);
        $stmt->bindParam(':telefono_padre', $telefonoPadre);
        $stmt->bindParam(':email_padre', $correoPadre);
        $stmt->bindParam(':nombre_apellidos_madre', $nombreApellidosMadre);
        $stmt->bindParam(':dni_madre', $dniMadre);
        $stmt->bindParam(':telefono_madre', $telefonoMadre);
        $stmt->bindParam(':email_madre', $correoMadre);
        $stmt->bindParam(':calle', $calle);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':portal', $portal);
        $stmt->bindParam(':piso', $piso);
        $stmt->bindParam(':puerta', $puerta);
        $stmt->bindParam(':codigo_postal', $codigoPostal);
        $stmt->bindParam(':municipio', $municipio);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':telefono_urgencia', $telefonoUrgencia);
        $stmt->bindParam(':centro', $centro);
        $stmt->bindParam(':localidad_centro', $localidadCentro);
        $stmt->bindParam(':provincia_centro', $provinciaCentro);
        $stmt->bindParam(':curso_antiguo', $curso_antiguo);
        $stmt->bindParam(':cambio', $cambio);
        $stmt->bindParam(':trabaja', $trabaja);
        $stmt->bindParam(':religion', $religion);
        $stmt->bindParam(':bilingue', $bilingue);


        $stmt->execute();

        // matriculas
        $insert = "INSERT INTO Matriculas (curso, anio, usuario) VALUES (:curso, :anio, :usuario)";
        $stmt = $db->prepare($insert);
        $stmt->bindValue(':curso', $curso);
        $stmt->bindValue(':anio', $anioCurso);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();


        //Obtener el último código de matrícula insertado
        $select = "SELECT LAST_INSERT_ID() AS ultimo_codigo_matricula FROM Matriculas;";
        $stmt = $db->query($select);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $codMatricula = $resultado['ultimo_codigo_matricula'];

    // comunes ESO, Bachillerato y FP
 
    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO" || $curso == "SMR1" || $curso == "SMR2"  || $curso == "DAM1" || $curso == "DAM2"  || $curso == "DAW1" || $curso == "DAW2" ) {

        // Verificar si la asignatura existe en la tabla 'asignaturas'
        $consultaAsignatura = "SELECT cod_asignatura, nombre FROM Asignaturas WHERE curso = :curso AND tipo = 'comunes'";
        $stmtConsultaAsignatura = $db->prepare($consultaAsignatura);
        $stmtConsultaAsignatura->bindParam(':curso', $curso);
        $stmtConsultaAsignatura->execute();
        
        while ($asignatura = $stmtConsultaAsignatura->fetch(PDO::FETCH_ASSOC)) {
            // Insertar en la tabla 'comunes'
            $matesNoInsertar="";
            if($curso == "4ESO" && $_POST['comunes_mates'] == $asignatura['nombre'] && $_POST['comunes_mates'] == 'Matemáticas A'){
                $matesNoInsertar='Matemáticas B';
            }else if($curso == "4ESO" && $_POST['comunes_mates'] == $asignatura['nombre'] && $_POST['comunes_mates'] == 'Matemáticas B'){
                $matesNoInsertar='Matemáticas A';
            }
            if($asignatura['nombre'] !==  $matesNoInsertar){
            $insert = "INSERT INTO Comunes (matricula, asignatura) VALUES (:matricula, :codAsignatura)";
            $stmtInsert = $db->prepare($insert);
            $stmtInsert->bindParam(':matricula', $codMatricula);
            $stmtInsert->bindParam(':codAsignatura', $asignatura['cod_asignatura']);
            $stmtInsert->execute();
            }
        }
    }
    

        // Formativo y Profesionales PEFP
        if($curso == "PEFP1" || $curso == "PEFP2" || $curso == "CFGB1" || $curso == "CFGB2" ) {
            // Verificar si la asignatura existe en la tabla 'asignaturas'
            $consultaAsignatura = "SELECT cod_asignatura, tipo FROM Asignaturas WHERE curso = :curso";
            $stmtConsultaAsignatura = $db->prepare($consultaAsignatura);
            $stmtConsultaAsignatura->bindParam(':curso', $curso);
            $stmtConsultaAsignatura->execute();
            
            while ($asignatura = $stmtConsultaAsignatura->fetch(PDO::FETCH_ASSOC)) {
                // Insertar en la tabla 'obligatorias'
                $insert="";
                if($asignatura['tipo'] == 'Profesionales'){
                    $insert = "INSERT INTO Profesionales (matricula, asignatura) VALUES (:matricula, :codAsignatura)";
                }else{
                    $insert = "INSERT INTO FormativosCaracterGeneral (matricula, asignatura) VALUES (:matricula, :codAsignatura)";

                }
                $stmtInsert = $db->prepare($insert);
                $stmtInsert->bindParam(':matricula', $codMatricula);
                $stmtInsert->bindParam(':codAsignatura', $asignatura['cod_asignatura']);
                $stmtInsert->execute();
            }
        }

    if($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO"){
        //Verificar si la asignatura existe en la tabla 'asignaturas'
        $consultaAsignatura = "SELECT cod_asignatura FROM Asignaturas WHERE nombre = :nombreAsignatura";
        $stmt = $db->prepare($consultaAsignatura);
        $stmt->bindParam(':nombreAsignatura', $obligatoria);
        $stmt->execute();
        $asignaturaExistente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($asignaturaExistente) {
            $codAsignatura = $asignaturaExistente['cod_asignatura'];

            //Obtener el último código de matrícula insertado
            $select = "SELECT LAST_INSERT_ID() AS ultimo_codigo_matricula FROM Matriculas;";
            $stmt = $db->query($select);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $codMatricula = $resultado['ultimo_codigo_matricula'];

            //Insertar en la tabla 'obligatorias'
            $insert = "INSERT INTO Obligatorias (matricula, asignatura) VALUES (:matricula, :codAsignatura)";
            $stmt = $db->prepare($insert);
            $stmt->bindParam(':matricula', $codMatricula);
            $stmt->bindParam(':codAsignatura', $codAsignatura);
            $stmt->execute();
        } else {
            echo "Error: La asignatura con el nombre $obligatoria no existe en la tabla 'asignaturas'.";
        }
    }

    // modalidad
    if($curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO"){
        // Asumiendo que $modalidadArray es una cadena con nombres separados por '/' o un array que contiene una sola cadena con nombres separados por '/'
        $cadenaModalidades = is_array($modalidadArray) ? $modalidadArray[0] : $modalidadArray;
        $modalidades = explode('/', $cadenaModalidades);

        //Insertar las modalidades en la base de datos
        foreach ($modalidadArray as $indice => $nombreAsignatura) {
            //Obtener el código de la asignatura basado en su nombre
            $consultaCodigo = "SELECT cod_asignatura FROM Asignaturas WHERE nombre = :nombreAsignatura AND curso = :curso";
            $stmt = $db->prepare($consultaCodigo);
            $stmt->bindParam(':nombreAsignatura', $nombreAsignatura);
            $stmt->bindParam(':curso', $curso);
            $stmt->execute();
            $resultadoAsignatura = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultadoAsignatura) {
                $codAsignatura = $resultadoAsignatura['cod_asignatura'];
                $preferencia = $indice + 1;
        
                //Insertar en la tabla modalidad
                $insertModalidad = "INSERT INTO Modalidad (matricula, asignatura, preferencia) VALUES (:matricula, :codAsignatura, :preferencia)";
                $stmt = $db->prepare($insertModalidad);
                $stmt->bindParam(':matricula', $codMatricula);
                $stmt->bindParam(':codAsignatura', $codAsignatura);
                $stmt->bindParam(':preferencia', $preferencia);
                $stmt->execute();
            } else {
                echo "Error: La asignatura con el nombre $nombreAsignatura no existe en la tabla 'asignaturas'.";
            }
        }
    }

    //Opcion
    if($curso == "4ESO"){

                // Asumiendo que $modalidadArray es una cadena con nombres separados por '/' o un array que contiene una sola cadena con nombres separados por '/'
                $opcion = $_POST['preferenciaClasesOpcion'];
                $opcionArray = explode("/",$opcion);
        
                //Insertar las modalidades en la base de datos
                foreach ($opcionArray as $indice => $nombreAsignatura) {
                    //Obtener el código de la asignatura basado en su nombre
                    $consultaCodigo = "SELECT cod_asignatura FROM Asignaturas WHERE nombre = :nombreAsignatura AND curso = :curso";
                    $stmt = $db->prepare($consultaCodigo);
                    $stmt->bindParam(':nombreAsignatura', $nombreAsignatura);
                    $stmt->bindParam(':curso', $curso);
                    $stmt->execute();
                    $resultadoAsignatura = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($resultadoAsignatura) {
                        $codAsignatura = $resultadoAsignatura['cod_asignatura'];
                        $preferencia = $indice + 1;
                
                        // Insertar en la tabla modalidad
                        $insertModalidad = "INSERT INTO Opciones (matricula, asignatura, preferencia) VALUES (:matricula, :codAsignatura, :preferencia)";
                        $stmt = $db->prepare($insertModalidad);
                        $stmt->bindParam(':matricula', $codMatricula);
                        $stmt->bindParam(':codAsignatura', $codAsignatura);
                        $stmt->bindParam(':preferencia', $preferencia);
                        $stmt->execute();
                    } else {
                        echo "Error: La asignatura con el nombre $nombreAsignatura no existe en la tabla 'asignaturas'.";
                    }
                }
            }
    
    //optativas
    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTOCIENCIAS" || $curso == "2BTOCIENCIAS" || $curso == "1BTOHUMCSO" || $curso == "2BTOHUMCSO") {
        // Asumiendo que $modalidadArray es una cadena con nombres separados por '/' o un array que contiene una sola cadena con nombres separados por '/'
        $cadenaOptativas = is_array($optativasArray) ? $optativasArray[0] : $optativasArray;
        $optativas = explode('/', $cadenaOptativas);
        $cursoBusqueda=$curso;
        if($curso == "1BTOCIENCIAS" || $curso == "1BTOHUMCSO" ){
            $cursoBusqueda="1BTO";
        }else if($curso == "2BTOCIENCIAS" || $curso == "2BTOHUMCSO"){
            $cursoBusqueda="2BTO";
        }
        //Insertar las modalidades en la base de datos
        foreach ($optativasArray as $indice => $nombreAsignatura) {

            //Obtener el código de la asignatura basado en su nombre
            $consultaCodigo = "SELECT cod_asignatura FROM Asignaturas WHERE nombre = :nombreAsignatura AND curso = :curso";
            $stmt = $db->prepare($consultaCodigo);
            $stmt->bindParam(':nombreAsignatura', $nombreAsignatura);
            $stmt->bindParam(':curso', $cursoBusqueda);
            $stmt->execute();
            $resultadoAsignatura = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultadoAsignatura) {
                $codAsignatura = $resultadoAsignatura['cod_asignatura'];
                $preferencia = $indice + 1;
        
                // Insertar en la tabla modalidad
                $insertModalidad = "INSERT INTO Optativas (matricula, asignatura, preferencia) VALUES (:matricula, :codAsignatura, :preferencia)";
                $stmt = $db->prepare($insertModalidad);
                $stmt->bindParam(':matricula', $codMatricula);
                $stmt->bindParam(':codAsignatura', $codAsignatura);
                $stmt->bindParam(':preferencia', $preferencia);
                $stmt->execute();
            } else {
                echo "Error: La asignatura con el nombre $nombreAsignatura no existe en la tabla 'asignaturas'.";
            }
        }
    }
    }
?>