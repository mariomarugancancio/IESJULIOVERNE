<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lector QR con Webcam</title>
    <!-- Cargar el script de html5-qrcode versión 2.0.9 desde CDN -->
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/0a601e401a.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../images/logoJulioVerneNuevo.png">

   <style>
      

        .container {
            text-align: center;
        }

        /* Estilo para el lector QR */
        #reader {
            margin-top: 20px;
            width: 300px;
            height: 300px;
            margin: 0 auto;
        }

        /* Estilo para los resultados */
        #result {
            margin-top: 0px;
            font-size: 1.2em;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            width: 300px;
            margin-left: auto;
            margin-right: auto;
        }
              /* Media Query para pantallas más pequeñas */
              @media (max-width: 768px) {
            #result {
                margin-top: 100px; /* Márgen superior adicional */
                
            }
            table {
            font-size: 0.9em; /* Reduce el tamaño de la fuente */
        }

        .table-responsive {
            margin-bottom: 1rem; /* Espaciado inferior para móviles */
        }
        }
    </style>
</head>

<body>
    <?php
            require_once "archivosComunes/nav.php";
            require_once("../archivosComunes/conexion.php");
            require_once('../archivosComunes/loginRequerido.php');
            if(isset($_GET['correcto'])){
                if($_GET['correcto'] == "true"){
                    // Mostrar el error en la pantalla
                    echo '<div class="alert alert-success" role="alert">';
                    echo ' Fotocopias pagadas con exito';
                    echo '</div>';
                }else{
                    // Mostrar el error en la pantalla
                    echo '<div class="alert alert-danger" role="alert">';
                    echo ' No tiene saldo suficiente';
                    echo '</div>';
                }
            }
    ?>
    <div class="container">
        <h1>Escanear Código QR con Webcam</h1>

        <!-- Div para mostrar el video de la cámara -->
        <div id="reader"></div>

        <!-- Resultado del QR -->
        <div id="result"></div>
        <div id="resultTabla"></div>

    </div>
    <script>
    const usuarioRol = "<?php echo $_SESSION['usuario_login']['rol']; ?>";
</script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function buscarAlumno(matricula) {
    fetch(`buscarAlumno.php?matricula=${matricula}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('result').innerHTML = `<p style="color: red;">${data.error}</p>`;
            } else {
                document.getElementById('resultTabla').innerHTML = `
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center mt-2" id="lista">
            <thead>
                <tr>
                    <th scope="col">Matrícula</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Número de Fotocopias</th>
                    ${usuarioRol == "0" ? '<th scope="col">Transacciones</th>' : ''}
                </tr>
            </thead>
            <tbody>
                <tr class="fila-tabla">
                    <td>${data.matricula}</td>
                    <td>${data.nombre}</td>
                    <td>${data.apellidos}</td>
                    <td>${data.grupo}</td>
                    <td>${data.saldo}</td>
                    <td>
                        <form method="POST" action="actualizarFotocopias.php">
                            <input type="hidden" id="matricula" name="matricula" value="${data.matricula}">
                            <input type="hidden" id="nombre" name="nombre" value="${data.nombre}">
                            <input type="hidden" id="apellidos" name="apellidos" value="${data.apellidos}">
                            <input type="hidden" id="grupo" name="grupo" value="${data.grupo}">
                            <input type="number" name="fotocopias" id="fotocopias" placeholder="Num de fotocopias" min="1" required>
                            <input type="hidden" id="pagina" name="pagina" value="qr">

                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </td>
                    ${usuarioRol == "0" ? `
                        <td>
                            <a href="#" onclick="transacciones('${data.matricula}');">
                                <i id="editar${data.matricula}" class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        </td>` : ''}
                </tr>
            </tbody>
        </table>
    </div>`;


            }
        })
        .catch(error => console.error('Error:', error));
}


            // Función llamada al escanear correctamente un QR
            function onScanSuccess(qrMessage) {
                // Mostrar el contenido del QR
                document.getElementById('result').innerHTML = `<strong>Matrícula escaneada:</strong> ${qrMessage}`;

                // Buscar información del alumno en la base de datos
                const qrMessagepartes = qrMessage.split(' ');

                const alumno = buscarAlumno(qrMessagepartes[0]);
                if (alumno) {
                    document.getElementById('result').innerHTML += `
                        <p><strong>Nombre:</strong> ${alumno.nombre}</p>
                        <p><strong>Carrera:</strong> ${alumno.carrera}</p>
                        <p><strong>Semestre:</strong> ${alumno.semestre}</p>`;
                } else {
                    document.getElementById('result').innerHTML += `<p style="color: red;">Alumno no encontrado.</p>`;
                }
            }

            // Función llamada en caso de error durante el escaneo
            function onScanError(error) {
                console.warn(`Error de escaneo: ${error}`);
            }

            // Configuración automática del lector de QR
            const html5QrcodeScanner = new Html5Qrcode("reader");
            html5QrcodeScanner.start({ facingMode: "environment" }, { fps: 10, qrbox: { width: 250, height: 250 } },
                onScanSuccess, onScanError);
        });
        function transacciones(matricula) {
        var url = "transacciones.php?matricula=" + encodeURIComponent(matricula);
        window.location.href = url;
    }

    </script>
</body>

</html>
