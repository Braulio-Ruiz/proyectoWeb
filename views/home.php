<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Establece la metaetiqueta de la ventana gráfica para controlar el diseño en navegadores móviles -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el título de la página que aparecerá en la pestaña del navegador -->
    <title>..:: SiberOs ::..</title>
    <!-- Enlaza el archivo de hoja de estilos CSS externo para aplicar estilos a la página -->
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>
    <!-- Crea un enlace que apunta a index.php -->
    <a href="index.php">
        <!-- Define el encabezado de la página -->
        <header>
            <!-- Muestra el logo de la empresa. El atributo src indica la ubicación de la imagen, alt proporciona texto alternativo para accesibilidad, y class define la clase CSS -->
            <img src="assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Muestra un encabezado de nivel 1 con el texto "Bienvenidos a SiberOs" -->
            <h1>Bienvenidos a SiberOs</h1>
        </header>
    </a>
    <!-- Define un contenedor principal con la clase CSS "container" -->
    <div class="container">
        <!-- Define una sección de navegación con la clase CSS "navigation" -->
        <div class="navigation">
            <!-- Enlace a la página de categorías con la clase CSS "nav-link" -->
            <a href="backend/views/categorias.html" class="nav-link">Categorías</a>
            <!-- Enlace a la página de productos con la clase CSS "nav-link" -->
            <a href="backend/views/productos.php" class="nav-link">Productos</a>
        </div>
        <!-- Define una segunda sección de navegación con la clase CSS "navigation" -->
        <div class="navigation">
            <!-- Enlace a la página de listado de categorías con la clase CSS "nav-link" -->
            <a href="backend/views/lista_categorias.php" class="nav-link">Listado de Categorías</a>
            <!-- Enlace a la página de listado de productos con la clase CSS "nav-link" -->
            <a href="backend/views/lista_productos.php" class="nav-link">Listado de Productos</a>
        </div>
        <!-- Define una tabla para mostrar datos -->
        <table>
            <!-- Define el encabezado de la tabla -->
            <thead>
                <!-- Define una fila en el encabezado de la tabla -->
                <tr>
                    <!-- Encabezado de columna para ID -->
                    <th>ID</th>
                    <!-- Encabezado de columna para Nombre -->
                    <th>Nombre</th>
                    <!-- Encabezado de columna para Descripción -->
                    <th>Descripción</th>
                    <!-- Encabezado de columna para Precio -->
                    <th>Precio</th>
                    <!-- Encabezado de columna para Imagen -->
                    <th>Imagen</th>
                    <!-- Encabezado de columna para Categoría -->
                    <th>Categoría</th>
                </tr>
            </thead>
            <!-- Define el cuerpo de la tabla -->
            <tbody>
                <!-- Inicia un bucle PHP para iterar sobre cada producto en la variable $productos -->
                <?php foreach ($productos as $prod) : ?>
                    <!-- Define una fila de la tabla para cada producto -->
                    <tr>
                        <!-- Muestra el ID del producto en una celda de la tabla -->
                        <td><?php echo $prod['id']; ?></td>
                        <!-- Muestra el nombre del producto en una celda de la tabla -->
                        <td><?php echo $prod['nombre']; ?></td>
                        <!-- Muestra la descripción del producto en una celda de la tabla -->
                        <td><?php echo $prod['descripcion']; ?></td>
                        <!-- Muestra el precio del producto formateado en una celda de la tabla -->
                        <td><?php echo '$', number_format($prod['precio'], 0, ',', '.'); ?></td>
                        <!-- Muestra la imagen del producto en una celda de la tabla. El atributo src construye la ruta de la imagen, y el atributo alt proporciona texto alternativo -->
                        <td><img src="assets/img/<?php echo $prod['imagen']; ?>" alt="<?php echo $prod['nombre']; ?>" style="width: 100px; height: auto;"></td>
                        <!-- Muestra el ID de la categoría del producto en una celda de la tabla -->
                        <td><?php echo $prod['categoria_id']; ?></td>
                    </tr>
                    <!-- Cierra el bucle PHP -->
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Muestra el texto "Creado por Braulio Ruiz Niñoles" -->
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <!-- Enlaza el archivo JavaScript externo para añadir funcionalidad a la página -->
    <script src="assets/js/main.js"></script>
</body>

</html>