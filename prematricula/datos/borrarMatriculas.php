
<?php
// Iniciamos la sesion
session_start();
require_once("../../archivosComunes/conexion.php");
// Para acceder a esta pagina hay que iniciar sesion previamente.
require_once('../../archivosComunes/loginRequerido.php');
if (isset($_GET['cod_matricula']) && isset($_GET['curso'])) {
  $id = $_GET['cod_matricula'];
  $curso = $_GET['curso'];
  $stmt = $db->prepare("DELETE FROM Comunes WHERE matricula = ?");
  $stmt->execute([$id]);
  $stmt = $db->prepare("DELETE FROM Opciones WHERE matricula = ?");
  $stmt->execute([$id]);
  $stmt = $db->prepare("DELETE FROM Modalidad WHERE matricula = ?");
  $stmt->execute([$id]);
  $stmt = $db->prepare("DELETE FROM Obligatorias WHERE matricula = ?");
  $stmt->execute([$id]);
  $stmt = $db->prepare("DELETE FROM Optativas WHERE matricula = ?");
  $stmt->execute([$id]);
  $stmt = $db->prepare("DELETE FROM Matriculas WHERE cod_matricula = ?");
  $stmt->execute([$id]);
  $stmt = $db->prepare("DELETE FROM AlumnosMatriculados WHERE cod_alumnosMatriculados = ?");
  $stmt->execute([$id]);
  header('Location: alumnos.php?curso='+ $curso+'');
  
  exit();
    }
?>
