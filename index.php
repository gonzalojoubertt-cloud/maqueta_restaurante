<?php

session_start();

require_once "modelos/conexion.php";
require_once "modelos/comidas.modelo.php";
require_once "modelos/usuarios.modelo.php";

require_once "controladores/comidas.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/plantilla.controlador.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrTraerPlantilla();
