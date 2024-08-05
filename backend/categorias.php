<?php

// Incluye el archivo 'autoload.php' que se encuentra en el directorio '../class/' para cargar automáticamente las clases necesarias.
include '../class/autoload.php';

// Verifica si la solicitud HTTP es de tipo POST, lo que indica que el formulario fue enviado.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    }
    // Si no se proporcionaron todos los datos necesarios, muestra un mensaje de error.
    else {
        echo "Error: Datos no proporcionados.";
    }
}
