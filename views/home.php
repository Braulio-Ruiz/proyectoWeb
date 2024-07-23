<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>..:: SiberOs ::..</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>
    <a href="index.php">
        <header>
            <img src="assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <h1>Bienvenidos a SiberOs</h1>
        </header>
    </a>
    <div class="container">
        <div class="navigation">
            <a href="backend/views/categorias.html" class="nav-link">Categorías</a>
            <a href="backend/views/productos.php" class="nav-link">Productos</a>
        </div>
        <div class="navigation">
            <a href="backend/views/lista_categorias.php" class="nav-link">Listado de Categorías</a>
            <a href="backend/views/lista_productos.php" class="nav-link">Listado de Productos</a>
        </div>
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
                        <td><img src="assets/img/<?php echo $prod['imagen']; ?>" alt="<?php echo $prod['nombre']; ?>" style="width: 100px; height: auto;"></td>
                        <td><?php echo $prod['categoria_id']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <script src="assets/js/main.js"></script>
</body>

</html>