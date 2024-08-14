<?php
// Incluye el archivo controlador /backend/productos.php.
include '../productos.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Configura la ventana gráfica para que sea responsive, ajustándose al ancho del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el título del documento que se muestra en la pestaña del navegador -->
    <title>Listado de Productos ..:: SiberOs ::..</title>
    <!-- Vincula el archivo de estilos CSS ubicado en '../../assets/css/estilos.css' -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/estilos.css">
</head>

<body>
    <!-- Enlace que apunta a la página 'index.php' ubicada en el directorio '../../' -->
    <a href="../../index.php">
        <!-- Inicio de la sección de encabezado del documento -->
        <header>
            <!-- Imagen del logo de la empresa, ubicada en '../../assets/img/logo.png', con texto alternativo y clase 'logo' -->
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Título de nivel 1 que indica el contenido de la página: Listado de Productos -->
            <h1>Listado de Productos</h1>
        </header>
    </a>
    <!-- Contenedor principal del contenido -->
    <div class="container">
        <!-- Formulario de busqueda de Productos -->
        <form method="GET" action="lista_productos.php">
            <!-- Campo para introducir el término de búsqueda -->
            <input type="text" name="search" placeholder="Buscar producto" aria-label="Buscar producto">
            <!-- Botón para enviar la búsqueda -->
            <button class="search" type="submit">Buscar</button>
        </form>
        <!-- Inicio de la tabla para mostrar los productos -->
        <table>
            <!-- Encabezado de la tabla -->
            <thead>
                <!-- Fila del encabezado -->
                <tr>
                    <!-- Celda del encabezado para la columna de ID -->
                    <th>ID</th>
                    <!-- Celda del encabezado para la columna de Nombre -->
                    <th>Nombre</th>
                    <!-- Celda del encabezado para la columna de Descripción -->
                    <th>Descripción</th>
                    <!-- Celda del encabezado para la columna de Precio -->
                    <th>Precio</th>
                    <!-- Celda del encabezado para la columna de Imagen -->
                    <th>Imagen</th>
                    <!-- Celda del encabezado para la columna de Categoría -->
                    <th>Categoría</th>
                    <!-- Celda del encabezado para la columna de Acciones -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla -->
            <tbody>
                <!-- Inicia un bucle PHP para recorrer cada producto -->
                <?php foreach ($productos as $prod) : ?>
                    <!-- Fila de la tabla para cada producto -->
                    <tr>
                        <!-- Celda que muestra el ID del producto -->
                        <td><?php echo $prod['id']; ?></td>
                        <!-- Celda que muestra el nombre del producto -->
                        <td><?php echo htmlspecialchars($prod['nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <!-- Celda que muestra la descripción del producto -->
                        <td><?php echo htmlspecialchars($prod['descripcion'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <!-- Celda que muestra el precio del producto, formateado con puntos como separadores de miles y sin decimales -->
                        <td><?php echo '$', number_format($prod['precio'], 0, ',', '.'); ?></td>
                        <!-- Celda que muestra la imagen del producto, con una anchura de 100px y altura automática -->
                        <td>
                            <!-- Mostrar la imagen del producto -->
                            <img src="../../assets/img/<?php echo htmlspecialchars($prod['imagen']); ?>" alt="<?php echo htmlspecialchars($prod['nombre']); ?>" style="width: 100px; height: auto;">
                        </td>
                        <!-- Celda que muestra el ID de la categoría del producto -->
                        <td><?php echo htmlspecialchars($prod['categoria_nombre'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <!-- Celda que muestra el boton "Eliminar" -->
                        <td>
                            <!-- Formulario para eliminar el producto -->
                            <form method="POST" action="lista_productos.php">
                                <!-- Campo oculto con el ID del producto -->
                                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                <!-- Botón para eliminar el producto -->
                                <button class="delete" type="submit" name="delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Fin del bucle PHP -->
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Enlace que apunta a 'productos.php' para agregar nuevos productos, con la clase 'nav-link' -->
        <a href="productos.php" class="nav-link">Agregar Productos</a>
        <!-- Párrafo con el texto 'Creado por Braulio Ruiz Niñoles' -->
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <!-- Incluye el archivo JavaScript principal ubicado en '../../assets/js/main.js' -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>