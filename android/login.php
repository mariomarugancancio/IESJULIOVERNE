<?php
include 'conexion.php';

$email = $_GET['email'];
$password = $_GET['password'];
$sql = "SELECT u.cod_usuario, u.dni, u.nombre, u.apellidos, u.email, u.clave, u.rol, u.cod_delphos, u.validar, d.codigo, d.nombre AS nombre_departamento, u.tutor_grupo 
FROM Usuarios u
LEFT JOIN Departamentos d ON u.departamento = d.codigo
WHERE u.email = ?;";
//Preparo la consulta
$consulta = $db->prepare($sql);
//Pasar a traves de un array los valores escritos en el formulario
//Los valores se recogen por parametros en la función
$consulta->execute(array($email));
$datos = array();

//si la consulta devuelve algo, es que todo va bien
if ($consulta->rowCount() > 0){

        $row = $consulta->fetch();
        $cod_usuario = $row['cod_usuario'];
        $dni = $row['dni'];
        $nombre = $row['nombre'];
        $apellidos = $row['apellidos'];
        $email = $row['email'];
        $clave = $row['clave'];
        $rol = $row['rol'];
        $cod_delphos = $row['cod_delphos'];
        $validar = $row['validar'];
        $departamento_codigo = $row['codigo'];
        $departamento_nombre = $row['nombre_departamento'];
        $tutor_grupo = $row['tutor_grupo'];
       if (password_verify($password, $clave)) {

        $datos[] = array(
            'cod_usuario' => $cod_usuario,
            'dni' => $dni,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'email' => $email,
            'clave' => $clave,
            'rol' => $rol,
            'cod_delphos' => $cod_delphos,
            'validar' => $validar,
            'departamento_codigo' => $departamento_codigo,
            'departamento_nombre' => $departamento_nombre,
            'tutor_grupo' => $tutor_grupo
        );
    }
    }


$recordFiltered = count ($datos);
$recordsTotal = $recordFiltered;

header ('Content-Type: application/json');

echo json_encode($datos);

?>