<?php
require_once("../archivosComunes/conexion.php");

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $matricula = $_POST['matricula'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $grupo = $_POST['grupo'];
            $fotocopias = $_POST['fotocopias'];
            $saldoAntiguo = 0;
            $fecha_actual = date('Y-m-d H:i:s');
            $precio=0;
            $select = "SELECT saldo
            FROM Alumnos
            WHERE matricula = '".$matricula."';";
            $resul = $db->query($select);

            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
            if ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
                $saldoAntiguo = $columna['saldo'];
            }

            $select = "SELECT precio
            FROM Fotocopias
            WHERE tipo = 'BN';";
            $resul = $db->query($select);

            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
            if ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
                $precio = $columna['precio'];
            }

            $gasto = $fotocopias * $precio;
            $saldoNuevo = $saldoAntiguo - $gasto;
            if($saldoNuevo < 0){
                // Redirigir a la página de asignaturas
                header('Location: gestionarFotocopias.php?correcto=false');
                exit();
            }else{
            $insert = "INSERT INTO Transacciones (matricula, fecha, fotocopias, saldoNuevo, saldoAntiguo)
            VALUES (:matricula, :fecha, :fotocopias, :saldoNuevo,  :saldoAntiguo)";
            $stmt = $db->prepare($insert);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':fecha', $fecha_actual);
            $stmt->bindParam(':fotocopias', $fotocopias);
            $stmt->bindParam(':saldoNuevo', $saldoNuevo);
            $stmt->bindParam(':saldoAntiguo', $saldoAntiguo);
            $lastID = $stmt->execute();


            $update = "UPDATE Alumnos SET saldo = saldo - :gasto WHERE matricula = :matricula";
            $stmt = $db->prepare($update);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':gasto', $gasto);
            $lastID = $stmt->execute();
              // Redirigir a la página de asignaturas
              header('Location: gestionarFotocopias.php?correcto=true');
              exit();
            }
        }
        ?>