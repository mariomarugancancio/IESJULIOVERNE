<?php
        $alumno='';
        $curso='';
        $fecha='';
        $fechaInicio='';
        $fechaFin='';

    
    
                    // Verificar si se proporcionó el parámetro cod_expulsion en la URL
                    if (isset($_GET['cod_expulsion'])) {
                        // Obtener el valor del parámetro cod_expulsion
                        $cod_expulsion = $_GET['cod_expulsion'];
                        require_once "../../archivosComunes/conexion.php";

                        // Preparar la consulta para obtener los detalles de la expulsión
                        $consultaExpulsion = $db->prepare(
                            "SELECT
                CONCAT(a.nombre, ' ', a.apellidos) AS nombreAlumno,
                DATE_FORMAT(e.fecha_Insercion, '%d-%m-%Y') AS fecha_Insercion, -- Formatear la fecha
                DATE_FORMAT(e.fecha_Inicio, '%d-%m-%Y') AS fecha_Inicio, -- Formatear la fecha
                DATE_FORMAT(e.fecha_Fin, '%d-%m-%Y') AS fecha_Fin, -- Formatear la fecha
                a.grupo
                FROM Expulsiones e
                JOIN Alumnos a ON e.matricula_del_Alumno = a.matricula 
                WHERE cod_expulsion = :cod_expulsion"
                        );
                        $consultaExpulsion->bindParam(":cod_expulsion", $cod_expulsion, PDO::PARAM_INT);
                        $consultaExpulsion->execute();
        
                        // Obtener los detalles de la expulsión
                        $expulsion = $consultaExpulsion->fetch(PDO::FETCH_ASSOC);
        
                        // Verificar si se encontró la expulsión
                        if ($expulsion) {

                            // Mostrar los detalles de la expulsión en una card de Bootstrap
                            $alumno = $expulsion['nombreAlumno'];
                            $curso = $expulsion['grupo'];
                            $fecha = $expulsion['fecha_Insercion'];
                            $fechaInicio = $expulsion['fecha_Inicio'];
                            $fechaFin = $expulsion['fecha_Fin'];
                        }
                    }        

                    
        // include class
        require('../../fpdf/fpdf.php');
        
        // extend class
        class KodePDF extends FPDF {
            protected $fontName = 'Arial';
            function Header() {
                // Se puede usar para agregar encabezado si es necesario
            }
        
            // Pie de página
            function Footer() {
                // Posición a 1.5 cm del final
                //$this->SetY(-15);
                // Arial italic 8
                //$this->SetFont('Arial', 'I', 8);
                // Número de página
                //$this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo()), 0, 0, 'C');
            }

            function renderTitle($text) {
             // Definir la imagen y el texto
                $leftMargin = 20; // 2 cm en milímetros
                $rightMargin = 20; // 2 cm en milímetros
                 // Establecer posición inicial
                $this->SetLeftMargin($leftMargin);
                $this->SetRightMargin($rightMargin);
                $startX = $this->GetX();
                $startY = $this->GetY();
                $this->SetTextColor(0, 0, 0);
                $this->SetFont($this->fontName, 'B', 11);
                $this->MultiCell(0, 5, utf8_decode($text), 0, 'J');
                $this->Ln();
            }
        
            function renderSubTitle($text) {
                     // Definir la imagen y el texto
                     $leftMargin = 20; // 2 cm en milímetros
                     $rightMargin = 20; // 2 cm en milímetros
                      // Establecer posición inicial
                     $this->SetLeftMargin($leftMargin);
                     $this->SetRightMargin($rightMargin);
                     $startX = $this->GetX();
                     $startY = $this->GetY();
                $this->SetTextColor(0, 0, 0);
                $this->SetFont($this->fontName, 'B', 11);
                $this->MultiCell(0, 3, utf8_decode($text), 0, 'J');
                $this->Ln();
            }
        
            function renderText($text) {
                     // Definir la imagen y el texto
                     $leftMargin = 20; // 2 cm en milímetros
                     $rightMargin = 20; // 2 cm en milímetros
                      // Establecer posición inicial
                     $this->SetLeftMargin($leftMargin);
                     $this->SetRightMargin($rightMargin);
                     $startX = $this->GetX();
                     $startY = $this->GetY();
                $this->SetTextColor(0, 0, 0);
                $this->SetFont($this->fontName, '', 11);
                $this->MultiCell(0, 5, utf8_decode($text), 0, 'J');
                $this->Ln();
            }
        }
        
        // create document
        $pdf = new KodePDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12); // Configurar la fuente antes de agregar cualquier texto
        //Logo y datos del centro
        $image_path = '../../images/logoJulioVerneNuevo.png';
        $image_path_firma = '../../images/firmaAlicia.jpg';
        $image_path_sello = '../../images/selloIES.png';

        $text = "I.E.S. Julio Verne de Bargas\nConsejería de Educación, Ciencia y Cultura\nC/ Instituto s/n 45593 Bargas (Toledo)\nTel: 925358268\njefatura@iesbargas.com";
        
        // Añadir la imagen (primera columna)
        $pdf->Image($image_path, 10, 10, 40); // (ruta, x, y, ancho)

        // Mover la posición de la celda para la segunda columna
        $pdf->SetXY(110, 17); // Ajustar x e y según sea necesario
        $pdf->renderText($text);
    
        // config document
        $pdf->SetTitle('Generar archivos PDF con PHP');
        $pdf->SetAuthor('Kodetop');
        $pdf->SetCreator('FPDF Maker');
        
        // add content
        $pdf->SetXY(10, 50); // Ajustar x e y según sea necesario
        $pdf->renderTitle('NOTIFICACIÓN DE MEDIDA ADOPTADA PARA CORREGIR LA CONDUCTA DEL ALUMNADO');
        $pdf->renderText('(Conducta gravemente perjudicial para la convivencia)');
        $pdf->renderSubTitle('Alumno: '. $alumno);
        $pdf->renderSubTitle('Curso: '. $curso);
        $pdf->renderText('Fecha de notificación: '.$fecha);
        $pdf->renderText('Dª. Alicia de Álvaro Martín, directora del centro IES "Julio Verne" le comunica que, en el ejercicio de la competencia atribuida en el Decreto 3/2008, de la Convivencia Escolar de Castilla-La Mancha (DOCM 11-01-2008) y del Decreto 13/2013 de autoridad del profesorado en Castilla-La Mancha (DOCM 26-03-2013)');
        $pdf->renderText('Se procederá a corregir las siguientes conductas de su hijo, tipificado como gravemente perjudiciales para la convivencia.');
        try {
           
// Preparar la consulta para obtener los detalles de la expulsión
$consulta = $db->prepare(
    "SELECT DISTINCT i.nombre
FROM Expulsiones e
JOIN PartesExpulsiones pe ON e.cod_expulsion = pe.cod_expulsion
JOIN Partes p ON p.cod_parte = pe.cod_parte 
JOIN Incidencias i ON i.cod_incidencia = p.incidencia 
WHERE e.cod_expulsion = :cod_expulsion"
);
$consulta->bindParam(":cod_expulsion", $cod_expulsion, PDO::PARAM_INT);
$consulta->execute();



            // Iterar sobre los resultados y mostrar cada parte en una fila de la tabla
$i = 1;
while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
    $pdf->renderSubTitle($i.'. '.$row['nombre']);
    $i++;

}

            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Cerrar la conexión a la base de datos
        $db = null;

        $pdf->renderTitle('Realización de tareas educativas en su domicilio, con suspensión temporal de la asistencia al propio centro docente desde el día '.$fechaInicio.' al día '.$fechaFin.' (ambos incluidos). Durante el periodo citado la alumna no podrá utilizar el servicio de transporte escolar y únicamente podrá asistir a los exámenes oficialmente convocados.');
        $pdf->renderText('Para la realización del preceptivo trámite de audiencia a las partes interesadas, deben ustedes solicitar cita a través de EducamosCLM en un plazo de 2 días dirigiéndose a los miembros del Equipo Directivo. Contra esta medida cabe presentar un recurso motivado ante el Consejo Escolar del centro en el plazo de 2 días.');
        $y = $pdf->GetY()+10;
        $pdf->SetXY(30, $y); // Ajustar x e y según sea necesario

        $pdf->renderText('LA DIRECTORA');
        $pdf->Image($image_path_firma, 30, 225, 40); // (ruta, x, y, ancho)
        $pdf->SetXY(20, $y+45); // Ajustar x e y según sea necesario
        $pdf->renderText('Fdo.: Alicia de Álvaro Martín');
        $pdf->Image($image_path_sello, 70, $y, 40); // (ruta, x, y, ancho)
        $pdf->SetXY(120, $y-10); // Ajustar x e y según sea necesario
        $pdf->renderText('En Bargas, a '.$fechaInicio.'');
        $pdf->SetXY(131, $y); // Ajustar x e y según sea necesario
        $pdf->renderText('EL ALUMNO');
        $pdf->SetXY(120, $y+45); // Ajustar x e y según sea necesario
        $pdf->renderText('Fdo.: '.$alumno);

        
        // output file
        $pdf->Output('', utf8_decode('Expulsión '.$alumno.' '.$fecha.'.pdf'));
    

?>
