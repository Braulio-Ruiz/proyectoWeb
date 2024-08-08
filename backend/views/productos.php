<?php
// Incluye el archivo de carga automática para cargar clases automáticamente
include '../../class/autoload.php';

// Crea una instancia de la clase Categorias
$categoria = new Categorias();

// Llama al método obtenerTodas() para obtener todas las categorías de la base de datos
$categorias = $categoria->obtenerTodas();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Configura la ventana gráfica para que sea responsive, ajustándose al ancho del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el título del documento que se muestra en la pestaña del navegador -->
    <title>Agregar productos ..:: SiberOS ::..</title>
    <!-- Vincula el archivo de estilos CSS ubicado en '../../assets/css/estilos.css' -->
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <!-- Incluye la biblioteca jQuery desde una CDN, con una versión específica y una verificación de integridad -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Enlace que apunta a la página 'index.php' ubicada en el directorio '../../' -->
    <a href="../../index.php">
        <!-- Inicio de la sección de encabezado del documento -->
        <header>
            <!-- Imagen del logo de la empresa, ubicada en '../../assets/img/logo.png', con texto alternativo y clase 'logo' -->
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Título de nivel 1 que indica el contenido de la página: Agregar nuevos Productos -->
            <h1>Agregar nuevos Productos</h1>
        </header>
    </a>
    <!-- Contenedor principal del contenido -->
    <div class="container">
        <!-- Formulario para agregar nuevos productos, con identificación 'formProductos', que envía datos a 'productos.php' mediante el método POST y permite la carga de archivos -->
        <form id="formProductos" action="../productos.php" method="post" enctype="multipart/form-data">
            <!-- Etiqueta para el campo de entrada del nombre del producto -->
            <label for="nombreProducto">Nombre del Producto:</label>
            <!-- Campo de entrada de texto para el nombre del producto, con identificación 'nombreProducto' y nombre 'nombre' -->
            <input type="text" id="nombreProducto" name="nombre">
            <!-- Etiqueta para el campo de entrada de la descripción del producto -->
            <label for="descripcionProducto">Descripción del Producto:</label>
            <!-- Campo de entrada de texto para la descripción del producto, con identificación 'descripcionProducto' y nombre 'descripcion' -->
            <input type="text" id="descripcionProducto" name="descripcion">
            <!-- Etiqueta para el campo de entrada del precio del producto -->
            <label for="precioProducto">Precio del Producto:</label>
            <!-- Campo de entrada numérico para el precio del producto, con identificación 'precioProducto', nombre 'precio' y paso de 0.01 para decimales -->
            <input type="number" id="precioProducto" name="precio" step="0.01">
            <!-- Etiqueta para el campo de entrada de la imagen del producto -->
            <label for="imagenProducto">Imagen del Producto:</label>
            <!-- Campo de entrada de archivo para la imagen del producto, con identificación 'imagenProducto', nombre 'imagen' y aceptación de solo archivos de imagen -->
            <input type="file" id="imagenProducto" name="imagen" accept="image/*">
            <!-- Etiqueta para el campo de selección de la categoría del producto -->
            <label for="categoriaProducto">Categoría del Producto:</label>
            <!-- Campo de selección de la categoría del producto, con identificación 'categoriaProducto' y nombre 'categoria_id' -->
            <select id="categoriaProducto" name="categoria_id">
                <!-- Bucle PHP para recorrer cada categoría y crear una opción en el campo de selección -->
                <?php foreach ($categorias as $categoria) : ?>
                    <!-- Opción del campo de selección con el valor del ID de la categoría -->
                    <option value="<?php echo $categoria['id']; ?>">
                        <!-- Muestra el nombre de la categoría -->
                        <?php echo $categoria['nombre']; ?>
                    </option>
                    <!-- Fin del bucle PHP -->
                <?php endforeach; ?>
            </select>
            <!-- Botón para enviar el formulario -->
            <button type="submit">Guardar</button>
            <!-- Botón para restablecer el formulario, con la clase 'btn-cancelar' -->
            <button class="btn-cancelar" type="reset">Cancelar</button>
        </form>
        <!-- Párrafo con el texto 'Creado por Braulio Ruiz Niñoles' -->
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <!-- Incluye el archivo JavaScript de validaciones ubicado en '../../assets/js/validaciones.js' -->
    <script src="../../assets/js/validaciones.js"></script>
    <!-- Incluye el archivo JavaScript principal ubicado en '../../assets/js/main.js' -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>