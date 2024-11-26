<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>

    <style>
        .disabled {
            pointer-events: none;
            opacity: 0.7;
            border-color: rgba(118, 118, 118, 0.3);
            color: -internal-light-dark(gray, rgb(170, 170, 170));
            background: #dddddd;
        }
    </style>
</head>

<body>

    <?php
    include ('./archivosComunes/nav.php');
    require_once ("../archivosComunes/conexion.php");
    require_once ('../archivosComunes/loginRequerido.php');
   
    // Para acceder a esta pagina hay que iniciar sesion previamente.
    if (isset($_GET['matricula'])) {
        $select = "SELECT matricula, nombre, apellidos, grupo, saldo, qr_imagen, qr_datos
    FROM Alumnos
    WHERE matricula = '" . $_GET['matricula'] . "';";
        $resul = $db->query($select);
        $columna = $resul->fetch(PDO::FETCH_ASSOC);
    }
    ?>

    <div id="formulario" class="mx-auto mt-3 mb-5" style="width:400px; height:800px;">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php if ($_SESSION["usuario_login"]["rol"] == 0) {
              
                if (isset($columna['matricula'])) {

                    echo "<input type='text' class='form-control' name='matriculaAntigua' id='matriculaAntigua' value='" . $columna['matricula'] . "' hidden>";

                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='matricula' id='matricula' value='" . $columna['matricula'] . "' readonly>";

                    echo "<label for='matricula'>Matricula:</label>";
                    echo "</div>";
                } else {
                    echo "<input type='text' class='form-control' name='matriculaAntigua' id='matriculaAntigua'  hidden>";

                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='matricula' id='matricula'  readonly>";

                    echo "<label for='matricula'>Matricula:</label>";
                    echo "</div>";
                }
                if (isset($columna['nombre'])) {
                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='nombre' id='nombre' value='" . $columna['nombre'] . "' readonly >";

                    echo "<label for='nombre'>nombre:</label>";
                    echo "</div>";
                } else {
                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='nombre' id='nombre' readonly>";

                    echo "<label for='nombre'>nombre:</label>";
                    echo "</div>";
                }
                if (isset($columna['apellidos'])) {

                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='apellidos' id='apellidos'   value='" . $columna['apellidos'] . "' readonly>";

                    echo "<label for='apellidos'>Apellidos:</label>";
                    echo "</div>";
                } else {
                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='apellidos' id='apellidos'  readonly>";

                    echo "<label for='apellidos'>Apellidos:</label>";
                    echo "</div>";
                }
                if (isset($columna['grupo'])) {
                    echo "<div class='form-group form-floating mb-3'>";

                    echo "<select class='form-control' name='grupo' id='grupo' readonly>";
                    $select = "SELECT grupo FROM Cursos";
                    $resul = $db->query($select);

                    while ($columna1 = $resul->fetch(PDO::FETCH_ASSOC)) {
                        // si tienen el mismo nombre que lo marque como selected y asi aparece como valor principal 
            

                        if ($columna1['grupo'] == $columna['grupo']) {

                            echo "<option value='" . $columna1['grupo'] . "' selected>" . $columna1['grupo'] . "</option>";

                        } else {
                            echo "<option value='" . $columna1['grupo'] . "'>" . $columna1['grupo'] . "</option>";
                        }
                    }
                    ?>
                    </select>
                    <label for="grupo">Grupo:</label>
                    <?php echo "</div>";
                } else {
                }
                if (isset($columna['saldo'])) {

                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='saldo' id='saldo'   value='" . $columna['saldo'] . "' readonly>";

                    echo "<label for='saldo'>Saldo:</label>";
                    echo "</div>";
                } else {
                    echo "<div class='form-group form-floating mb-3'>";
                    echo "<input type='text' class='form-control' name='saldo' id='saldo' readonly>";

                    echo "<label for='saldo'>Saldo:</label>";
                    echo "</div>";
                }
                // Imprime la imagen en HTML
                if (isset($columna['qr_imagen'])) {

                    echo "<div class='form-group form-floating mb-3 text-center'>";
                    echo "<img src='data:image/png;base64," . $columna['qr_imagen'] . "' alt='Código QR' class='img-fluid'>"; // Clase para imagen responsiva
                    echo "</div>";
                }
            } ?>

        </form>
    </div>

    <?php
    
    include ('./archivosComunes/footer.php');
    ?>