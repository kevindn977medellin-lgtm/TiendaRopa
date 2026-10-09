<?php
require_once "../config/conexion.php";
$conexion = new Conexion();

// Consulta de categorías
$consultaCategorias = "SELECT * FROM categoria ORDER BY Nombre_Categoria ASC;";
$listaCategoria = $conexion->getData($consultaCategorias);

// Variable para almacenar la información del producto
$dataCovert = [];

// TRAER LOS DATOS DEL PRODUCTO
if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "") {
    $id = $_REQUEST['id']; // Es recomendable sanitizar/preparar esta variable según tu clase Conexion
    $consultarDatos = "SELECT * FROM productos WHERE id_producto = '{$id}';";
    $datos = $conexion->getData($consultarDatos);
    
    if ($datos) {
        $dataCovert = mysqli_fetch_array($datos);
    }
}

// PROCESAR LA ACTUALIZACIÓN
if (isset($_POST["btnEditar"])) {
    // Se utiliza $_REQUEST / $_GET con fallback para evitar errores Notice
    $id_producto = $_GET["id"] ?? $_REQUEST["id"] ?? '';
    
    $nombre = $_POST["nombre"] ?? '';
    $descripcion = $_POST["descripcion"] ?? '';
    $precio = $_POST["precio"] ?? 0;
    $cantidad = $_POST["cantidad"] ?? 0;
    $id_categoria = $_POST["id_categoria"] ?? '';
    $estado = $_POST["estado"] ?? '1'; // Valor por defecto si no viene en el formulario

    // Consulta UPDATE (se eliminó la coma sobrante antes del WHERE)
    $query = "UPDATE productos SET
                nombre = '{$nombre}', 
                descripcion = '{$descripcion}',
                precio = '{$precio}', 
                cantidad = '{$cantidad}',
                id_categoria = '{$id_categoria}', 
                estado = '{$estado}'
              WHERE id_producto = '{$id_producto}';";

    $respuesta = $conexion->setTransaction($query);

    if ($respuesta) {
        echo "<script>alert('Actualización exitosa');</script>";
        echo "<script>window.location.href='?view=verProductos';</script>";
    } else {
        echo "<script>alert('Error: No se actualizó el producto');</script>";
        echo "<script>window.location.href='?view=crearProducto';</script>";
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
                <h1 class="mb-0 fs-3">Editar Producto</h1>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar producto</li>
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
                            <div class="card-title">Editar producto</div>
                        </div>
                        <form class="needs-validation" novalidate method="POST">
                            <div class="card-body">
                                <div class="row g-3">

                                    <!-- Campo: Nombre producto -->
                                    <div class="col-md-6">
                                        <label for="validationCustom01" class="form-label">Nombre producto</label>
                                        <input type="text" class="form-control" id="validationCustom01" name="nombre"
                                            value="<?= htmlspecialchars($dataCovert['nombre'] ?? ''); ?>" required />
                                        <div class="valid-feedback">¡Se ve bien!</div>
                                    </div>

                                    <!-- Campo: Descripción -->
                                    <div class="col-md-6">
                                        <label for="validationCustom02" class="form-label">Descripción</label>
                                        <input type="text" class="form-control" id="validationCustom02"
                                            name="descripcion"
                                            value="<?= htmlspecialchars($dataCovert['descripcion'] ?? ''); ?>"
                                            required />
                                        <div class="valid-feedback">¡Se ve bien!</div>
                                    </div>

                                    <!-- Campo: Precio -->
                                    <div class="col-md-6">
                                        <label for="validationCustomUsername" class="form-label">Precio</label>
                                        <div class="input-group has-validation">
                                            <input type="number" step="0.01" class="form-control"
                                                id="validationCustomUsername" name="precio"
                                                value="<?= htmlspecialchars($dataCovert['precio'] ?? ''); ?>"
                                                required />
                                            <div class="invalid-feedback">Ingrese el precio</div>
                                        </div>
                                    </div>

                                    <!-- Campo: Cantidad -->
                                    <div class="col-md-6">
                                        <label for="validationCustom03" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="validationCustom03"
                                            name="cantidad"
                                            value="<?= htmlspecialchars($dataCovert['cantidad'] ?? ''); ?>" required />
                                        <div class="invalid-feedback">Ingrese la cantidad</div>
                                    </div>

                                    <!-- Campo: Categoría -->
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Categorías</label>
                                        <select class="form-select" id="validationCustom04" name="id_categoria"
                                            required>
                                            <option disabled value="">Elegir...</option>
                                            <?php foreach ($listaCategoria as $item): ?>
                                            <option value="<?= $item['id_categoria']; ?>"
                                                <?= (isset($dataCovert['id_categoria']) && $item['id_categoria'] == $dataCovert['id_categoria']) ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($item['Nombre_Categoria']); ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">Seleccione una categoría válida</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom04" class="form-label">Estado</label>
                                        <select class="form-select" id="validationCustom04" name="estado" required>
                                            <option disabled value="">Seleccione</option>
                                            <option value="Activo"
                                                <?php echo ("Activo"==$dataCovert['estado']) ? 'selected':''; ?>>
                                                Activo
                                            </option>
                                            <option value="Inactivo"
                                                <?php echo ("Inactivo"==$dataCovert['estado']) ? 'selected':''; ?>>
                                                Inactivo
                                            </option>
                                        </select>
                                        <div class="invalid-feedback">Seleccione una categoría válida</div>
                                    </div>
                                </div> <!-- /.row g-3 -->
                            </div> <!-- /.card-body -->
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit" name="btnEditar">Guardar cambios</button>
                            </div>
                        </form>
                    </div> <!-- /.card -->
                </div> <!-- /.col-lg-6 -->
            </div> <!-- /.col-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container-fluid -->
</div> <!-- /.app-content -->