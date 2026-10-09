<?php
require_once "../config/conexion.php";
$conexion = new Conexion();
$consulta = "SELECT productos.*, categoria.Nombre_Categoria
FROM productos
INNER JOIN categoria ON productos.id_categoria = categoria.id_categoria";
$tabla = $conexion->getData($consulta);
//var_dump($tabla);
//exit();
if(isset($_POST["btnEliminarProducto"])){
    $id = $_POST["id_producto_eliminar"];
    $consultaEliminar = "DELETE FROM productos WHERE id_producto = '{$id}';";
    $respuesta = $conexion->setTransaction($consultaEliminar);
    if($respuesta){
        echo "<script> alert('Producto eliminado'); </script>";
        echo "<script> window.location.href='?view=verProductos'; </script>";
    }else{
        echo "<script> alert('Error: No se elimino el producto'); </script>";
    }
}
?>
<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h1 class="mb-0 fs-3"></h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lista producto</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-12">
                <!--begin::Card-->

            <div class="container mt-3">
                <p>The .table-hover class adds a hover effect (grey background color) on table rows:</p>
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre producto</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Categoria</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tabla as $data): ?>
                        <tr>
                            <td><?= $data['id_producto']?></td>
                            <td><?= $data['nombre']?></td>
                            <td><?= $data['precio']?></td>
                            <td><?= $data['cantidad']?></td>
                            <td><?= $data['id_categoria']?></td>
                            <td><?= $data['estado']?></td>
                            <td><?= $data['descripcion']?></td>
                            <td>
                                <button type = "button" class="btn btn-info" title="Ver productos">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <a href="?view=editarProductos&id=<?= $data['id_producto']; ?>">
                                <button type = "button" class="btn btn-primary" title="Editar">
                                    <i class="fa fa-edit"></i>
                                </button>
                                </a>
                                <button type = "button" class="btn btn-danger btn-eliminar-producto" title="Eliminar"
                                    data-bs-toggle="modal" data-bs-target="#modalEliminarProducto"
                                    data-id="<?= $data['id_producto']; ?>"
                                    data-nombre="<?= $data['nombre']; ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button type = "button" class="btn btn-dark" title="Generar PDF">
                                    <i class="fa fa-file-pdf-o"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!--end::Card-->
        </div>
        <!-- /.col -->
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->
<!--MODAL PARA ELIMINAR-->
<div class="modal fade" id="modalEliminarProducto" tabindex="-1" aria-labelledby="modalEliminarProductoLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarProductoLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <p>¿Deseas eliminar el producto <strong id="nombreProductoEliminar"></strong>?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form method="POST">
                    <input type="hidden" name="id_producto_eliminar" id="idProductoEliminar">
                    <button type="submit" name="btnEliminarProducto" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!--end::App Content-->

<script>
    function cargarDatos(id, nombre){
        document.getElementById("idProductoEliminar").value = id;
        document.getElementById("nombreProductoEliminar").textContent = nombre;
    }
    //FUNCION ESPECIAL DE CARGA DE DOCUMENTO
    document.addEventListener('DOMContentLoaded', function(){
        let botonesEliminar = document.querySelectorAll('.btn-eliminar-producto');
        botonesEliminar.forEach(function(boton){
            boton.addEventListener('click', function(){
                let id = this.dataset.id;
                let nombre = this.dataset.nombre;
                cargarDatos(id, nombre);

            })
        })
    });
</script>