<?php
include 'conexion.php';
$db = conexion();

// Obtener la fecha de inicio y fin de la semana 
$startDate = date('Y-m-d', strtotime('monday this week'));
$endDate = date('Y-m-d', strtotime('sunday this week'));

// Preparar la consulta SQL
$sql = "SELECT * FROM Guardias WHERE fecha >= ? AND fecha <= ?";

// Preparar la declaración
$stmt = $db->prepare($sql);

// Ejecutar la consulta 
$stmt->execute([$startDate, $endDate]);

// Obtener todas las guardias de la semana actual
$guardias = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver las guardias como JSON
echo json_encode($guardias);
?>
