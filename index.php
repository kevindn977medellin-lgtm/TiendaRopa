<?php
 //echo "Bienvenido";
 //ruta de la conexion
require __DIR__."/config/conexion.php";
require __DIR__."/config/sesion.php";
$conexion = new Conexion();
$sesion = new Sesion();
// loica de ingreso de usuario

//SESION
if(isset($_SESSION["inicio_sesion"]) && $_SESSION["inicio_sesion"]==true) {
    header("Location: /crud_php/views/home.php");
    exit();
}
//INGRESO
if(isset($_POST["btnIngresar"])){
    $nombre_usuario = $_POST["nombre_usuario"];
    $clave_usuario = sha1(md5($_POST["clave_usuario"]));
    $consulta = "SELECT * FROM usuario WHERE nombre_usuario ='{$nombre_usuario}' AND clave_usuario='{$clave_usuario}';";
    $respuesta = $conexion->getData($consulta);
    $datosUsuario = mysqli_fetch_assoc($respuesta);
    $cantidadUsuario = mysqli_num_rows($respuesta);
    if($cantidadUsuario>0){
        $_SESSION["inicio_sesion"] = true;
        $_SESSION["user_name"] = $datosUsuario["nombre_completo"];
        $_SESSION["rol"] = $datosUsuario["rol"];
        $_SESSION["status"] = $datosUsuario["estado"];
        if($_SESSION["status"] == 1){
            header("location: /crud_php/views/home.php");
            exit();
        }else{
            echo "<script> alert('El usuario se encuentra inactivo'); </script>";
        }
    }else{
         echo "<script> alert('Usuario o/y contraseña incorrectos'); </script>";
    }
    $_SESSION["inicio_sesion"] = false;
        require_once __DIR__."/views/login.php";
        exit();
    }
require_once __DIR__."/views/login.php";
?>