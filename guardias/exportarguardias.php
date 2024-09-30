<?php
// PHPoffice
require '../vendor/autoload.php';
// Conexion
require_once("../archivosComunes/conexion.php");
// Para acceder a esta pagina hay que iniciar sesion previamente.
// require_once('../archivosComunes/loginRequerido.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Obtener la fecha especificada del formulario
if (isset($_POST['inicio']) && $_POST['fin'] ) {
    $inicio = $_POST['inicio'];
    $fin = $_POST['fin'];
if($inicio<$fin){
    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    $activeWorksheet->setCellValue('A1', 'Fecha');
    $activeWorksheet->setCellValue('B1', 'Periodo');
    $activeWorksheet->setCellValue('C1', 'Clase');
    $activeWorksheet->setCellValue('D1', 'Usuario');

    $activeWorksheet->getColumnDimension('A')->setWidth(20);
    $activeWorksheet->getColumnDimension('B')->setWidth(20);
    $activeWorksheet->getColumnDimension('C')->setWidth(20);
    $activeWorksheet->getColumnDimension('D')->setWidth(40);

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
                AND fecha >= :fechaInicio AND fecha <= :fechaFin
        ORDER BY fecha ASC";
    $stmt = $db->prepare($select);
    $stmt->bindParam(':fechaInicio', $inicio);
    $stmt->bindParam(':fechaFin', $fin);

    $stmt->execute();
    $resul = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Utilizamos un bucle foreach para recorrer todas las filas que devuelve la consulta
    $i = 2;
    foreach ($resul as $columna) {
        $usuario =  $columna['cod_usuario'];
        $activeWorksheet->setCellValue('A' . $i, $columna['fecha']);
        $activeWorksheet->setCellValue('B' . $i, $columna['periodoinicio'] . ' - ' . $columna['periodofin']);

        $dia   = substr($columna['fecha'],8,2);
        $mes = substr($columna['fecha'],5,2);
        $anio = substr($columna['fecha'],0,4); 
        $semana = date('w',  mktime(0,0,0,$mes,$dia,$anio));  
        $activeWorksheet->setCellValue('C' . $i, $columna['clase']);

       
        
        $activeWorksheet->setCellValue('D' . $i, $columna['nombre'] . ' ' . $columna['apellidos']);
        $i++;
    }
        $writer = new Xlsx($spreadsheet);
        $writer->save('../Exportar/datos ' . $inicio . ' ' . $fin . '.xlsx');
}else{
    echo '<div class="alert alert-danger" role="alert">';
    echo 'La fecha de inicio es mayor a la de fin';
    echo '</div>';

}
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Exportal excel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <?php
    include('../guardias/navguardias.php');

    ?>
    <div class="container mt-5" style="max-width: 300px;">
        <form action="exportarguardias.php" method="post">
            <div class="form-group">
                <label for="inicio">Inicio:</label>
                <input type="date" id="inicio" name="inicio" class="form-control">
            </div>
            <div class="form-group">
                <label for="fin">Fin:</label>
                <input type="date" id="fin" name="fin" class="form-control">
            </div>
            <br>
            <div class="d-flex justify-content-center">

                <button type="submit" class="btn btn-primary">Crear</button>
            </div>
        </form>
    </div>
    <div class="container mt-5" style="max-width: 300px;">
        <?php
        if (isset($_POST['inicio']) && $_POST['fin']) {
            echo "<a class='d-flex justify-content-center text-warning fs-2' href='../Exportar/datos " . $inicio . " " . $fin . ".xlsx'>Descargar</a>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
        include('../archivosComunes/footer.php');
        ?>