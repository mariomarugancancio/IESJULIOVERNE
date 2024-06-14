<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1BTO-Humanidades</title>
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/principalCSS.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        .error{
            color: red;
        }

        .novalido{
            border-color: red;
        }
        
    </style>
    
    <?php
        require('../../../../archivosComunes/conexion.php');
    ?>
</head>

<body>
    <?php
    include('../../../nav.php');
    ?>
    <div class="fondo">
        <div class="matricula mt-4">
            <h1 style="text-align: right; color: green; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">1BTO-Humanidades</h1>
            <form id="matriculas" action="../../../generate_pdf.php" method="post">
                <input type="hidden" name="curso" value="1BTO-Humanidades">
                <input type="hidden" name="preferenciaClasesOptativas" id="preferenciaClasesOptativas">
                <input type="hidden" name="preferenciaClasesModalidad" id="preferenciaClasesModalidad">
                <input type="hidden" name="preferenciaClasesObligatoria" id="preferenciaClasesObligatoria">

                
                <?php
                    include('../../formularioComun.php');
                    ?>
                <div class="form-group mb-2">
                <p>¿Desea cursar Religión? (1 hora) 
                    <input type="radio" id="religion_si" name="religion" value="SI"> SÍ
                    <input type="radio" id="religion_no" name="religion" value="NO"> NO</p>
                </div> 

                <div class="form-group mb-5">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Materias Comunes</th>
                            <th scope="col">Horas Semanales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM asignaturas WHERE curso LIKE 'BTOHUMCSO1' AND tipo LIKE '%comunes'";
                            $resul = $db->query($select);                            
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                            while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                // Recorremos las columnas de la fila actual
                                    echo '<td id="asignaturas_comumnes'.$asignatura['cod_asignatura'].'">'.$asignatura['nombre'].'</td>';
                                    echo '<td id="horas_comumnes'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                echo "</tr>"; 
                            }
                        ?>
                    </tbody>
                </table>
                </div>

                <div class="form-group mb-5">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Obligatoria</th>
                            <th scope="col">Horas Semanales</th>
                    </thead>
                    <tbody id="clasesObligatorias">
                        <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM asignaturas WHERE curso LIKE 'BTOHUMCSO1' AND tipo LIKE '%obligatoria'";
                            $resul = $db->query($select);                            
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                            while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                // Recorremos las columnas de la fila actual
                                    echo '<td id="asignaturas_obligatorias'.$asignatura['cod_asignatura'].'"> <input class="obligatorias" type="radio" name="obligatorias" value="'.$asignatura['nombre'].'"> '.$asignatura['nombre'].'</td>';
                                    echo '<td id="horas_obligatorias'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                echo "</tr>"; 
                            }
                        ?>
                    </tbody>
                </table>
                </div>

                <div class="form-group mb-5">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Materias de Modalidad (Se cursarán 2)
                                <p>Numere del 1 al 4 por orden de preferencia</p>
                            </th>
                            <th scope="col">Horas Semanales</th>
                        </tr>
                    </thead>
                    <tbody id="clasesModalidad">
                        <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM asignaturas WHERE curso LIKE 'BTOHUMCSO1' AND tipo LIKE '%modalidad'";
                            $resul = $db->query($select);
                            $idClasesModalidad = 1;
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                            while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                // Recorremos las columnas de la fila actual
                                    echo '<td id="'.$idClasesModalidad++.'_modalidad"> <input class="clasesModalidad" type="number" name="'. $asignatura['cod_asignatura'].'" min="1" max="4"> '.$asignatura['nombre'].'</td>';
                                    echo '<td id="horas_modalidad'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                echo "</tr>"; 
                            }
                        ?>
                    </tbody>
                </table>
                </div>

                <div class="form-group mb-5">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Materias Optativas (Se cursará 1)
                                <p>Numere del 1 al 4 por orden de preferencia</p>
                            </th>
                            <th scope="col">Horas Semanales</th>
                        </tr>
                    </thead>
                    <tbody id="tablaOptativas">
                        <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM asignaturas WHERE curso LIKE 'BTO1' AND tipo LIKE '%optativas'";
                            $resul = $db->query($select);
                            $idClasesOptativas = 1;
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                            while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                // Recorremos las columnas de la fila actual
                                    echo '<td id="'.$idClasesOptativas++.'_optativas"><input class="clasesOptativas" type="number" name="'. $asignatura['cod_asignatura'].'" min="1" max="4"> '.$asignatura['nombre'].'</td>';
                                    echo '<td id="horas_optativas'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                echo "</tr>"; 
                            }
                        ?>
                    </tbody>
                </table>
                </div>

                <div class="d-flex w-100 justify-content-center">
                <button type="button" onclick="validarDatos()" class="btn btn-secondary p-2">Generar PDF</button>
                </div> 
            </form>
        </div>
    </div>

    <?php
    include('../../../footer.php');
    ?>
    <script src="../../gg.js"></script>
</body>
</html>