<?php
include '../conexion.php';

// Función para obtener el rol de un usuario dado su email
function obtenerRolUsuario($email) {
    global $db; // Acceso a la variable de conexión PDO definida en conexion.php

    try {
        // Preparo la consulta para obtener el rol del usuario
        $sql = "SELECT rol FROM Usuarios WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);

        // Obtengo el resultado (debería ser un único registro)
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado['rol'];
        } else {
            return null; // En caso de que no se encuentre ningún usuario con ese email
        }

    } catch (PDOException $e) {
        // Manejo de errores en caso de fallo en la consulta
        throw new PDOException("Error al obtener el rol del usuario: " . $e->getMessage());
    }
}

// Consulta para obtener todos los usuarios con rol 0 y 1
try {
    // Preparo la consulta 
    $sql = "SELECT  u.cod_usuario, u.dni, u.nombre, u.apellidos, u.email, u.clave, u.rol, u.cod_delphos, u.validar, d.codigo AS departamento_codigo, d.nombre AS departamento_nombre, u.tutor_grupo
            FROM Usuarios u
            LEFT JOIN Departamentos d ON u.departamento = d.codigo
            WHERE rol IN ('0', '1')
            ORDER BY nombre, apellidos";

    $stmt = $db->prepare($sql);

    // Ejecuto la consulta 
    $stmt->execute();

    // Buscar todos los usuarios con rol 0 y 1
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Preparar el response
    $response = $usuarios;

    // encabezado en json
    header('Content-Type: application/json');

    // Preparar el response
    echo json_encode($response);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
