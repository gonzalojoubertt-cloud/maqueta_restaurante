<?php
class ControladorComidas {

    static public function ctrMostrarDatos($item, $valor) {

        $tabla = "platos";

        $respuesta = ModeloComidas::mdlMostrarDatos($tabla, $item, $valor);

        return $respuesta;
    }
    static public function ctrCrearPlato() {
        if (isset($_POST["nuevoNombre"])) {
            $datos = [
                "nombre" => trim($_POST["nuevoNombre"]),
                "descripcion" => trim($_POST["nuevaDescripcion"] ?? ""),
                "precio" => trim($_POST["nuevoPrecio"] ?? "0"),
                "imagen" => trim($_POST["nuevaImagen"] ?? ""),
                "peso" => trim($_POST["nuevoPeso"] ?? ""),
                "calorias" => trim($_POST["nuevasCalorias"] ?? ""),
                "grasas" => trim($_POST["nuevasGrasas"] ?? ""),
                "carbohidratos" => trim($_POST["nuevosCarbohidratos"] ?? ""),
                "proteinas" => trim($_POST["nuevasProteinas"] ?? "")
            ];

            if ($datos["nombre"] === "" || $datos["precio"] === "") {
                echo '<div class="alert alert-danger mt-3">Completá al menos nombre y precio.</div>';
                return;
            }

            $respuesta = ModeloComidas::mdlCrearPlato("platos", $datos);

            if ($respuesta === "ok") {
                echo '<script>window.location = "index.php?ruta=admin";</script>';
            } else {
                echo '<div class="alert alert-danger mt-3">Error al guardar el plato.</div>';
            }
        }
    }

    static public function ctrEditarPlato() {
        if (isset($_POST["editarId"])) {
            $datos = [
                "id" => (int) $_POST["editarId"],
                "nombre" => trim($_POST["editarNombre"]),
                "descripcion" => trim($_POST["editarDescripcion"] ?? ""),
                "precio" => trim($_POST["editarPrecio"] ?? "0"),
                "imagen" => trim($_POST["editarImagen"] ?? ""),
                "peso" => trim($_POST["editarPeso"] ?? ""),
                "calorias" => trim($_POST["editarCalorias"] ?? ""),
                "grasas" => trim($_POST["editarGrasas"] ?? ""),
                "carbohidratos" => trim($_POST["editarCarbohidratos"] ?? ""),
                "proteinas" => trim($_POST["editarProteinas"] ?? "")
            ];

            if ($datos["id"] <= 0 || $datos["nombre"] === "") {
                echo '<div class="alert alert-danger mt-3">Datos inválidos para editar.</div>';
                return;
            }

            $respuesta = ModeloComidas::mdlEditarPlato("platos", $datos);

            if ($respuesta === "ok") {
                echo '<script>window.location = "index.php?ruta=admin";</script>';
            } else {
                echo '<div class="alert alert-danger mt-3">Error al editar el plato.</div>';
            }
        }
    }

    static public function ctrEliminarPlato() {
        if (isset($_POST["eliminarId"])) {
            $id = (int) $_POST["eliminarId"];

            if ($id <= 0) {
                return;
            }

            $respuesta = ModeloComidas::mdlEliminarPlato("platos", $id);

            if ($respuesta === "ok") {
                echo '<script>window.location = "index.php?ruta=admin";</script>';
            } else {
                echo '<div class="alert alert-danger mt-3">Error al eliminar el plato.</div>';
            }
        }
    }
}