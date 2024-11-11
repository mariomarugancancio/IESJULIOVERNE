<?php
    require_once("../archivosComunes/conexion.php");
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    require_once('../archivosComunes/loginRequerido.php');

    $select = "SELECT aula FROM Aulas ORDER BY aula";
    $resul = $db->query($select);
    
    // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
    while ($aulas = $resul->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr class="fila-tabla">';
        // Recorremos las columnas de la fila actual
            echo '<td id="aulaA'.$aulas['aula'].'" hidden>'.$aulas['aula'].'</td>';
            echo '<td id="aula'.$aulas['aula'].'">'.$aulas['aula'].'</td>';
            echo '<td> <a href="#" onclick="editar(\''.$aulas['aula'].'\');"><i id="editar'.$aulas['aula'].'" class="fa-solid fa-pencil"></i></a> </td>';
            echo '<td> <a href="#" onclick="borrar(\''.$aulas['aula'].'\');"><i class="fa-solid fa-trash"></i></a> </td>';
        echo "</tr>";
    }
?>