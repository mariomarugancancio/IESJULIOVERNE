<?php
session_start();
require('./../archivosComunes/conexion.php');
$usuario = $_SESSION['usuario_login']['cod_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $curso = $_POST['curso'];
    $primerApellido = $_POST['primer-apellido'];
    $segundoApellido = $_POST['segundo-apellido'];
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $sexo = $_POST['sexo'];

    $miCorreo = null;
    $miTelefono = null;
    $nombreApellidosPadre = null;
    $dniPadre = null;
    $telefonoPadre = null;
    $correoPadre = null;
    $nombreApellidosMadre = null;
    $dniMadre = null;
    $telefonoMadre = null;
    $correoMadre = null;

    $anioActual = date('Y');
    $anioSiguiente = date('Y')+1;
    $anioCurso = $anioActual . "-" . $anioSiguiente;
    

    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTO-Ciencias" || $curso == "2BTO-Ciencias" || $curso == "1BTO-Humanidades" || $curso == "2BTO-Humanidades") {
        $optativas = $_POST['preferenciaClasesOptativas'];
        $optativasArray = explode("/",$optativas);
    }

    if($curso == "1BTO-Ciencias" || $curso == "2BTO-Ciencias" || $curso == "1BTO-Humanidades" || $curso == "2BTO-Humanidades") {
        $obligatoria = $_POST['preferenciaClasesObligatoria'];
        $modalidad = $_POST['preferenciaClasesModalidad'];
        $modalidadArray = explode("/",$modalidad);
    }

    if($curso == "SMR2"){
        $miCorreo = $_POST['correoAlumno'];
    }

    if($curso == "SMR2" || $curso == "DAW1" || $curso == "DAM1" || $curso == "DAW2" || $curso == "DAM2"){
        $miTelefono = $_POST['telefonoAlumno'];
    }

    if($curso !== "DAM1" && $curso !== "DAM2" && $curso !== "DAW1" && $curso !== "DAW2"){
        $nombreApellidosPadre = $_POST['nombre_apellidos_padre'];
        $dniPadre = $_POST['dni_padre'];
        $telefonoPadre = $_POST['telefono_padre'];
        $correoPadre = $_POST['correo_padre'];
        $nombreApellidosMadre = $_POST['nombre_apellidos_madre'];
        $dniMadre = $_POST['dni_madre'];
        $telefonoMadre = $_POST['telefono_madre'];
        $correoMadre = $_POST['correo_madre'];
    }

        // alumnosMatriculados
        $insert = "INSERT INTO alumnosmatriculados (primer_apellido_alumno, segundo_apellido_alumno, nombre_alumno, dni_alumno, sexo_alumno, email_alumno, telefono_alumno, nombre_apellidos_padre, dni_padre, telefono_padre, email_padre, nombre_apellidos_madre, dni_madre, telefono_madre, email_madre) VALUES (:primer_apellido_alumno, :segundo_apellido_alumno, :nombre_alumno, :dni_alumno, :sexo_alumno, :email_alumno, :telefono_alumno, :nombre_apellidos_padre, :dni_padre, :telefono_padre, :email_padre, :nombre_apellidos_madre, :dni_madre, :telefono_madre, :email_madre)";
        $stmt = $db->prepare($insert);
        $stmt->bindParam(':primer_apellido_alumno', $primerApellido);
        $stmt->bindParam(':segundo_apellido_alumno', $segundoApellido);
        $stmt->bindParam(':nombre_alumno', $nombre);
        $stmt->bindParam(':dni_alumno', $dni);
        $stmt->bindParam(':sexo_alumno', $sexo);
        $stmt->bindParam(':email_alumno', $miCorreo);
        $stmt->bindParam(':telefono_alumno', $miTelefono);
        $stmt->bindParam(':nombre_apellidos_padre', $nombreApellidosPadre);
        $stmt->bindParam(':dni_padre', $dniPadre);
        $stmt->bindParam(':telefono_padre', $telefonoPadre);
        $stmt->bindParam(':email_padre', $correoPadre);
        $stmt->bindParam(':nombre_apellidos_madre', $nombreApellidosMadre);
        $stmt->bindParam(':dni_madre', $dniMadre);
        $stmt->bindParam(':telefono_madre', $telefonoMadre);
        $stmt->bindParam(':email_madre', $correoMadre);
        $stmt->execute();

        // matriculas
        $insert = "INSERT INTO matriculas (curso, anio, usuario) VALUES (:curso, :anio, :usuario)";
        $stmt = $db->prepare($insert);
        $stmt->bindValue(':curso', $curso);
        $stmt->bindValue(':anio', $anioCurso);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->execute();


        //Obtener el último código de matrícula insertado
        $select = "SELECT LAST_INSERT_ID() AS ultimo_codigo_matricula FROM matriculas;";
        $stmt = $db->query($select);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $codMatricula = $resultado['ultimo_codigo_matricula'];

    // obligatorias
    if($curso == "1BTO-Ciencias" || $curso == "2BTO-Ciencias" || $curso == "1BTO-Humanidades" || $curso == "2BTO-Humanidades"){
        //Verificar si la asignatura existe en la tabla 'asignaturas'
        $consultaAsignatura = "SELECT cod_asignatura FROM asignaturas WHERE nombre = :nombreAsignatura";
        $stmt = $db->prepare($consultaAsignatura);
        $stmt->bindParam(':nombreAsignatura', $obligatoria);
        $stmt->execute();
        $asignaturaExistente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($asignaturaExistente) {
            $codAsignatura = $asignaturaExistente['cod_asignatura'];

            //Obtener el último código de matrícula insertado
            $select = "SELECT LAST_INSERT_ID() AS ultimo_codigo_matricula FROM matriculas;";
            $stmt = $db->query($select);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            $codMatricula = $resultado['ultimo_codigo_matricula'];

            //Insertar en la tabla 'obligatorias'
            $insert = "INSERT INTO obligatorias (matricula, asignatura) VALUES (:matricula, :codAsignatura)";
            $stmt = $db->prepare($insert);
            $stmt->bindParam(':matricula', $codMatricula);
            $stmt->bindParam(':codAsignatura', $codAsignatura);
            $stmt->execute();
        } else {
            echo "Error: La asignatura con el nombre $obligatoria no existe en la tabla 'asignaturas'.";
        }
    }

    // modalidad
    if($curso == "1BTO-Ciencias" || $curso == "2BTO-Ciencias" || $curso == "1BTO-Humanidades" || $curso == "2BTO-Humanidades"){
        // Asumiendo que $modalidadArray es una cadena con nombres separados por '/' o un array que contiene una sola cadena con nombres separados por '/'
        $cadenaModalidades = is_array($modalidadArray) ? $modalidadArray[0] : $modalidadArray;
        $modalidades = explode('/', $cadenaModalidades);

        //Insertar las modalidades en la base de datos
        foreach ($modalidadArray as $indice => $nombreAsignatura) {
            //Obtener el código de la asignatura basado en su nombre
            $consultaCodigo = "SELECT cod_asignatura FROM asignaturas WHERE nombre = :nombreAsignatura";
            $stmt = $db->prepare($consultaCodigo);
            $stmt->bindParam(':nombreAsignatura', $nombreAsignatura);
            $stmt->execute();
            $resultadoAsignatura = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultadoAsignatura) {
                $codAsignatura = $resultadoAsignatura['cod_asignatura'];
                $preferencia = $indice + 1;
        
                //Insertar en la tabla modalidad
                $insertModalidad = "INSERT INTO modalidad (matricula, asignatura, preferencia) VALUES (:matricula, :codAsignatura, :preferencia)";
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
    if($curso == "1ESO" || $curso == "2ESO" || $curso == "3ESO" || $curso == "4ESO" || $curso == "1BTO-Ciencias" || $curso == "2BTO-Ciencias" || $curso == "1BTO-Humanidades" || $curso == "2BTO-Humanidades") {
        // Asumiendo que $modalidadArray es una cadena con nombres separados por '/' o un array que contiene una sola cadena con nombres separados por '/'
        $cadenaOptativas = is_array($optativasArray) ? $optativasArray[0] : $optativasArray;
        $optativas = explode('/', $cadenaOptativas);

        //Insertar las modalidades en la base de datos
        foreach ($optativasArray as $indice => $nombreAsignatura) {
            //Obtener el código de la asignatura basado en su nombre
            $consultaCodigo = "SELECT cod_asignatura FROM asignaturas WHERE nombre = :nombreAsignatura";
            $stmt = $db->prepare($consultaCodigo);
            $stmt->bindParam(':nombreAsignatura', $nombreAsignatura);
            $stmt->execute();
            $resultadoAsignatura = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($resultadoAsignatura) {
                $codAsignatura = $resultadoAsignatura['cod_asignatura'];
                $preferencia = $indice + 1;
        
                // Insertar en la tabla modalidad
                $insertModalidad = "INSERT INTO optativas (matricula, asignatura, preferencia) VALUES (:matricula, :codAsignatura, :preferencia)";
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