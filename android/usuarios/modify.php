<?php
include '../conexion.php';

$email = $_GET['email'];
$password = $_GET['clave'];
$nombre = $_GET['nombre'];
$apellidos = $_GET['apellidos'];
$dni = $_GET['dni'];
$rol = $_GET['rol'];
if ($rol == 1 || $rol == 0) {

    $cod_delphos = $_GET['cod_delphos'];
    $departamento = $_GET['departamento'];
    $tutor_grupo = $_GET['tutor_grupo'];
}
$email2 = $_GET['email2'];
$dni2 = $_GET['dni2'];

if ($email === $email2) {
    $email3 = null;
} else {
    $email3 = $email2;
}
if ($dni === $dni2) {
    $dni3 = null;
} else {
    $dni3 = $dni2;
}

//Compruebo que no haya un correo o dni ya registrado
$sql = "SELECT * FROM Usuarios WHERE email = ? OR dni = ?";
$consulta = $db->prepare($sql);
$consulta->execute([$email3, $dni3]);


if ($consulta->rowCount() == 0) {
    $sql = "SELECT * FROM Usuarios where email=?;";
    //Preparo la consulta
    $consulta = $db->prepare($sql);
    //Pasar a traves de un array los valores escritos en el formulario
    //Los valores se recogen por parametros en la función
    $consulta->execute(array($email));
    //si la consulta devuelve algo, es que todo va bien
    if ($consulta->rowCount() > 0) {
        // Como solo va a devolver una linea la consulta ya que el email es unique usamos fetch
        $us = $consulta->fetch();
        if (!password_verify($password, $us[5])) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($rol === "1" || $rol === "0") {

            $sql = "UPDATE Usuarios 
            SET dni=?, nombre=?, apellidos=?, email=?, departamento=?, cod_delphos=?, tutor_grupo=?, clave=?
            WHERE email=?";
            $consulta = $db->prepare($sql);
            $consulta->execute(array($dni2, $nombre, $apellidos, $email2, $departamento, $cod_delphos, $tutor_grupo, $password, $email));

        } else {

            $sql = "UPDATE Usuarios 
            SET dni=?, nombre=?, apellidos=?, email=?, clave=?
            WHERE email=?";
            $consulta = $db->prepare($sql);
            $consulta->execute(array($dni2, $nombre, $apellidos, $email2, $password, $email));
        }

    }
    $respuesta = 1;
} else {
    $respuesta = 0;
}

header('Content-Type: application/json');

echo $respuesta;


?>