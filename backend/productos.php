<?php

// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.
include __DIR__ . '/../class/autoload.php';

// Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario.
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : null;
    $precio = isset($_POST['precio']) ? trim($_POST['precio']) : null;
    $categoria_id = isset($_POST['categoria_id']) ? trim($_POST['categoria_id']) : null;
    $imagen = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
    // Sanitizar las entradas para evitar XSS
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
            echo json_encode(array('success' => false, 'error' => 'El archivo no es una imagen.'));
            $uploadOk = 0;
        }
        // Comprobar si el archivo ya existe.
        if (file_exists($target_file)) {
            echo json_encode(array('success' => false, 'error' => 'Lo siento, el archivo ya existe.'));
            $uploadOk = 0;
        }
        // Comprobar el tamaño del archivo.
        if ($_FILES['imagen']['size'] > 500000) { // 500KB max file size.
            echo json_encode(array('success' => false, 'error' => 'Lo siento, tu archivo es demasiado grande.'));
            $uploadOk = 0;
        }
        // Limitar los formatos permitidos.
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo json_encode(array('success' => false, 'error' => 'Lo siento, solo se permiten archivos JPG, JPEG, PNG & GIF.'));
            $uploadOk = 0;
        }
        // Si todo es correcto, mover el archivo al directorio final.
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
                // Crea una nueva instancia de la clase Productos.
                $producto = new Productos();
                // Establece los atributos del producto usando los métodos correspondientes.
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setImagen($imagen);
                $producto->setPrecio($precio);
                $producto->setCategoriaId($categoria_id);
                // Guarda el producto en la base de datos.
                $producto->guardar();
                // Redirige al usuario a la página 'lista_productos.php' en el directorio 'views/'.
                header('Location: views/lista_productos.php');
                exit;
            } else {
                // Si el archivo no se pudo mover, muestra un mensaje de error.
                echo json_encode(array('success' => false, 'error' => 'Error al subir la imagen.'));
            }
        } else {
            // Si el archivo no se pudo subir, muestra un mensaje de error.
            echo json_encode(array('success' => false, 'error' => 'Lo siento, tu archivo no fue subido.'));
        }
    } else {
        // Si los datos no están completos, muestra un mensaje de error.
        echo json_encode(array('success' => false, 'error' => 'Error: Datos no proporcionados.'));
    }
}

// Verifica si el formulario de búsqueda fue enviado (solicitud GET).
if (isset($_GET['search'])) {
    $search = $_GET['search'];
} else {
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Obtiene el valor del campo 'id' del formulario enviado y lo asigna a la variable $producto_id.
    $producto_id = isset($_POST['id']) ? trim($_POST['id']) : null;
    if ($producto_id) {
        // Crea una nueva instancia de la clase 'Productos'.
        $producto = new Productos();
        // Establece el ID del producto a eliminar.
        $producto->setId($producto_id);
        try {
            // Intenta eliminar el producto.
            $resultado = $producto->eliminar();
            // Verifica si la eliminación fue exitosa.
            if ($resultado) {
                // Redirige al usuario a la página 'lista_productos.php' después de eliminar el producto.
                header('Location: lista_productos.php');
                exit;
            } else {
                // Muestra un mensaje de error si la eliminación falló.
                echo json_encode(array('success' => false, 'error' => 'No se pudo eliminar el producto.'));
            }
        } catch (Exception $e) {
            // Muestra un mensaje de error si ocurre una excepción.
            echo json_encode(array('success' => false, 'error' => 'Error al eliminar el producto: ' . $e->getMessage()));
        }
    } else {
        // Muestra un mensaje de error si el ID del producto no es válido.
        echo json_encode(array('success' => false, 'error' => 'ID de producto no proporcionado.'));
    }
    // Finaliza el script para asegurar que no se ejecute ningún código adicional.
    exit;
}
