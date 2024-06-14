<?php
include '../conexion.php';

try {

    // Preparo la consulta 
    $sql = "SELECT cod_guardias,observaciones, fecha,  Guardias.cod_usuario AS cod_usuario,
    Usuarios.nombre AS nombre, Usuarios.apellidos AS apellidos, Usuarios.cod_delphos AS delphos, Periodos.inicio AS periodoinicio, Periodos.fin AS periodofin
    , Horarios.clase AS clase
    FROM Guardias
    JOIN Periodos ON Guardias.periodo = Periodos.cod_periodo
    JOIN Usuarios ON Guardias.cod_usuario = Usuarios.cod_usuario
    JOIN Horarios ON Horarios.cod_delphos = Usuarios.cod_delphos
    WHERE Horarios.inicio = Periodos.inicio AND Horarios.fin = Periodos.fin AND Horarios.clase IS NOT NULL AND
                CASE 
                    WHEN DAYOFWEEK(fecha) = 2 THEN 'Lunes'
                    WHEN DAYOFWEEK(fecha) = 3 THEN 'Martes'
                    WHEN DAYOFWEEK(fecha) = 4 THEN 'Miércoles'
                    WHEN DAYOFWEEK(fecha) = 5 THEN 'Jueves'
                    WHEN DAYOFWEEK(fecha) = 6 THEN 'Viernes'
                    END = Horarios.dia
    AND YEARWEEK(fecha, 1) = YEARWEEK(NOW(), 1)
    ORDER BY fecha ASC, periodoinicio ASC;";
    $stmt = $db->prepare($sql);

    // Ejecuto la consulta 
    $stmt->execute();

    // Buscar todos los alumnos
    $alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Preparar el response
    $response = $alumnos;

    // encabezado en json
    header('Content-Type: application/json');

    // Preparar el response
    echo json_encode($response);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>