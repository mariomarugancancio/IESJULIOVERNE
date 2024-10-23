<?php
// Incluir el archivo de conexión a la base de datos
require_once "../../archivosComunes/conexion.php";

try {
    // Iniciar una transacción
    $db->beginTransaction();
    echo'<script type="text/javascript">
    alert();
    window.location.href="index.php";
    </script>';
    // Verificar si se recibió el parámetro cod_expulsion por POST
    if(isset($_GET['cod_expulsion'])) {
        // Obtener el valor del parámetro cod_expulsion
        $cod_expulsion = $_GET['cod_expulsion'];
        echo'<script type="text/javascript">
    alert('.$cod_expulsion.');
    window.location.href="index.php";
    </script>';
        // Actualizar el estado de los partes asociados a esta expulsión
        $actualizarEstadoPartes = $db->prepare("UPDATE Partes SET caducado = 0 WHERE cod_parte IN (SELECT cod_parte FROM PartesExpulsiones WHERE cod_expulsion = :cod_expulsion)");
        $actualizarEstadoPartes->bindParam(":cod_expulsion", $cod_expulsion, PDO::PARAM_INT);
        $actualizarEstadoPartes->execute();
        
        // Eliminar las filas de PartesExpulsiones asociadas a esta expulsión
        $eliminarPartesExpulsiones = $db->prepare("DELETE FROM PartesExpulsiones WHERE cod_expulsion = :cod_expulsion");
        $eliminarPartesExpulsiones->bindParam(":cod_expulsion", $cod_expulsion, PDO::PARAM_INT);
        $eliminarPartesExpulsiones->execute();

        // Eliminar la expulsión
        $eliminarExpulsion = $db->prepare("DELETE FROM Expulsiones WHERE cod_expulsion = :cod_expulsion");
        $eliminarExpulsion->bindParam(":cod_expulsion", $cod_expulsion, PDO::PARAM_INT);
        $eliminarExpulsion->execute();

        // Confirmar la transacción
        $db->commit();

        // Redireccionar al usuario a alguna página, por ejemplo, a la página de inicio
        header("Location: ../verExpulsionesConfirmadas.php?eliminado=1");
        exit();
    } else {
        // Redireccionar al usuario a alguna página de error si el parámetro no se proporcionó correctamente
        header("Location: ../verExpulsionesConfirmadas.php?eliminado=0");
        exit();
    }
} catch (Exception $e) {
    // En caso de error, realizar un rollback para revertir los cambios
    $db->rollback();
    // Redirigir a una página de error o mostrar un mensaje de error al usuario
    echo "Algo no ha salido bien: " . $e->getMessage();
}
?>
