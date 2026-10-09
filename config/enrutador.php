<?php
class Enrutador{
    // FUNCIÓN QUE REALIZA LA CARGA DE LAS VISTAS
    public function cargarVista($view)
    {
        $basePath = __DIR__ . "/../";
        switch ($view) {
            case 'home':
                require_once $basePath . "views/{$view}.php";
                break;
            case 'dasboard':
                require_once $basePath . "views/{$view}.php";
                break;
            case 'crearProducto':
                require_once $basePath . "views/productos/{$view}.php";
                break;
            case 'verProductos':
                require_once $basePath . "views/productos/{$view}.php";
                break;
            case 'editarProductos':
                require_once $basePath . "views/productos/{$view}.php";
                break;
            default:
                require_once $basePath . "views/error.php";
                break;
        }
    }
}