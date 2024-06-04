<?php
// Iniciamos la sesion
session_start();
// Para acceder a esta pagina hay que iniciar sesion previamente.
require_once('../../archivosComunes/conexion.php');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Añadir Material</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- <link rel="stylesheet" type="text/css" href="../inventario/css/index.css"> -->
    <style>
        .row {
            padding: 15px;
        }

        .form-label {
            margin-bottom: 0;
            margin-top: 10px;
        }

        input {
            margin-top: 0;
        }

        .shadow-blue {
            box-shadow: 0 .5rem 1rem rgba(0, 123, 255, .2) !important;
        }

        input[type="file"]::-webkit-file-upload-button {
            background-color: #0d6efd;
            color: white;

        }

        input[type="file"]:hover {
            color: #0d6efd !important;
            background-color: white;
        }

        .gradient-custom {
            /* fallback for old browsers */
            background: #6a11cb;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
        }

        .btn {
            width: 100px;
            height: 40px;
        }

        html {
            min-height: 100%;
            position: relative;
            box-sizing: border-box;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            font-size: 20px;
        }

        .main-content {
            min-height: calc(100vh - 100px);
            /* Resta el tamaño del footer al alto total de la ventana */
            padding-bottom: 100px;
            /* Asegura que el contenido no tape con el footer */
        }

        .main-form {
        min-height: calc(100vh - 180px); /* Resta el tamaño del footer al alto total de la ventana */
       
        
        }

        footer .row {
			padding: 0;
		}
		footer p {
			margin-bottom: 0;
		}


        @media (max-width: 767px) {
            .btn-container {
                display: flex;
                flex-direction: column;
                align-items: stretch;
            }

            .btn-container .btn {
                margin-bottom: 10px;
                width: 100%;
            }

            .texto-footer {
                font-size: 14px;
            }

            .main-form{
                padding-bottom: 100px;
            }

            
        }
    </style>
    <script>
        function validarFormulario() {
            // Verificamos si el usuario ha dejado la opción por defecto
            var departamento = document.getElementById('selectDepartamento').value;
            if (departamento === "- Seleccione su departamento -") {
            // Se muestra un mensaje de error
            alert("Seleccione un departamento");
            return false; // Evitar el envío del formulario
            }
        }
    </script>

</head>

