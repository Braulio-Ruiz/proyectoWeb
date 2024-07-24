<?php
/* @autor Braulio Ruiz */
// Incluye el archivo de carga automática para cargar clases automáticamente
include '../../class/autoload.php';

// Crea una instancia de la clase Categorias
$categoria = new Categorias();

// Llama al método obtenerTodas() para obtener todas las categorías de la base de datos
$categorias = $categoria->obtenerTodas();
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
    <title>Agregar productos ..:: SiberOS ::..</title>
    <!-- Define el título del documento que se muestra en la pestaña del navegador -->
    <link rel="stylesheet" href="../../assets/css/estilos.css">
    <!-- Vincula el archivo de estilos CSS ubicado en '../../assets/css/estilos.css' -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Incluye la librería jQuery desde un CDN con su integridad verificada -->
</head>

<body>
    <!-- Inicio del cuerpo del documento HTML -->
    <a href="../../index.php">
        <!-- Enlace que apunta a la página 'index.php' ubicada en el directorio '../../' -->
        <header>
            <!-- Inicio de la sección de encabezado del documento -->
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Imagen del logo de la empresa, ubicada en '../../assets/img/logo.png', con texto alternativo y clase 'logo' -->
            <h1>Agregar nuevos Productos</h1>
            <!-- Título de nivel 1 que indica el contenido de la página: Agregar nuevos Productos -->
        </header>
    </a>
    <div class="container">
        <!-- Contenedor principal del contenido -->
        <form id="formProductos" action="../productos.php" method="post" enctype="multipart/form-data">
            <!-- Formulario para agregar nuevos productos, con identificación 'formProductos', que envía datos a 'productos.php' mediante el método POST y permite la carga de archivos -->
            <label for="nombreProducto">Nombre del Producto:</label>
            <!-- Etiqueta para el campo de entrada del nombre del producto -->
            <input type="text" id="nombreProducto" name="nombre">
            <!-- Campo de entrada de texto para el nombre del producto, con identificación 'nombreProducto' y nombre 'nombre' -->
            <label for="descripcionProducto">Descripción del Producto:</label>
            <!-- Etiqueta para el campo de entrada de la descripción del producto -->
            <input type="text" id="descripcionProducto" name="descripcion">
            <!-- Campo de entrada de texto para la descripción del producto, con identificación 'descripcionProducto' y nombre 'descripcion' -->
            <label for="precioProducto">Precio del Producto:</label>
            <!-- Etiqueta para el campo de entrada del precio del producto -->
            <input type="number" id="precioProducto" name="precio" step="0.01">
            <!-- Campo de entrada numérico para el precio del producto, con identificación 'precioProducto', nombre 'precio' y paso de 0.01 para decimales -->
            <label for="imagenProducto">Imagen del Producto:</label>
            <!-- Etiqueta para el campo de entrada de la imagen del producto -->
            <input type="file" id="imagenProducto" name="imagen" accept="image/*">
            <!-- Campo de entrada de archivo para la imagen del producto, con identificación 'imagenProducto', nombre 'imagen' y aceptación de solo archivos de imagen -->
            <label for="categoriaProducto">Categoría del Producto:</label>
            <!-- Etiqueta para el campo de selección de la categoría del producto -->
            <select id="categoriaProducto" name="categoria_id">
                <!-- Campo de selección de la categoría del producto, con identificación 'categoriaProducto' y nombre 'categoria_id' -->
                <?php foreach ($categorias as $categoria) : ?>
                    <!-- Bucle PHP para recorrer cada categoría y crear una opción en el campo de selección -->
                    <option value="<?php echo $categoria['id']; ?>">
                        <!-- Opción del campo de selección con el valor del ID de la categoría -->
                        <?php echo $categoria['nombre']; ?>
                        <!-- Muestra el nombre de la categoría -->
                    </option>
                <?php endforeach; ?>
                <!-- Fin del bucle PHP -->
            </select>
            <button type="submit">Guardar</button>
            <!-- Botón para enviar el formulario -->
            <button class="btn-cancelar" type="reset">Cancelar</button>
            <!-- Botón para restablecer el formulario, con la clase 'btn-cancelar' -->
        </form>
        <p>Creado por Braulio Ruiz Niñoles</p>
        <!-- Párrafo con el texto 'Creado por Braulio Ruiz Niñoles' -->
    </div>
    <script src="../../assets/js/validaciones.js"></script>
    <!-- Incluye el archivo JavaScript de validaciones ubicado en '../../assets/js/validaciones.js' -->
    <script src="../../assets/js/main.js"></script>
    <!-- Incluye el archivo JavaScript principal ubicado en '../../assets/js/main.js' -->
</body>

</html>
<!-- Fin del documento HTML -->