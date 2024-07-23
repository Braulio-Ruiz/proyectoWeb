<?php
/* @autor Braulio Ruiz */
include '../../class/autoload.php';

$categoria = new Categorias();
$categorias = $categoria->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar productos ..:: SiberOS ::..</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <a href="../../index.php">
        <header>
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <h1>Agregar nuevos Productos</h1>
        </header>
    </a>
    <div class="container">
        <form id="formProductos" action="../productos.php" method="post" enctype="multipart/form-data">
            <label for="nombreProducto">Nombre del Producto:</label>
            <input type="text" id="nombreProducto" name="nombre">
            <label for="descripcionProducto">Descripción del Producto:</label>
            <input type="text" id="descripcionProducto" name="descripcion">
            <label for="precioProducto">Precio del Producto:</label>
            <input type="number" id="precioProducto" name="precio" step="0.01">
            <label for="imagenProducto">Imagen del Producto:</label>
            <input type="file" id="imagenProducto" name="imagen" accept="image/*">
            <label for="categoriaProducto">Categoría del Producto:</label>
            <select id="categoriaProducto" name="categoria_id">
                <?php foreach ($categorias as $categoria) : ?>
                    <option value="<?php echo $categoria['id']; ?>">
                        <?php echo $categoria['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Guardar</button>
            <button class="btn-cancelar" type="reset">Cancelar</button>
        </form>
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <script src="../../assets/js/validaciones.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>

</html>