<?php

// Incluye el archivo controlador /backend/categorias.php.
include '../categorias.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Configura la ventana gráfica para que sea responsive, ajustándose al ancho del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el título del documento que se muestra en la pestaña del navegador -->
    <title>Listado de Categorías ..:: SiberOs ::..</title>
    <!-- Vincula el archivo de estilos CSS ubicado en '../../assets/css/estilos.css' -->
    <link rel="stylesheet" href="../../assets/css/estilos.css">
</head>

<body>
    <!-- Enlace que apunta a la página 'index.php' ubicada en el directorio '../../' -->
    <a href="../../index.php">
        <!-- Inicio de la sección de encabezado del documento -->
        <header>
            <!-- Imagen del logo de la empresa, ubicada en '../../assets/img/logo.png', con texto alternativo y clase 'logo' -->
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Título de nivel 1 que indica el contenido de la página: Listado de Categorías -->
            <h1>Listado de Categorías</h1>
        </header>
    </a>
    <!-- Contenedor principal del contenido -->
    <div class="container">
        <!-- Formulario de busqueda de Categorias -->
        <form method="GET" action="lista_categorias.php">
            <input type="text" name="search" placeholder="Buscar categoria">
            <button class="search" type="submit">Buscar</button>
        </form>
        <!-- Inicio de la tabla para mostrar las categorías -->
        <table>
            <!-- Encabezado de la tabla -->
            <thead>
                <!-- Fila del encabezado -->
                <tr>
                    <!-- Celda del encabezado para la columna de ID -->
                    <th>ID</th>
                    <!-- Celda del encabezado para la columna de Nombre -->
                    <th>Nombre</th>
                    <!-- Celda del encabezado para la columna de Acciones -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla -->
            <tbody>
                <!-- Inicia un bucle PHP para recorrer cada categoría -->
                <?php foreach ($categorias as $cat) : ?>
                    <!-- Fila de la tabla para cada categoría -->
                    <tr>
                        <!-- Celda que muestra el ID de la categoría -->
                        <td><?php echo $cat['id']; ?></td>
                        <!-- Celda que muestra el nombre de la categoría -->
                        <td><?php echo $cat['nombre']; ?></td>
                        <!-- Celda que muestra el boton "Eliminar" -->
                        <td>
                            <form method="POST" action="lista_categorias.php">
                                <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                                <button class="delete" type="submit" name="delete">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Fin del bucle PHP -->
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Enlace que apunta a 'categorias.html' para agregar nuevas categorías, con la clase 'nav-link' -->
        <a href="categorias.html" class="nav-link">Agregar Categorías</a>
        <!-- Párrafo con el texto 'Creado por Braulio Ruiz Niñoles' -->
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>
    <!-- Incluye el archivo JavaScript principal ubicado en '../../assets/js/main.js' -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>