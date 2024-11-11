<?php 
// Importa la biblioteca
require '../vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
require_once("../archivosComunes/conexion.php");

$select = "SELECT matricula, nombre, apellidos
FROM Alumnos
ORDER BY matricula, apellidos, nombre ;";
$resul = $db->query($select);

// Utilizamos un bucle while para recorrer todas las filas que devuelve la consulta
while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
    $nombre = $columna['nombre'];
    $apellidos = $columna['apellidos'];
    $matricula = $columna['matricula'];
    if($matricula != "") {
        // Datos para generar el QR
        $data = $matricula." ".$nombre." ".$apellidos; // El contenido del QR
        $logoPath = '../images/logoJulioVerneNuevoQR.png'; // Ruta al archivo del logo

        // Crear el código QR con las configuraciones tradicionales
        $qrCode = new QrCode($data);
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);

        // Crear una imagen desde el QR generado
        $qrImageResource = imagecreatefromstring($qrCodeImage->getString());

        // Cargar y redimensionar el logo
        $logo = imagecreatefrompng($logoPath);
        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);

        // Redimensionar el logo si es necesario
        $centralAreaSize = 40;
        if ($logoWidth > $centralAreaSize || $logoHeight > $centralAreaSize) {
            $ratio = min($centralAreaSize / $logoWidth, $centralAreaSize / $logoHeight);
            $newLogoWidth = (int)($logoWidth * $ratio);
            $newLogoHeight = (int)($logoHeight * $ratio);

            $logoResized = imagecreatetruecolor($newLogoWidth, $newLogoHeight);
            imagealphablending($logoResized, false);
            imagesavealpha($logoResized, true);
            $transparent = imagecolorallocatealpha($logoResized, 255, 255, 255, 127);
            imagefill($logoResized, 0, 0, $transparent);
            imagecopyresampled($logoResized, $logo, 0, 0, 0, 0, $newLogoWidth, $newLogoHeight, $logoWidth, $logoHeight);
            $logo = $logoResized;
        }

        // Calcular la posición del logo en el centro del QR
        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);
        $centerX = (imagesx($qrImageResource) - $logoWidth) / 2;
        $centerY = (imagesy($qrImageResource) - $logoHeight) / 2;

        // Borrar el área central para hacerla completamente blanca
        $background = imagecolorallocate($qrImageResource, 255, 255, 255); // Fondo blanco
        imagefilledrectangle(
            $qrImageResource,
            $centerX - 10, $centerY - 10,
            $centerX + $logoWidth + 10, $centerY + $logoHeight + 10,
            $background
        );

        // Superponer el logo en el centro del QR
        imagecopy($qrImageResource, $logo, $centerX, $centerY, 0, 0, $logoWidth, $logoHeight);

        // --- AGREGAR MARCO AZUL CLARO Y EL ÁREA ENTRE EL MARCO Y EL QR ---
        $frameWidth = 50; // Ancho del marco (puedes ajustarlo según lo necesites)
        $frameColor = imagecolorallocate($qrImageResource, 173, 216, 230); // Azul claro

        // Crear una nueva imagen más grande para incluir el marco
        $finalWidth = imagesx($qrImageResource) + 2 * $frameWidth;
        $finalHeight = imagesy($qrImageResource) + 2 * $frameWidth;
        $finalImage = imagecreatetruecolor($finalWidth, $finalHeight);

        // Crear fondo azul claro para la nueva imagen
        $backgroundColor = imagecolorallocate($finalImage, 173, 216, 230); // Azul claro
        imagefill($finalImage, 0, 0, $backgroundColor);

        // Colocar el código QR con el logo en el centro de la nueva imagen con el marco
        imagecopy($finalImage, $qrImageResource, $frameWidth, $frameWidth, 0, 0, imagesx($qrImageResource), imagesy($qrImageResource));

        // Dibuja el marco azul claro alrededor del QR
        imagerectangle($finalImage, 0, 0, $finalWidth - 1, $finalHeight - 1, $frameColor);

        // Capturar la imagen final en una cadena de bytes
        ob_start();
        imagepng($finalImage);
        $imageData = ob_get_contents();
        ob_end_clean();

        // Convertir la imagen a base64 para almacenar en la base de datos
        $qrImageBase64 = base64_encode($imageData);

        // Libera los recursos de imagen
        imagedestroy($finalImage);
        imagedestroy($qrImageResource);
        imagedestroy($logo);

        // Intentamos ejecutar la inserción en la base de datos
        $conexion = $db->prepare("UPDATE Alumnos SET qr_datos=?, qr_imagen=? WHERE matricula = ?");
        $conexion->execute([$data, $qrImageBase64, $matricula]);
    }
}
?>
