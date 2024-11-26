<?php
// Importa la biblioteca
require '../vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
require_once("../archivosComunes/conexion.php");

$select = "SELECT matricula, nombre, apellidos FROM Alumnos ORDER BY matricula, apellidos, nombre;";
$resul = $db->query($select);

while ($columna = $resul->fetch(PDO::FETCH_ASSOC)) {
    $nombre = $columna['nombre'];
    $apellidos = $columna['apellidos'];
    $matricula = $columna['matricula'];

    if ($matricula != "") {
        // Datos para generar el QR
        $data = $matricula . " " . $nombre . " " . $apellidos;
          //Sin logo
            // Crea una instancia de QrCode
            $qrCode = new QrCode($data);
           

            // Usa PngWriter para escribir el código QR en PNG
            $writer = new PngWriter();
            $result = $writer->write($qrCode);

// Obtén la imagen PNG como una cadena de bytes y luego conviértela a base64
$qrImage = base64_encode($result->getString());                                            
                        $qrImageEncoded = base64_encode($qrImage);
        /*Con logo
        $logoPath = '../images/logoJulioVerneNuevo.png';

        // Crear el código QR
        $qrCode = new QrCode($data);
        // Usamos el método `setWriterByName` para el tipo de archivo
        $writer = new PngWriter();
        
        // Escribir el QR en formato PNG
        $qrCodeImage = $writer->write($qrCode);

        // Crear una imagen desde el QR generado
        $qrImageResource = imagecreatefromstring($qrCodeImage->getString());

        // Verificar si el logo existe y ajustarlo
        if (file_exists($logoPath)) {
            $logo = imagecreatefrompng($logoPath);

            // Calcular las dimensiones óptimas del logo
            $qrWidth = imagesx($qrImageResource);
            $qrHeight = imagesy($qrImageResource);
            $maxLogoSize = (int)($qrWidth * 0.2); // El logo ocupa un máximo del 20% del QR

            $logoWidth = imagesx($logo);
            $logoHeight = imagesy($logo);

            if ($logoWidth > $maxLogoSize || $logoHeight > $maxLogoSize) {
                $ratio = min($maxLogoSize / $logoWidth, $maxLogoSize / $logoHeight);
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
            $centerX = ($qrWidth - $logoWidth) / 2;
            $centerY = ($qrHeight - $logoHeight) / 2;

            // Limpiar el área central completamente (no hay QR debajo del logo)
            $background = imagecolorallocate($qrImageResource, 255, 255, 255); // Color blanco
            imagefilledrectangle(
                $qrImageResource,
                $centerX,
                $centerY,
                $centerX + $logoWidth,
                $centerY + $logoHeight,
                $background
            );

            // Superponer el logo en el centro del QR
            imagecopy($qrImageResource, $logo, $centerX, $centerY, 0, 0, $logoWidth, $logoHeight);
            imagedestroy($logo); // Liberar recursos del logo
        }

        // Capturar la imagen final en una cadena de bytes
        ob_start();
        imagepng($qrImageResource);
        $imageData = ob_get_contents();
        ob_end_clean();

        // Convertir la imagen a base64 para almacenar en la base de datos
        $qrImageBase64 = base64_encode($imageData);

        // Guardar el QR en el servidor para depuración (opcional)
        file_put_contents("qrs/{$matricula}.png", $imageData);

        // Liberar recursos de la imagen del QR
        imagedestroy($qrImageResource);
*/
        // Insertar en la base de datos
        $conexion = $db->prepare("UPDATE Alumnos SET qr_datos=?, qr_imagen=? WHERE matricula = ?");
        $conexion->execute([$data, $qrImage, $matricula]);
    }
}
?>
