<?php
if (isset($_GET['grupo'])) {
    $grupo = $_GET['grupo'];

    try {
        // Conexión a la base de datos
        require_once "../../archivosComunes/conexion.php";
        
        // Preparar la consulta con el parámetro $grupo
        $consulta = $db->prepare("SELECT DISTINCT a.cod_asignatura , a.nombre
        FROM Cursos, Asignaturas a WHERE (a.curso = Cursos.curso AND Cursos.grupo = ?)
        UNION
        SELECT DISTINCT a.cod_asignatura , a.nombre
        FROM Asignaturas a WHERE a.curso = 'Jefatura'
        ");

        // Ejecutar la consulta con el parámetro
        $consulta->execute(array($grupo));
        
        // Obtener los resultados
        $alumnos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        // Codificar a JSON y mostrar los resultados
        echo json_encode($alumnos);
    } catch (PDOException $e) {
        // Capturar y mostrar el error
        echo json_encode(['error' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No se proporcionó el grupo']);
}
?>
