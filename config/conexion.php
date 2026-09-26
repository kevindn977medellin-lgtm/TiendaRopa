<?php
class Conexion{
    //parametros
    public $host;//ubicacion de mysql
    public $user;//usuario de mysql
    public $pass;//contraseña de mysql
    public $db_name;//base de datos de mysql
    public $con;//conexion

    public function __construct(){
        //echo "Soy la funcion que se ejecuta al ser llamada la clase";
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->db_name = "proyecto_poli_db";
        $this->con = new Mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db_name
        );
        $this->con ->set_charset("utf8");
        if ($this->con->connect_error){
            echo "Error: No hay conexion con la base de datos";
        }else{
            echo "Conexion exitosa";
        }
       
    }


}

?>