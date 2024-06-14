<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió el parámetro "cod_asignatura"
    if (isset($_GET['cod_asignatura'])) {
        // Obtener el valor del parámetro "cod_asignatura"
        $codAsignatura = $_GET['cod_asignatura'];
        
        // Construir la consulta para eliminar la asignatura correspondiente
        $delete = "DELETE FROM asignaturas WHERE cod_asignatura = :cod_asignatura";
        $stmt = $db->prepare($delete);
        $stmt->bindParam(':cod_asignatura', $codAsignatura);
        $stmt->execute();

        // Redirigir a la página de asignaturas
        header('Location: asignaturas.php');
        exit();
    } else {
        // Si no se recibió el parámetro "cod_asignatura", mostrar un mensaje de error o redirigir a otra página
        echo "Error: código de grupo no especificado";
    }
?>