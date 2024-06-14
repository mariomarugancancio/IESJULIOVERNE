<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió el parámetro "grupo"
if (isset($_GET['nombre']) && isset($_GET['horas']) && isset($_GET['curso']) && isset($_GET['tipo']) && isset($_GET['Asignatura'])){
        // Obtener el valor del parámetro "grupo"
        $nombre = $_GET['nombre'];
        $horas = $_GET['horas'];
        $curso = $_GET['curso'];
        $tipo = $_GET['tipo'];
        if($tipo===""){
            $tipo = null;
        }
        $Asignatura = $_GET['Asignatura'];

        // Construir la consulta para actualizar la clase correspondiente
        $update = "UPDATE asignaturas SET nombre = :nombre, horas = :horas, curso = :curso, tipo = :tipo WHERE cod_asignatura = :Asignatura";
        $stmt = $db->prepare($update);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':horas', $horas);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':Asignatura', $Asignatura);
        $stmt->execute();

        // Redirigir a la página de clases
        header('Location: asignaturas.php');
        exit();
    }else {
        // Si no se recibió el parámetro "cod_clase", mostrar un mensaje de error o redirigir a otra página
        echo "Error: código de clase no especificado";
    }
?>