<!-- Utilizamos el fichero para añdir el material en el inventario manualmente. -->
<body>
<header class="gradient-custom ">
		<nav class="navbar navbar-expand navbar-light p-3 me-5 ms-5">
			<a class="navbar-brand text-light" href="../index.php">Inventario</a>
			<ul class="navbar-nav flex-row flex-wrap text-light ms-auto">
            <li class="nav-item">
      <a class="text-light btn btn-outline-secondary me-2" style="width: 300px;" href="../../archivosComunes/actualizarUsuario.php?idusuario=<?php echo $_SESSION['usuario_login']['cod_usuario']?>">
      <span class="d-flex">
          <svg xmlns="http://www.w3.org/2000/svg" style="height: 24px;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>&nbsp;
                <?php echo $_SESSION['usuario_login']['nombre'].' '.$_SESSION['usuario_login']['apellidos'] ?>
      </span>                 
  </a>
  </li> 	
            <li class="nav-item dropdown"><i id="iniciar_sesion" class="bi bi-person
								nav-link dropdown text-light" role="button" data-bs-toggle="dropdown" style="text-align: right;"> Mi
						cuenta</i>
					<ul class="dropdown-menu dropdown-menu-end">
						
						<a class="dropdown-item" href="../../archivosComunes/selector.php">Página Principal</a>
						<a class="dropdown-item" href="../../archivosComunes/logout.php">Cerrar
							sesión</a>
					</ul>
				</li>
			</ul>
		</nav>
	</header>

    <!-- Una vez rellenos los campos del formuario para añadir el elemento, por el metodo POST llamamos a anadirMaterial.php  -->
    <!-- con el fin de actualizar la base de datos con el elemento insertado. -->

    <div class="container-fluid main-content pb-3" >
        <form action="anadirMaterial.php" method="POST" enctype="multipart/form-data" class="main-form d-flex justify-content-center align-items-center" onsubmit="return validarFormulario()">
            <div class="row d-flex">
                <div class="col-12 ">
                    <div class="row datos " style="padding-bottom: 150px;">
                        <div class="col-md-8 col-12 mb-4 ">
                            <div class="card shadow bg-white rounded shadow-blue">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="descripcion" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <label for="localizacion" class="form-label">Localizacion</label>
                                        <input type="text" class="form-control" id="localizacion" name="localizacion" required>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <label for="procedencia" class="form-label">Procedencia</label>
                                        <input type="text" class="form-control" id="procedencia" name="procedencia" required>
                                    </div>

                                    <div class="col-sm-12 ">
                                        <label for="baja" class="form-label">Motivo de Baja</label>
                                        <input type="text" class="form-control" id="motivo_bj" name="motivo_bj">
                                    </div>
                                    <div class="col-sm-12 ">
                                        <label for="imagen" class="form-label img">Imagen</label>
                                        <input type="file" class="form-control" id="imagen" name="imagen">
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="card shadow bg-white rounded shadow-blue">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <label for="numero" class="form-label">Nº de serie</label>
                                        <input type="number" class="form-control" id="numero" name="numero" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="unidades" class="form-label">Unidades</label>
                                        <input type="number" class="form-control" id="unidades" name="unidades" value="unidades" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="fungible" class="form-label">Fungible</label>
                                        <select class="form-control" id="fungible" name="fungible" required>
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>
                                        
                                    </div>
                                    <div class="col-sm-12 col-md-12" id="departamento" name="departamento">
                                        <label for="departamento" class="form-label">Departamento</label>
                                        <select class="form-control" id="selectDepartamento" name="selectDepartamento">
                                            <option name="dpto_no_valido" id="dpto_no_valido">- Seleccione su departamento -</option>
                                            <?php
                                            require_once('../../archivosComunes/conexion.php');
                                            $consulta = "SELECT * FROM Departamentos";
                                            $consulta = $db->query($consulta);
                                            foreach ($consulta as $row) {
                                                echo '<option>' . $row['nombre'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-12 col-md-12" style="color: red; font-weight: bold;">
                                        <?php
                                        if (isset($_GET['error'])) {
                                            echo "Seleccione el departamento";
                                        }
                                        ?>
                                    </div>

                                        <!-- Tenemos en cuenta el ROL del usuario a la hora de añadir el material. -->
                                    
                                    <?php
                                    require_once('../../archivosComunes/conexion.php');
                                    if ($_SESSION["usuario_login"]["rol"] != 0) {
                                        $departamento = $_SESSION["usuario_login"]["departamento"];
                                        $consulta = "SELECT * FROM Departamentos WHERE codigo = ?";
                                        $consulta = $db->prepare($consulta);
                                        $consulta->execute(array($departamento));
                                        $consulta_departamento = $consulta->fetch();
                                        $dpto_usuario = $consulta_departamento['nombre'];
                                        print "<script>
                                                    document.getElementById('selectDepartamento').disabled = true;
                                                </script>";
                                    }

                                    if($_SESSION['usuario_login']['rol'] == 1){
                                        ?>
                                        <!-- Utilizamos el input hidden con el fin de proporcionar un campo oculto para guardar un valor que 
                                        no pueda ser modificado directamente por el usuario; en este caso para enviar el departamento del profesor. -->
                                            <input type="hidden" name="nombreDepartamento" id="nombreDepartamento" value="<?php echo $dpto_usuario?>">
                                        <?php } ?>
                                        
                                 <!-- Utilizamos este script para que le aparezca al profesor seleccionado su 
                                 departamento y no pueda modificarlo. -->
                                 
                                    <script>
                                        let selector = document.getElementById('selectDepartamento');
                                        for (let i = 0; i < selector.length; i++) {
                                            if (selector[i].value == "<?php echo $dpto_usuario ?>") {
                                                selector[i].selected = true;
                                            }
                                        }
                                    </script>

                                    <div class="col-sm-12">
                                        <label for="fecha" class="form-label">Fecha de baja</label>
                                        <input type="date" class="form-control" id="fecha_bj" name="fecha_bj">
                                    </div>


                                    <label for="opciones" class="form-label" style="visibility: hidden">Hola </label><br>
                                    <div class="col-sm-12 d-flex btn-container">
                                        <div class="col-sm-6 text-center">
                                            <input id="btn-guardar" type="submit" class="btn gradient-custom shadow" style="color: white" name="btn-guardar" value="Guardar">
                                        </div>
                                        <div class="col-sm-6 text-center">
                                            <a href="../index.php" id="btn-salir" class="btn gradient-custom shadow" style="color: white" name="salir" value="Salir">Salir</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <footer class="gradient-custom p-3">
		<div class="container text-light">
			<div class="row">
				<div class="col-12 text-center">
					<p>IES JULIO VERNE <br>Curso(2022-2023)&#169;</p>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-md-6">
					<p>Creado por: <br> Brenda Serafín Camara <br> Daniel Andrés Bravo</p>
				</div>
				
				<div class="col-md-6">
					<p>Javier Díaz Marcos <br> Nera Domínguez Alcalde <br> Raúl Gómez Hernández</p>
				</div>
			</div>
		</div>
	</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>