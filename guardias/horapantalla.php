<?php
require_once("../archivosComunes/conexion.php");
// Para acceder a esta pagina hay que iniciar sesion previamente.
require_once('../archivosComunes/loginRequerido.php');

$hora_actual = date("H:i:s");
$select = "SELECT DISTINCT cod_guardias, observaciones, fecha, Guardias.cod_usuario AS cod_usuario,
Usuarios.nombre AS nombre, Usuarios.apellidos AS apellidos, Usuarios.cod_delphos AS delphos, Periodos.inicio AS periodoinicio, Periodos.fin AS periodofin,
Periodos.cod_periodo AS cod_periodo
, Horarios.clase AS clase
FROM Guardias
JOIN Periodos ON Guardias.periodo = Periodos.cod_periodo
JOIN Usuarios ON Guardias.cod_usuario = Usuarios.cod_usuario
JOIN Horarios ON Horarios.cod_delphos = Usuarios.cod_delphos
    WHERE (Horarios.inicio = Periodos.inicio AND Horarios.fin = Periodos.fin AND Horarios.clase IS NOT NULL AND
                CASE 
                    WHEN DAYOFWEEK(fecha) = 2 THEN 'Lunes'
                    WHEN DAYOFWEEK(fecha) = 3 THEN 'Martes'
                    WHEN DAYOFWEEK(fecha) = 4 THEN 'Miércoles'
                    WHEN DAYOFWEEK(fecha) = 5 THEN 'Jueves'
                    WHEN DAYOFWEEK(fecha) = 6 THEN 'Viernes'
                    END = Horarios.dia)
    AND ((fecha = CURDATE() AND TIME(Periodos.inicio) > DATE_SUB(TIME('$hora_actual'), INTERVAL 55 MINUTE))
OR (fecha = CURDATE() + INTERVAL 1 DAY AND TIME('$hora_actual') >= TIME('21:15:00')))
ORDER BY fecha ASC, periodoinicio ASC;";
$resul = $db->query($select);
$i=0;
$periodoActual="";
$periodoSiguiente="";
// Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
    $usuario =  $columna['cod_usuario'];
    $delphos =  $columna['delphos'];
    $i = $i+1;
    if($i==1){
        if($columna['periodoinicio'] <= $hora_actual && $columna['periodofin'] >= $hora_actual){
        $periodoActual = $columna['periodoinicio'];
        $periodoSiguiente = $columna['periodofin'];

        }
        
        if($hora_actual<='08:29:59'){
            $periodoSiguiente = '08:30:00';
        }else if($hora_actual>='08:30:00' && $hora_actual<='09:24:59'){
            $periodoSiguiente = '09:25:00';
        }else if($hora_actual>='09:25:00' && $hora_actual<='10:19:59'){
            $periodoSiguiente = '10:20:00';
        }else if($hora_actual<='11:44:59' && $hora_actual>='10:20:00'){
            $periodoSiguiente = '11:45:00';
        }else if($hora_actual>='11:45:00' && $hora_actual<='12:39:59'){
            $periodoSiguiente = '12:40:00';
        }else if($hora_actual>='12:40:00' && $hora_actual<='13:34:59'){
            $periodoSiguiente = '13:35:00';
        }else if($hora_actual>='13:35:00' && $hora_actual<='15:14:59'){
            $periodoSiguiente = '15:15:00';
        }else if($hora_actual>='15:15:00' && $hora_actual<='16:09:59'){
            $periodoSiguiente = '16:10:00';
        }else if($hora_actual>='16:10:00' && $hora_actual<='17:04:59'){
            $periodoSiguiente = '17:05:00';
        }else if($hora_actual<='18:29:59' && $hora_actual>='17:05:00'){
            $periodoSiguiente = '18:30:00';
        }else if($hora_actual>='13:35:00' && $hora_actual<='15:14:59'){
            $periodoSiguiente = '15:15:00';
        }else if($hora_actual>='18:30:00' && $hora_actual<='19:24:59'){
            $periodoSiguiente = '19:25:00';
        }else if($hora_actual>='19:25:00' && $hora_actual<='20:19:59'){
            $periodoSiguiente = '20:20:00';
        }else if($hora_actual>='20:20:00' && $hora_actual<='21:14:59'){
            $periodoSiguiente = '21:15:00';
        }
    }
    echo "<tr id='".$i."' class='fila-tabla'>";
    // Recorremos las columnas de la fila actual
    echo '<td>'.$columna['fecha'].'</td>';
    if ($periodoActual == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#008f39"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="white"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        
        
    }else if ($periodoSiguiente == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#b8daba"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="black"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        

    }else if ('08:30:00' == $columna['periodoinicio'] || '15:15:00' == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#00008B"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="white"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        
        
    }else if ('09:25:00' == $columna['periodoinicio'] || '16:10:00' == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#1E90FF"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="black"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        
        
    }else if ('10:20:00' == $columna['periodoinicio'] || '17:05:00' == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#00BFFF"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="black"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        
        
    }else if ('11:45:00' == $columna['periodoinicio'] || '18:30:00' == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#87CEFA"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="black"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        
        
    }else if ('12:40:00' == $columna['periodoinicio'] || '19:25:00' == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#ADD8E6"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="black"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        
        
    }else if ('13:35:00' == $columna['periodoinicio'] || '20:20:00' == $columna['periodoinicio']){
        echo '<script>document.getElementById('.$i.').style.background="#F0F8FF"</script>';        
        echo '<script>document.getElementById('.$i.').style.color="black"</script>';    
        echo '<script>document.getElementById('.$i.').style.fontWeight="bold"</script>';        
        
    }
    echo '<td>'.substr($columna['periodoinicio'], 0, strlen($columna['periodoinicio']) - 3)." - ".substr($columna['periodofin'], 0, strlen($columna['periodofin']) - 3).'</td>';
    echo '<td>'.$columna['clase'].'</td>';
    echo '<td>'.$columna['nombre'].' '.$columna['apellidos'].'</td>';
    echo '<td style="max-width:300px;">'.$columna['observaciones'].'</td>';
   
    echo "</tr>";
}

?>