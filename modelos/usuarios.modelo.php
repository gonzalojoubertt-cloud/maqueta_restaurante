<?php

require_once "conexion.php";

class ModeloUsuarios {

    static public function mdlMostrarUsuario($tabla, $item, $valor) {

        $tablasPermitidas = ["usuarios"];
        if (!in_array($tabla, $tablasPermitidas, true)) {
            return [];
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $item)) {
            return [];
        }

        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->execute();

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado ?: [];
        } catch (Exception $e) {
            return [];
        }
    }
}