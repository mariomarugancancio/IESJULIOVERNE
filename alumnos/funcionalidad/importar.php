<?php 
// Importa la biblioteca
require '../../vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

require_once("../../archivosComunes/conexion.php");

if (isset($_FILES['archivo']) && !empty($_FILES['archivo']['name'][0])) {
    // Obtener el número de archivos seleccionados
    $numArchivos = count($_FILES['archivo']['name']);
    $db->beginTransaction();
    $eliminar =$db->prepare("DELETE FROM Expulsiones");
    $eliminar->execute();
    $eliminar =$db->prepare("DELETE FROM Partes");
    $eliminar->execute();
    $eliminar =$db->prepare("DELETE FROM Alumnos");
    $eliminar->execute();
    // Recorrer cada archivo
    for ($i = 0; $i < $numArchivos; $i++) {
        $rutaArchivo = $_FILES['archivo']['tmp_name'][$i];
        

        $contenidoarchivo = file_get_contents($rutaArchivo);


       $codificacion = mb_detect_encoding($contenidoarchivo, 'UTF-8, ISO-8859-1, ISO-8859-15', true);

        $contenidoarchivo = explode("\n",$contenidoarchivo);
        $contenidoarchivo = array_filter($contenidoarchivo);

        foreach($contenidoarchivo as $file){
            if($codificacion == "ISO-8859-1"){
                $file=utf8_encode($file);
            }
            if (str_contains($file, ',')){
                $lista[] = explode(",",$file);
            }else{
                $lista[] = explode(";",$file);
            }

        }
        try {
            foreach ($lista as $datos) {
            
                $matricula = $datos[0];
                $nombre = $datos[1];
                $apellidos = $datos[2];
                $grupo = trim($datos[3]);

                if($matricula != ""){
            // Datos para generar el QR
            $data = $matricula." ".$nombre." ".$apellidos; // El contenido del QR
            /*Sin logo
            // Crea una instancia de QrCode
            $qrCode = new QrCode($data);
           

            // Usa PngWriter para escribir el código QR en PNG
            $writer = new PngWriter();
            $result = $writer->write($qrCode);

// Obtén la imagen PNG como una cadena de bytes y luego conviértela a base64
$qrImage = base64_encode($result->getString());                                            
                        $qrImageEncoded = base64_encode($qrImage);
                        */
                         // Datos para generar el QR
        $data = $matricula." ".$nombre." ".$apellidos; // El contenido del QR
        $logoPath = '../images/logoJulioVerneNuevo.png';

        // Crear el código QR
        $qrCode = new QrCode($data);
        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode);

        // Crear una imagen desde el QR generado
        $qrImageResource = imagecreatefromstring($qrCodeImage->getString());

        // Cargar y redimensionar el logo
        $logo = imagecreatefrompng($logoPath);
        $logoWidth = imagesx($logo);
        $logoHeight = imagesy($logo);

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

        // Superponer el logo en el centro del QR
        imagecopy($qrImageResource, $logo, $centerX, $centerY, 0, 0, $logoWidth, $logoHeight);

        // Capturar la imagen final en una cadena de bytes
        ob_start();
        imagepng($qrImageResource);
        $imageData = ob_get_contents();
        ob_end_clean();

        // Convertir la imagen a base64 para almacenar en la base de datos
        $qrImageBase64 = base64_encode($imageData);

        // Libera los recursos de imagen
        imagedestroy($qrImageResource);
        imagedestroy($logo);


                        // Intentamos ejecutar la inserción en la base de datos
                        $conexion = $db->prepare("INSERT INTO Alumnos (matricula, nombre, apellidos, grupo, qr_datos, qr_imagen)
                            VALUES (:matricula, :nombre, :apellidos, :grupo, :qr_datos, :qr_imagen)");
                        $conexion->execute(array(":matricula" => $matricula, ":nombre" => $nombre, ":apellidos" => $apellidos, ":grupo" => $grupo, 
                   ":qr_datos" => $data,":qr_imagen" =>  $qrImageBase64));

                }
            }
            $db->commit();
            header("location: ../gestionarAlumnos.php?Añadido=1");

        } catch (PDOException $e) {
            // Si ocurre un error, mostramos un mensaje de error o realizamos alguna otra acción necesaria
            $db->rollBack();
            header("location: ../gestionarAlumnos.php?Añadido=0");
        }
    }
} else{
    header('Location: ../gestionarAlumnos.php');
} 


?>