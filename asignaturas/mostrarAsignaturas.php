<?php

    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas ORDER BY curso, Tipo";
    $resul = $db->query($select);
    
    // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
    while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr class="fila-tabla">';
        // Recorremos las columnas de la fila actual
            echo '<td id="Asignatura'.$asignatura['cod_asignatura'].'" hidden>'.$asignatura['cod_asignatura'].'</td>';           
            echo '<td id="nombre'.$asignatura['cod_asignatura'].'">'.$asignatura['nombre'].'</td>';
            echo '<td id="horas'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].'</td>';
            echo '<td id="curso'.$asignatura['cod_asignatura'].'">'.$asignatura['curso'].'</td>';
            echo '<td id="tipo'.$asignatura['cod_asignatura'].'">'.$asignatura['tipo'].'</td>';
            echo '<td> <a href="#" onclick="editar(\''.$asignatura['cod_asignatura'].'\');"><i id="editar'.$asignatura['cod_asignatura'].'" class="fa-solid fa-pencil"></i></a> </td>';
            echo '<td> <a href="#" onclick="borrar(\''.$asignatura['cod_asignatura'].'\',\''.$asignatura['nombre'].'\',\''.$asignatura['curso'].'\');"><i class="fa-solid fa-trash"></i></a> </td>';
        echo "</tr>";
    }
?>