<?php
// Incluye el archivo controlador /backend/productos.php.
include 'backend/productos.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <!-- Establece la metaetiqueta de la ventana gráfica para controlar el diseño en navegadores móviles -->
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- Define el título de la página que aparecerá en la pestaña del navegador -->
   <title>..:: SiberOs ::..</title>
   <!-- Enlaza el archivo de hoja de estilos CSS externo para aplicar estilos a la página -->
   <link rel="stylesheet" type="text/css" href="assets/css/estilos.css" />
</head>

<body>
   <!-- Crea un enlace que apunta a index.php -->
   <a href="index.php">
      <!-- Define el encabezado de la página -->
      <header>
         <!-- Muestra el logo de la empresa. El atributo src indica la ubicación de la imagen, alt proporciona texto alternativo para accesibilidad, y class define la clase CSS -->
         <img
            src="assets/img/logo.png"
            alt="Logo de la Empresa"
            class="logo" />
         <!-- Muestra un encabezado de nivel 1 con el texto "Bienvenidos a SiberOs" -->
         <h1>Bienvenidos a SiberOs</h1>
      </header>
   </a>
   <!-- Define un contenedor principal con la clase CSS "container" -->
   <div class="container">
      <!-- Define una sección de navegación con la clase CSS "navigation" -->
      <div class="navigation">
         <!-- Enlace a la página de categorías con la clase CSS "nav-link" -->
         <a href="backend/views/categorias.html" class="nav-link">Agregar Categorías</a>
         <!-- Enlace a la página de productos con la clase CSS "nav-link" -->
         <a href="backend/views/productos.php" class="nav-link">Agregar Productos</a>
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
               <!-- Fila de la tabla para cada producto -->
               <tr>
                  <!-- Celda que muestra el ID del producto -->
                  <td><?php echo $prod['id']; ?></td>
                  <!-- Celda que muestra el nombre del producto -->
                  <td>
                     <?php echo htmlspecialchars($prod['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                  </td>
                  <!-- Celda que muestra la descripción del producto -->
                  <td>
                     <?php echo htmlspecialchars($prod['descripcion'], ENT_QUOTES, 'UTF-8'); ?>
                  </td>
                  <!-- Celda que muestra el precio del producto, formateado con puntos como separadores de miles y sin decimales -->
                  <td>
                     <?php echo '$', number_format($prod['precio'], 0, ',', '.'); ?>
                  </td>
                  <!-- Celda que muestra la imagen del producto, con una anchura de 100px y altura automática -->
                  <td>
                     <!-- Mostrar la imagen del producto -->
                     <img
                        src="assets/img/<?php echo htmlspecialchars($prod['imagen']); ?>"
                        alt="<?php echo htmlspecialchars($prod['nombre']); ?>"
                        style="width: 100px; height: auto" />
                  </td>
                  <!-- Celda que muestra el ID de la categoría del producto -->
                  <td>
                     <?php echo htmlspecialchars($prod['categoria_nombre'], ENT_QUOTES, 'UTF-8'); ?>
                  </td>
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