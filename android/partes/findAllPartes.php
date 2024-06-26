<?php
include '../conexion.php';

try {

    $cod_usuario = $_GET['cod_usuario'];
    $rol = $_GET['rol'];


    if ($rol==="0"){
        // Preparo la consulta 
        $sql = "SELECT p.cod_parte, p.cod_usuario, a.matricula, i.cod_incidencia, 
        i.nombre AS inci_nombre, i.puntos, i.descripcion AS inci_descripcion, p.materia, p.fecha, p.hora, p.descripcion, p.fecha_Comunicacion, 
        p.via_Comunicacion, p.tipo_Parte, p.caducado, a.matricula, a.nombre, a.apellidos, a.grupo 
        FROM Partes p 
        JOIN Alumnos a ON p.matricula_Alumno = a.matricula
        JOIN Incidencias i ON p.incidencia = i.cod_incidencia
        ORDER BY a.apellidos";
        
        $stmt = $db->prepare($sql);

        // Ejecuto la consulta 
        $stmt->execute();
            // Buscar todos
        $respuesta = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else if ($rol==="1"){
        // Preparo la consulta 
        $sql = "SELECT p.cod_parte, p.cod_usuario, a.matricula, i.cod_incidencia, 
        i.nombre AS inci_nombre, i.puntos, i.descripcion AS inci_descripcion, p.materia, p.fecha, p.hora, p.descripcion, p.fecha_Comunicacion, 
        p.via_Comunicacion, p.tipo_Parte, p.caducado, a.matricula, a.nombre, a.apellidos, a.grupo 
        FROM Partes p 
        JOIN Alumnos a ON p.matricula_Alumno = a.matricula
        JOIN Incidencias i ON p.incidencia = i.cod_incidencia
        WHERE p.cod_usuario=?
        ORDER BY a.apellidos";


        $stmt = $db->prepare($sql);

        // Ejecuto la consulta 
        $stmt->execute(array($cod_usuario));
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