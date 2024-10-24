<!doctype html>
<html lang="en">

<head>
    <title>Alumnos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>
    <script src="./js/paginacionFiltroAlumnos.js"></script>

    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">
    <link rel="stylesheet" href="../css/confirmarEliminarr.css">

</head>

<body>
    <header>
        <?php

        require_once "archivosComunes/nav.php";
        require_once("../archivosComunes/conexion.php");
        require_once('../archivosComunes/loginRequerido.php');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $matricula = $_POST['matricula'];
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $grupo = $_POST['grupo'];
            $insert = "INSERT INTO Alumnos (matricula, nombre, apellidos, grupo)
            VALUES (:matricula, :nombre,  :apellidos, :grupo)";
            $stmt = $db->prepare($insert);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellidos', $apellidos);
            $stmt->bindParam(':grupo', $grupo);
            $lastID = $stmt->execute();
        }
        ?>
    </header>


    <?php
    if (isset($_GET['Añadido'])) {

        if ($_GET['Añadido'] == 1) {
            echo '<h3 class="text-light rounded bg-success p-2 px-3 m-3">Alumnos insertados exitosamente</h3>';
        } elseif ($_GET['Añadido'] == 0) {
            echo '<h3 class="text-light rounded bg-danger p-2 px-3 m-3">No se ha podido insertados los Alumnos. Compruebe el archivo</h3>';
        }
    }

    ?>
      <!-- Modal personalizado -->
      <div id="customConfirm" class="modal">
    <div class="modal-content">
        <p id="mensajeEliminar">¿Está seguro de que desea borrar este alumno?</p>
        <button id="confirmBtn" class="btnConfirmar btn-success">Sí, borrar</button>
        <button id="cancelBtn" class="btnConfirmar btn-danger">No, cancelar</button>
    </div>
</div>
    <main class="container mt-3">

        <div class="d-flex justify-content-between flex-wrap">

            <div id="formulario" class="mx-auto mt-3 order-sm-2 order-md-1" style="width:400px;">
                <h2 class="text-decoration-underline mb-5">Agregar Alumnos </h2>

                <!-- PHP_SELF para enviar al mismo archivo -->
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">


                    <div class="form-group form-floating mb-3">
                        <input type="text" name="matricula" class="form-control" id="matricula" required>
                        <label for="matricula">Matrícula</label>

                    </div>
                    <div class="form-group form-floating mb-3">
                        <input type="text" name="nombre" class="form-control" id="nombre" required>
                        <label for="nombre">Nombre</label>

                    </div>
                    <div class="form-group form-floating mb-3">
                        <input type="text" name="apellidos" class="form-control" id="apellidos" required>
                        <label for="apellidos">Apellidos</label>

                    </div>

                    <label for="grupo">Grupo:</label>

                    <div class="mb-3">
                        <div class="form-group">
                            <!-- creamos un select -->
                            <select class="form-control" name="grupo" id="grupo" required>
                                <?php
                                $select = "SELECT grupo FROM Cursos";
                                $resul = $db->query($select);

                                while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $columna['grupo'] . "'>" . $columna['grupo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>

                </form>



                <div class="container mt-5 g-3" style="max-width: 400px;">
                    <h3 class="text-decoration-underline">Importar Alumnos </h2>
                        <p class="mb-2"> Seleccione un archivo de hoja de calculo para importar los alumnos</p>

                        <form method="post" action="./funcionalidad/importar.php" enctype="multipart/form-data">
                            <div class="mb-3 g-3">
                                <label for="archivo" class="form-label">Seleccionar archivo:</label>
                                <input type="file" class="form-control" id="archivo" name="archivo[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary ">Importar</button>
                        </form>
                </div>
                <div class="container my-5 py-2" style="max-width: 400px;">
                    <!-- PHP_SELF para enviar al mismo archivo -->
                    <h3 class="text-decoration-underline mb-2">Eliminar todos los alumnos</h2>

                        <form method="POST" action="./funcionalidad/eliminarTodosLosAlumnos.php">
                            <button type="submit" class="btn btn-primary ">Eliminar alumnos</button>

                        </form>
                </div>
            </div>

            <div id="lista" class="mx-auto mt-3 order-sm-1 order-md-2" style="max-width:600px;">
                <h2 class="text-decoration-underline mb-5">Lista de Alumnos </h2>

                <div class='form-group form-floating mb-3'>
                    <input type='text' class='form-control' name='buscador' id='buscador'>
                    <label for="buscador">Buscador</label>

                </div>

                <table class="table table-bordered table-striped table-hover text-center mt-2" id="lista">
                    <thead>
                        <tr>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $select = "SELECT matricula, nombre, apellidos, grupo
                        FROM Alumnos
                        ORDER BY grupo, matricula, apellidos, nombre ;";
                        $resul = $db->query($select);

                        // Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
                        while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
                            $nombre = $columna['nombre'];
                            $apellidos = $columna['apellidos'];
                            $matricula = $columna['matricula'];
                            $grupo = $columna['grupo'];

                            echo "<tr class='fila-tabla'>";
                            // Recorremos las columnas de la fila actual
                            echo '<td>' . $columna['matricula'] . '</td>';
                            echo '<td>' . $columna['nombre'] . '</td>';
                            echo '<td>' . $columna['apellidos'] . '</td>';
                            echo '<td>' . $columna['grupo'] . '</td>';
                            
                            echo '<td> <a href="#" class="btn-editar" onclick="editarAlumno(\'' . $columna['matricula'] . '\')"><i class="fa-solid fa-pencil"></i></a> </td>';
                            echo '<td> <a href="#"  class="btn-borrar" onclick="eliminarAlumno(\'' . $columna['matricula'] . '\')"><i class="fa-solid fa-trash"></i></a> </td>';
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
    function editarAlumno(matricula) {
        var url = "editarAlumno.php?matricula=" + encodeURIComponent(matricula);
        window.location.href = url;
    }

    function eliminarAlumno(matricula) {

      // Mostrar el modal personalizado
      var mensaje =document.getElementById("mensajeEliminar");
        mensaje.innerHTML= "¿Está seguro de que desea borrar este alumno?"
        var modal = document.getElementById("customConfirm");
        modal.style.display = "block";

        // Manejo del botón confirmar
        document.getElementById("confirmBtn").onclick = function() {
            var url = "./funcionalidad/eliminarAlumno.php?matricula=" + encodeURIComponent(matricula);
          window.location.href = url;
        };

        // Manejo del botón cancelar
        document.getElementById("cancelBtn").onclick = function() {
            modal.style.display = "none"; // Cerrar el modal si cancela
        };
    }

    // Opción para cerrar el modal si se hace clic fuera de él
    window.onclick = function(event) {
        var modal = document.getElementById("customConfirm");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>

</html>