<?php
//ruta de la conexion
require __DIR__ ."/config/conexion.php";
$conexion = new Conexion();
require_once __DIR__."/views/login.php";
?>