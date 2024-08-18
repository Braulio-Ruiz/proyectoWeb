<?php

// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.
include __DIR__ . '/../class/autoload.php';

// Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si se ha enviado una solicitud de eliminación de categoría
    if (isset($_POST['delete'])) {
        // Obtiene el valor del campo 'id' del formulario enviado y lo asigna a la variable $categoria_id.
        $categoria_id = isset($_POST['id']) ? trim($_POST['id']) : null;
        // Verifica si el ID de la categoría es válido.
        if ($categoria_id) {
            // Crea una nueva instancia de la clase 'Categorias'.
            $categoria = new Categorias();
            // Establece el ID de la categoría a eliminar utilizando el método 'setId' de la clase 'Categorias'.
            $categoria->setId($categoria_id);
            // Inicia un bloque try-catch para manejar posibles excepciones al eliminar la categoría.
            try {
                // Intenta eliminar la categoría.
                $resultado = $categoria->eliminar();
                // Verifica si la eliminación fue exitosa.
                if ($resultado) {
                    // Envía una respuesta JSON de éxito.
                    header('Content-Type: application/json');
                    echo json_encode(array('success' => true, 'message' => 'Categoría eliminada correctamente.'));
                } else {
                    // Si la eliminación falla, podría ser debido a productos asociados. Muestra un mensaje adecuado.
                    header('Content-Type: application/json');
                    echo json_encode(array('success' => false, 'error' => 'No se pudo eliminar la categoría. Verifica si tiene productos asociados.'));
                }
            } catch (Exception $e) {
                // Maneja la excepción de eliminación fallida (por ejemplo, debido a restricciones de clave foránea).
                header('Content-Type: application/json');
                echo json_encode(array('success' => false, 'error' => 'Error al eliminar la categoría: ' . $e->getMessage()));
            }
            // Finaliza el script para asegurar que no se ejecute ningún código adicional.
            exit;
        } else {
            // Envía una respuesta JSON de error si el ID de la categoría no es válido.
            header('Content-Type: application/json');
            echo json_encode(array('success' => false, 'error' => 'ID de categoría no proporcionado.'));
            exit;
        }
    }
    // Asigna el valor de 'nombre' del formulario POST a la variable $nombre, eliminando espacios en blanco al principio y al final, o null si no está definido.
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    // Verifica si la variable $nombre tiene un valor.
    if ($nombre) {
        // Sanitiza la entrada para evitar XSS.
        $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
        // Crea una nueva instancia de la clase Categorias.
        $categoria = new Categorias();
        // Establece el nombre de la categoría usando el método setNombre().
        $categoria->setNombre($nombre);
        // Guarda la categoría en la base de datos usando el método guardar().
        $categoria->guardar();
        // Redirige al usuario a la página 'lista_categorias.php' en el directorio 'views/'.
        header('Location: views/lista_categorias.php');
        // Finaliza el script para asegurar que no se ejecute ningún código adicional.
        exit;
    } else {
        // Envía una respuesta JSON de error si no se proporcionaron todos los datos necesarios.
        header('Content-Type: application/json');
        echo json_encode(array('success' => false, 'error' => 'Datos no proporcionados.'));
        exit;
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

// Crea una instancia de la clase Categorias.
$categoria = new Categorias();

// Si hay un término de búsqueda, busca las categorías que coincidan.
if (!empty($search)) {
    $categorias = $categoria->buscar($search);
} else {
    // Si no hay búsqueda, obtiene todas las categorías.
    $categorias = $categoria->obtenerTodas();
}
