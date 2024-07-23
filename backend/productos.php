<?php
/* @autor Braulio Ruiz */

include '../class/autoload.php';
// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    // Asigna el valor de 'nombre' del formulario POST a la variable $nombre, o null si no está definido.

    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
    // Asigna el valor de 'descripcion' del formulario POST a la variable $descripcion, o null si no está definido.

    $precio = isset($_POST['precio']) ? $_POST['precio'] : null;
    // Asigna el valor de 'precio' del formulario POST a la variable $precio, o null si no está definido.

    $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : null;
    // Asigna el valor de 'categoria_id' del formulario POST a la variable $categoria_id, o null si no está definido.

    if ($nombre && $descripcion && $precio && $categoria_id && isset($_FILES['imagen']['name'])) {
        // Verifica si todas las variables (nombre, descripcion, precio, categoria_id) están definidas y si se ha subido un archivo de imagen.

        $imagen = $_FILES['imagen']['name'];
        // Asigna el nombre del archivo de la imagen a la variable $imagen.

        $target_dir = "../assets/img/";
        // Define el directorio de destino para la imagen subida.

        $target_file = $target_dir . basename($imagen);
        // Define la ruta completa del archivo de destino concatenando el directorio de destino y el nombre base del archivo.

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
            // Mueve el archivo subido desde su ubicación temporal a la ubicación de destino.
            // Si la operación es exitosa, continúa con la siguiente lógica.

            $producto = new Productos();
            // Crea una nueva instancia de la clase Productos.

            $producto->setNombre($nombre);
            // Establece el nombre del producto usando el método setNombre().

            $producto->setDescripcion($descripcion);
            // Establece la descripción del producto usando el método setDescripcion().

            $producto->setImagen($imagen);
            // Establece la imagen del producto usando el método setImagen().

            $producto->setPrecio($precio);
            // Establece el precio del producto usando el método setPrecio().

            $producto->setCategoriaId($categoria_id);
            // Establece la categoría del producto usando el método setCategoriaId().

            $producto->guardar();
            // Guarda el producto en la base de datos usando el método guardar().

            header('Location: views/lista_productos.php');
            // Redirige al usuario a la página 'lista_productos.php' en el directorio 'views/'.

            exit;
            // Finaliza el script para asegurar que no se ejecute ningún código adicional.
        } else {
            echo "Error al subir la imagen.";
            // Si el archivo no se pudo mover, muestra un mensaje de error.
        }
    } else {
        echo "Error: Datos no proporcionados.";
        // Si no se proporcionaron todos los datos necesarios, muestra un mensaje de error.
    }
}
