<?php
/* @autor Braulio Ruiz */
include '../../class/autoload.php';

$producto = new Productos();
$productos = $producto->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos ..:: SiberOs ::..</title>
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>
    <a href="../../index.php">
        <header>
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <h1>Listado de Productos</h1>
        </header>
    </a>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $prod) : ?>
                    <tr>
                        <td><?php echo $prod['id']; ?></td>
                        <td><?php echo $prod['nombre']; ?></td>
                        <td><?php echo $prod['descripcion']; ?></td>
                        <td><?php echo '$', number_format($prod['precio'], 0, ',', '.'); ?></td>
                        <td><img src="../../assets/img/<?php echo $prod['imagen']; ?>" alt="<?php echo $prod['nombre']; ?>" style="width: 100px; height: auto;"></td>
                        <td><?php echo $prod['categoria_id']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="productos.php" class="nav-link">Agregar nuevos productos</a>
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <script src="../../assets/js/main.js"></script>
</body>

</html>