<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió el parámetro "grupo"
if (isset($_GET['grupo']) && $_GET['curso'] && $_GET['grupoA']){
        // Obtener el valor del parámetro "grupo"
        $grupo = $_GET['grupo'];
        $aula = $_GET['aula'];
        $curso = $_GET['curso'];
        $grupoA = $_GET['grupoA'];

        // Construir la consulta para actualizar la clase correspondiente
        $update = "UPDATE Cursos SET aula = :aula, grupo = :grupo, curso = :curso WHERE grupo = :grupoA";
        $stmt = $db->prepare($update);
        $stmt->bindParam(':aula', $aula);
        $stmt->bindParam(':grupo', $grupo);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':grupoA', $grupoA);
        $stmt->execute();

        // Redirigir a la página de clases
        header('Location: cursos.php');
        exit();
    }else {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Usuario pendiente de validación por parte de administración';
        echo '</div>';
    }
?>