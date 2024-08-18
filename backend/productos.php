<?php

// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.
include __DIR__ . '/../class/autoload.php';

// Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si la solicitud es para eliminar un producto.
    if (isset($_POST['eliminar']) && isset($_POST['id'])) {
        $producto_id = $_POST['id'];  // Obtiene el ID del producto a eliminar.
        // Crea una nueva instancia de la clase 'Productos'.
        $producto = new Productos();
        // Establece el ID del producto a eliminar utilizando el método 'setId'.
        $producto->setId($producto_id);
        // Manejo de errores al intentar eliminar un producto.
        try {
            $producto->eliminar();  // Elimina el producto de la base de datos.
            // Responde con un mensaje de éxito si la eliminación se realiza correctamente.
            echo json_encode(['success' => true, 'message' => 'Producto eliminado con éxito.']);
        } catch (PDOException $e) {
            // En caso de un error, envía un mensaje de error.
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto: ' . $e->getMessage()]);
        }
        exit;  // Finaliza el script para asegurarse de que no se ejecute ningún código adicional.
    }
    // Obtener y sanitizar los datos del formulario.
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : null;
    $precio = isset($_POST['precio']) ? trim($_POST['precio']) : null;
    $categoria_id = isset($_POST['categoria_id']) ? trim($_POST['categoria_id']) : null;
    $imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
    // Validar y sanitizar los datos.
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
        // Comprueba si el archivo de imagen es una imagen.
        $check = getimagesize($_FILES['imagen']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "El archivo no es una imagen.";
            $uploadOk = 0;
        }
        // Comprueba si el archivo ya existe.
        if (file_exists($target_file)) {
            echo "Lo siento, el archivo ya existe.";
            $uploadOk = 0;
        }
        // Comprueba el tamaño del archivo.
        if ($_FILES['imagen']['size'] > 500000) { // 500KB max file size
            echo "Lo siento, tu archivo es demasiado grande.";
            $uploadOk = 0;
        }
        // Limita los formatos permitidos.
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }
        // Si todo es correcto, mueve el archivo al directorio final.
        if ($uploadOk == 1) {
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
                // Si el archivo no se pudo mover, muestra un mensaje de error.
                echo "Error al subir la imagen.";
            }
        } else {
            // Si el archivo no se pudo subir, muestra un mensaje de error.
            echo "Lo siento, tu archivo no fue subido.";
        }
    } else {
        // Si los datos no están completos, muestra un mensaje de error.
        echo "Error: Datos no proporcionados.";
    }
}

// Verifica si el formulario de búsqueda fue enviado (solicitud GET).
if (isset($_GET['search'])) {
    // Asigna el valor de la búsqueda a la variable $search.
    $search = $_GET['search'];
} else {
    // Si no se realizó ninguna búsqueda, establece $search como una cadena vacía.
    $search = '';
}

// Crea una instancia de la clase Productos.
$producto = new Productos();

// Si hay un término de búsqueda, busca los productos que coincidan.
if (!empty($search)) {
    $productos = $producto->buscar($search);
} else {
    // Si no hay búsqueda, obtiene todos los productos.
    $productos = $producto->obtenerTodos();
}

// Verifica si la solicitud HTTP es de tipo POST y si el campo 'delete' está presente en la solicitud.
// Esto indica que se ha enviado un formulario de eliminación.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Obtiene el valor del campo 'id' del formulario enviado y lo asigna a la variable $producto_id.
    $producto_id = $_POST['id'];
    // Crea una nueva instancia de la clase 'Productos'.
    $producto = new Productos();
    // Establece el ID del producto a eliminar utilizando el método 'setId' de la clase 'Productos'.
    $producto->setId($producto_id);
    // Llama al método 'eliminar' de la clase 'Productos' para eliminar el producto de la base de datos.
    $producto->eliminar();
    // Redirige al usuario a la página 'lista_productos.php' después de eliminar el producto.
    header('Location: lista_productos.php');
    // Finaliza el script para asegurarse de que no se ejecute ningún código adicional después de la redirección.
    exit;
}
