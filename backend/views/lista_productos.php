<?php
/* @autor Braulio Ruiz */
// Incluye el archivo de carga automática para cargar clases automáticamente
include '../../class/autoload.php';

// Crea una instancia de la clase Productos
$producto = new Productos();

// Llama al método obtenerTodos() para obtener todos los productos de la base de datos
$productos = $producto->obtenerTodos();
?>

<!DOCTYPE html>
<!-- Define el tipo de documento como HTML5 -->
<html lang="en">
<!-- Inicio del documento HTML, con el idioma configurado como inglés -->

<head>
    <!-- Inicio de la sección del encabezado del documento HTML -->
    <meta charset="UTF-8">
    <!-- Define la codificación de caracteres del documento como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Configura la ventana gráfica para que sea responsive, ajustándose al ancho del dispositivo -->
    <title>Listado de Productos ..:: SiberOs ::..</title>
    <!-- Define el título del documento que se muestra en la pestaña del navegador -->
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <!-- Vincula el archivo de estilos CSS ubicado en '../../assets/css/estilos.css' -->
</head>

<body>
    <!-- Inicio del cuerpo del documento HTML -->
    <a href="../../index.php">
        <!-- Enlace que apunta a la página 'index.php' ubicada en el directorio '../../' -->
        <header>
            <!-- Inicio de la sección de encabezado del documento -->
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Imagen del logo de la empresa, ubicada en '../../assets/img/logo.png', con texto alternativo y clase 'logo' -->
            <h1>Listado de Productos</h1>
            <!-- Título de nivel 1 que indica el contenido de la página: Listado de Productos -->
        </header>
    </a>
    <div class="container">
        <!-- Contenedor principal del contenido -->
        <table>
            <!-- Inicio de la tabla para mostrar los productos -->
            <thead>
                <!-- Encabezado de la tabla -->
                <tr>
                    <!-- Fila del encabezado -->
                    <th>ID</th>
                    <!-- Celda del encabezado para la columna de ID -->
                    <th>Nombre</th>
                    <!-- Celda del encabezado para la columna de Nombre -->
                    <th>Descripción</th>
                    <!-- Celda del encabezado para la columna de Descripción -->
                    <th>Precio</th>
                    <!-- Celda del encabezado para la columna de Precio -->
                    <th>Imagen</th>
                    <!-- Celda del encabezado para la columna de Imagen -->
                    <th>Categoría</th>
                    <!-- Celda del encabezado para la columna de Categoría -->
                </tr>
            </thead>
            <tbody>
                <!-- Cuerpo de la tabla -->
                <?php foreach ($productos as $prod) : ?>
                    <!-- Inicia un bucle PHP para recorrer cada producto -->
                    <tr>
                        <!-- Fila de la tabla para cada producto -->
                        <td><?php echo $prod['id']; ?></td>
                        <!-- Celda que muestra el ID del producto -->
                        <td><?php echo $prod['nombre']; ?></td>
                        <!-- Celda que muestra el nombre del producto -->
                        <td><?php echo $prod['descripcion']; ?></td>
                        <!-- Celda que muestra la descripción del producto -->
                        <td><?php echo '$', number_format($prod['precio'], 0, ',', '.'); ?></td>
                        <!-- Celda que muestra el precio del producto, formateado con puntos como separadores de miles y sin decimales -->
                        <td>
                            <img src="../../assets/img/<?php echo $prod['imagen']; ?>" alt="<?php echo $prod['nombre']; ?>" style="width: 100px; height: auto;">
                        </td>
                        <!-- Celda que muestra la imagen del producto, con una anchura de 100px y altura automática -->
                        <td><?php echo $prod['categoria_id']; ?></td>
                        <!-- Celda que muestra el ID de la categoría del producto -->
                    </tr>
                <?php endforeach; ?>
                <!-- Fin del bucle PHP -->
            </tbody>
        </table>
        <a href="productos.php" class="nav-link">Agregar nuevos productos</a>
        <!-- Enlace que apunta a 'productos.php' para agregar nuevos productos, con la clase 'nav-link' -->
        <p>Creado por Braulio Ruiz Niñoles</p>
        <!-- Párrafo con el texto 'Creado por Braulio Ruiz Niñoles' -->
    </div>
    <script src="../../assets/js/main.js"></script>
    <!-- Incluye el archivo JavaScript principal ubicado en '../../assets/js/main.js' -->
</body>

</html>
<!-- Fin del documento HTML -->