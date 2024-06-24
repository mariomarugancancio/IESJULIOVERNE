<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DAW2</title>
    <link rel="stylesheet" href="../../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../../css/app.css">
  <link rel="stylesheet" type="text/css" href="../../../../../css/prematriculas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../../../images/logoJulioVerneNuevo.png">

    <style>
        .error{
            color: red;
        }

        .novalido{
            border-color: red;
        }
        
    </style>
</head>
<?php
        require('../../../../../archivosComunes/conexion.php');
    ?>
<body>
    <?php
    include('./../../../../navFP.php');
    ?>
    <div class="fondo">
        <div class="matricula mt-4">
            <h1 style="text-align: right; color: green; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">DAW2</h1>
            <form id="matriculas" action="../../../../generate_pdf.php" method="post">
                <input type="hidden" name="curso" value="DAW2">
                <input type="hidden" name="preferenciaClasesOptativas" id="preferenciaClasesOptativas">
                <input type="hidden" name="preferenciaClasesOpcion" id="preferenciaClasesOpcion">
                <input type="hidden" name="preferenciaClasesModalidad" id="preferenciaClasesModalidad">
                
                <?php
                    include('../../../formularioComunMedioSuperiorCambio.php');
                ?>

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
                            require('../../../../../archivosComunes/conexion.php');

                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE 'DAW2' AND tipo LIKE '%comunes'";
                            $resul = $db->query($select);                            
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                             while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                    echo '<td id="general'.$asignatura['cod_asignatura'].'">'.$asignatura['nombre'].'</td>';
                                    echo '<td id="horas_comumnes'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
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
    include('../../../../footer.php');
    ?>
    <script src="../../../script.js"></script>
</body>
</html>