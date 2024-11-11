<?php
    // Iniciamos la sesion
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    // Preparar y ejecutar la consulta
    $query = "SELECT aula FROM Aulas";
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Recoger los resultados en un array
    $aulas = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $aulas[] = ["nombre" => $row['aula']];
    }

    // Convertir el array a formato JSON
    $json_data = json_encode($aulas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    // Guardar los datos en un archivo JSON
    $file_name = '../reservas/static/aulas.json';
    if (file_put_contents($file_name, $json_data)) {
        echo "El archivo JSON se ha generado exitosamente: $file_name";
    } else {
        echo "Error al guardar el archivo JSON.";
    }


?>
