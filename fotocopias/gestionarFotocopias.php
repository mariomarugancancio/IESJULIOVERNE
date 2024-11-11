<!doctype html>
<html lang="en">

<head>
    <title>Fotocopias</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>
    <script src="./js/paginacionFiltroAlumnos.js"></script>
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">


</head>

<body>
    <header>
        <?php

        require_once "archivosComunes/nav.php";
        require_once("../archivosComunes/conexion.php");
        require_once('../archivosComunes/loginRequerido.php');
?>
    </header>
    <?php
    if(isset($_GET['correcto'])){
        if($_GET['correcto'] == "true"){
            // Mostrar el error en la pantalla
            echo '<div class="alert alert-success" role="alert">';
            echo ' Fotocopias pagadas con exito';
            echo '</div>';
        }else{
            // Mostrar el error en la pantalla
            echo '<div class="alert alert-danger" role="alert">';
            echo ' No tiene saldo suficiente';
            echo '</div>';
        }
    }
    if(isset($_GET['correcto2'])){
        if($_GET['correcto2'] == "true"){
            // Mostrar el error en la pantalla
            echo '<div class="alert alert-success" role="alert">';
            echo 'Precio de las fotocopias actualizado';
            echo '</div>';
        }else{
            // Mostrar el error en la pantalla
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Precio de las fotocopias no actualizado';
            echo '</div>';
        }
    }
    ?>
    <main class="container mt-3">
    <?php 
    if ($_SESSION['usuario_login']['rol'] == "0") {

    $precio;
    $select = "SELECT precio
            FROM Fotocopias
            WHERE tipo = 'BN';";
            $resul = $db->query($select);

            // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
            if ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
                $precio = $columna['precio'];
            }
?>
    <form method="POST" action="actualizarPrecioFotocopias.php">

    <div class='form-group form-floating mb-3'>
            <input type='number' class='form-control' name='precio' id='precio' value=<?php echo $precio;?> step=".01">
            <label for="precio">Precio fotocopias</label>

        </div>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </form>
                                   

    <?php
        }
    ?>
    <h2 class="text-decoration-underline mb-5">Lista de Alumnos </h2>

        <div class='form-group form-floating mb-3'>
            <input type='text' class='form-control' name='buscador' id='buscador'>
            <label for="buscador">Buscador</label>

        </div>
        <div class="d-flex justify-content-center flex-wrap">


                <table class="table table-bordered table-striped table-hover text-center mt-2" id="lista">
                    <thead>
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Saldo</th>
                            <th scope="col">Número de Fotocopias</th>
                            <?php

                            if ($_SESSION['usuario_login']['rol'] == "0") {
                                echo '<th scope="col">Transacciones</th>';

                            }            
            
            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = "SELECT matricula, nombre, apellidos, grupo, saldo
                        FROM Alumnos
                        ORDER BY grupo, matricula, apellidos, nombre ;";
                        $resul = $db->query($select);

                        // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                        while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
                            $nombre = $columna['nombre'];
                            $apellidos = $columna['apellidos'];
                            $matricula = $columna['matricula'];
                            $grupo = $columna['grupo'];
                            $saldo = $columna['saldo'];

                            echo "<tr class='fila-tabla'>";
                            // Recorremos las columnas de la fila actual
                            echo '<td>' . $columna['matricula'] . '</td>';
                            echo '<td>' . $columna['nombre'] . '</td>';
                            echo '<td>' . $columna['apellidos'] . '</td>';
                            echo '<td>' . $columna['grupo'] . '</td>';
                            echo '<td>' . $columna['saldo'] . ' €</td>';

                            echo '<td>
                                 <form method="POST" action="actualizarFotocopias.php">
                                        <input hidden type="text" id="matricula" name="matricula" value='.$columna['matricula'].'>
                                        <input hidden type="text" id="nombre" name="nombre" value='.$columna['nombre'].'>
                                        <input hidden type="text" id="apellidos" name="apellidos" value='.$columna['apellidos'].'>
                                        <input hidden type="text" id="grupo" name="grupo" value='.$columna['grupo'].'>

                                        <input type="number" name="fotocopias" id="fotocopias" placeholder="Num de fotocopias" min=1>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </form>
                                </td>';
                                if ($_SESSION['usuario_login']['rol'] == "0") {
                                    echo '<td> <a href="#" onclick="transacciones(\''.$columna['matricula'].'\');"><i id="editar'.$columna['matricula'].'" class="fa-solid fa-magnifying-glass"></i></a> </td>';
    
                                }            
                

                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-5" id="tablaPaginacion">

                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id="paginacion">

                        </ul>
                    </nav>

                </div>
            </div>
            <button onclick="window.location.href='escanearQR.php';">Ir a Escanear QR (JavaScript)</button>


    </main>
    <footer>
        <?php
        require_once "./archivosComunes/footer.php";
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
    function transacciones(matricula) {
        var url = "transacciones.php?matricula=" + encodeURIComponent(matricula);
        window.location.href = url;
    }

  
</script>

</html>