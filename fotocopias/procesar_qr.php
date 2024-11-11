<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el contenido del QR desde la petición POST
    $qrContent = $_POST['qr_content'] ?? '';

    // Procesar el contenido (aquí podrías, por ejemplo, guardarlo en una base de datos)
    // Ejemplo: echo para mostrar el resultado en la consola o como respuesta
    echo "Contenido recibido: " . htmlspecialchars($qrContent);
} else {
    echo "No se recibió contenido.";
}
?>
