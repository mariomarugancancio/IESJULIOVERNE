<?php
    // Iniciamos la sesion
    session_start();
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Verificar si se recibió los parámetros "nombre", "horas", "curso" y "tipo"
    if (isset($_GET['nombre']) && isset($_GET['horas']) && isset($_GET['curso']) && isset($_GET['tipo'])) {
        // Obtener los valores de los parámetros "nombre", "horas", "curso" y "tipo"
        $nombre = $_GET['nombre'];
        $horas = $_GET['horas'];
        $curso = $_GET['curso'];
        $tipo = $_GET['tipo'];
        if($tipo===""){
            $tipo = null;
        }
        
        // Construir la consulta para insertar una nueva asignatura
        $insert = "INSERT INTO asignaturas (nombre, horas, curso, tipo) VALUES (:nombre, :horas, :curso, :tipo)";
        $stmt = $db->prepare($insert);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':horas', $horas);
        $stmt->bindParam(':curso', $curso);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();

        // Redirigir a la página de asignaturas
        header('Location: asignaturas.php');
        exit();
    } else {
        // Si no se recibieron los parámetros "nombre", "horas", "curso" y "tipo", mostrar un mensaje de error o redirigir a otra página
        echo "Error: faltan parámetros";
    }
?>
