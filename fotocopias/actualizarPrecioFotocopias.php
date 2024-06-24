<?php
require_once("../archivosComunes/conexion.php");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $precio = $_POST['precio'];
            
            $update = "UPDATE Fotocopias SET precio = :precio WHERE tipo = 'BN'";
            $stmt = $db->prepare($update);
            $stmt->bindParam(':precio', $precio);
            $lastID = $stmt->execute();
              // Redirigir a la página de asignaturas
              header('Location: gestionarFotocopias.php?correcto2=true');
              exit();
            }
        
        ?>