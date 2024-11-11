<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lector QR con Webcam</title>
    <!-- Cargar el script de html5-qrcode versión 2.0.9 desde CDN -->
    <script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>
</head>
<body>
    <h1>Escanear Código QR con Webcam</h1>
    
    <!-- Div para mostrar el video de la cámara -->
    <div id="reader" style="width: 300px; height: 300px;"></div>
    
    <!-- Resultado del QR -->
    <div id="result"></div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function onScanSuccess(qrMessage) {
                document.getElementById('result').innerHTML = `<strong>Contenido del QR:</strong> ${qrMessage}`;
            }

            function onScanError(error) {
                console.warn(`Error de escaneo: ${error}`);
            }

            // Configuración del lector de QR
            let html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: { width: 250, height: 250 } });
            html5QrcodeScanner.render(onScanSuccess, onScanError);
        });
    </script>
</body>
</html>
