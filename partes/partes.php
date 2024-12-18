<!doctype html>
<html lang="en">

<head>
    <title>Partes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="../css/app.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">

</head>

<body>
    <header>
        <?php
        require_once "archivosComunes/navPartes.php";
        ?>
    </header>
    <main>
        <div class="row col-11 m-auto g-4 p-5">
            <div class="card col-lg-7 col-10 g-3 m-auto my-3 bg-dark text-light">
                <div class="row">
                    <div class="col-2 d-lg-block d-none">
                        <img src="./img/escribir.jpg" class="rounded-start" alt="foto" style="height: 150px; margin-left: -8px;">
                    </div>
                    <div class="col-lg-10 col-12">
                        <div class="card-body">
                            <h4 class="card-title text-decoration-underline">Poner Parte</h4>
                            <p class="card-text">Apartado para poner partes</p>
                            <a href="ponerParte.php"><button type="button" class="btn btn-light">Poner Partes</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class='card col-lg-7 col-10 g-3 m-auto my-3 bg-dark text-light'>
                <div class='row'>
                    <div class='col-2 d-lg-block d-none'>
                        <img src='./img/consultar.jpg' class=' rounded-start' alt='foto' style='height: 150px; margin-left: -8px;'>
                    </div>
                    <div class="col-lg-10 col-12">
                        <div class='card-body'>
                            <h4 class='card-title text-decoration-underline'>Ver Partes</h4>
                            <p class='card-text'>Apartado para visualizar los partes que han sido puestos</p>
                            <a href='verPartes.php'><button type='button' class='btn btn-light'>Ver Partes</button></a>
                        </div>
                    </div>
                </div>
            </div>


                    <div class='card col-lg-7 col-10 g-3 m-auto my-3 bg-dark text-light'>
                        <div class='row'>
                            <div class='col-2 d-lg-block d-none'>
                                <img src='./img/expulsionpendiente.jpg' class=' rounded-start' alt='foto' style='height: 150px; margin-left: -8px;'>
                            </div>
                                <div class='col-lg-10 col-12'>
                                <div class='card-body'>
                                    <h4 class='card-title text-decoration-underline'>Ver Expulsiones Pendientes</h4>
                                    <p class='card-text'>Apartado para visualizar las expulsiones pendientes de realizar</p>
                                    <a href='verExpulsionesPendientes.php'><button type='button' class='btn btn-light'>Ver Expulsiones Pendientes</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                      <div class='card col-lg-7 col-10 g-3 m-auto my-3 bg-dark text-light'>
                        <div class='row'>
                            <div class='col-2 d-lg-block d-none'>
                                <img src='./img/expulsion.jpg' class=' rounded-start' alt='foto' style='height: 150px; margin-left: -8px;'>
                            </div>
                                <div class='col-lg-10 col-12'>
                                <div class='card-body'>
                                    <h4 class='card-title text-decoration-underline'>Ver Expulsiones Confirmadas</h4>
                                    <p class='card-text'>Apartado para visualizar las expulsiones confirmadas</p>
                                    <a href='verExpulsionesConfirmadas.php'><button type='button' class='btn btn-light'>Ver Expulsiones Confirmadas</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if ($_SESSION['usuario_login']['rol'] == "0") {
                echo "
                    <div class='card col-lg-7 col-10 g-3 m-auto my-3 bg-dark text-light'>
                        <div class='row'>
                            <div class='col-2 d-lg-block d-none'>
                                <img src='./img/exportar.jpg' class=' rounded-start' alt='foto' style='height: 150px; margin-left: -8px;'>
                            </div>
                    <div class='col-lg-10 col-12'>
                                <div class='card-body'>
                                    <h4 class='card-title text-decoration-underline'>Exportar Alumnos</h4>
                                    <p class='card-text'>Apartado para exportar los alumnos matriculados a un archivo externo</p>
                                    <a href='exportarAlumnos.php'><button type='button' class='btn btn-light'>Exportar Alumnos</button></a>
                                </div>
                            </div>
                        </div>
                    </div>

            ";} ?>

    </main>
    <footer>
        <?php
        require_once "./archivosComunes/footerPartes.php";
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>