<!doctype html>
<html lang="en">

<head>
    <title>Introducir Parte</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/app.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">
    <script src="../js/multiselect-dropdown.js"></script>

</head>

<body>
    <header>
        <?php
        require_once "archivosComunes/navPartes.php";
        ?>
    </header>
    <main class="p-4">
        <div class="m-2">
            <h2 class="text-light rounded bg-dark p-2 px-3 mb-5">Introducir Parte</h2>
            <form action="./funcionalidad/insertarParte.php" method="post" class="rounded p-3 bg-light">
                <div class="row mb-3">
                    <div class="col">
                        <label for="grupo" class="form-label">Grupo</label>
                        <select name="grupo" id="grupo" class="form-select" required>
                            <option value="">Seleccione un grupo</option>
                            <?php
                            require_once "../archivosComunes/conexion.php";
                            $consulta = $db->prepare("SELECT grupo FROM Cursos");
                            $consulta->execute();
                            while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $row['grupo'] . "'>" . $row['grupo'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="matriculaAlumno" class="form-label">Matrícula del Alumno</label>
                        
                          <!-- creamos un select -->
                            <select name="matricula_Alumno[]" id="matriculaAlumno" class="form-control" required multiple multiselect-search="true" multiselect-select-all="true" multiselect-max-items="3" onchange="console.log(this.selectedOptions)">
                            
                            
                            </select>
                      
                    </div>
                </div>
                <div class="mb-3">
                    <label for="incidencia" class="form-label">Incidencia</label>
                    <select name="incidencia" id="incidencia" class="form-select" required>
                        <option value="">Seleccione una incidencia</option>
                        <?php
                        $consulta = $db->prepare("SELECT cod_incidencia, descripcion, puntos FROM Incidencias");
                        $consulta->execute();
                        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['cod_incidencia'] . "'>" . $row['puntos'] . " - " . $row['descripcion'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="materia" class="form-label">Materia</label>
                    <select name="materia" id="materia" class="form-select" required>
                        <option value="">Seleccione una materia</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="fechaComunicacion" class="form-label">Fecha de Comunicación</label>
                        <input type="date" name="fecha_Comunicacion" id="fechaComunicacion" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="viaComunicacion" class="form-label">Vía de Comunicación</label>
                        <select name="via_Comunicacion" id="viaComunicacion" class="form-select" required>
                            <option value="">Seleccione una vía de comunicación</option>
                            <option value="Mensaje">Mensaje</option>
                            <option value="Notificacion Externa">Notificación Escrita</option>
                            <option value="LLamada Telefónica">Llamada Telefónica</option>
                            <option value="Entrevista con los padres">Entrevista con los padres</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Poner Parte</button>
            </form>
        </div>
    </main>
    <footer>
        <?php
        require_once "./archivosComunes/footerPartes.php";
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const grupoSelect = document.getElementById("grupo");
            let matriculaAlumnoSelect = document.getElementById("matriculaAlumno");
            const materiaSelect = document.getElementById("materia");

            grupoSelect.addEventListener("change", function() {
                const grupo = this.value;
                // Limpiar el select de alumnos y materias

                materiaSelect.innerHTML = '<option value="">Seleccione una Materia</option>';

                if (grupo) {
                    
                    fetchAlumnos(grupo);
                    fetchMaterias(grupo);
                }
            });

           async function fetchAlumnos(grupo) {

               await fetch(`./funcionalidad/fetch_alumnos.php?grupo=${encodeURIComponent(grupo)}`)
        .then(response => response.json())
        .then(alumnos => {

            // Filtrar y agregar las opciones al select
            alumnos.forEach(alumno => {

                const option = document.createElement("option");
                option.value = alumno.matricula;
                option.textContent = alumno.nombreCompleto;
                
                matriculaAlumnoSelect.appendChild(option);
            });
            matriculaAlumnoSelect.loadOptions();


        })
        .catch(error => console.error('Error:', error));

            }

            function fetchMaterias(grupo) {
                fetch(`./funcionalidad/fetch_materias.php?grupo=${encodeURIComponent(grupo)}`)
        .then(response => response.json())
        .then(materias => {
            console.log(materias.length);
            // Filtrar y agregar las opciones al select
                materias.forEach(materia => {
                    const option = document.createElement("option");
                    option.value = materia.cod_asignatura;
                    option.textContent = materia.nombre;
                    materiaSelect.appendChild(option);
                });

        })
        .catch(error => console.error('Error:', error));


               
            }
        });
    </script>
</body>
<script>
todos = new Array();
function marcar(s) {
cual=s.selectedIndex;
for(y=0;y<s.options.length;y++){
if(y==cual){
s.options[y].selected=(todos[y]==true)?false:true;
todos[y]=(todos[y]==true)?false:true;
}else{
s.options[y].selected=todos[y];
}
}
}
</script>
</html>
