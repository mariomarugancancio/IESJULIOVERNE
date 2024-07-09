<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2BTOCIENCIAS</title>
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/app.css">
  <link rel="stylesheet" type="text/css" href="../../../../css/prematriculas.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../../../images/logoJulioVerneNuevo.png">

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
    include('navBAC.php');
    ?>
    <div class="fondo">
        <div class="matricula mt-4">
            <h1 style="text-align: right; color: green; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">2BTOCIENCIAS</h1>
            <form id="matriculas" action="../../../generate_pdf.php" method="post">
                <input type="hidden" name="curso" value="2BTOCIENCIAS">
                <input type="hidden" name="preferenciaClasesOptativas" id="preferenciaClasesOptativas">
                <input type="hidden" name="preferenciaClasesModalidad" id="preferenciaClasesModalidad">
                <input type="hidden" name="preferenciaClasesObligatoria" id="preferenciaClasesObligatoria">

                
                <?php
                    include('../../formularioComun.php');
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
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '2BTOCIENCIAS' AND tipo LIKE '%comunes'";
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
                            <th scope="col">Obligatoria (Elegir 1)</th>
                            <th scope="col">Horas Semanales</th>
                    </thead>
                    <tbody id="clasesObligatorias">
                    <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '2BTOCIENCIAS' AND tipo LIKE '%obligatoria'";
                            $resul = $db->query($select);                            
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                            while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                // Recorremos las columnas de la fila actual
                            if (count($asignaturasObligatorias) > 0){
                                if ($asignaturasObligatorias[0] == $asignatura['cod_asignatura']){
                                    echo '<td id="asignaturas_obligatorias'.$asignatura['cod_asignatura'].'"> <input class="obligatorias" type="radio" name="obligatorias" value="'.$asignatura['nombre'].'" checked> '.$asignatura['nombre'].'</td>';
                                    echo '<td id="horas_obligatorias'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                }else{
                                    echo '<td id="asignaturas_obligatorias'.$asignatura['cod_asignatura'].'"> <input class="obligatorias" type="radio" name="obligatorias" value="'.$asignatura['nombre'].'"> '.$asignatura['nombre'].'</td>';
                                    echo '<td id="horas_obligatorias'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';                                   
                                    $cod_asignaturaNoObligatoria=$asignatura['cod_asignatura'];
                                    $horas_asignaturaNoObligatoria=$asignatura['horas'];
                                    $nombre_asignaturaNoObligatoria = $asignatura['nombre'];
                                }
                            }else{
                                echo '<td id="asignaturas_obligatorias'.$asignatura['cod_asignatura'].'"> <input class="obligatorias" type="radio" name="obligatorias" value="'.$asignatura['nombre'].'"> '.$asignatura['nombre'].'</td>';
                                echo '<td id="horas_obligatorias'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';                                   
                 
                            }
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
                                <p>Numere del 1 al 5 por orden de preferencia</p>
                            </th>
                            <th scope="col">Horas Semanales</th>
                        </tr>
                    </thead>
                    <tbody id="clasesModalidad">
                    <?php  
                          $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '2BTOCIENCIAS' AND tipo LIKE '%modalidad'";
                          $resul = $db->query($select);
                          $idClasesModalidad = 1;
                          // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                          while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                              if(count($asignaturasModalidades)>0){
                              $i=0;
                              $encontrado=false;
                              while($i < count($asignaturasModalidades)){
                                    if($asignaturasModalidades[$i] == $cod_asignaturaNoObligatoria){
                                        $preferenciaObligatoria = $asignaturasModalidadesPreferencias[$i];
                                    }
                                  if($asignaturasModalidades[$i] == $asignatura['cod_asignatura']){
                                      $encontrado=true;
                                      echo '<tr>';
                                      // Recorremos las columnas de la fila actual
                                          echo '<td id="'.$idClasesModalidad++.'_modalidad"> <input class="clasesModalidad" type="number" name="materias_modalidad" min="1" max="4" value='.$asignaturasModalidadesPreferencias[$i].'> '.$asignatura['nombre'].'</td>';
                                          echo '<td id="horas_modalidad'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                      echo "</tr>";  
                                  }
                                  $i = $i + 1;
                              }
                              if($encontrado == false){
                                  echo '<tr>';
                                  // Recorremos las columnas de la fila actual
                                      echo '<td id="'.$idClasesModalidad++.'_modalidad"> <input class="clasesModalidad" type="number" name="materias_modalidad" min="1" max="4"> '.$asignatura['nombre'].'</td>';
                                      echo '<td id="horas_modalidad'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                  echo "</tr>";  
                              
                              }
                          }else{
  
                                      echo '<tr>';
                                      // Recorremos las columnas de la fila actual
                                          echo '<td id="'.$idClasesModalidad++.'_modalidad"> <input class="clasesModalidad" type="number" name="materias_modalidad" min="1" max="4"> '.$asignatura['nombre'].'</td>';
                                          echo '<td id="horas_modalidad'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                      echo "</tr>";  
                                  
                              
                          }
                              
                          }
                          //No obligatoria
                          if (count($asignaturasObligatorias) > 0){
                            echo '<tr class="obligatoriaAniadido">';
                          // Recorremos las columnas de la fila actual
                              echo '<td id="'.$idClasesModalidad++.'_modalidad"> <input class="clasesModalidad" type="number" name="materias_modalidad" min="1" max="4" value='.$preferenciaObligatoria.'> '.$nombre_asignaturaNoObligatoria.'</td>';
                              echo '<td id="horas_modalidad'.$cod_asignaturaNoObligatoria.'">'.$horas_asignaturaNoObligatoria.' horas</td>';
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
                                <p>Numere del 1 al 3 por orden de preferencia</p>
                            </th>
                            <th scope="col">Horas Semanales</th>
                        </tr>
                    </thead>
                    <tbody id="tablaOptativas">
                    <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '2BTO' AND tipo LIKE '%optativas'";
                            $resul = $db->query($select);
                            $idClasesOptativas = 1;
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                            while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                if(count($asignaturasOptativas)>0){
                                $i=0;
                                $encontrado=false;
                                while($i < count($asignaturasOptativas)){
    
                                    if($asignaturasOptativas[$i] == $asignatura['cod_asignatura']){
                                        $encontrado=true;
                                        echo '<tr>';
                                        // Recorremos las columnas de la fila actual
                                            echo '<td id="'.$idClasesOptativas++.'_optativas"> <input class="clasesOptativas" type="number" name="materias_optativas" min="1" max="3" value='.$asignaturasOptativasPreferencias[$i].'> '.$asignatura['nombre'].'</td>';
                                            echo '<td id="horas_optativas'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                        echo "</tr>";  
                                    }
                                    $i = $i + 1;
                                }
                                if($encontrado == false){
                                    echo '<tr>';
                                    // Recorremos las columnas de la fila actual
                                        echo '<td id="'.$idClasesOptativas++.'_optativas"> <input class="clasesOptativas" type="number" name="materias_optativas" min="1" max="3"> '.$asignatura['nombre'].'</td>';
                                        echo '<td id="horas_optativas'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                    echo "</tr>";  
                                
                                }
                            }else{
    
                                        echo '<tr>';
                                        // Recorremos las columnas de la fila actual
                                            echo '<td id="'.$idClasesOptativas++.'_optativas"> <input class="clasesOptativas" type="number" name="materias_optativas" min="1" max="3"> '.$asignatura['nombre'].'</td>';
                                            echo '<td id="horas_optativas'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                        echo "</tr>";  
                                    
                                
                            }
                                
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
    <script src="../../script.js"></script>
</body>
</html>