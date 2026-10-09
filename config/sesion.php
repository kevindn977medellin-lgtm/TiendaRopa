<?php
class Sesion{
    public function __construct(){
        session_start();//iniciar sesion
    }
    public function cerrarSesion(){
        session_destroy();//cerrar sesion
    }
}
?>