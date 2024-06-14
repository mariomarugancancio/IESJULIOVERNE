<?php
include '../conexion.php';

try {

    $grupo = $_GET['grupo'];
    $rol = $_GET['rol'];

    if ($rol==="0"){
        // Preparo la consulta 
        $sql = "SELECT     
        e.cod_expulsion, 
        e.cod_usuario, 
        e.matricula_del_Alumno, 
        e.fecha_Inicio, 
        e.Fecha_Fin, 
        e.tipo_expulsion, 
        e.fecha_Insercion,
        a.matricula, a.nombre, a.apellidos, a.grupo 
        FROM Expulsiones e
        JOIN Alumnos a ON e.matricula_del_Alumno = a.matricula
        ORDER BY e.fecha_Insercion DESC";

        $stmt = $db->prepare($sql);

        // Ejecuto la consulta 
        $stmt->execute();
        // Buscar todos
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else if ($rol==="1" && $grupo!=="null"){
        // Preparo la consulta 
        $sql = "SELECT     
        e.cod_expulsion, 
        e.cod_usuario, 
        e.matricula_del_Alumno, 
        e.fecha_Inicio, 
        e.Fecha_Fin, 
        e.tipo_expulsion, 
        e.fecha_Insercion,
        a.matricula, a.nombre, a.apellidos, a.grupo 
        FROM Expulsiones e
        JOIN Alumnos a ON e.matricula_del_Alumno = a.matricula
        WHERE a.grupo=?
        ORDER BY e.fecha_Insercion DESC";
        
        $stmt = $db->prepare($sql);

        // Ejecuto la consulta 
        $stmt->execute(array($grupo));
            // Buscar todos
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $respuesta=null;
    }



    // Preparar el response
    $response = $respuesta;

    // encabezado en json
    header('Content-Type: application/json');

    // Preparar el response
    echo json_encode($response);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>