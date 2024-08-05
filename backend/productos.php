<?php

// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.
include '../class/autoload.php';

// Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : null;
    $precio = isset($_POST['precio']) ? trim($_POST['precio']) : null;
    $categoria_id = isset($_POST['categoria_id']) ? trim($_POST['categoria_id']) : null;
    $imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
    // Sanitizar entradas para evitar XSS
    $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8');
    $precio = htmlspecialchars($precio, ENT_QUOTES, 'UTF-8');
    $categoria_id = htmlspecialchars($categoria_id, ENT_QUOTES, 'UTF-8');
    // Verifica si todas las variables (nombre, descripcion, precio, categoria_id, imagen) están definidas.
    if ($nombre && $descripcion && $precio && $categoria_id && $imagen) {
        // Define el directorio de destino para la imagen subida.
        $target_dir = "../assets/img/";
        // Define la ruta completa del archivo de destino concatenando el directorio de destino y el nombre base del archivo.
        $target_file = $target_dir . basename($imagen);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Compruebe si el archivo de imagen es una imagen real o una imagen falsa
        $check = getimagesize($_FILES['imagen']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }
        // Comprobar si el archivo ya existe
        if (file_exists($target_file)) {
            echo "Lo siento, el archivo ya existe.";
            $uploadOk = 0;
        }
        // Comprobar el tamaño del archivo
        if ($_FILES['imagen']['size'] > 500000) { // 500KB max file size
            echo "Lo siento, tu archivo es demasiado grande.";
            $uploadOk = 0;
        }
        // Permitir ciertos formatos de archivo
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
        // Compruebe si $uploadOk está establecido en 0 por un error
        if ($uploadOk == 0) {
            echo "Lo siento, tu archivo no fue subido.";
        }
        // Si todo está bien, intenta subir el archivo.
        else {
            // Mueve el archivo subido desde su ubicación temporal a la ubicación de destino.
            // Si la operación es exitosa, continúa con la siguiente lógica.
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
                // Crea una nueva instancia de la clase Productos.
                $producto = new Productos();
                // Establece el nombre del producto usando el método setNombre().
                $producto->setNombre($nombre);
                // Establece la descripción del producto usando el método setDescripcion().
                $producto->setDescripcion($descripcion);
                // Establece la imagen del producto usando el método setImagen().
                $producto->setImagen($imagen);
                // Establece el precio del producto usando el método setPrecio().
                $producto->setPrecio($precio);
                // Establece la categoría del producto usando el método setCategoriaId().
                $producto->setCategoriaId($categoria_id);
                // Guarda el producto en la base de datos usando el método guardar().
                $producto->guardar();
                // Redirige al usuario a la página 'lista_productos.php' en el directorio 'views/'.
                header('Location: views/lista_productos.php');
                // Finaliza el script para asegurar que no se ejecute ningún código adicional.
                exit;
            } else {
                echo "Error al subir la imagen.";
                // Si el archivo no se pudo mover, muestra un mensaje de error.
            }
        }
    }
    // Si no se proporcionaron todos los datos necesarios, muestra un mensaje de error.
    else {
        echo "Error: Datos no proporcionados.";
    }
}
