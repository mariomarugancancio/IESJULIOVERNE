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
        if(isset($_GET['matricula'])){
            $matricula = $_GET['matricula'];
        }

?>
    </header>
   
    <main class="container mt-3">
    <?php
    $select = "SELECT matricula, nombre, apellidos
                        FROM Alumnos
                        WHERE matricula = '".$matricula."'";
                        $resul = $db->query($select);

                        // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                        if ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
                        
    echo '<h2 class="text-decoration-underline mb-5">Alumno '.$columna['nombre'].' '.$columna['apellidos'].'</h2>';
                        }
?>
        <div class='form-group form-floating mb-3'>
            <input type='text' class='form-control' name='buscador' id='buscador'>
            <label for="buscador">Buscador</label>

        </div>
        <div class="d-flex justify-content-center flex-wrap">


                <table class="table table-bordered table-striped table-hover text-center mt-2" id="lista">
                    <thead>
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Fotocopias</th>
                            <th scope="col">Saldo antiguo</th>
                            <th scope="col">Saldo nuevo</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = "SELECT matricula, fecha, fotocopias, saldoAntiguo, saldoNuevo
                        FROM Transacciones
                        WHERE matricula = '".$matricula."'
                        ORDER BY fecha DESC;";
                        $resul = $db->query($select);

                        // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                        while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
           

                            echo "<tr class='fila-tabla'>";
                            // Recorremos las columnas de la fila actual
                            echo '<td>' . $columna['matricula'] . '</td>';
                            echo '<td>' . $columna['fecha'] . '</td>';
                            echo '<td>' . $columna['fotocopias'] . '</td>';
                            echo '<td>' . $columna['saldoAntiguo'] . ' €</td>';
                            echo '<td>' . $columna['saldoNuevo'] . '€</td>';
                            
                                    
                

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