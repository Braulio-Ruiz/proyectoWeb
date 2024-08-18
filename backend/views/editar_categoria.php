<?php
// Incluye el archivo controlador /backend/categorias.php para manejar las operaciones de categorías.
include '../categorias.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <!-- Configura la ventana gráfica para que sea responsive, ajustándose al ancho del dispositivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Define el título del documento que se muestra en la pestaña del navegador -->
    <title>Editar Categoría ..:: SiberOs ::..</title>
    <!-- Vincula el archivo de estilos CSS ubicado en '../../assets/css/estilos.css' -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/estilos.css">
    <!-- Incluye la biblioteca jQuery -->
    <script src="../../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <!-- Enlace que apunta a la página 'index.php' ubicada en el directorio '../../' -->
    <a href="../../index.php">
        <!-- Inicio de la sección de encabezado del documento -->
        <header>
            <!-- Imagen del logo de la empresa, ubicada en '../../assets/img/logo.png', con texto alternativo y clase 'logo' -->
            <img src="../../assets/img/logo.png" alt="Logo de la Empresa" class="logo">
            <!-- Título de nivel 1 que indica el contenido de la página: Editar Categoría -->
            <h1>Editar Categoría</h1>
        </header>
    </a>

    <!-- Contenedor principal del contenido -->
    <div class="container">
        <!-- Formulario para editar la categoría -->
        <form method="POST" action="editar_categoria.php">
            <!-- Campo oculto con el ID de la categoría -->
            <input type="hidden" name="id" value="<?php echo $categoria['id']; ?>">

            <!-- Campo de texto para editar el nombre de la categoría -->
            <label for="nombre">Nombre de la Categoría:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8'); ?>" required>

            <!-- Botón para actualizar la categoría -->
            <button class="updateCat" type="submit" name="update">Actualizar</button>
        </form>

        <!-- Enlace para volver a la lista de categorías -->
        <a href="lista_categorias.php" class="nav-link">Volver al listado de Categorías</a>
        <!-- Párrafo con el texto 'Creado por Braulio Ruiz Niñoles' -->
        <p>Creado por Braulio Ruiz Niñoles</p>
    </div>

    <!-- Incluye el archivo JavaScript de validaciones ubicado en '../../assets/js/validaciones.js' -->
    <script src="../../assets/js/validaciones.js"></script>
    <!-- Incluye el archivo JavaScript principal ubicado en '../../assets/js/main.js' -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>