<!DOCTYPE html>
<!-- Define el tipo de documento como HTML5 -->
<html lang="en">
<!-- Comienza el documento HTML y establece el idioma en inglés -->

<head>
    <!-- Define la cabecera del documento -->
    <meta charset="UTF-8">
    <!-- Especifica la codificación de caracteres del documento como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Establece la metaetiqueta de la ventana gráfica para controlar el diseño en navegadores móviles -->
    <title>..:: SiberOs ::..</title>
    <!-- Define el título de la página que aparecerá en la pestaña del navegador -->
    <link rel="stylesheet" href="assets/css/estilos.css">
    <!-- Enlaza el archivo de hoja de estilos CSS externo para aplicar estilos a la página -->
</head>

<body>
    <!-- Comienza el cuerpo del documento HTML -->
    <a href="index.php">
        <!-- Crea un enlace que apunta a index.php -->
        <header>
            <!-- Define el encabezado de la página -->
            <img src="assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Muestra el logo de la empresa. El atributo src indica la ubicación de la imagen, alt proporciona texto alternativo para accesibilidad, y class define la clase CSS -->
            <h1>Bienvenidos a SiberOs</h1>
            <!-- Muestra un encabezado de nivel 1 con el texto "Bienvenidos a SiberOs" -->
        </header>
    </a>
    <!-- Cierra el enlace, haciendo que el encabezado sea un enlace clicable -->
    <div class="container">
        <!-- Define un contenedor principal con la clase CSS "container" -->
        <div class="navigation">
            <!-- Define una sección de navegación con la clase CSS "navigation" -->
            <a href="backend/views/categorias.html" class="nav-link">Categorías</a>
            <!-- Enlace a la página de categorías con la clase CSS "nav-link" -->
            <a href="backend/views/productos.php" class="nav-link">Productos</a>
            <!-- Enlace a la página de productos con la clase CSS "nav-link" -->
        </div>
        <!-- Cierra la primera sección de navegación -->
        <div class="navigation">
            <!-- Define una segunda sección de navegación con la clase CSS "navigation" -->
            <a href="backend/views/lista_categorias.php" class="nav-link">Listado de Categorías</a>
            <!-- Enlace a la página de listado de categorías con la clase CSS "nav-link" -->
            <a href="backend/views/lista_productos.php" class="nav-link">Listado de Productos</a>
            <!-- Enlace a la página de listado de productos con la clase CSS "nav-link" -->
        </div>
        <!-- Cierra la segunda sección de navegación -->
        <table>
            <!-- Define una tabla para mostrar datos -->
            <thead>
                <!-- Define el encabezado de la tabla -->
                <tr>
                    <!-- Define una fila en el encabezado de la tabla -->
                    <th>ID</th>
                    <!-- Encabezado de columna para ID -->
                    <th>Nombre</th>
                    <!-- Encabezado de columna para Nombre -->
                    <th>Descripción</th>
                    <!-- Encabezado de columna para Descripción -->
                    <th>Precio</th>
                    <!-- Encabezado de columna para Precio -->
                    <th>Imagen</th>
                    <!-- Encabezado de columna para Imagen -->
                    <th>Categoría</th>
                    <!-- Encabezado de columna para Categoría -->
                </tr>
            </thead>
            <tbody>
                <!-- Define el cuerpo de la tabla -->
                <?php foreach ($productos as $prod) : ?>
                    <!-- Inicia un bucle PHP para iterar sobre cada producto en la variable $productos -->
                    <tr>
                        <!-- Define una fila de la tabla para cada producto -->
                        <td><?php echo $prod['id']; ?></td>
                        <!-- Muestra el ID del producto en una celda de la tabla -->
                        <td><?php echo $prod['nombre']; ?></td>
                        <!-- Muestra el nombre del producto en una celda de la tabla -->
                        <td><?php echo $prod['descripcion']; ?></td>
                        <!-- Muestra la descripción del producto en una celda de la tabla -->
                        <td><?php echo '$', number_format($prod['precio'], 0, ',', '.'); ?></td>
                        <!-- Muestra el precio del producto formateado en una celda de la tabla -->
                        <td><img src="assets/img/<?php echo $prod['imagen']; ?>" alt="<?php echo $prod['nombre']; ?>" style="width: 100px; height: auto;"></td>
                        <!-- Muestra la imagen del producto en una celda de la tabla. El atributo src construye la ruta de la imagen, y el atributo alt proporciona texto alternativo -->
                        <td><?php echo $prod['categoria_id']; ?></td>
                        <!-- Muestra el ID de la categoría del producto en una celda de la tabla -->
                    </tr>
                <?php endforeach; ?>
                <!-- Cierra el bucle PHP -->
            </tbody>
        </table>
        <!-- Cierra la tabla -->
        <p>Creado por Braulio Ruiz Niñoles</p>
        <!-- Muestra el texto "Creado por Braulio Ruiz Niñoles" -->
    </div>
    <!-- Cierra el contenedor principal -->
    <script src="assets/js/main.js"></script>
    <!-- Enlaza el archivo JavaScript externo para añadir funcionalidad a la página -->
</body>
<!-- Cierra el cuerpo del documento HTML -->

</html>
<!-- Cierra el documento HTML -->