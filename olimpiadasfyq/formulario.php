<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>
    <script src="../js/multiselect-dropdown.js"></script>
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">

    <style>
                body {
            font-family: 'Arial', sans-serif;
            padding: 0;
            background-color: #f8f8f8;
            text-align:justify;

        }

        header {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        section {
            margin: 20px;
        }
        .negrita{
            font-weight: bold;
        }
        h1{
            color: white;
        }

         h2 {
            color: #333;
        }
        footer {
            padding: 10px;
            background-color: #333;
            color: #fff;
            bottom: 0;
            width: 100%;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            align-items: center;
        }
                    /* Estilos para el icono de Instagram */
        .instagram-icon {
            width: 30px; /* Tamaño del icono */
            height: 30px;
            /* Otros estilos, como color, margen, etc. */
        }
        </style>
</head>

<body>
    <?php
    include('navegacion.php');
    ?>
     <header>
        <h1>Formulario de inscripción</h1>
    </header>

    
    <section>
    <p>La inscripción la debe llevar a cabo el docente de Física y Química responsable en cada centro y rellenar una inscripción por cada alumno participante.<span class="negrita"> La fecha límite es el 1 de abril de 2025.</span></p>
    <p>La inscripción se rellena online a través del siguiente enlace<a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSeEBxpTmYCKEG-F2q66Gcb4u9flYFqIMJ8BRjcWczMCQOlT2A/viewform"> Formulario de inscripción 2025</a>.</p>
    <p>En caso de que tenga problemas, escriba al correo <a target="_blank" href="mailto:miniolimpiadasfqtoledo@gmail.com">miniolimpiadasfqtoledo@gmail.com</a></p>
     </section>



     <footer>
        <p>© 2024 MiniOlimpiadas de Física y Química - APFyQ-CLM. Todos los derechos reservados.</p>
        <a href="https://www.instagram.com/miniolimpiadasclm/" target="_blank" rel="noopener noreferrer">
            <img src="img/instagram.png" alt="Instagram" class="instagram-icon">
        </a>
    </footer>
</body>
<html>
