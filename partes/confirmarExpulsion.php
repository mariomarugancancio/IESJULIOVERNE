<!doctype html>
<html lang="en">
<head>
    <title>Detalles de la Parte</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">

    <style>
        .card-rounded {
            border-radius: 10px;
            overflow: hidden;
        }
        .boton{
            height: 50px;
            align-self: center;
        }
        form {
            align-items: center;
        }
    </style>
</head>
<body>
    <header>
        <?php require_once "./archivosComunes/navPartes.php"; ?>
    </header>
    <main class="p-4 col-11 m-auto">
    <?php
                        require_once "../archivosComunes/conexion.php";
                        if ($db) {
                            if (isset($_GET['cod_expulsion'])) {
                                $cod_expulsion =  $_GET['cod_expulsion'] ;
                                $consulta = $db->prepare("SELECT p.cod_parte, CONCAT(u.nombre, ' ', u.apellidos) AS nombreProfesorCompleto, p.fecha, i.puntos, CONCAT(a.nombre, ' ', a.apellidos) AS nombreAlumnoCompleto, a.matricula, p.materia, p.fecha_Comunicacion, p.descripcion, p.caducado, a.grupo , e.cod_expulsion, e.tipo_expulsion
                                                          FROM Partes p  
                                                          JOIN Expulsiones e ON p.matricula_Alumno = e.matricula_del_alumno
                                                          JOIN Incidencias i ON p.incidencia = i.cod_incidencia
                                                          JOIN Usuarios u ON p.cod_usuario = u.cod_usuario
                                                          JOIN Alumnos a ON p.matricula_Alumno = a.matricula
                                                          WHERE  e.cod_expulsion = ? AND p.caducado = 0
                                                          ORDER BY p.fecha DESC");
                                $consulta->execute(array($cod_expulsion));
                                $alumno = $consulta->fetch();
                       
                                $consulta->execute(array($cod_expulsion));
                                $tipoExpulsion = $consulta->fetch();
                               $consulta->execute(array($cod_expulsion));
                                $partes = $consulta->fetchAll(PDO::FETCH_ASSOC);
                                
                            } else {
                                echo "<p>No se proporcionó el parámetro cod_parte en la URL.</p>";
                            }
                        } else {
                            echo "<p>Error en la conexión a la base de datos.</p>";
                        }
                    ?>
        <?php
        if ( $_SESSION['usuario_login']['rol'] == 0){
            ?>
        <div class="m-2">
            <h2 class="text-light rounded bg-dark p-2 px-3">Seleccione fecha de expulsión y Partes de: <?php echo isset($alumno['nombreAlumnoCompleto']) ? $alumno['nombreAlumnoCompleto'] : ''; ?></h2> 
            <div class='card card-rounded'>
                <form id="expulsionForm" class="m-3 d-flex justify-content-center flex-wrap" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="m-3 d-flex justify-content-center flex-wrap">  
                        <label class="me-2">Fecha inicio de expulsión</label>
                        <input type="date" name="fecha_inicio" required>
                    </div>
                    <div class="m-3 d-flex justify-content-center flex-wrap">
                        <label class="me-2">Fecha final de la expulsión</label>
                        <input type="date" name="fecha_final" required>
                    </div>
                    <div class="m-3 d-flex justify-content-center flex-wrap">
                    <label for="tipoExpulsion" class="me-2">Tipo de Expulsión</label>

                    <select class="me-2" name="tipoExpulsion" id="tipoExpulsion">
                    <?php if ($tipoExpulsion['tipo_expulsion'] == "Expulsión a Casa"){ ?>
                        <option value='Expulsión a Casa' select>Expulsión a casa</option>
                        <option value='Trabajo Social Educativo'>Trabajo Social Educativo</option>
                    <?php }else{ ?>
                        <option value='Trabajo Social Educativo' select>Trabajo Social Educativo</option>
                        <option value='Expulsión a Casa'>Expulsión a casa</option>
                    <?php }?>

                
                    </select>
                    </div>

                    <div class="m-3">
                        <label class="ms-3">Seleccione los partes</label>
                        <div class="m-3 border border-dark p-2" style="max-height: 150px; overflow-y: auto;">
                            <?php
                                if (isset($partes)) {
                                    $i=1;
                                    foreach ($partes as $parte) {
                                        echo '  <input hidden type="text" id="matricula" name="matricula[]" value="' . $parte['matricula'] . '">';

                                        echo '<input type="checkbox" id="'.$i.'" name="partes[]" value="' . $parte['cod_parte'] . '">';
                                        echo '<label for='.$i.'"">'.$i.'. ' . $parte['nombreProfesorCompleto'] . ' - ' . $parte['fecha_Comunicacion'] .' / '. $parte['puntos'] .'</label><br>';
                                          $i=$i+1;
                                    }

                                }
                            ?>
                        </div>
                    </div>

                    <button type="submit" name="Expulsar"  value="<?php echo isset($alumno['cod_expulsion']) ? $alumno['cod_expulsion'] : ''; ?>" class="btn btn-danger m-1 boton">Expulsar</button>
                </form>  
                <button class="btn btn-danger mt-4" onclick="eliminarExpulsion(<?php echo $cod_expulsion; ?>)">Eliminar Expulsión</button>

            </div>

        </div>  
        
        <?php
       }
            ?>
        <h2 class="text-light rounded bg-dark p-2 px-3">Datos de los Partes de <?php echo isset($alumno['nombreAlumnoCompleto']) ? $alumno['nombreAlumnoCompleto'] : ''; ?></h2>
        <table id="tablaPartes" class="table table-striped table-rounded">
            <thead>
                <tr>
                    <th style="width: 75px" class="text-center">Número</th>
                    <th style="width: 125px" class="text-center">Fecha</th>
                    <th style="width: 125px" class="text-center">Matricula</th>
                    <th style="width: 200px">Nombre Profesor</th>
                    <th style="width: 200px">Nombre Alumno</th>
                    <th style="width: 100px" class="text-center">Grupo</th>
                    <th style="width: 100px" class="text-center">Puntos</th>
                    <th style="width: 100px" class="text-center">Acción</th>

                </tr>
            </thead>
            <tbody>
            <?php 
                if (isset($partes)) {
                    $i=1;
                    foreach ($partes as $row) {
                        echo "<tr class='fila-tabla'>";
                        echo "<td class='text-center'>" . $i . "</td>";
                        echo "<td class='text-center'>" . $row['fecha_Comunicacion'] . "</td>";
                        echo "<td class='text-center'>" . $row['matricula'] . "</td>";
                        echo "<td>" . $row['nombreProfesorCompleto'] . "</td>";
                        echo "<td>" . $row['nombreAlumnoCompleto'] . "</td>";
                        echo "<td class='text-center'>" . $row['grupo'] . "</td>";
                        echo "<td class='text-center'>" . $row['puntos'] . "</td>";
                        echo "<td><p><a class='text-decoration-none  text-black' href='detalleParte.php?cod_parte=" . $row['cod_parte'] . "'>Ver Parte -></a></p></td>";

                        echo "</tr>";
                        $i=$i+1;

                        
                    }
                }
            ?>
            </tbody>
        </table>
    </main>
    <footer>
        <?php require_once "./archivosComunes/footerPartes.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Expulsar"])) {
            require_once "../archivosComunes/conexion.php";

            $partes = $_POST["partes"];
            $puntos = 0;

            foreach($partes as $parte){
                $consulta = $db->prepare("SELECT i.puntos AS puntos
                FROM Partes p  
                JOIN Incidencias i ON p.incidencia = i.cod_incidencia
                WHERE  p.cod_parte = ?
                ORDER BY i.puntos DESC");
                $consulta->execute(array($parte));
                if ($puntosSQL = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $puntos = $puntos + $puntosSQL["puntos"];
                }
            }      

            if ($puntos>=10) {
                try {
                    $db->beginTransaction();
                    $cod_expulsion = $_POST["Expulsar"];
                    $fecha_inicio = $_POST["fecha_inicio"];
                    $fecha_fin = $_POST["fecha_final"];
                    $tipo_expulsion = $_POST["tipoExpulsion"];
                    $matricula_Alumno = $_POST["matricula"];

                    $actualizar_Expulsion = $db->prepare("UPDATE Expulsiones SET fecha_Inicio = ?, Fecha_Fin = ?, tipo_expulsion = ?  WHERE cod_expulsion = ?");
                    $result = $actualizar_Expulsion->execute(array($fecha_inicio, $fecha_fin, $tipo_expulsion, $cod_expulsion));
                
                    if (!$result) {
                        throw new Exception("Error al actualizar la expulsión.");
                    }
                    
                    $partes = $_POST["partes"];
                    foreach ($partes as $parte) {
                        $Añadir_Parte_Expulsion = $db->prepare("INSERT INTO PartesExpulsiones(cod_parte, cod_expulsion) VALUES (?, ?)");
                        $result = $Añadir_Parte_Expulsion->execute(array($parte, $cod_expulsion));
                
                        if (!$result) {
                            throw new Exception("Error al insertar datos.");
                        } else {
                            $actualizacion = $db->prepare("UPDATE Partes SET caducado = 2 WHERE cod_parte = ?");
                            $actualizacion->execute(array($parte));
                        }
                    }
                
                    $db->commit();
                    
                    include("./funcionalidad/insertarExpulsionSinPartes.php");


                    print "
                    <script>
                    window.location = 'verExpulsionesConfirmadas.php?insertado=1';
                    </script>"; 
                    exit();
                } catch (Exception $e) {
                    $db->rollBack();
                    echo "Error: " . $e->getMessage();
                    print "
                    <script>
                    window.location = 'verExpulsionesPendientes.php?insertado=0';
                    </script>"; 
                    exit();
                }
                
            } else {
                print "
                <script>
                window.location = 'verExpulsionesPendientes.php?insertado=2';
                </script>"; 
                exit();            
            }
        }
    ?>
    <script>
        function confirmarExpulsion(event) {
            if (!confirm("¿Está seguro de que desea expulsar a este alumno?")) {
                event.preventDefault();
            }
        }  
        document.querySelector("button[name='Expulsar']").addEventListener("click", confirmarExpulsion);
        function eliminarExpulsion(cod_expulsion) {
            if (confirm("¿Estás seguro de que quieres eliminar esta expulsión?")) {
                window.location.href = "./funcionalidad/eliminarExpulsion.php?cod_expulsion=" + cod_expulsion;
            }
        }
   </script>
</body>
</html>
