<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió el parámetro "aula"
if (isset($_GET['aula']) &&  $_GET['aulaA']){
        // Obtener el valor del parámetro "grupo"
        $aula = $_GET['aula'];
        $aulaA = $_GET['aulaA'];

        // Construir la consulta para actualizar la clase correspondiente
        $update = "UPDATE Aulas SET aula = :aula WHERE aula = :aulaA";
        $stmt = $db->prepare($update);
        $stmt->bindParam(':aula', $aula);
        $stmt->bindParam(':aulaA', $aulaA);
        $stmt->execute();
        include("aulasjson.php");
        // Redirigir a la página de aulas
        header('Location: aulas.php');
        exit();
    }else {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Usuario pendiente de validación por parte de administración';
        echo '</div>';
    }
?>