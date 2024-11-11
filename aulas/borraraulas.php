<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió el parámetro "aula"
    if (isset($_GET['aula'])) {
        // Obtener el valor del parámetro "aula"
        $aula = $_GET['aula'];
        
        // Construir la consulta para eliminar la clase correspondiente
        $delete = "DELETE FROM Aulas WHERE aula = :aula";
        $stmt = $db->prepare($delete);
        $stmt->bindParam(':aula', $aula);
        $stmt->execute();
        include("aulasjson.php");
        // Redirigir a la página de clases
        header('Location: aulas.php');
        exit();
    } else {
        // Si no se recibió el parámetro "aula", mostrar un mensaje de error o redirigir a otra página
        echo "Error: código de grupo no especificado";
    }
?>