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
    <title>Listado de Categorías ..:: SiberOs ::..</title>
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
            <h1>Listado de Categorías</h1>
            <!-- Título de nivel 1 que indica el contenido de la página: Listado de Categorías -->
        </header>
    </a>
    <div class="container">
        <!-- Contenedor principal del contenido -->
        <table>
            <!-- Inicio de la tabla para mostrar las categorías -->
            <thead>
                <!-- Encabezado de la tabla -->
                <tr>
                    <!-- Fila del encabezado -->
                    <th>ID</th>
                    <!-- Celda del encabezado para la columna de ID -->
                    <th>Nombre</th>
                    <!-- Celda del encabezado para la columna de Nombre -->
                </tr>
            </thead>
            <tbody>
                <!-- Cuerpo de la tabla -->
                <?php foreach ($categorias as $cat) : ?>
                    <!-- Inicia un bucle PHP para recorrer cada categoría -->
                    <tr>
                        <!-- Fila de la tabla para cada categoría -->
                        <td><?php echo $cat['id']; ?></td>
                        <!-- Celda que muestra el ID de la categoría -->
                        <td><?php echo $cat['nombre']; ?></td>
                        <!-- Celda que muestra el nombre de la categoría -->
                    </tr>
                <?php endforeach; ?>
                <!-- Fin del bucle PHP -->
            </tbody>
        </table>
        <a href="categorias.html" class="nav-link">Agregar nuevas categorías</a>
        <!-- Enlace que apunta a 'categorias.html' para agregar nuevas categorías, con la clase 'nav-link' -->
        <p>Creado por Braulio Ruiz Niñoles</p>
        <!-- Párrafo con el texto 'Creado por Braulio Ruiz Niñoles' -->
    </div>
    <script src="../../assets/js/main.js"></script>
    <!-- Incluye el archivo JavaScript principal ubicado en '../../assets/js/main.js' -->
</body>

</html>
<!-- Fin del documento HTML -->