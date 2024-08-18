<?php

// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.
include __DIR__ . '/../class/autoload.php';

// Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si la solicitud es para eliminar una categoría.
    if (isset($_POST['eliminar']) && isset($_POST['id'])) {
        $categoria_id = $_POST['id'];  // Obtiene el ID de la categoría a eliminar.
        // Crea una nueva instancia de la clase 'Categorias'.
        $categoria = new Categorias();
        // Establece el ID de la categoría a eliminar utilizando el método 'setId'.
        $categoria->setId($categoria_id);
        // Manejo de errores al intentar eliminar una categoría con productos asociados.
        try {
            $categoria->eliminar();  // Elimina la categoría de la base de datos.
            // Responde con un mensaje de éxito si la eliminación se realiza correctamente.
            echo json_encode(['success' => true, 'message' => 'Categoría eliminada con éxito.']);
        } catch (PDOException $e) {
            // Si ocurre un error de restricción de clave foránea, envía un mensaje de error específico.
            if ($e->getCode() == 23000) {
                echo json_encode(['success' => false, 'message' => 'Error: No se puede eliminar la categoría porque tiene productos asociados.']);
            } else {
                // En caso de otros errores, envía un mensaje de error genérico.
                echo json_encode(['success' => false, 'message' => 'Error al eliminar la categoría: ' . $e->getMessage()]);
            }
        }
        exit;  // Finaliza el script para asegurarse de que no se ejecute ningún código adicional.
    }
    // Asigna el valor de 'nombre' del formulario POST a la variable $nombre, eliminando espacios en blanco al principio y al final, o null si no está definido.
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
    // Verifica si la variable $nombre tiene un valor.
    if ($nombre) {
        // Sanitiza la entrada para evitar XSS
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
        // Si no se proporcionaron todos los datos necesarios, muestra un mensaje de error.
        echo "Error: Datos no proporcionados.";
    }
}

// Verifica si el formulario de búsqueda fue enviado (solicitud GET)
if (isset($_GET['search'])) {
    // Asigna el valor de la búsqueda a la variable $search
    $search = $_GET['search'];
} else {
    // Si no se realizó ninguna búsqueda, establece $search como una cadena vacía
    $search = '';
}

// Crea una instancia de la clase Categorias
$categoria = new Categorias();

// Si hay un término de búsqueda, busca las categorías que coincidan
if (!empty($search)) {
    $categorias = $categoria->buscar($search);
} else {
    // Si no hay búsqueda, obtiene todas las categorías
    $categorias = $categoria->obtenerTodas();
}

// Verifica si la solicitud HTTP es de tipo POST y si el campo 'delete' está presente en la solicitud.
// Esto indica que se ha enviado un formulario de eliminación.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    // Obtiene el valor del campo 'id' del formulario enviado y lo asigna a la variable $categoria_id.
    $categoria_id = $_POST['id'];
    // Crea una nueva instancia de la clase 'Categorias'.
    $categoria = new Categorias();
    // Establece el ID de la categoría a eliminar utilizando el método 'setId' de la clase 'Categorias'.
    $categoria->setId($categoria_id);
    // Llama al método 'eliminar' de la clase 'Categorias' para eliminar la categoría de la base de datos.
    $categoria->eliminar();
    // Redirige al usuario a la página 'lista_categorias.php' después de eliminar la categoría.
    header('Location: lista_categorias.php');
    // Finaliza el script para asegurarse de que no se ejecute ningún código adicional después de la redirección.
    exit;
}
