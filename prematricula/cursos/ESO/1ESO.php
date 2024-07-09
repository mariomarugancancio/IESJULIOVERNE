<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1ESO</title>
    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../../css/app.css">
  <link rel="stylesheet" type="text/css" href="../../../css/prematriculas.css">
  <link rel="shortcut icon" href="../../../images/logoJulioVerneNuevo.png">

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
        require('../../../archivosComunes/conexion.php');
    ?>
</head>

<body>
    <?php
    
    include('navESO.php');
    ?>
    <div class="fondo">
        <div class="matricula mt-4">
            <h1 style="text-align: right; color: green; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">1ºESO</h1>
            
            <form id="matriculas" action="../../generate_pdf.php" method="post">
                <input type="hidden" name="curso" value="1ESO">
                <input type="hidden" name="preferenciaClasesOptativas" id="preferenciaClasesOptativas">
                <?php
                    include('../formularioComun.php');
                ?>


                <div class="form-group mb-2">
                <p>¿DESEARÁ CURSAR EL PROGRAMA BILINGÜE?  
                    <?php if($bilingue == "SI"){
                        echo '<input type="radio" id="bilingue_si" name="bilingue" value="SI" checked> SÍ ';
                        echo '<input type="radio" id="bilingue_no" name="bilingue" value="NO"> NO</p>';

                    }else if($bilingue == "NO"){
                        echo '<input type="radio" id="bilingue_si" name="bilingue" value="SI"> SÍ ';
                        echo '<input type="radio" id="bilingue_no" name="bilingue" value="NO" checked> NO</p>';

                    }else{
                        echo '<input type="radio" id="bilingue_si" name="bilingue" value="SI"> SÍ ';
                        echo '<input type="radio" id="bilingue_no" name="bilingue" value="NO"> NO</p>';
 
                    }
                    ?>
                                    </div> 

                <div class="form-group mb-2">
                <p>¿Desea cursar Religión? (1 hora) 
                <?php if($religion == "SI"){
                        echo '<input type="radio" id="religion_si" name="religion" value="SI" checked> SÍ ';
                        echo '<input type="radio" id="religion_no" name="religion" value="NO"> NO</p>';

                    }else if($religion == "NO"){
                            echo '<input type="radio" id="religion_si" name="religion" value="SI"> SÍ ';
                            echo '<input type="radio" id="religion_no" name="religion" value="NO" checked> NO</p>';
                    }else{
                        echo '<input type="radio" id="religion_si" name="religion" value="SI"> SÍ ';
                        echo '<input type="radio" id="religion_no" name="religion" value="NO"> NO</p>';
                    }
                    ?>
                </div> 
                <h2 class="text-center">Rellenar solamente en caso de necesitar transporte escolar</h2>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-2">

            <label for="pueblo_transporte">Pueblo de residencia:</label>
            <input class="form-control" type="text" id="pueblo_transporte" name="pueblo_transporte" value="<?php echo $pueblo_transporte; ?>">
        </div>
        <div class="form-group mb-2">
            <label for="urbanizacion_transporte">Especificar urbanización si corresponde:</label>
            <input class="form-control" type="text" id="urbanizacion_transporte" name="urbanizacion_transporte" value="<?php echo $urbanizacion_transporte; ?>">
        </div>
    </div>

</div>
                <div class="form-group mb-4">
                <table class="table table-bordered table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Materias Comunes</th>
                            <th scope="col">Horas Semanales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '1ESO' AND tipo LIKE '%comunes'";
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
                            <th scope="col">Materias Optativas (Se cursará 1) 
                                <p>Numera del 1 al 3 por orden de preferencia</p>
                            </th>

                            <th scope="col">Horas Semanales</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $select = "SELECT cod_asignatura, nombre, horas, curso, tipo FROM Asignaturas WHERE curso LIKE '1ESO' AND tipo LIKE '%optativas'";
                            $resul = $db->query($select);
                            $idClasesOptativas = 1;
                            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                            while ($asignatura = $resul->fetch(PDO::FETCH_ASSOC)) {
                                if(count($asignaturasOptativas)>0){
                                $i=0;
                                while($i < count($asignaturasOptativas)){
    
                                    if($asignaturasOptativas[$i] == $asignatura['cod_asignatura']){
                                        echo '<tr>';
                                        // Recorremos las columnas de la fila actual
                                            echo '<td id="'.$idClasesOptativas++.'_optativas"> <input class="clasesOptativas" type="number" name="materias_optativas" min="1" max="3" value='.$asignaturasOptativasPreferencias[$i].'> '.$asignatura['nombre'].'</td>';
                                            echo '<td id="horas_optativas'.$asignatura['cod_asignatura'].'">'.$asignatura['horas'].' horas</td>';
                                        echo "</tr>";  
                                    }
                                    $i = $i + 1;
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
    include('./../../footer.php');
    ?>
    <script src="../script.js"></script>
    <script>
        // Función para manejar el cambio de los radio buttons
        function handleRadioChange(event) {
                    if(document.getElementById('bilingue_si').checked){
  // Obtener todos los tr
  const rows = document.querySelectorAll('table tr');

// Recorrer todas las filas para buscar los td con la palabra "obligatoria"
rows.forEach(row => {
    const tds = row.querySelectorAll('td');
    tds.forEach((td, index) => {
        if (td.textContent.includes('obligatoria')) {
            const inputTd = td.querySelector('input[type="number"]');
            if (inputTd) {
                inputTd.value = 1;
                inputTd.readOnly = true;
                }
            
        }
    });
});
                   
                }

                if(document.getElementById('bilingue_no').checked){
  // Obtener todos los tr
  const rows = document.querySelectorAll('table tr');

// Recorrer todas las filas para buscar los td con la palabra "obligatoria"
rows.forEach(row => {
    const tds = row.querySelectorAll('td');
    tds.forEach((td, index) => {
        if (td.textContent.includes('obligatoria')) {
            const inputTd = td.querySelector('input[type="number"]');
            if (inputTd) {
                inputTd.value = null;
                inputTd.readOnly = false;
                }
            
        }
    });
});
                   
                }
                }

        // Obtener todos los radio buttons y agregar el event listener
        const radios = document.querySelectorAll('input[type="radio"][name="bilingue"]');
        radios.forEach(radio => {
            radio.addEventListener('change', handleRadioChange);
        });
    </script>
</body>
</html>