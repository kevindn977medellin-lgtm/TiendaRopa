<?php
require_once "../config/conexion.php";
$conexion = new Conexion();
$consultaCategorias = "SELECT * FROM categoria ORDER BY Nombre_Categoria ASC;";
$listaCategoria = $conexion->getData($consultaCategorias);
if(isset($_POST["btnGuardar"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];
    $id_categoria = $_POST["id_categoria"];
    $estado = "activo";
   // var_dump($nombre, $descripcion, $precio, $cantidad, $id_categoria, $estado);
    //exit();
    $query = "INSERT INTO productos
    VALUES(null, '{$nombre}','{$precio}','{$cantidad}','{$id_categoria}','{$estado}','{$descripcion}');";
    $respuesta = $conexion->setTransaction($query);
    if($respuesta){
        echo "<script> alert('Registro exitoso')</script>";
        echo "<script> window.location.href='?view=verProductos';</script>";
    }else{
        echo "<script> alert('Erorr: No se registro el producto');</script>";
        echo "<script> window.location.href='?view=crearProducto';</script>";
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
                <h1 class="mb-0 fs-3">Crear Producto</h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">crear producto</li>
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
                <div class="col-lg-6">
                    <div class="card card-info card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Crear producto</div>
                        </div>
                        <form class="needs-validation" novalidate method="POST">
                            <div class="card-body">
                                <div class="row g-3">
                                    
                                    <!-- Campo: Nombre producto -->
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Nombre producto</label>
                                        <input
                                         type="text" 
                                         class="form-control" 
                                         id="validationCustom01" 
                                         name="nombre" 
                                         required 
                                         />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Descripcion</label>
                                        <input
                                         type="text" 
                                         class="form-control" 
                                         id="validationCustom01" 
                                         name="descripcion" 
                                         required />
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>

                                    <!-- Campo: Precio -->
                                    <div class="col-md-6">
                                        <label for="validationCustomUsername" class="form-label">Precio</label>
                                        <div class="input-group has-validation">
                                            <input type="number" class="form-control" id="validationCustomUsername" name="precio" required />
                                            <div class="invalid-feedback">Ingrese el precio</div>
                                        </div>
                                    </div>

                                    <!-- Campo: Cantidad -->
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="validationCustom03" name="cantidad" required />
                                        <div class="invalid-feedback">Ingrese la cantidad</div>
                                    </div>

                                    <!-- Campo: Categoría -->
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Categorías</label>
                                        <select class="form-select" id="validationCustom04" name="id_categoria" required>
                                            <option selected disabled value="">Elegir...</option>
                                            <?php foreach($listaCategoria as $item): ?>
                                                <option value="<?= $item['id_categoria'];?>">
                                                    <?= $item['Nombre_Categoria']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Seleccione una categoría válida</div>
                                    </div>

                                </div> <!-- /.row g-3 -->
                            </div> <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-info" type="submit" name="btnGuardar">Guardar</button>
                            </div>
                        </form>
                    </div> <!-- /.card -->
                </div> <!-- /.col-lg-6 -->
            </div> <!-- /.col-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /.app-content -->