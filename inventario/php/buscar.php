<?php
session_start();
// comprobamos si el usuario ha iniciado sesion
if(!isset($_SESSION["usuario_login"])){
	header("Location: ../../index.php?redirigido=true");
};
// incluimos el archivo de conexion a la bbdd
require_once('../../archivosComunes/conexion.php');
// comprobamos el rol del usuario
if($_SESSION['usuario_login']['rol'] == 0){
	// comprobamos si se ha enviado el formulario
	if (isset($_POST['boton_buscar'])) {
		$buscar = $_POST["buscar"];
		$codigo = array();
		// consulta para buscar articulos por nombre o descripcion
		$consultaBuscar = "SELECT * FROM Articulos WHERE nombre LIKE '%" . $buscar . "%' OR descripcion LIKE '%" . $buscar . "%' OR localizacion LIKE '%" . $buscar . "%' ";
	}
} else if ($_SESSION['usuario_login']['rol'] == 1) {
	// comprobamos si se ha enviado el formulario
	if (isset($_POST['boton_buscar'])) {
		$buscar = $_POST["buscar"];
		$codigo = array();
		// consulta para buscar articulos por nombre o descripcion y filtramos por departamento del usuario
		$consultaBuscar = "SELECT * FROM Articulos INNER JOIN Tiene ON Tiene.cod_articulo = Articulos.codigo
							WHERE (Articulos.nombre LIKE '%$buscar%' OR Articulos.descripcion LIKE '%$buscar%'
							OR Articulos.localizacion LIKE '%$buscar%')
							AND Tiene.cod_departamento = ".$_SESSION['usuario_login']['departamento'];
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Buscador Inventario</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<!-- <link rel="stylesheet" type="text/css" href="../inventario/css/index.css"> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<style>

		footer .row {
            padding: 0;
        }
        footer p {
            margin-bottom: 0;
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
		.container-fluid{
			padding: 0px!important;
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

		form fieldset {
			display: flex;
		}

		form fieldset ul{
			list-style: none;
			display: flex;
		}

		form fieldset select {
			height: 40px;
			margin-top: 10px;
		}

		form fieldset ul li {
			margin-right: 10px;
			margin-top: 20px;
		}

		form fieldset .btn {
			margin-left: 10px;
			margin-top: 10px;
		}

		.buscador input {
			width: 600px;
		}

        @media screen and (max-width: 768px) {
            .texto-footer {
                font-size: 14px;
            }

			.btn-container {
                display: flex;
                flex-direction: column;
                align-items: stretch;
            }

            .btn-container .btn {
                margin-bottom: 10px;
                width: 100%;
            }

			#tablaArticulos{
				padding-bottom: 100px;
			}
        }

    </style>
</head>

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

	<!-- cuerpo -->
	<div class="container-fluid main-content ">
		<!-- filtros -->
		<div class="main-form" style="padding-bottom: 300px;">
					<form method="post" action="cookieFiltro.php">
	
						<fieldset name="filtro" id="filtro">
						<div class="row w-75">
							<div class="col-md-6">		
								<!-- FILTRO Fungibles -->
								<ul>
									<li>
										<!-- creamos un elemento de lista y un radio button con el valor todos, si no esta la variable filtro en la url o si filtro es igual a todos, se agrega el atributo checked -->
										<input type="radio" name="filtro" value="todos" <?php if(!isset($_GET['filtro']) || (isset($_GET['filtro']) && $_GET['filtro'] == "todos")) echo 'checked'; ?>> Todos 
									</li>
									<li>
										<!-- creamos un elemento de lista y un radio button con el valor Fungibless, si la variable filtro esta en la url y es igual a Fungibless, se agrega el atributo checked -->
										<input type="radio" name="filtro" value="fungibles" <?php if(isset($_GET['filtro']) && $_GET['filtro'] == "fungibles") echo 'checked'; ?>> Fungibles 
									</li>
									<li>
										<!-- creamos un elemento de lista y un radio button con el valor Fungiblesspedir, si la variable filtro esta establecida en la url y es igual a Fungiblesspedir, se agrega el atributo checked -->
										<input type="radio" name="filtro" value="fungiblespedir" <?php if(isset($_GET['filtro']) && $_GET['filtro'] == "fungiblespedir") echo 'checked'; ?>> Pedir Fungibles 
									</li>
									<li>
										<!-- creamos un elemento de lista y un radio button con el valor noFungibless, si la variable filtro esta establecida en la url y es igual a noFungibless, se agrega el atributo checked -->
										<input type="radio" name="filtro" value="nofungibles" <?php if(isset($_GET['filtro']) && $_GET['filtro'] == "nofungibles") echo 'checked'; ?>> No Fungibles 
									</li>
								</ul>

								
								</div>
							<div class="col-md-6 d-flex align-items-center">		
								<!-- FILTRO DEPARTAMENTO -->
								<?php
									// session_start();
									// compruebamos si el usuario tiene un rol de valor 0
									if($_SESSION['usuario_login']['rol'] == 0){
								?>
									<select class="form-control" id="filtro_departamento" name="filtro_departamento" style="width: 300px; margin-left: 2rem;">
										<option value="0">Todos</option>
										<?php 
										 // incluimos el archivo de conexion a la bbdd
										require_once('../../archivosComunes/conexion.php');
										// consulta para obtener los departamentos
										$consulta = "SELECT * FROM Departamentos";
										// ejecutamos la consulta y obtenemos el resultado
										$resultado = $db->query($consulta);

										foreach ($resultado as $row) {
											// añadimos las opciones del select utilizando los datos obtenidos de la bbdd
											echo '<option value="'.$row['codigo'].'">'.$row['nombre'].'</option>';
										}
										?>
									</select>
									<?php
										if(isset($_GET['codigo'])){
									?>
										<!-- creamos un campo oculto con el valor del parametro codigo en la url -->
										<input type="hidden" name="filtro_dpto" id="filtro_dpto" value="<?php echo $_GET['codigo'] ?>">
									<?php } ?>
								<?php } ?>
								<!-- creamos un boton de envío de formulario -->
								<input class="btn gradient-custom shadow" style="color: white" name="aplicar_filtros" id="aplicar_filtros" type="submit" value="Filtrar">
							</div>
						</div>
						</fieldset>
					</form>
				
			
			<div class="row container">
				<div class="col-12" style="padding-left: 2rem;">
					<form class="buscador d-flex mt-3 w-25" method="POST" action="buscar.php">
						<input class="form-control me-2" type="search" id="buscar" name="buscar" placeholder="Buscar" aria-label="Buscar">
						<button class="btn btn-outline-light gradient-custom shadow" type="submit" id="boton_buscar" name="boton_buscar"><i class="bi bi-search"></i></button>
					</form>
				</div>
			</div>
			
			
			<!-- tabla -->
			<div  style="padding-left:10px; padding-right: 10px;"  id="tablaArticulos" >
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr class="texto-table">
								<th scope="col">Imagen</th>
								<th scope="col">codigo</th>
								<th scope="col">Fecha Alta</th>
								<th scope="col">Número de Serie</th>
								<th scope="col">Nombre</th>
								<th scope="col">Descripción</th>
								<th scope="col">Unidades</th>
								<th scope="col">Localización</th>
								<th scope="col">Procedencia</th>
								<th scope="col">Motivo baja</th>
								<th scope="col">Fecha baja</th>
								<th scope="col">
									<?php
										if($_SESSION['usuario_login']['rol'] == 0){
									?>
									<a href='exportarPDF.php?codDepartamento=<?php if(isset($_GET['codigo'])){echo $_GET['codigo']; } else { echo "todos"; } ?>' target="_blank">
										<!-- <i class="bi bi-box-arrow-in-down"></i> -->
										<i class="bi bi-filetype-pdf"></i>
									</a>
									<?php 
										} else if($_SESSION['usuario_login']['rol'] == 1){
									?>
									<a href='exportarPDF.php' target="_blank">
										<!-- <i class="bi bi-box-arrow-in-down"></i> -->
										<i class="bi bi-filetype-pdf"></i>
									</a>
									<?php 
										} 
									?>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								require_once('../../archivosComunes/conexion.php');
								try {
									if(isset($_POST['buscar']) && $_POST['buscar'] != null){
										// preparamos y ejecutamos la consulta
										$preparada = $db->prepare($consultaBuscar);
										$preparada->execute();
										// obtenemos los resultados
										$resultados = $preparada->fetchAll(PDO::FETCH_ASSOC);
										$preparada->closeCursor();
										// comprobam,os si hay resultados
										$hayResultados = !empty($resultados); 
	
										foreach ($resultados as $row) {
											echo "<tr>
												<th scope=\"row\">";
	
												// condicional para que cuando no tenga imagen no se pase de binario a foto
												if ($row['ruta_imagen'] != NULL) {
													echo "<img src=data:image/jpg;base64," . base64_encode($row["ruta_imagen"]) . " style=\"width: 50px;\"/>";
												}
	
												echo "</th>
												<td>" . $row["codigo"] . "</td>
												<td>" . $row["fecha_alta"] . "</td>
												<td>" . $row["num_serie"] . "</td>
												<td>" . $row["nombre"] . "</td>
												<td>" . $row["descripcion"] . "</td>
												<td>" . $row["unidades"] . "</td>
												<td>" . $row["localizacion"] . "</td>
												<td>" . $row["procedencia_entrada"] . "</td>
												<td>" . $row["motivo_baja"] . "</td>
												<td>" . $row["fecha_baja"] . "</td>
												<td>
													<a href=\"editarMaterial.php?cod=" . $row["codigo"] . "\" class=\"text-decoration-none p-1\"><i class=\"bi bi-pencil-square\"></i></a>
												</td>
												<td>
													<a href=\"confirmarDelete.php?cod=" . $row["codigo"] . "\" class=\"text-decoration-none p-1\"><i class=\"bi bi-trash3\"></i></a>
												</td>";
	
												// mostramos el icono de pedir o no pedir para artículos Fungibles
												$consulta = "SELECT Articulos.codigo FROM Articulos INNER JOIN Fungibles WHERE Articulos.codigo = Fungibles.codigo;";
												$consulta = $db->query($consulta);
												foreach ($consulta as $row01) {
													if ($row01['codigo'] == $row['codigo']) {
														// CONSULTA PARA SABER SI EN LA BASE DE DATOS ESTA PEDIR A SI O PEDIR A NO
														$consulta = "SELECT * FROM Fungibles WHERE codigo = ?;";
														$consulta = $db->prepare($consulta);
														$consulta->execute(array($row01['codigo']));
														foreach ($consulta as $key) {
															$pedir = $key['pedir'];
														}
														// mostramos el icono correspondiente si se debe pedir o no
														if ($pedir == 'no') {
															echo '<td>
															<a href="pedirArticulo.php?cod=' . $row01['codigo'] . '" class="text-decoration-none p-1" style="margin-left: 0px; color: blue;" id="nopedido" name="nopedido"><i class="bi bi-cart-dash"></i></a>
															<a href="pedirArticulo.php?cod=' . $row01['codigo'] . '" class="text-decoration-none p-1" style="margin-left: 0px; color: blue; display: none;" id="pedido" name="pedido"><i class="bi bi-cart-check"></i></a>
														</td>';
															// SI EN LA BASE DE DATOS SE ENCUENTRA EN SI SE PONDRA EL ICONO DE PEDIDO
														} else if ($pedir == 'si') {
															echo '<td>
															<a href="pedirArticulo.php?cod=' . $row01['codigo'] . '" class="text-decoration-none p-1" style="margin-left: 0px; color: blue; display: none;" id="nopedido" name="nopedido"><i class="bi bi-cart-dash"></i></a>
															<a href="pedirArticulo.php?cod=' . $row01['codigo'] . '" class="text-decoration-none p-1" style="margin-left: 0px; color: blue; " id="pedido" name="pedido"><i class="bi bi-cart-check"></i></a>
														</td>';
														}
													}
												}
	
												// SI SE ENCUENTRA INICIALIZADO A TRAVES DEL METODO GET 'PEDIR' Y A LA VEZ ES IGUAL A NO
												// EL ICONO DE NO PEDIDO DESAPARECE Y EL DE PEDIDO APARECE
												if (isset($_GET['pedir']) && $_GET['pedir'] == 'no') {
													echo '
														<script type="text/javascript"> 
															document.getElementById("nopedido").style.display = "none";
															document.getElementById("pedido").style.display = "block";
														</script>
													';
													// SI SE ENCUENTRA INICIALIZADO A TRAVES DEL METODO GET 'PEDIR' Y A LA VEZ ES IGUAL A SI
													// EL ICONO DE NO PEDIDO APARECE Y EL DE PEDIDO DESAPARECE
												} else if (isset($_GET['pedir']) && $_GET['pedir'] == 'si') {
													echo '
														<script type="text/javascript"> 
															document.getElementById("nopedido").style.display = "block";
															document.getElementById("pedido").style.display = "none";
														</script>
													';
												}
	
											echo '</tr>';
										}
									} else {
										$hayResultados = false;
									}
									
									// mostramos mensaje de no se encontraron resultados si no hay resultados
									if (!$hayResultados) {
										echo '
											<tr>
												<td colspan="13">
													<div class="alert alert-primary d-flex align-items-center justify-content-center" role="alert">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
															<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
														</svg>
														<div>
															No se encontró ningún resultado
														</div>
													</div>
												</td>
											</tr>
										';
									}

									// return TRUE;
								} catch (PDOException $e) {
									echo "Error en la base de datos " . $e->getMessage();
									return FALSE;
								}
							?>
						</tbody>
					</table>	
				</div>
				
			</div>
		</div>
	</div>

	<footer class="gradient-custom p-3" style="margin-top: 100px;">
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
	<script src="../js/exportarPDF.js"></script>
	
</body>

</html>