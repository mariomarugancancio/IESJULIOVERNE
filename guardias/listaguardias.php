<?php
// Iniciamos la sesion
require_once("../archivosComunes/conexion.php");
// Para acceder a esta pagina hay que iniciar sesion previamente.
require_once('../archivosComunes/loginRequerido.php');

$select = "SELECT  DISTINCT cod_guardias,observaciones, fecha, Guardias.cod_usuario AS cod_usuario,
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
            ORDER BY fecha DESC, periodoinicio DESC;";
$resul = $db->query($select);
$i=0;
// Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
    $usuario =  $columna['cod_usuario'];
    $delphos =  $columna['delphos'];
    $i = $i+1;
    echo "<tr id='".$i."' class='fila-tabla'>";
    // Recorremos las columnas de la fila actual
    echo '<td>'.$columna['fecha'].'</td>';
    echo '<td>'.substr($columna['periodoinicio'], 0, strlen($columna['periodoinicio']) - 3)." - ".substr($columna['periodofin'], 0, strlen($columna['periodofin']) - 3).'</td>';
    echo '<td>'.$columna['clase'].'</td>';
    echo '<td>'.$columna['nombre'].' '.$columna['apellidos'].'</td>';
    echo '<td style="max-width:300px;">'.$columna['observaciones'].'</td>';
    echo '<td> <a href="#"  class="btn-editar" onclick="editarGuardia('.$columna['cod_guardias'].')"><i class="fa-solid fa-pencil"></i></a> </td>';
    echo '<td> <a href="#"  class="btn-borrar" onclick="eliminarGuardia('.$columna['cod_guardias'].')"><i class="fa-solid fa-trash"></i></a> </td>';
    echo "</tr>";
}
?>
