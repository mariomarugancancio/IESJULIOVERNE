<?php
// Verificar si se ha recibido el código de la parte a eliminar
if(isset($_GET['cod_parte'])) {
    // Conectar a la base de datos
    require_once "../../archivosComunes/conexion.php";

    try {
        // Obtener el código de la parte a eliminar desde la solicitud GET
        $cod_parte = $_GET['cod_parte'];
        $matricula = $_GET['matricula'];

        // Preparar la consulta para eliminar la parte
        $consulta = $db->prepare("DELETE FROM Partes WHERE cod_parte = :cod_parte");
        $consulta->bindParam(':cod_parte', $cod_parte);
        
        // Ejecutar la consulta
        $consulta->execute();

            // Obtener la suma de puntos de todos los partes del alumno
            $consultaPuntos = $db->prepare("
            SELECT p.matricula_Alumno,SUM(i.puntos) AS total_puntos 
            FROM Incidencias i 
            JOIN Partes p ON i.cod_incidencia = p.incidencia 
            JOIN Alumnos a ON p.matricula_Alumno = a.matricula
            WHERE p.matricula_Alumno = :matricula_Alumno
            AND p.caducado = 0 
            GROUP BY p.matricula_Alumno");

$consultaPuntos->execute([':matricula_Alumno' => $matricula]);

    $resultadoPuntos = $consultaPuntos->fetch();
    // Array para guardar los alumnos que superan los 10 puntos
    if ($resultadoPuntos === false || $resultadoPuntos['total_puntos'] < 10) {
        // Eliminar la expulsión
        $eliminarExpulsion = $db->prepare("DELETE FROM Expulsiones WHERE Fecha_Inicio IS NULL AND matricula_del_alumno = :matricula");
        $eliminarExpulsion->bindParam(":matricula", $matricula, PDO::PARAM_STR);
        $eliminarExpulsion->execute();
        }
    
        // Redireccionar a la página principal de partes después de eliminar
        header("Location: ../verPartes.php?eliminado=1");
        exit();
    } catch (PDOException $e) {
        // Manejar errores si ocurren
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión a la base de datos
    $db = null;
} else {
    // Si no se recibe el código de la parte, redireccionar a alguna página de error o a la página principal
    header("Location: verPartes.php?eliminado=0");
    exit();
}
?>
