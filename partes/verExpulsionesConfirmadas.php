<!doctype html>
<html lang="en">

<head>
    <title>Expulsiones</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/app.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">
    <link rel="stylesheet" href="../css/tablasResponsive.css">

    <style>
        .table-rounded {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
    <script src="./js/paginacionFiltroExpulsiones.js"></script>

</head>

<body>
    <header>
        <?php
        require_once "archivosComunes/navPartes.php";
        ?>
    </header>
    <main class="p-4">
        <div class=" m-2">
        <?php
            // Verificar si se ha recibido el parámetro 'eliminado' en la URL
            if (isset($_GET['eliminado'])) {
                // Mostrar el mensaje según el valor del parámetro
                if ($_GET['eliminado'] == 1) {
                    echo '<h3 class="text-light rounded bg-success p-2 px-3">Expulsion eliminada exitosamente</h3>';
                } elseif ($_GET['eliminado'] == 0) {
                    echo '<h3 class="text-light rounded bg-danger p-2 px-3">No se ha podido eliminar la Expulsion. Intentelo más tarde</h3>';
                }
            }

            // Verificar si se ha recibido el parámetro 'insertado' en la URL
            if (isset($_GET['insertado'])) {
                // Mostrar el mensaje según el valor del parámetro
                if ($_GET['insertado'] == 1) {
                    echo '<h3 class="text-light rounded bg-success p-2 px-3">Expulsion insertada exitosamente</h3>';
                } elseif ($_GET['insertado'] == 0) {
                    echo '<h3 class="text-light rounded bg-danger p-2 px-3">No se ha podido insertar la Expulsion. Intentelo más tarde</h3>';
                } elseif ($_GET['insertado'] == 2) {
                    echo '<h3 class="text-light rounded bg-danger p-2 px-3">No se ha podido insertar la Expulsion. Puntos insuficientes</h3>';
                }
            }
            ?>
            <h2 class="text-light rounded bg-dark p-2 px-3">Expulsiones</h2>
            <div class="row my-2">
            <div class="col-lg-3 col-md-6 my-2">
                    <div class="input-group">
                        <span class="input-group-text">Desde</span>
                        <input type="date" id="filtroFechaInicio" class="form-control" placeholder="Fecha de inicio">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 my-2">
                    <div class="input-group">
                        <span class="input-group-text">Hasta</span>
                        <input type="date" id="filtroFechaFin" class="form-control" placeholder="Fecha de fin">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-2">
                    <input type="text" id="filtroNombreAlumno" class="form-control" placeholder="Filtrar por nombre del alumno">
                </div>
                <?php
                // Incluir el archivo de conexión a la base de datos
                require_once "../archivosComunes/conexion.php";
                ?>
                <div class="col-lg-2 col-md-6 my-2">
                    <select id="filtroGrupo" class="form-select">
                        <option value="">Filtrar grupo</option>
                        <?php
                        $consulta = $db->prepare("SELECT * FROM Cursos");
                        $consulta->execute();
                        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=" . $row['grupo'] . ">" . $row['grupo'] . "</option>";
                        }
                        ?>
                    </select>
                </div>

            </div>
            <div class="table-responsive">

            <table id="tablaExpulsiones" class="table table-striped table-rounded  mx-auto text-center">
                <thead>
                    <tr>
                        <th>Fecha Expulsion</th>
                        <th>Nombre Alumno</th>
                        <th>Grupo</th>
                        <th class="	d-none d-lg-block">Estado</th>
                        <th>Administrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Incluir el archivo de conexión a la base de datos
                    require_once "../archivosComunes/conexion.php";

                    try {
                        // Obtener el rol del usuario
                        $rol_usuario = $_SESSION['usuario_login']['rol']; // Asegúrate de ajustar esto según tu sistema de autenticación
                        $tutor_usuario = $_SESSION['usuario_login']['tutor_grupo']; // Asegúrate de ajustar esto según tu sistema de autenticación

                        $query = " ";
                        // Preparar la consulta SQL
                        if ($rol_usuario == 1) {
                            // Si el rol del usuario es 1, mostrar todas las expulsiones
                            $id_usuario = $_SESSION['usuario_login']['cod_usuario']; // Asegúrate de ajustar esto según tu sistema de autenticación
                            $query = "WHERE '$tutor_usuario' = a.grupo";
                        }

                        $consulta = $db->prepare(    
                            "SELECT  e.cod_expulsion, DATE(e.fecha_Insercion) fecha_Insercion, a.matricula, 
                            CONCAT(a.nombre, ' ', a.apellidos) AS nombreAlumnoCompleto, a.grupo
                            FROM Expulsiones e
                            JOIN Alumnos a ON e.matricula_del_Alumno = a.matricula 
                            $query AND e.fecha_Inicio IS NOT NULL
                            ORDER BY fecha_Insercion DESC
                        ");

                        $consulta->execute();

                        // Iterar sobre los resultados y mostrar cada expulsion en una fila de la tabla
                        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['fecha_Insercion'] . "</td>";
                            echo "<td>" . $row['nombreAlumnoCompleto'] . "</td>";
                            echo "<td>" . $row['grupo'] . "</td>"; 
                            echo "<td class='text-success 	d-none d-lg-block  py-3'>" . "Confirmada" . "</td>";
                            echo "<td><p><a class='text-decoration-none  ' href='detalleExpulsion.php?cod_expulsion=" . $row['cod_expulsion'] . "'>Ver detalle expulsión</a></p></td>";
                            echo "</tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }

                    // Cerrar la conexión a la base de datos
                    $db = null;
                    ?>
                </tbody>
            </table>
            </div>  
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
        require_once "./archivosComunes/footerPartes.php";
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const filtroFechaInicio = document.getElementById("filtroFechaInicio");
    const filtroFechaFin = document.getElementById("filtroFechaFin");
            const filtroNombreAlumno = document.getElementById("filtroNombreAlumno");
            const filtroGrupo = document.getElementById("filtroGrupo");
            const tablaExpulsiones = document.getElementById("tablaExpulsiones").getElementsByTagName("tbody")[0].getElementsByTagName("tr");

            // Agregar event listeners para los campos de filtro
            filtroFechaInicio.addEventListener("input", filtrarTabla);
            filtroFechaFin.addEventListener("input", filtrarTabla);
            filtroNombreAlumno.addEventListener("input", filtrarTabla);
            filtroGrupo.addEventListener("change", filtrarTabla);

            function filtrarTabla() {
                const fechaInicio = filtroFechaInicio.valueAsDate;
                const fechaFin = filtroFechaFin.valueAsDate;
                const textoNombreAlumno = filtroNombreAlumno.value.toLowerCase();
                const valorGrupo = filtroGrupo.value;
                // Iterar sobre las filas de la tabla
                for (let fila of tablaExpulsiones) {
                    const fecha = new Date(fila.cells[0].textContent);

                    const cumpleFiltroFechaInicio = !fechaInicio || fecha >= fechaInicio; // Verificar si la fecha está después de la fecha de inicio
                    const cumpleFiltroFechaFin = !fechaFin || fecha <= fechaFin; // Verificar si la fecha está antes de la fecha de fin
                    const nombreAlumno = fila.cells[1].textContent.toLowerCase(); // Cambiado a 0, primera celda de la fila
                    const grupo = fila.cells[2].textContent; // Cambiado a 1, segunda celda de la fila
                    // Verificar si la fila coincide con los filtros
                    const cumpleFiltroNombreAlumno = nombreAlumno.includes(textoNombreAlumno) || textoNombreAlumno === "";
                    const cumpleFiltroGrupo = valorGrupo === "" || grupo === valorGrupo;
                    // Mostrar u ocultar la fila según los filtros
                    fila.style.display = cumpleFiltroFechaInicio && cumpleFiltroFechaFin && cumpleFiltroNombreAlumno && cumpleFiltroGrupo ? "" : "none";
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
