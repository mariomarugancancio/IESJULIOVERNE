<?php

if (isset($_GET['email'])) {
    try {

        include 'conexion.php';
        $email = $_GET['email'];
        require_once ('../conexion.php');
        $select = "SELECT nombre, apellidos, email FROM Usuarios WHERE email = '".$email."'";
        $resul = $db->query($select);

        // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
        if ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {

            require_once ("../../correo/correo.php");
            $cuerpo =
                "Si desea restablecer la contraseña del usuario {$columna['nombre']} {$columna['apellidos']},
                    pulse en el siguiente enlace: <a href='https://iesbargas.es/archivosComunes/restablecerPassword.php?usuario=" . password_hash($email, PASSWORD_DEFAULT) . "'>Restablecer contraseña</a>";

            // Enviar correo incidenciasiesbargas@gmail.com
            enviarcorreo($email, "Restablecer Contraseña", $cuerpo);
            echo "Email enviado";
        } else {
            echo "Error. Email no enviado";
        }



    } catch (PDOException $e) {
        echo "Error en la base de datos " . $e->getMessage() . "</p>";
    }
}
?>