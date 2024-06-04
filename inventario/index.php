<?php
// Iniciamos la sesion
session_start();
if(!isset($_SESSION["usuario_login"])){
	header("Location: ../../index.php?redirigido=true");
};

if($_SESSION["usuario_login"]['rol'] == 2) {
	header ("Location: ../archivosComunes/selector.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Index</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
	<!-- <link rel="stylesheet" type="text/css" href="../descargas/index.css"> -->
	<style>
		.gradient-custom {
			/* fallback for old browsers */
			background: #6a11cb;

			/* Chrome 10-25, Safari 5.1-6 */
			background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

			/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
			background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
		}
		html {
			min-height: 100%;
			position: relative;
			box-sizing: border-box;
		}

		.centro {
        display: flex;
        justify-content: center;
        align-items: center;
        /* height: 75vh; */
		
		
		
      }
		footer {
			position: absolute;
			bottom: 0;
			width: 100%;
			font-size: 20px;

		}
		footer .row {
			padding: 0;
		}
		footer p {
			margin-bottom: 0;
		}

		.shadow-blue {
			box-shadow: 0 .5rem 1rem rgba(0, 123, 255, .2) !important;
		}

		.row {
			padding: 40px;
		}
		@media screen and (max-width: 768px) {
			.contenedor{
				padding-bottom: 100px;
			}
			.texto-footer {
                font-size: 14px;
            }
			.card.shadow-blue {
				padding: 30px;
				transition: transform 0.2s ease-in-out;
			}

			.card.shadow-blue:hover {
				transform: scale(1.1);
			}
	
		}

		.card.shadow-blue {
			padding: 30px;
				transition: transform 0.2s ease-in-out;
			}

		.card.shadow-blue:hover {
			transform: scale(1.1);
		}
		
	</style>
</head>

<body>
	<header class="gradient-custom ">
		<nav class="navbar navbar-expand navbar-light p-3 me-5 ms-5">
			<a class="navbar-brand text-light" href="index.php">Inventario</a>
			
			<ul class="navbar-nav flex-row flex-wrap text-light ms-auto">
                <li class="nav-item">
      <a class="text-light btn btn-outline-secondary me-2" href="../archivosComunes/actualizarUsuario.php?idusuario=<?php echo $_SESSION['usuario_login']['cod_usuario']?>">
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

						<a class="dropdown-item" href="../archivosComunes/selector.php">Página Principal</a>
						<a class="dropdown-item" href="../archivosComunes/logout.php">Cerrar
							sesión</a>
					</ul>
				</li>
			</ul>
		</nav>
	</header>

	<div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 76vh; padding-bottom: 200px;">
		<!-- <div class="row centro "> -->
			<div class="col-12 contenedor " >
				<div class="row elegir d-flex justify-content-center align-items-center p-2">		
					<div class="col-md-4 col-12 p-4">
						<div class="card shadow bg-white rounded shadow-blue " id="excel"
							style="align-items: center; text-align: center">
							<a href="php/cargarExcel.php" style="width: 300px; height: 300px;">
								<img src="../inventario/img/EXCEL.png" style="width: 250px; height:250px;">
							<span>CARGAR HOJA DE CÁLCULO</span>
							</a>
						</div>
					</div>
					<div class="col-md-4 col-12 p-4">
						<div class="card shadow bg-white rounded shadow-blue " id="anadir"
							style="align-items: center; text-align: center">
							<a href="php/formulario.php" style="width: 300px; height: 300px;">
								<img src="../inventario/img/img1.jpg" style="width: 250px; height:
											250px;">
								<span>AÑADIR MATERIAL</span>
							</a>
						</div>
					</div>
					<div class="col-md-4 col-12 p-4">
						<div class="card shadow bg-white rounded shadow-blue" id="editar"
							style="align-items: center; text-align: center">
							<a href="php/lista.php" style="width: 300px; height: 300px;">
								<img src="../inventario/img/img2.jpg" style="width: 250px; height:
											250px;">
								<span>LISTAR MATERIAL</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		<!-- </div> -->
	</div>

	<footer class="gradient-custom p-3">
		<div class="container text-light">
			<div class="row p-0">
				<div class="col-12 text-center">
					<p>IES JULIO VERNE <br> Curso(2022-2023)&#169;</p>
				</div>
			</div>
			<div class="row text-center p-0">
				<div class="col-md-6">
					<p>Creado por: <br> Brenda Serafín Camara <br> Daniel Andrés Bravo</p>
				</div>
				
				<div class="col-md-6">
					<p>Javier Díaz Marcos <br> Nerea Domínguez Alcalde <br> Raúl Gómez Hernández</p>
				</div>
			</div>
		</div>
	</footer>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
		crossorigin="anonymous"></script>
</body>

</html>