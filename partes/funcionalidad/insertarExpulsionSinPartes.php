<?php
try {
    // Establecer el modo de error de PDO a excepción
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener los datos del formulario
    //$matricula_Alumno = $_POST['matricula_Alumno']; // Esto es ahora un array
    // Iniciar una transacción
    $db->beginTransaction();

        $consulta = $db->prepare("SELECT u.cod_usuario, CONCAT(u.nombre, ' ', u.apellidos) AS nombreProfesorCompleto, a.matricula, e.cod_expulsion, e.tipo_expulsion
                                  FROM Partes p  
                                  JOIN Expulsiones e ON p.matricula_Alumno = e.matricula_del_alumno
                                  JOIN Usuarios u ON p.cod_usuario = u.cod_usuario
                                  JOIN Alumnos a ON p.matricula_Alumno = a.matricula
                                  WHERE  e.cod_expulsion = ?
                                  ORDER BY p.fecha DESC");
        $consulta->execute(array($cod_expulsion));
        $alumno = $consulta->fetch();
        
    
    // Obtener la suma de puntos de todos los partes del alumno
    $consultaPuntos = $db->prepare("
    SELECT p.matricula_Alumno, a.nombre, a.apellidos, SUM(i.puntos) AS total_puntos 
    FROM Incidencias i 
    JOIN Partes p ON i.cod_incidencia = p.incidencia 
    JOIN Alumnos a ON p.matricula_Alumno = a.matricula
    WHERE p.matricula_Alumno = :matricula_Alumno
    AND p.matricula_Alumno NOT IN (
        SELECT matricula_del_Alumno
        FROM Expulsiones
        WHERE fecha_Inicio IS NULL
        ) 
    AND p.caducado = 0 
    GROUP BY p.matricula_Alumno, a.nombre, a.apellidos
");

$consultaPuntos->execute([':matricula_Alumno' => $matricula_Alumno[0]]);

    $resultadoPuntos = $consultaPuntos->fetch();

    // Array para guardar los alumnos que superan los 10 puntos
    $alumnoExpulsion = "";
    $alumnoExpulsionNombre = "";
        if ($resultadoPuntos['total_puntos'] >= 10) {
            $alumnoExpulsion = $resultadoPuntos['matricula_Alumno'];
            $alumnoExpulsionNombre = $resultadoPuntos['nombre']." ".$resultadoPuntos['apellidos'];

        }
    

    if (!empty($alumnoExpulsion)) {
 // Obtener los datos del formulario
 $matricula_Alumno = $alumnoExpulsion;
 $tipoExpulsion = $alumno['tipo_expulsion'];
 $cod_Usuario = $alumno['cod_usuario'];

 // Preparar la consulta SQL para insertar la expulsión
 $consulta = $db->prepare(
     "INSERT INTO Expulsiones (cod_Usuario, matricula_del_Alumno, tipo_expulsion, fecha_Insercion) 
     VALUES (:cod_Usuario, :matricula_Alumno, :tipo_expulsion, :fecha)"
 );

 $fecha = date('Y-m-d'); // Fecha actual




     $consulta->bindParam(':cod_Usuario', $cod_Usuario);
     $consulta->bindParam(':matricula_Alumno', $matricula_Alumno);
     $consulta->bindParam(':tipo_expulsion', $tipoExpulsion);
     $consulta->bindParam(':fecha', $fecha);

     // Ejecutar la consulta
     $consulta->execute();
 

 // Confirmar la transacción
 $db->commit();
    } else {
        // Confirmar la transacción
        $db->commit();

       
    }
} catch (PDOException $e) {

    // En caso de error, deshacer la transacción y redirigir al usuario con un mensaje de error
    $db->rollBack();
    header(header: "Location: verExpulsionesPendientes.php?insertado=0");
    exit();
}
?>
