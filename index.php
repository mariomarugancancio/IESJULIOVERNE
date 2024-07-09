<?php

session_start();
if (isset($_SESSION["usuario_login"])) {
    header("Location: archivosComunes/selector.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usu = comprobar_usuario($_POST["typeEmailX"], $_POST["typePasswordX"]);
    if ($usu == FALSE) {
       
        $usuario = $_POST["typeEmailX"];
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Correo electrónico o contraseña incorrectos';
        echo '</div>';
    } else if ($usu['validar'] == 'no') {
         // Mostrar el error en la pantalla
         echo '<div class="alert alert-danger" role="alert">';
         echo 'Usuario pendiente de validación por parte de administración';
         echo '</div>';
    } else {
        session_start();
        $_SESSION["usuario_login"] = $usu;
        header("Location: archivosComunes/selector.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ICONO DE LA PESTAÑA DEL NAVEGADOR -->
    <link rel="shortcut icon" href="images/logoJulioVerneNuevo.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>Login</title>
    <link rel="shortcut icon" href="images/logoJulioVerneNuevo.png">
    <style>
        .gradient-custom {
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }
        .error {
            color: red;
        }
    </style>
</head>
<body class="gradient-custom">
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Iniciar Sesión</h2>
                                <p class="text-white-50 mb-5">Por favor, inserte su usuario y contraseña</p>
                                <form method="POST" class="form-group">
                                    <div class="form-floating form-white mb-4 text-dark">
                                        <input type="email" name="typeEmailX" class="form-control" placeholder="EMAIL" required/>
                                        <label class="form-label" for="typeEmailX">Email</label>
                                    </div>
                                    <div class="form-floating form-white mb-4 text-dark">
                                        <input type="password" name="typePasswordX" class="form-control" placeholder="CONTRASEÑA" required/>
                                        <label class="form-label" for="typePasswordX">Contraseña</label>
                                    </div>
                                    <button name="enviar" id="enviar" class="btn btn-outline-light btn-lg px-5" type="submit">Iniciar Sesión</button>
                                                                       <?php
                                    if (isset($_GET["redirigido"])) {
                                        echo "<p style='padding-top: 10px;'>Haga login para continuar</p>";
                                    }
                                    ?>
                                </form>
                            </div>
                            <div>
                                <p class="mb-0">¿No tiene cuenta? <a href="archivosComunes/registrar.php" class="text-white-50 fw-bold">Registrar</a></p>
                                <p class="mb-0">¿Has olvidado tu contraseña? <a href="archivosComunes/recuperar.php" class="text-white-50 fw-bold">Recuperar</a></p>
                                <p class="mb-0">¿Quieres realizar la prematrícula? <a href="./prematricula/prematricula.php" class="text-white-50 fw-bold">Prematrícula</a></p>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    
    <?php
    function comprobar_usuario($email, $clave) {
        try {
            $db = require('archivosComunes/conexion.php');
            $sql = "SELECT * FROM Usuarios WHERE email = ?";
            $consulta = $db->prepare($sql);
            $consulta->execute([$email]);

            if ($consulta->rowCount() > 0) {
                $us = $consulta->fetch();
                if (password_verify($clave, $us['clave'])) {
                    return $us;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">';
            echo 'Error en la base de datos: ' . $e->getMessage();
            echo '</div>';
        }
    }


   
    ?>
</body>
</html>
