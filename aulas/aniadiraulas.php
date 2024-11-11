<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió el parámetro "aula"
    if ( isset($_GET['aula'])) {
        // Obtener los valores del parámetro "aula"
        $aula = $_GET['aula'];
    

        // Construir la consulta para insertar un nuevo aula
        $insert = "INSERT INTO Aulas (aula) VALUES (:aula)";
        $stmt = $db->prepare($insert);
        $stmt->bindParam(':aula', $aula);
        $stmt->execute();
        include("aulasjson.php");
        // Redirigir a la página de cursos
        header('Location: aulas.php');
        exit();
    } else {
        // Si no se recibió parámetro "aula", mostrar un mensaje de error o redirigir a otra página
        echo "Error: faltan parámetros";
    }
?>
