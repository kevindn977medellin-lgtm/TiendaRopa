<?php

class Conexion
{
    public $host;
    public $user;
    public $pass;
    public $db_name;
    public $con;

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->db_name = "tiendaropa_db";

        $this->con = new mysqli(
            $this->host,
            $this->user,
            $this->pass,
            $this->db_name
        );

        if ($this->con->connect_error) {
            die("Error de conexión: " . $this->con->connect_error);
        }

        // Recomendado usar 'utf8mb4' para compatibilidad total con emojis y caracteres especiales
        $this->con->set_charset("utf8mb4");
    }

    public function getData($consulta)
    {
        $datos = $this->con->query($consulta);

        if (!$datos) {
            die("Error en SELECT: " . $this->con->error);
        }

        return $datos;
    }

    public function setTransaction($consulta)
    {
        $resultado = $this->con->query($consulta);

        if (!$resultado) {
            die("Error en la consulta: " . $this->con->error);
        }

        return true;
    }

    public function cerrarConexion()
    {
        $this->con->close();
    }
}