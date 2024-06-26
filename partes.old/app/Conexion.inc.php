<?php

class Conexion {

    private static $conexion;

    public static function abrirConexion() {
        if (!isset(self::$conexion)) {
            try {
                include_once "config.inc.php";
                self::$conexion = new PDO("mysql:host=" . SERVIDOR . ";dbname=" . BASE_DATOS, USUARIO, PASSWORD);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexion->exec("SET CHARACTER SET utf8");
            } catch (PDOException $ex) {
                print "Error: " . $ex->getMessage() . "<br>";
                die();
            }
        }
    }

    public static function cerrarConexion() {
        if (isset(self::$conexion)) {
            self::$conexion = null;
        }
    }

    public static function getConexion() {
        return self::$conexion;
    }

}
