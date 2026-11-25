<?php

class ControladorUsuarios {

    static public function ctrIngresoUsuario() {

        if (isset($_POST["ingUsuario"]) && isset($_POST["ingPassword"])) {

            $usuarioIngresado = trim($_POST["ingUsuario"]);
            $passwordIngresado = $_POST["ingPassword"];

            if ($usuarioIngresado === "" || $passwordIngresado === "") {
                echo '<div class="alert alert-danger mt-3">Completá usuario y contraseña.</div>';
                return;
            }

            $respuesta = ModeloUsuarios::mdlMostrarUsuario("usuarios", "usuario", $usuarioIngresado);

            if (!empty($respuesta) && $respuesta["usuario"] === $usuarioIngresado) {

                $passBD = $respuesta["password"];
                $valida = password_verify($passwordIngresado, $passBD) || ($passwordIngresado === $passBD);

                if ($valida) {
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["idUsuario"] = $respuesta["id"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["nombre"] = $respuesta["nombre"];

                    echo '<script>window.location = "index.php?ruta=admin";</script>';
                    return;
                }
            }

            echo '<div class="alert alert-danger mt-3">Usuario o contraseña incorrectos.</div>';
        }
    }
}