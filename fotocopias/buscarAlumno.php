<?php
require_once('../archivosComunes/conexion.php');

// Verificar que se haya pasado una matrícula
if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    // Consulta SQL para obtener los detalles del alumno
    $query = "SELECT matricula, nombre, apellidos, grupo, saldo FROM Alumnos WHERE matricula = :matricula";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':matricula', $matricula);
    $stmt->execute();

    // Obtener los resultados
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alumno) {
        // Si se encuentra al alumno, devolver los datos en formato JSON
        echo json_encode($alumno);
    } else {
        // Si no se encuentra al alumno
        echo json_encode(['error' => 'Alumno no encontrado']);
    }
} else {
    // Si no se pasa matrícula
    echo json_encode(['error' => 'Solicitud inválida']);
}
?>
