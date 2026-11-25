<?php

require_once "conexion.php";

class ModeloComidas {

    static public function mdlMostrarDatos($tabla, $item, $valor) {

        $tablasPermitidas = ["platos"];
        if (!in_array($tabla, $tablasPermitidas, true)) {
            return [];
        }

        if ($item !== null) {
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
        } else {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt->execute();

                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado ?: [];
            } catch (Exception $e) {
                return [];
            }
        }
    }
    static public function mdlCrearPlato($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare(
                "INSERT INTO $tabla (nombre, descripcion, precio, imagen, peso, calorias, grasas, carbohidratos, proteinas)
                 VALUES (:nombre, :descripcion, :precio, :imagen, :peso, :calorias, :grasas, :carbohidratos, :proteinas)"
            );

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
            $stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
            $stmt->bindParam(":calorias", $datos["calorias"], PDO::PARAM_STR);
            $stmt->bindParam(":grasas", $datos["grasas"], PDO::PARAM_STR);
            $stmt->bindParam(":carbohidratos", $datos["carbohidratos"], PDO::PARAM_STR);
            $stmt->bindParam(":proteinas", $datos["proteinas"], PDO::PARAM_STR);

            return $stmt->execute() ? "ok" : "error";
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlEditarPlato($tabla, $datos) {
        try {
            $stmt = Conexion::conectar()->prepare(
                "UPDATE $tabla
                 SET nombre = :nombre,
                     descripcion = :descripcion,
                     precio = :precio,
                     imagen = :imagen,
                     peso = :peso,
                     calorias = :calorias,
                     grasas = :grasas,
                     carbohidratos = :carbohidratos,
                     proteinas = :proteinas
                 WHERE id = :id"
            );

            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
            $stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
            $stmt->bindParam(":calorias", $datos["calorias"], PDO::PARAM_STR);
            $stmt->bindParam(":grasas", $datos["grasas"], PDO::PARAM_STR);
            $stmt->bindParam(":carbohidratos", $datos["carbohidratos"], PDO::PARAM_STR);
            $stmt->bindParam(":proteinas", $datos["proteinas"], PDO::PARAM_STR);

            return $stmt->execute() ? "ok" : "error";
        } catch (Exception $e) {
            return "error";
        }
    }

    static public function mdlEliminarPlato($tabla, $id) {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            return $stmt->execute() ? "ok" : "error";
        } catch (Exception $e) {
            return "error";
        }
    }
}