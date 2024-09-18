<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió los parámetros "aula" y "grupo"
    if (isset($_GET['aula']) && isset($_GET['grupo']) && isset($_GET['curso'])) {
        // Obtener los valores de los parámetros "aula" y "grupo"
        $aula = $_GET['aula'];
        $grupo = $_GET['grupo'];
        $curso = $_GET['curso'];

        // Construir la consulta para insertar un nuevo curso
        $insert = "INSERT INTO Cursos (aula, grupo, curso) VALUES (:aula, :grupo, :curso)";
        $stmt = $db->prepare($insert);
        $stmt->bindParam(':aula', $aula);
        $stmt->bindParam(':grupo', $grupo);
        $stmt->bindParam(':curso', $curso);
        $stmt->execute();

        // Redirigir a la página de cursos
        header('Location: cursos.php');
        exit();
    } else {
        // Si no se recibieron los parámetros "aula" y "grupo", mostrar un mensaje de error o redirigir a otra página
        echo "Error: faltan parámetros";
    }
?>
